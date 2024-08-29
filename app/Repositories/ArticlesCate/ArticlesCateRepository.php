<?php

namespace App\Repositories\ArticlesCate;
use App\Models\ArticleCategory;
use App\Repositories\BaseEloquentRepository;


class ArticlesCateRepository extends BaseEloquentRepository implements ArticlesCateRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
        return ArticleCategory::class;
    }
}
