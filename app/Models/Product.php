<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'added_by',
        'category_id',
        'brand_id',
        'featured_img',
        'description',
        'content',
        'featured',
        'status',
        'is_new',
        'is_favourite',
        'price',
        'sale_price',
        'discount',
        'number_sold',
        'uses',
        'txt_uses',
        'ingredients',
        'txt_ingredient',
        'txt_manual',
        'txt_info',
        'meta_title',
        'meta_description',
        'deleted_at'
    ];

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'title'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productSizes(){
        return $this->hasMany(ProductSize::class, 'product_id')->select(['id','title','product_id','price','sale_price','is_default','stock','discount']);
    }

    // public function productColors(){
    //     return $this->hasMany(ProductColor::class, 'product_id');
    // }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id')->where('status', 1);
    }
}
