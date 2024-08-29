<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Repositories\ArticlesCate\ArticlesCateRepositoryInterface;
use App\Repositories\Articles\ArticlesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Services\AdminService;

class ArticlesController extends BaseController
{
    //
    protected $articlesCateRepository;
    protected $articlesRepository;
    protected $adminService;

    public function __construct(
        ArticlesCateRepositoryInterface $articlesCateRepository,
        ArticlesRepositoryInterface     $articlesRepository,
        AdminService $adminService
    ) {
        $this->middleware(function ($request, $next) {
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('6', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->articlesCateRepository = $articlesCateRepository;
        $this->articlesRepository = $articlesRepository;
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {
        $categories = $this->articlesCateRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title', 'parent_id']);

        $page = $request->page ?: 1;
        $conditions = [];
        $condition_likes = [];
        $num_show = $request->num_show;
        $status = $request->status;
        $keyword = $request->keyword;
        $category_id = $request->category_id;
        if ($keyword) {
            $condition_likes['title'] = $keyword;
        }
        if ($category_id && $category_id != 'all') {
            $conditions['article_category_id'] = $category_id;
        }
        if ($status) {
            $conditions['status'] = $status == 1 ? 1 : 0;
        }
        if ($request->is_featured) {
            $conditions['is_featured'] = $request->is_featured == 1 ? 1 : 0;
        }
        if ($request->is_hot) {
            $conditions['is_hot'] = $request->is_hot == 1 ? 1 : 0;
        }
        $limit = isset($num_show) > 0 ? $num_show : 20;
        $columns = ['id', 'title', 'slug', 'article_category_id', 'thumbnail', 'status', 'is_hot', 'is_featured', 'created_at', 'admin_id'];
        $articles = $this->articlesRepository->paginateWhereLikeOrderBy($conditions, $condition_likes, 'updated_at', 'ASC', $page, $limit, $columns);
        return view('admins.articles.index', compact('articles', 'categories', 'limit'));
    }

    public function create()
    {
        $categories = $this->articlesCateRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title', 'parent_id']);

        return view('admins.articles.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'content_article' => 'required',
            'image' => 'image|max:720000'
        ], [
            '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
            'slug.unique' => 'Slug đã tồn tại, vui lòng kiểm tra lại',
            'image.mimes' => 'Ảnh không đúng định dạng.',
            'image.max' => 'Ảnh quá kích thước.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $article = $this->adminService->addImageWithThumb($request)['arrList'];
            $this->articlesRepository->create($article);

            DB::commit();
            return redirect('/admin/articles')->with('success', 'Tạo bài viết thành công.');
        } catch (\Exception $e) {
            Log::notice("Create articles-categories failed" . $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/articles/create')->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        $article = $this->articlesRepository->findById($id);
        $categories = $this->articlesCateRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title', 'parent_id']);

        return view('admins.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'slug' => 'required|unique:articles,slug,' . $id,
                'description' => 'required',
                'category_id' => 'required',
                'content_article' => 'required',
                'image' => 'image|max:720000'
            ],
            [
                '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
                'slug.unique' => 'Slug đã tồn tại, vui lòng kiểm tra lại',
                'image.max' => 'Ảnh quá kích thước.'
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $flag_img = $this->adminService->addImageWithThumb($request)['flag_photo'];
            $article = $this->adminService->addImageWithThumb($request)['arrList'];
            //delete old image
            if ($request->previous_thumbnail_img && file_exists(public_path() . '/' . $request->previous_thumbnail_img) && $flag_img) {
                unlink(public_path() . '/' . $request->previous_thumbnail_img);
            }
            if ($request->previous_photos && file_exists(public_path() . '/' . $request->previous_photos) && $flag_img) {
                unlink(public_path() . '/' . $request->previous_photos);
            }
            $this->articlesRepository->update($article, $id);

            DB::commit();
            return redirect('/admin/articles')->with('success', 'Cập nhật bài viết thành công.');
        } catch (\Exception $e) {
            Log::notice("Update articles failed" . $e . ' ' . Carbon::now());
            return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            try {
                DB::beginTransaction();
                $article = $this->articlesRepository->findById($id);
                $thumbnail = $article->thumbnail;
                $photos = $article->photos;
                if ($thumbnail != null && file_exists(public_path() . $thumbnail)) {
                    unlink(public_path() . $thumbnail);
                }
                if ($photos != null && file_exists(public_path() . $photos)) {
                    unlink(public_path() . $photos);
                }
                $article->delete();

                DB::commit();
                return redirect('/admin/articles')->with('success', 'Xóa tin tức thành công');
            } catch (\Exception $e) {
                Log::notice("Delete articles failed" . $e . ' ' . Carbon::now());
                return redirect('/admin/articles')->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
            }
        }
    }
}
