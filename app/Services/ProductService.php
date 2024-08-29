<?php

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function pushProducts($products)
    {
        $listProducts = [];
        foreach ($products as $i => $product) {
            if ($i == 24) break;
            array_push($listProducts, $product);
        }
        return $listProducts;
    }

    public function paginatePage($current_page, $page_number, $next)
    {
        $page_arr = [];
        if ($next == 'before') {
            for ($i = 1; $i < $current_page; $i++) {
                if ($i > 4 && $i < $current_page - 2) {
                    $page_arr[count($page_arr) - 1] = "...";
                } else {
                    array_push($page_arr, $i);
                }
            }
            return $page_arr;
        } else {
            for ($i = $current_page; $i <= $page_number; $i++) {
                if ($i > $current_page + 3 && $i < $page_number - 2) {
                    $page_arr[count($page_arr) - 1] = "...";
                } else {
                    array_push($page_arr, $i);
                }
            }
            return $page_arr;
        }
    }

    public function searchProduct($request)
    {
        
        $keyword = $request->txtsearch;
        if (!$keyword) {
            return [
                'data' => array(),
                'totalProd' => 0,
                'check'=>"adadadad"
            ];
        }
        

        //search by product
        $totalProd = count($this->productRepository->search($keyword));
        if ($totalProd > 0) {
            $products = $this->productRepository->search($keyword);
            return [
                'data' => $products,
                'totalProd' => $totalProd,
            ];
        } else {
            return [
                'data' => array(),
                'totalProd' => 0,
            ];
        }
    }
}
