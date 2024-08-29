<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\BoughtProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Repositories\Articles\ArticlesRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\CustomersAddress\CustomersAddressRepositoryInterface;;

use App\Repositories\DeliveryFee\DeliveryFeeRepositoryInterface;
use App\Repositories\District\DistrictRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductSize\ProductSizeRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Ward\WardRepositoryInterface;
class CartService
{
    protected $productRepository;
    protected $productSizeRepository;
    protected $cAddressRepository;
    protected $customerRepository;
    protected $orderRepository;
    protected $orderDetailRepository;
    public function __construct(
        ProductRepositoryInterface          $productRepository,
        ProductSizeRepositoryInterface      $productSizeRepository,
        CustomersAddressRepositoryInterface $cAddressRepository,
        CustomerRepositoryInterface         $customerRepository,
        OrderRepositoryInterface            $orderRepository,
        OrderDetailRepositoryInterface      $orderDetailRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productSizeRepository = $productSizeRepository;
        $this->cAddressRepository = $cAddressRepository;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function addToCart($flag, $request, $product, $product_size, $qty_check)
    {
        $data = array();
        if ($request->product_qty < 0 || $request->product_qty > $product_size->stock) {
            $flag = 0;
            return $flag;
        }

        if ($product && $product_size) {
            if ($request->session()->has('cart')) {
                $cartItem = $request->session()->get('cart', collect([]));
                foreach ($cartItem as $k => $val) {
                    // check isset product
                    if ($val['product_id'] == $request->product_id && $val['product_size_id'] == $request->size_id) {
                        $flag = 2;
                        $qty_check = $val['product_qty'];
                        $cartItem->forget($k);
                        $request->session()->put('cart', $cartItem);
                        break;
                    }
                }
            }

            $data['product_id'] = $product->id;
            // price
            $price = $product_size->price;
            $sale_price = $price;
            if ($product_size->sale_price != null) {
                $sale_price = $product_size->sale_price;
            }

            $data['product_qty'] = $request->product_qty + $qty_check;
            $data['price'] = $price;
            $data['sale_price'] = $sale_price;
            $data['title_size'] = $product_size->title;
            $data['product_size_id'] = $request->size_id;
            $data['product_image'] = $product->featured_img;
            $data['title'] = $product->title;
            $data['slug'] = $product->slug;
            $data['stock'] = $product_size->stock;


            if ($request->product_qty + $qty_check > $product_size->stock) {
                $data['product_qty'] = $product_size->stock;
            }

            if ($request->session()->has('cart')) {
                $cart = $request->session()->get('cart', collect([]));
                $cart->push($data);
                $request->session()->put('cart', $cart);
            } else {
                $cart = collect([$data]);
                $request->session()->put('cart', $cart);
            }

            return $flag;
        } else {
            return $flag;
        }
    }

    public function handleCheckOut(
        $request
    ) {
        DB::beginTransaction();
        $inputCustomer = [
            'full_name' => $request->billing_name,
            'user_name' => $request->billing_phone,
            'phone' => $request->billing_phone,
            'password' => bcrypt('123456'),
            'is_active' => 1
        ];
        $shipping_info = [
            'name' => $request->billing_name,
            'address' => $request->billing_address,
            'phone' => $request->billing_phone,
            'ship_fee' => $request->ship_fee ?: 0
        ];

        if ($request->billing_email) {
            $customerCheck = $this->customerRepository->findWhereFirst(['phone' => $request->billing_phone, 'email' => $request->billing_email]);
            $inputCustomer['email'] = $request->billing_email;
            $shipping_info['email'] = $request->billing_email;
        } else {
            $customerCheck = $this->customerRepository->findWhereFirst(['phone' => $request->billing_phone]);
        }

        if ($customerCheck) {
            $customer_id = $customerCheck->id;
        } else {
            $customerNew = $this->customerRepository->create($inputCustomer);
            $customer_id = $customerNew->id;
            // save address
            $dataAddress = [
                'customer_id' => $customer_id,
                'client_name' => $request->billing_name,
                'client_phone' => $request->billing_phone,
                'province_id' => $request->billing_province,
                'district_id' => $request->billing_district,
                'ward_id' => $request->billing_wards,
                'address' => $request->billing_address,
                'is_default' => 1
            ];
            $this->cAddressRepository->create($dataAddress);
        }

        $orderInput = [
            'customer_id' => $customer_id,
            'customer_name' => $request->billing_name,
            'customer_phone' => $request->billing_phone,
            'shipping_address' => json_encode($shipping_info),
            'payment_method' => $request->payment_method == 'bacs' ? 2 : 1,
            'payment_status' => $request->payment_method == 'bacs' ? 2 : 1,
            'delivery_status' => 1,
            'status' => 1,
            'order_note' => $request->order_note ?: '',
            'code' => date('Ymd-his'),
            'order_at' => strtotime('now'),
            'delivery_fee' => $request->ship_fee ?: 0,
        ];
        $order = $this->orderRepository->create($orderInput);

        //////

        if ($order) {
            $subtotal = 0;

            foreach (Session::get('cart') as $cartItem) {
                $product = $this->productRepository->findById($cartItem['product_id'], ['id', 'status', 'price', 'sale_price']);
                if ($product) {
                    $pricePro = $product->sale_price > 0 ? $product->sale_price : $product->price;
                    $product_size = $this->productSizeRepository->findById($cartItem['product_size_id'], ['id', 'title', 'code', 'stock']);

                    $subtotal += $pricePro * $cartItem['product_qty'];
                    $orderDetail = [
                        'order_id' => $order->id,
                        'product_id' => $cartItem['product_id'],
                        'product_size_id' => $cartItem['product_size_id'],
                        'title_size' => $cartItem['title_size'],
                        'price' => $pricePro * $cartItem['product_qty'],
                        'quantity' => $cartItem['product_qty']
                    ];
                    if (isset($product_size->code)) {
                        $orderDetail['product_code'] = $product_size->code;
                    }


                    // create product detail
                    $this->orderDetailRepository->create($orderDetail);


                    //update stock product_size
                    $prodSizeStock = $cartItem['product_qty'] < $product_size->stock ? ($product_size->stock - $cartItem['product_qty']) : 0;
                    $this->productSizeRepository->update(['stock' => $prodSizeStock], $product_size->id);

                    //save bought products
                    if ($bought_product = BoughtProduct::where('customer_id', $customer_id)->where('product_id', $cartItem['product_id'])->first()) {
                        $bought_product->updated_at = Carbon::now();
                        $bought_product->save();
                    } else {
                        $bought_product = new BoughtProduct();
                        $bought_product->customer_id = $customer_id;
                        $bought_product->product_id = $cartItem['product_id'];
                        $bought_product->save();
                    }
                }
            }
            //cong fee ship
            $subtotal += $request->ship_fee ?: 0;
            // update grand_total
            $this->orderRepository->update(['grand_total' => $subtotal], $order->id);

            Session::put('cart', collect([]));
            DB::commit();
            return 1;
        } else {
            DB::commit();
            return 0;
        }
    }
}
