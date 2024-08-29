<?php


namespace App\Repositories\Category;


use App\Models\Category;
use App\Repositories\BaseEloquentRepository;

class CategoryRepository extends BaseEloquentRepository implements CategoryRepositoryInterface
{

    public function model()
    {
        return Category::class;
    }
}
