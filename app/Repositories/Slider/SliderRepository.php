<?php
namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\BaseEloquentRepository;


class SliderRepository extends BaseEloquentRepository implements SliderRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Slider::class;
    }


}
