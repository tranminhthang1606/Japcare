<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
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
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartsController extends BaseController
{
    protected $productRepository;
    protected $productSizeRepository;
    protected $cAddressRepository;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;
    protected $deliveryFeeRepository;
    protected $articleRepository;
    protected $customerRepository;
    protected $orderRepository;
    protected $orderDetailRepository;

    protected $cartService;
    public function __construct(
        ProductRepositoryInterface          $productRepository,
        ProductSizeRepositoryInterface      $productSizeRepository,
        CustomersAddressRepositoryInterface $cAddressRepository,
        ProvinceRepositoryInterface         $provinceRepository,
        DistrictRepositoryInterface         $districtRepository,
        WardRepositoryInterface             $wardRepository,
        DeliveryFeeRepositoryInterface      $deliveryFeeRepository,
        ArticlesRepositoryInterface         $articleRepository,
        CustomerRepositoryInterface         $customerRepository,
        OrderRepositoryInterface            $orderRepository,
        OrderDetailRepositoryInterface      $orderDetailRepository,
        CartService $cartService
    ) {
        $this->productRepository = $productRepository;
        $this->productSizeRepository = $productSizeRepository;
        $this->cAddressRepository = $cAddressRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
        $this->deliveryFeeRepository = $deliveryFeeRepository;
        $this->articleRepository = $articleRepository;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->cartService = $cartService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = array();
        if (Session::has('cart')) {
            // $idProdViewArr = Session::get('cart');
            // $listIdProdSize=[];
            // foreach ($idProdViewArr as $key => $value) {
            //     array_push($listIdProdSize, $value['product_size_id']);
            // }    
            // $column = ['id', 'title', 'featured_img', 'slug', 'status', 'is_new', 'brand_id', 'sale_price', 'price'];
            // $data = $this->productSizeRepository->findWhereIn('id', $listIdProdSize);   

            $data = Session::get('cart');
        }


        $provinces = $this->provinceRepository->all(['matp', 'name', 'type', 'slug']);


        // $articles = $this->articleRepository->findWhereLimit(['status' => 1], 5);      
        return view('frontend.carts.index', compact('data', 'provinces'));
    }

    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findById($request->product_id);
        $product_size = $this->productSizeRepository->findById($request->size_id);
        $qty_check = 0;
        $flag = 1;
        $flag = $this->cartService->addToCart($flag, $request, $product, $product_size, $qty_check);
        if ($flag == 0) {
            return back()->withErrors(['err_noti' => ['Sản phẩm đã hết hàng hoặc số lượng yêu cầu quá lớn!!']]);
        } else {
            return redirect()->route('cart');
        }
    }

    public function previewCart()
    {
        return view('frontend.carts.cart_preview');
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart', collect([]));
            foreach ($cart as $key => $value) {
                if ($value['product_size_id'] == $request->key) {
                    $cart->forget($key);
                    break;
                }
            }
            $request->session()->put('cart', $cart);
        }
        return 1;
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if ($object['product_size_id'] == $request->key) {
                $object['product_qty'] = $request->product_qty;
            }
            return $object;
        });
        $request->session()->put('cart', $cart);

        return 1;
    }

    public function payments()
    {
        $dataAddress = collect([]);
        $infoCustomer =  Auth::guard('customer')->user();
        $provinces = $this->provinceRepository->findWhereOrderBy([], ['matp', 'name'], 'slug', 'asc');
        if ($infoCustomer != null) {
            $customerId = $infoCustomer->id;
            $listAddress = $this->cAddressRepository->findWhereOrderByLimit(['customer_id' => $customerId], array('*'), 'is_default', 'DESC', 1);

            if (count($listAddress) > 0) {
                $dataAddress = $listAddress[0];
            }
        }

        return view('frontend.carts.payment', compact('infoCustomer', 'dataAddress', 'provinces'));
    }

    public function checkout(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'billing_phone' => 'required',
                'billing_name' => 'required',
                'billing_province' => 'required',
                'billing_district' => 'required',
                'billing_wards' => 'required',
                'billing_address' => 'required',
                'payment_method' => 'required',
                'payment_trans' => 'required'
            ]);
            if ($validator->fails()) {
                return back()->withErrors(['err_noti' => ['Xin vui lòng điền đầy đủ thông tin.']]);
            }

            $checkOutStatus = $this->cartService->handleCheckOut(
                $request
            );

            if ($checkOutStatus == 0) {
                return back()->withErrors(['err_noti' => ['Thanh toán không thành công!']]);
            } else {
                return redirect()->route('thank-you');
            }
        } catch (\Exception $exception) {
            Log::notice("payment error: " . $exception->getMessage());
            return back()->withErrors(['err_noti' => ['Lỗi thanh toán đơn hàng, vui lòng thử lại.']]);
        }
    }

    public function thankYou()
    {
        return view('frontend.carts.thank_you');
    }

    public function getShipFeeByProvince(Request $request)
    {
        $fee = $this->deliveryFeeRepository->findWhereFirst(['matp' => $request->matp, 'status' => 'NOW'], ['fee']);
        if ($fee) {
            return $this->responseSuccess($fee);
        } else {
            return $this->responseErrors(404, '', 200);
        }
    }

    public function getDistrictsByProvince(Request $request)
    {
        $districts = $this->districtRepository->findWhereOrderBy(['matp' => $request->matp], ['maqh', 'name'], 'name', 'asc');
        return $this->responseSuccess($districts);
    }

    public function getWardsByProvince(Request $request)
    {
        $wards = $this->wardRepository->findWhereOrderBy(['maqh' => $request->maqh], ['xaid', 'name'], 'name', 'asc');
        return $this->responseSuccess($wards);
    }
}
