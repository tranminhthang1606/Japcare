<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'customer_id',
        'customer_name',
        'customer_phone',
        'shipping_address',
        'payment_method',
        'delivery_status',
        'payment_status',
        'status',
        'order_note',
        'grand_total',
        'delivery_fee',
        'coupon_discount',
        'code',
        'order_at',
        'viewed',
        'deleted_at'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
