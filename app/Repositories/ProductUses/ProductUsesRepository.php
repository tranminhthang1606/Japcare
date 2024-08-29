<?php

namespace App\Repositories\ProductUses;


use App\Models\ProductUses;
use App\Repositories\BaseEloquentRepository;

class ProductUsesRepository extends BaseEloquentRepository implements ProductUsesRepositoryInterface
{

    public function model()
    {
        return ProductUses::class;
    }
}
