<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Repositories\ArticlesCate\ArticlesCateRepositoryInterface;
use App\Repositories\Articles\ArticlesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\AdminService;
class ArticlesCateController extends BaseController
{
    protected $articlesCateRepository;
    protected $articlesRepository;
    protected $adminService;
    public function __construct(
        ArticlesCateRepositoryInterface $articlesCateRepository,
        ArticlesRepositoryInterface $articlesRepository,
        AdminService $adminService
    ){
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('5', json_decode($roleData->permissions))) {
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
        $page = $request->page;
        $conditions = [];
        $conditions_like = [];
        $num_show = $request->num_show;
        $keyword = $request->keyword;
        if ($keyword) {
            $conditions_like['title'] = $keyword;
        }
        if ($request->status) {
            $conditions['is_favourite'] = $request->status;
        }
        if ($request->is_show) {
            $conditions['status'] = $request->is_show;
        }

        $limit = isset($num_show) > 0 ? $num_show : 20;
        $columns = ['id','title','slug','parent_id','is_show','photos','status','admin_id','created_at'];
        $articles_categories = $this->articlesCateRepository->paginateWhereLikeOrderBy(
            $conditions, $conditions_like, 'updated_at', 'DESC', $page ?: 1, $limit, $columns
        );
        return view('admins.article_categories.index', compact('articles_categories'));
    }

    public function create()
    {
        $parent_categories = $this->articlesCateRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title']);

        return view('admins.article_categories.add', compact('parent_categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content_cate' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024000'
        ],[
            '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
            'image.mimes' => 'Ảnh không đúng định dạng.',
            'image.max' => 'Ảnh quá kích thước.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }

        try {
            
            $articleCate = $this->adminService->addImage($request,'banner',"storage/uploads/categories/",760)['arrList'];
            
            $this->articlesCateRepository->create($articleCate);

            return redirect('/admin/articles-categories')->with('success', 'Thêm mới danh mục tin tức thành công.');
        } catch (\Exception $e) {
            Log::notice("Create articles-categories failed" . $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/articles-categories/create')->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        $parent_categories = $this->articlesCateRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title']);
        $category = $this->articlesCateRepository->findById($id);

        return view('admins.article_categories.edit', compact('category','parent_categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content_cate' => 'required',
            'slug' => 'required|unique:article_categories,slug,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024000'
        ],[
            '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
            'slug.unique' => 'Link phải là duy nhất',
            'image.mimes' => 'Ảnh không đúng định dạng.',
            'image.max' => 'Ảnh quá kích thước.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }

        try {
            
            DB::beginTransaction();
            
            $articleCate = $this->adminService->addImage($request,'banner',"storage/uploads/categories/",760)['arrList'];
            $flag_photo = $this->adminService->addImage($request,'banner',"storage/uploads/categories/",760)['flag_photo'];
            //delete old image
            if($request->previous_photo && file_exists(public_path().'/'.$request->previous_photo) && $flag_photo){
                unlink(public_path().'/'.$request->previous_photo);
            }

            $this->articlesCateRepository->update($articleCate, $id);
            DB::commit();

            return redirect('/admin/articles-categories')->with('success', 'Cập nhật danh mục tin tức thành công.!');
        } catch (\Exception $e) {
            Log::notice("Update articles-categories failed" . $e->getMessage());
            return redirect('/admin/articles-categories')->with('error', 'Có lỗi xảy ra! Vui lòng thử lại');
        }
    }

    public function destroy($id)
    {
        try {
            if ($id) {
                $this->articlesCateRepository->delete($id);
                return redirect('/admin/articles-categories')->with('success', 'Xóa danh mục thành công!');
            }
        } catch (\Exception $e) {
            return redirect('/admin/articles-categories')->with('error', 'Xóa danh mục không thành công!');
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                DB::beginTransaction();
                //check article in category
                $article = $this->articlesRepository->findWhereFirst(['article_category_id' => $id]);
                if ($article) return back()->with('error', 'Có tin tức thuộc danh mục tin tức này. Hãy kiểm tra.');

                $category = $this->articlesCateRepository->findById($id);
                $photos = $category->photos;
                //delete old image
                if($photos && file_exists(public_path().'/'.$photos)){
                    unlink(public_path().'/'.$photos);
                }
                $category->delete();

                DB::commit();
                return redirect('/admin/articles-categories')->with('success', 'Xóa danh mục tin tức thành công.');
            }
        } catch (\Exception $e) {
            return redirect('/admin/articles-categories')->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }

    public function updateSortOrder(Request $request) {
        $category_id = $request->category_id;
        $parent_id = $request->parent_id;
        $change = $request->change;
        $arrCategorySameLevel = ArticleCategory::where(['parent_id' => $parent_id, 'status' => 1, 'deleted_at' => null])->orderBy('sort_order', $change == 'up' ? 'desc' : 'asc')->get();
        $isChange = false;
        if ($change == 'up') {
            $i = count($arrCategorySameLevel);
            foreach ($arrCategorySameLevel as $categorySameLevel) {
                if ($categorySameLevel->id == $category_id) {
                    $categorySameLevel->sort_order = $i - 1;
                    $categorySameLevel->save();
                    $isChange = true;
                } else {
                    if ($isChange) {
                        $categorySameLevel->sort_order = $i + 1;
                        $categorySameLevel->save();
                        $isChange = false;
                    } else {
                        $categorySameLevel->sort_order = $i;
                        $categorySameLevel->save();
                    }
                }
                $i--;
            }
        } else {
            $i = 1;
            foreach ($arrCategorySameLevel as $categorySameLevel) {
                if ($categorySameLevel->id == $category_id) {
                    $categorySameLevel->sort_order = $i + 1;
                    $categorySameLevel->save();
                    $isChange = true;
                } else {
                    if ($isChange) {
                        $categorySameLevel->sort_order = $i - 1;
                        $categorySameLevel->save();
                        $isChange = false;
                    } else {
                        $categorySameLevel->sort_order = $i;
                        $categorySameLevel->save();
                    }
                }
                $i++;
            }
        }
        $menus = ArticleCategory::where(['parent_id' => 0, 'status' => 1, 'deleted_at' => null])->orderBy('sort_order')->get();
        return response()->json([
            'status' => 200,
            'data' => $menus
        ]);
    }
}
