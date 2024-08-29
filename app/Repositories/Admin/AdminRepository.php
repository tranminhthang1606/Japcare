<?php
namespace App\Repositories\Admin;

use App\Models\User;
use App\Repositories\BaseEloquentRepository;


class AdminRepository extends BaseEloquentRepository implements AdminRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }


}
