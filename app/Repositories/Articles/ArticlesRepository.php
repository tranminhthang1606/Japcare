<?php
namespace App\Repositories\Articles;

use App\Models\Article;
use App\Repositories\BaseEloquentRepository;


class ArticlesRepository extends BaseEloquentRepository implements ArticlesRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Article::class;
    }


}
