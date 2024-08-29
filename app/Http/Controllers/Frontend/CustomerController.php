<?php

namespace App\Http\Controllers\Frontend;

use App\Components\FlashMessages;
use App\Http\Controllers\BaseController;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\ViewedProduct\ViewedProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends BaseController
{
    protected $customerRepository;
    protected $viewedProductRepository;
    protected $orderRepository;
    protected $orderDetailRepository;
    use FlashMessages;

    public function __construct(
        CustomerRepositoryInterface      $customerRepository,
        ViewedProductRepositoryInterface $viewedProductRepository,
        OrderRepositoryInterface         $orderRepository,
        OrderDetailRepositoryInterface   $orderDetailRepository
    ){
        $this->customerRepository = $customerRepository;
        $this->viewedProductRepository = $viewedProductRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function index()
    {
        $customer = Auth::guard('customer')->user();

        return view('frontend.customers.index', compact('customer'));
    }

    public function profile()
    {
        $customer = Auth::guard('customer')->user();

        return view('frontend.customers.profile', compact('customer'));
    }
    //changePwd
    public function changePwd(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                    'current_pwd' => 'required|min:6|max:20',
                    'new_pwd' => 'required|different:current_pwd|min:6|max:20',
                    'confirm_new_pwd' => 'required|same:new_pwd'
                ],
                [
                    '*.required' => 'Vui lòng nhập đủ trường bắt buộc.',
                    'current_pwd.min' => 'Mật khẩu tối thiểu 6 ký tự.',
                    'current_pwd.max' => 'Mật khẩu tối đa 20 ký tự.',
                    'new_pwd.min' => 'Mật khẩu tối thiểu 6 ký tự.',
                    'new_pwd.max' => 'Mật khẩu tối đa 20 ký tự.',
                    'confirm_new_pwd.min' => 'Mật khẩu tối thiểu 6 ký tự.',
                    'confirm_new_pwd.max' => 'Mật khẩu tối đa 20 ký tự.',
                    'new_pwd.different' => 'Mật khẩu mới phải khác mật khẩu hiện tại.',
                    'confirm_new_pwd.same' => 'Mật khẩu xác nhận không đúng.'
                ]
            );

            if ($validator->fails()) {
                self::message('danger', $validator->errors()->first());
                return redirect()->back()->withInput();
            }

            $customer = Auth::guard('customer')->user();

            if( Hash::check($request->current_pwd, $customer->password) ){
                $this->customerRepository->update(['password' => Hash::make($request->new_pwd)], $customer->id);
                self::message('success', 'Đổi mật khẩu thành công!');
            }else{
                self::message('danger', 'Mật khẩu không đúng');
            }

            DB::commit();
            return redirect()->route('customer.info');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Create customer failed because $e");
            self::message('danger', 'Tạo tài khoản thất bại! Vui lòng liên hệ CSKH để được hỗ trợ');
            return redirect()->back()->withInput();
        }
    }

    public function purchase_history() {
        $customer = Auth::guard('customer')->user();
        $columns = [
            'id','customer_id', 'code', 'grand_total'
        ];
        $orders = $this->orderRepository->findWhere(['customer_id' => $customer->id], $columns);
        $total = collect($orders)->sum('grand_total');

        $order_detail = array();
        $orderId = $orders->pluck('id')->toArray();
        if (count($orderId) > 0){
            $order_detail = $this->orderDetailRepository->findWhereIn('order_id', $orderId);
        }

        return view('frontend.customers.purchase_history', compact( 'order_detail', 'total', 'customer'));
    }

    public function purchase_history_detail() {
        $customer = Auth::guard('customer')->user();


        return view('frontend.customers.purchase_history');
    }

}
