<?php


namespace App\Repositories\Review;


use App\Models\Review;
use App\Repositories\BaseEloquentRepository;

class ReviewRepository extends BaseEloquentRepository implements ReviewRepositoryInterface
{

    public function model()
    {
        return Review::class;
    }

    public function getReviews($product_id, $status = 1, $limit = 10) {
        return $this->model->leftJoin('users', 'users.id', '=', 'reviews.user_id')
            ->select('users.avatar', 'reviews.name', 'reviews.rating', 'reviews.comment', 'reviews.images', 'reviews.updated_at')
            ->where('product_id', $product_id)
            ->where('status', $status)
            ->orderBy('updated_at', 'DESC')
            ->limit($limit)
            ->get();
    }
}
