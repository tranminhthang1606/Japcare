<?php


namespace App\Repositories\Brand;


use App\Models\Brand;
use App\Repositories\BaseEloquentRepository;

class BrandRepository extends BaseEloquentRepository implements BrandRepositoryInterface
{
    public function model()
    {
        return Brand::class;
    }
}
