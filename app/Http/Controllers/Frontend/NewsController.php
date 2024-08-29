<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ArticleCategory;
use App\Repositories\Eloquent\ArticlesCateEloquentRepository;
use App\Repositories\Eloquent\ArticlesEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NewsController extends BaseController
{
    protected $newsRepository;
    protected $cateNewsRepository;
    protected $searchable = [
        'title',
        'description'
    ];

    public function __construct(
        ArticlesEloquentRepository     $newsRepository,
        ArticlesCateEloquentRepository $cateNewsRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->cateNewsRepository = $cateNewsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        try {
            $columnNews = ['id','title', 'slug', 'content', 'description', 'tags', 'thumbnail', 'status', 'is_featured','created_at'];
            $columnCateNews = ['id','title','slug','description','content','parent_id','status','is_show'];

            $optionsCateNews = [
                'parent_id' => 0 ,
                'status' => 1,
                'is_show' => 1
            ];
            $optionsArticleFeatured = [
                'is_featured' => 1,
                'status' => 1
            ];
            $optionsArticleHot = [
                'is_hot' => 1,
                'status' => 1
            ];

            // new category
            $cateNewsParent = $this->cateNewsRepository->findWhere($optionsCateNews, $columnCateNews);

            // news
            $newsRepository = $this->newsRepository;
            $featured_articles = $newsRepository->findWhereOrderByLimit($optionsArticleFeatured, $columnNews, 'updated_at', 'DESC', 1);
            $hot_articles = $newsRepository->findWhereOrderByLimit($optionsArticleHot, $columnNews, 'updated_at', 'DESC', 4);
            $newestArticles = $newsRepository->findWhereOrderByLimit(['status' => 1], $columnNews, 'updated_at', 'DESC',10);
            return view('frontend.news.index', compact('featured_articles', 'newestArticles' ,'hot_articles', 'cateNewsParent'));
        } catch (\Exception $e) {
            Log::notice("Can not get menu list " . $e . ' ' . Carbon::now());
            abort(404);
        }
    }

    public function newsCategory(Request $request, $slug)
    {
        try {
//            $cateInfo = $this->cateNewsRepository->findByField('slug', $slug, ['id', 'title', 'slug', 'admin_id' ,'description', 'meta_title', 'meta_description', 'created_at']);
//            $limit = 2;
//            $current_page = isset($request->page) ? $request->page : 1;
//            $where = ['status' => 1, 'article_category_id' => $cateInfo->id];
//            $column = ['id', 'title', 'admin_id', 'description', 'thumbnail', 'photos', 'status', 'slug', 'created_at'];
//            $newList = $this->newsRepository->paginateWhere($where, $current_page, $limit, $column);
//            return view('frontend.news.index', compact('newList', 'cateInfo'));

            return view('frontend.news.news_category');
        } catch (\Exception $e) {
            Log::notice("Can not get menu list " . $e . ' ' . Carbon::now());
            abort(404);
        }

    }

    public function show($slug)
    {
        try {
            $column = ['id', 'article_category_id', 'title', 'description', 'admin_id','content', 'thumbnail', 'photos', 'status', 'slug', 'meta_title', 'meta_description', 'created_at'];
            $newsDetail = $this->newsRepository->findByField( 'slug', $slug, $column);
            //
            $where = [
                ['article_category_id' , '=', $newsDetail->article_category_id],
                ['id', '!=', $newsDetail->id]
            ];
            $relatedPost = $this->newsRepository->whereLimit($where, 'updated_at', 'DESC', 6, ['id','title', 'admin_id', 'slug', 'thumbnail', 'photos', 'created_at']);

            return view('frontend.news.show', compact('newsDetail', 'relatedPost'));
        } catch (\Exception $e) {
            Log::notice("Can not get link news " . $e . ' ' . Carbon::now());
            abort(404);
        }
    }

}
