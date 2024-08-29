<?php


namespace App\Repositories\User;


use App\Models\CustomersAddress;
use App\Models\User;
use App\Repositories\BaseEloquentRepository;

class UserRepository extends BaseEloquentRepository implements UserRepositoryInterface
{

    public function model()
    {
        return User::class;
    }
}
