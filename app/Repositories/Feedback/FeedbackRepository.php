<?php
namespace App\Repositories\Feedback;

use App\Models\Feedback;
use App\Repositories\BaseEloquentRepository;


class FeedbackRepository extends BaseEloquentRepository implements FeedbackRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Feedback::class;
    }


}
