<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'logo',
        'top',
        'status',
        'meta_title',
        'meta_description',
        'deleted_at'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function productsList($limit = 8){
        return $this->hasMany(Product::class, 'brand_id')
            ->select(['products.id','products.title','products.slug','products.featured_img','products.number_sold','products.price','products.sale_price','products.discount'])
            ->where([['products.status', '=', 1], ['products.is_favourite', '=', 1]])
            ->orderBy('updated_at', 'DESC')
            ->limit($limit)->get();
    }

}
