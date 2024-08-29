<?php

namespace App\Repositories\Policy;

use App\Models\Policy;
use App\Repositories\BaseEloquentRepository;

class PolicyRepository extends BaseEloquentRepository implements PolicyRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Policy::class;
    }
}
