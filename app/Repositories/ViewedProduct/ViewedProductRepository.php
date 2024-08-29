<?php


namespace App\Repositories\ViewedProduct;


use App\Models\ViewedProduct;
use App\Repositories\BaseEloquentRepository;

class ViewedProductRepository extends BaseEloquentRepository implements ViewedProductRepositoryInterface
{

    public function model()
    {
        return ViewedProduct::class;
    }
}
