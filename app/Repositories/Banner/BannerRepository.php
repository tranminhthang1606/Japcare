<?php


namespace App\Repositories\Banner;


use App\Models\Banner;
use App\Repositories\BaseEloquentRepository;

class BannerRepository extends BaseEloquentRepository implements BannerRepositoryInterface
{

    public function model()
    {
        return Banner::class;
    }
}
