<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\AdminService;

class OrderController extends BaseController
{
    protected $orderRepository;
    protected $userRepository;
    protected $adminService;
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        UserRepositoryInterface $userRepository,
        AdminService $adminService
    ) {
        $this->middleware(function ($request, $next) {
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('9', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {
        $page = $request->page;
        $conditions = [];
        $condition_likes = [];
        $num_show = $request->num_show;
        $keyword = $request->keyword;

        if ($request->order_status) {
            $conditions['status'] = $request->order_status;
        }
        if ($request->payment_method) {
            $conditions['payment_method'] = $request->payment_method;
        }
        if ($request->payment_status) {
            $conditions['payment_status'] = $request->payment_status;
        }
        if ($request->delivery_status) {
            $conditions['delivery_status'] = $request->delivery_status;
        }
        if ($keyword) {
            $condition_likes['customer_name'] = $keyword;
            $condition_likes['customer_phone'] = $keyword;
        }

        $limit = isset($num_show) && $num_show > 0 ? $num_show : 20;
        $columns = [
            'id', 'customer_id', 'code', 'grand_total', 'payment_method', 'delivery_fee',
            'payment_status', 'delivery_status', 'status', 'customer_name', 'customer_phone', 'created_at',
        ];

        $orders = $this->orderRepository->paginateWhereLikeOrderBy($conditions, $condition_likes, 'updated_at', 'ASC', $page ?: 1, $limit, $columns);

        return view('admins.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderRepository->findById($id);
        $shipping_address = json_decode($order->shipping_address);

        return view('admins.orders.show', compact('order', 'shipping_address'));
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->orderRepository->delete($id);
            DB::commit();
            return redirect()->route('orders.admin')->with('success', 'Xóa đơn hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Delete order fail because " . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại!');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $order = $this->orderRepository->findById($id);
        if ($order) {
            foreach ($order->orderDetails as $orderDetail) {
                if (!$orderDetail->delete()) {
                    return back()->with('error', 'Delete product failed!');
                }
            }
            if ($order->delete()) {
                DB::commit();
                return redirect()->route('orders.admin')->with('success', 'Delete product successfully.');
            } else {
                return back()->with('error', 'Delete product failed!');
            }
        } else {
            return back()->with('error', 'Delete product failed!');
        }
    }

    public function update_delivery_status(Request $request)
    {
        try {

            DB::beginTransaction();

            $flag = $this->adminService->updateOrderStatus($request, 'delivery_status', $request->delivery_status);

            DB::commit();
            $mess = $flag == 1 ? 'Cập nhật trạng thái giao hàng thành công!' : 'Trạng thái hoặc đơn hàng không tồn tại!';
            return $this->responseDefault($flag, $mess);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("update delivery status fail because " . $e->getMessage());
            return $this->responseDefault(0, "Error! update delivery status fail");
        }
    }

    public function update_payment_status(Request $request)
    {
        try {

            DB::beginTransaction();
            $flag = $this->adminService->updateOrderStatus($request, 'payment_status', $request->payment_status);

            DB::commit();
            $mess = $flag == 1 ? 'Cập nhật trạng thái thanh toán thành công!' : 'Trạng thái hoặc đơn hàng không tồn tại!';
            return $this->responseDefault($flag, $mess);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("update_payment_status fail because " . $e->getMessage());
            return $this->responseDefault(0, "Error! update payment status fail");
        }
    }

    public function update_order_status(Request $request)
    {
        try {

            DB::beginTransaction();
            $flag = $this->adminService->updateOrderStatus($request, 'status', $request->status);
            DB::commit();
            $mess = $flag == 1 ? 'Cập nhật trạng thái đơn thành công!' : 'Trạng thái hoặc đơn hàng không tồn tại!';
            return $this->responseDefault($flag, $mess);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("update order status fail because " . $e->getMessage());
            return $this->responseDefault(0, "Error! update order status fail");
        }
    }
}
