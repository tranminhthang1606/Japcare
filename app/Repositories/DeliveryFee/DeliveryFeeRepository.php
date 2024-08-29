<?php


namespace App\Repositories\DeliveryFee;


use App\Models\DeliveryFee;
use App\Repositories\BaseEloquentRepository;

class DeliveryFeeRepository extends BaseEloquentRepository implements DeliveryFeeRepositoryInterface
{
    public function model()
    {
        return DeliveryFee::class;
    }
}
