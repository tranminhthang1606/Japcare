<?php


namespace App\Repositories\Ward;


use App\Models\Ward;
use App\Repositories\BaseEloquentRepository;

class WardRepository extends BaseEloquentRepository implements WardRepositoryInterface
{
    public function model()
    {
        return Ward::class;
    }
}
