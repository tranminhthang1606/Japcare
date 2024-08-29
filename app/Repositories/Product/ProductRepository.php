<?php


namespace App\Repositories\Product;


use App\Models\Product;
use App\Repositories\BaseEloquentRepository;

class ProductRepository extends BaseEloquentRepository implements ProductRepositoryInterface
{

    public function model()
    {
        return Product::class;
    }

    public function search($keyword)
    {
        $data = Product::where('title', 'LIKE', "%$keyword%")
            ->orderBy('updated_at', 'DESC')
            ->get(['id', 'title', 'featured_img', 'slug', 'price', 'sale_price', 'discount']);
            
            return $data;
    }

    public function filterProducts($price_filter, $color_filter, $size_filter, $sort_filter, $keyword)
    {

        $query = $this->model->select('products.*')->where('products.status', 1);
        if ($keyword) {
            $query = $query->whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", $keyword);
        }
        if ($price_filter && is_array($price_filter)) {
            $start_price = 0;
            $end_price = 5000000000;
            foreach ($price_filter as $i => $price_range) {
                $price_arr = explode('-', $price_range);
                if ($i == 0) {
                    $start_price = $price_arr[0];
                    $end_price = $price_arr[1];
                } else {
                    if ($price_arr[0] < $start_price) $start_price = $price_arr[0];
                    if ($price_arr[1] > $end_price) $end_price = $price_arr[1];
                }
            }
            $query = $query->where('products.price', '>=', $start_price)
                ->where('products.price', '<=', $end_price);
        }
        if ($color_filter && is_array($color_filter)) {
            $query = $query->join('product_colors', 'product_colors.product_id', '=', 'products.id')
                ->whereIn('product_colors.color_id', $color_filter);
        }
        if ($size_filter && is_array($size_filter)) {
            $query = $query->join('product_sizes', 'product_sizes.product_id', '=', 'products.id')
                ->whereIn('product_sizes.title', $size_filter);
        }
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('products.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('products.created_at', 'asc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('products.price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('products.price', 'desc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('products.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('products.title', 'desc');
                    break;
                default:
            }
        }
        return $query->groupBy('products.id', 'products.title', 'products.slug')->get();
    }

    public function filterProductsSale($price_filter, $color_filter, $size_filter, $sort_filter, $keyword)
    {

        $query = $this->model->select('products.*')->where('products.status', 1);
        if ($keyword) {
            $query = $query->whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", $keyword);
        }
        if ($price_filter && is_array($price_filter)) {
            $start_price = 0;
            $end_price = 5000000000;
            foreach ($price_filter as $i => $price_range) {
                $price_arr = explode('-', $price_range);
                if ($i == 0) {
                    $start_price = $price_arr[0];
                    $end_price = $price_arr[1];
                } else {
                    if ($price_arr[0] < $start_price) $start_price = $price_arr[0];
                    if ($price_arr[1] > $end_price) $end_price = $price_arr[1];
                }
            }
            $query = $query->where('products.price', '>=', $start_price)
                ->where('products.price', '<=', $end_price);
        }
        if ($color_filter && is_array($color_filter)) {
            $query = $query->join('product_colors', 'product_colors.product_id', '=', 'products.id')
                ->whereIn('product_colors.color_id', $color_filter);
        }
        if ($size_filter && is_array($size_filter)) {
            $query = $query->join('product_sizes', 'product_sizes.product_id', '=', 'products.id')
                ->whereIn('product_sizes.title', $size_filter);
        }
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('products.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('products.created_at', 'asc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('products.price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('products.price', 'desc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('products.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('products.title', 'desc');
                    break;
                default:
            }
        }
        return $query->groupBy('products.id', 'products.title', 'products.slug')->get();
    }
}
