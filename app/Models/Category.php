<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'description',
        'image',
        'icon_menu',
        'featured',
        'is_menu',
        'status',
        'added_by',
        'meta_title',
        'meta_description',
        'deleted_at',
        'sort_order'
    ];

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->where([['parent_id', '<>', null], ['status', '=', 1]])
            ->orderBy('sort_order', 'ASC');
    }

    public function childrenMain()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->where([['parent_id', '<>', null], ['status', '=', 1],['is_menu', '=', 1]])
            ->orderBy('sort_order', 'ASC');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))
            ->where([['parent_id', '=', null], ['status', '=', 1], ['is_menu', '=', 1]])
            ->orderBy('sort_order', 'ASC')
            ->get(['id','title','image','icon_menu','slug','parent_id']);
    }

    public function products($limit = 8){
        return $this->hasMany(Product::class, 'category_id')
                ->select(['products.id','products.title','products.slug','products.featured_img','products.number_sold','products.price','products.sale_price','products.discount'])
                ->where([['products.status', '=', 1]])
                ->orderBy('updated_at', 'DESC')
                ->limit($limit)->get();
    }

    public function productsCate($limit = 8){
        return $this->hasMany(Product::class, 'category_id')
            ->select(['products.id','products.title','products.slug','products.featured_img','products.number_sold','products.price','products.sale_price','products.discount'])
            ->where([['products.status', '=', 1]])
            ->orderBy('updated_at', 'DESC')
            ->limit($limit);
    }

    public function subproducts($limit = 8)
    {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'category_id')
            ->select(['products.id','products.title','products.slug','products.featured_img','products.number_sold','products.price','products.sale_price','products.discount'])
            ->where([['products.status', '=', 1]])
            ->orderBy('products.updated_at', 'DESC')
            ->limit($limit);
    }

    public function allproducts($limit = 8)
    {
        $products = $this->productsCate()->get()->merge($this->subproducts()->get());
        return $products->sortByDesc('updated_at')->take($limit);
    }

    public function paginateproducts($limit = 24)
    {
        $products = $this->productsCate()->get()->merge($this->subproducts()->get());
        return $products->sortByDesc('updated_at')->paginate($limit);
    }
}
