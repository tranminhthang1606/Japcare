<?php


namespace App\Repositories\Province;


use App\Models\Province;
use App\Repositories\BaseEloquentRepository;

class ProvinceRepository extends BaseEloquentRepository implements ProvinceRepositoryInterface
{
    public function model()
    {
        return Province::class;
    }
}
