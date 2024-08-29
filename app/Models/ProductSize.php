<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'product_id',
        'photo_color',
        'code',
        'stock',
        'price',
        'sale_price',
        'discount',
        'discount_type',
        'is_default',
        'deleted_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getQuantity($index)
    {
        $qty = session('cart');
        foreach ($qty as $key => $value) {
            if ($value['product_size_id'] == $index) {
                return $value['product_qty'];
            }
        }
    }
}
