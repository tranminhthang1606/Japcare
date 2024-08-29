<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseEloquentRepository;

class OrderRepository extends BaseEloquentRepository implements OrderRepositoryInterface
{
    public function model()
    {
        return Order::class;
    }

    public function getData($order_status, $payment_method, $payment_status, $delivery_status, $keyword, $current_page = null, $limit = null, $columns = null)
    {
        $columns = [
            'orders.id', 'orders.customer_id', 'orders.code', 'orders.grand_total', 'orders.payment_method', 'orders.created_at','orders.delivery_fee',
            'orders.payment_status', 'orders.delivery_status', 'orders.status', 'customers.full_name', 'customers.phone', 'customers.user_name'
        ];

        $query = Order::leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.id as ord_id', 'orders.customer_id as customer_id', 'orders.code as code', 'orders.grand_total as grand_total',
                'orders.payment_status as payment_status', 'orders.delivery_status as delivery_status', 'orders.payment_method as payment_method',
                'orders.status as order_status','orders.created_at as created_at', 'customers.full_name as full_name');
        if ($keyword) {
            $query = $query->where(function ($q) use ($keyword) {
                $q->where('customers.full_name', 'LIKE', "%$keyword%")->orWhere('customers.phone', 'LIKE', "%$keyword%")
                    ->orWhere('customers.user_name', 'LIKE', "%$keyword%");
            });
        }
        if($order_status){
            $query = $query->where(function ($q) use ($order_status) {
                $q->where('orders.status', '=', $order_status);
            });
        }
        if($payment_status){
            $query = $query->where(function ($q) use ($payment_status) {
                $q->where('orders.payment_status', '=', $payment_status);
            });
        }
        if($delivery_status){
            $query = $query->where(function ($q) use ($delivery_status) {
                $q->where('orders.delivery_status', '=', $delivery_status);
            });
        }
        if($payment_method){
            $query = $query->where(function ($q) use ($payment_method) {
                $q->where('orders.payment_method', '=', $payment_method);
            });
        }
        return $query->paginate($limit, $columns, 'page', $current_page);
    }
}
