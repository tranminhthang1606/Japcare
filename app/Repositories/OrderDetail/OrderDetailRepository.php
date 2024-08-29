<?php


namespace App\Repositories\OrderDetail;


use App\Models\OrderDetail;
use App\Repositories\BaseEloquentRepository;

class OrderDetailRepository extends BaseEloquentRepository implements OrderDetailRepositoryInterface
{
    public function model()
    {
        return OrderDetail::class;
    }
}
