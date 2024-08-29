<?php
namespace App\Repositories\Setting;

use App\Models\Setting;
use App\Repositories\BaseEloquentRepository;


class SettingRepository extends BaseEloquentRepository implements SettingRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Setting::class;
    }


}
