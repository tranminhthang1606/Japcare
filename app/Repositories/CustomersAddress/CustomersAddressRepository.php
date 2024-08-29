<?php

namespace App\Repositories\CustomersAddress;

use App\Models\CustomersAddress;
use App\Repositories\BaseEloquentRepository;

class CustomersAddressRepository extends BaseEloquentRepository implements CustomersAddressRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
        return CustomersAddress::class;
    }
}
