<?php


namespace App\Repositories\District;


use App\Models\District;
use App\Repositories\BaseEloquentRepository;

class DistrictRepository extends BaseEloquentRepository implements DistrictRepositoryInterface
{

    public function model()
    {
        return District::class;
    }
}
