<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\BaseController;
use App\Models\BoughtProduct;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Role;
use App\Models\ViewedProduct;
use App\Repositories\BoughtProduct\BoughtProductRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ViewedProduct\ViewedProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends BaseController
{
    protected $customerRepository;
    protected $orderRepository;
    protected $productRepository;
    protected $boughtProdRepository;
    protected $viewedProductRepository;

    public function __construct(
        CustomerRepositoryInterface  $customerRepository,
        OrderRepositoryInterface     $orderRepository,
        ProductRepositoryInterface   $productRepository,
        BoughtProductRepositoryInterface $boughtProdRepository,
        ViewedProductRepositoryInterface $viewedProductRepository
    )
    {
        $this->middleware(function ($request, $next) {
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('8', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->boughtProdRepository = $boughtProdRepository;
        $this->viewedProductRepository = $viewedProductRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $conditions = [];
        $condition_likes = [];
        $limit = $request->num_show ?? 20;
        $page = $request->page ?? 1;
        if($request->keyword){
            $condition_likes['full_name'] = $request->keyword;
            $condition_likes['phone'] = $request->keyword;
            $condition_likes['email'] = $request->keyword;
        }

        $columns = ['id','full_name','user_name','phone','email','sex','birthdate'];
        $customers = $this->customerRepository->paginateWhereLikeOrderBy($conditions, $condition_likes,'updated_at', 'ASC', $page, $limit, $columns);
        return view('admins.customers.index', compact('customers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($id) {
                Order::where('customer_id ', $id)->delete();
                if(Customer::destroy($id)){
                    return redirect('/admin/customers')->with('success', 'Xóa khách hàng thành công!');
                }

                return redirect('/admin/customers')->with('success', 'Xóa khách hàng thành công!');
            }
        } catch (\Exception $e) {
            Log::notice("Delete customer  failed " . $e->getMessage(). ' ' . Carbon::now());
            return redirect('/admin/customers')->with('error', 'Xóa khách hàng thất bại!');
        }
    }

    public function viewed_products($customer_id) {
        $customer = $this->customerRepository->findById($customer_id);
        $data = ViewedProduct::join('products', 'products.id', '=', 'viewed_products.product_id')
            ->select('products.*')
            ->where('viewed_products.customer_id', $customer_id)
            ->get();

        return view('admins.customers.viewed_products', compact('data', 'customer'));
    }

    public function bought_products($customer_id)
    {
        $data = array();
        $customer = $this->customerRepository->findById($customer_id);
        // get prod id
        $boughtProduct = $this->boughtProdRepository->findWhere(['customer_id' => $customer_id], ['id','product_id']);
        $idProdArr = $boughtProduct->pluck('product_id')->toArray();

        if(count($idProdArr) > 0){
            $column = ['id','title','featured_img','slug','status','brand_id','sale_price','price'];
            $data = $this->productRepository->findWhereIn('id', $idProdArr, $column);
        }

        return view('admins.customers.bought_products', compact('data', 'customer'));
    }

    public function orders($customer_id) {
        $customer = $this->customerRepository->findById($customer_id);
        $columns = [
            'id','customer_id', 'code', 'grand_total', 'payment_method', 'delivery_fee',
            'payment_status', 'delivery_status', 'status', 'customer_name', 'customer_phone','created_at',
        ];
        $data = $this->orderRepository->findWhere(['customer_id' => $customer_id], $columns);

        return view('admins.customers.orders', compact('data', 'customer'));
    }
}
