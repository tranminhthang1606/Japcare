<?php


namespace App\Repositories\BoughtProduct;


use App\Models\BoughtProduct;
use App\Repositories\BaseEloquentRepository;

class BoughtProductRepository extends BaseEloquentRepository implements BoughtProductRepositoryInterface
{

    public function model()
    {
        return BoughtProduct::class;
    }
}
