<?php


namespace App\Repositories\ProductSize;


use App\Models\ProductSize;
use App\Repositories\BaseEloquentRepository;

class ProductSizeRepository extends BaseEloquentRepository implements ProductSizeRepositoryInterface
{

    public function model()
    {
        return ProductSize::class;
    }
}
