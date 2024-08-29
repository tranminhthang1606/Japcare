<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\AdminService;
class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    protected $adminService;
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        AdminService $adminService
    )
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('1', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->adminService = $adminService;
    }
    public function index(Request $request)
    {
        $page = $request->page ?: 1;
        $limit = $request->num_show ?: 20;

        $conditions = [];
        $condition_likes = [];
        $featured= $request->featured;
        $is_menu = $request->is_menu;
        $status = $request->status;

        $keyword = $request->keyword;
        if ($keyword) {
            $condition_likes['title'] = $keyword;
        }
        if ($featured) {
            $conditions['featured'] = $featured == 1 ? 1 : 0;
        }
        if ($is_menu) {
            $conditions['is_menu'] = $is_menu == 1 ? 1 : 0;
        }
        if ($status) {
            $conditions['status'] = $status == 1 ? 1 : 0;
        }

        $columns = ['id','parent_id','title','slug','icon_menu','image','featured','is_menu','status','added_by'];
        $categories = $this->categoryRepository->paginateWhereLikeOrderBy($conditions, $condition_likes, 'updated_at', 'DESC', $page, $limit, $columns);

        return view('admins.categories.index',compact('categories'));
    }

    public function create()
    {
        $parent_categories = $this->categoryRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title']);

        return view('admins.categories.create', compact('parent_categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'title.max' => 'Tiêu đề tồi đa 255 ký tự',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:720000'
        ],
        [
            '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
            'title.max' => 'Tiêu đề tồi đa 255 ký tự',
            'image.mimes' => 'Ảnh không đúng định dạng.',
            'image.max' => 'Ảnh quá kích thước 720px.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }
        try {
            DB::beginTransaction();
        
            $data = $this->adminService->addImage($request,'image',"storage/uploads/categories/",720)['arrList'];
            $this->categoryRepository->create($data);

            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công.');
        } catch (\Exception $exception) {
            Log::notice("Add category failed ". $exception . ' ' . Carbon::now());
            return back()->with('error', 'Thêm danh mục lỗi từ hệ thống!');
        }
    }

    public function show() {}

    public function edit($id)
    {
        $category = $this->categoryRepository->findById($id);
        $parent_categories = $this->categoryRepository->findWhere(['parent_id' => null, 'status' => 1], ['id', 'title']);

        return view('admins.categories.edit', compact('category', 'parent_categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:720000'
        ],
        [
            '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
            'title.max' => 'Tiêu đề tồi đa 255 ký tự',
            'slug.unique' => 'Slug đã tồn tại, vui lòng kiểm tra lại',
            'image.mimes' => 'Ảnh không đúng định dạng.',
            'image.max' => 'Ảnh quá kích thước.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }
        try {
            DB::beginTransaction();
            $data = $this->adminService->addImage($request,'image',"storage/uploads/categories/",720)['arrList'];
            $flag_photo = $this->adminService->addImage($request,'image',"storage/uploads/categories/",720)['flag_photo'];
            $this->categoryRepository->update($data, $id);
            if($request->previous_image && file_exists(public_path().'/'.$request->previous_image) && $flag_photo){
                unlink(public_path().'/'.$request->previous_image);
            }
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Update category successfully.');
        } catch (\Exception $exception) {
            Log::notice("Update category failed ". $exception->getMessage() . ' ' . Carbon::now());
            return back()->with('error', 'Update category failed!');
        }
    }

    public function delete($id)
    {
        if (count($this->productRepository->findWhere(['category_id' => $id]))) {
            return back()->with('error', 'Có sản phẩm thuộc danh mục này, hãy kiểm tra!');
        }
        if ($this->categoryRepository->delete($id)) {
            return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
        } else {
            return back()->with('error', 'Xóa danh mục thất bại!');
        }
    }

    public function sortCategory()
    {
        $menus = $this->categoryRepository->findWhereOrderBy(['parent_id' => null, 'status' => 1], array('*'), 'sort_order', 'ASC');
        return view('admins.categories.sort', compact( 'menus'));
    }

    public function updateSortOrder(Request $request) {


        $this->adminService->handleCategorySameLevel($request);
        $menus = $this->categoryRepository->findWhereOrderBy(['parent_id' => null, 'status' => 1], array('*'), 'sort_order', 'ASC');
        return response()->json([
            'status' => 200,
            'data' => $menus
        ]);
    }
}
