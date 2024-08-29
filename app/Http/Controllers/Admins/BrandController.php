<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\AdminService;

class BrandController extends Controller
{
    protected $brandRepository;
    protected $productRepository;
    protected $adminService;
    public function __construct(BrandRepositoryInterface $brandRepository, ProductRepositoryInterface $productRepository, AdminService $adminService)
    {
        $this->middleware(function ($request, $next) {
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('3', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->adminService = $adminService;
    }
    public function index(Request $request)
    {
        $conditions = [];
        $condition_likes = [];
        $page = $request->page ?? 1;
        $limit = $request->num_show ?? 20;

        if ($request->keyword) {
            $condition_likes['title'] = $request->keyword;
        }
        if ($request->status) {
            $conditions['status'] = $request->status == 1 ? 1 : 0;
        }
        if ($request->top) {
            $conditions['top'] = $request->top == 1 ? 1 : 0;
        }
        $columns = ['id', 'title', 'slug', 'logo', 'top', 'status', 'created_at'];
        $brands =  $this->brandRepository->paginateWhereLikeOrderBy($conditions, $condition_likes, 'updated_at', 'DESC', $page, $limit, $columns);

        return view('admins.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admins.brands.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024000'
            ],
            [
                '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
                'title.max' => 'Tiêu đề tối đa 255 ký tự.',
                'image.mimes' => 'Ảnh không đúng định dạng.',
                'image.max' => 'Ảnh quá kích thước.'
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }
        try {
            DB::beginTransaction();



            $data = $this->adminService->addImage($request, 'logo', "storage/uploads/brands/", 520)['arrList'];
            $this->brandRepository->create($data);

            DB::commit();
            return redirect()->route('brands.index')->with('success', 'Thêm thương hiệu thành công.');
        } catch (\Exception $exception) {
            Log::notice("Add brand failed " . $exception->getMessage() . ' ' . Carbon::now());
            return back()->with('error', 'Thêm thương hiệu thất bại!');
        }
    }

    public function edit($id)
    {
        $brand = $this->brandRepository->findById($id);

        return view('admins.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:200',
            'slug' => 'required|unique:brands,slug,' . $id,
            'logo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024000'
        ], [
            '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
            'slug.unique' => 'Link phải là duy nhất',
            'logo.mimes' => 'Ảnh không đúng định dạng.',
            'logo.max' => 'Ảnh quá kích thước.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }
        try {
            DB::beginTransaction();

            $data = $this->adminService->addImage($request, 'logo', "storage/uploads/brands/", 520)['arrList'];
            $flag_logo = $this->adminService->addImage($request, 'logo', "storage/uploads/brands/", 520)['flag_photo'];
            $this->brandRepository->update($data, $id);

            if ($request->previous_logo && file_exists(public_path() . '/' . $request->previous_logo) && $flag_logo) {
                unlink(public_path() . '/' . $request->previous_logo);
            }

            DB::commit();
            return redirect()->route('brands.index')->with('success', 'Sửa thương hiệu thành công.');
        } catch (\Exception $exception) {
            Log::notice("Update brand failed " . $exception . ' ' . Carbon::now());
            return back()->with('error', 'Sửa thương hiệu thất bại!');
        }
    }

    public function delete($id)
    {
        if (count($this->productRepository->findWhere(['brand_id' => $id]))) {
            return back()->with('error', 'Có sản phẩm thuộc thương hiệu này, hãy kiểm tra!');
        }
        $brand = $this->brandRepository->findById($id);
        $logo = $brand->logo;
        if ($brand->delete()) {
            if ($logo != null && file_exists(public_path() . '/' . $logo)) {
                unlink(public_path() . '/' . $logo);
            }
            return redirect()->route('brands.index')->with('success', 'Xóa thương hiệu thành công.');
        } else {
            return back()->with('error', 'Xóa thương hiệu thất bại!');
        }
    }

    // public function destroy($id)
    // {
    //     if (count($this->productRepository->findWhere(['brand_id' => $id]))) {
    //         return back()->with('error', 'Có sản phẩm thuộc thương hiệu này, hãy kiểm tra!');
    //     }
    //     $brand = $this->brandRepository->findById($id);
    //     $logo = $brand->logo;
    //     if ($brand->delete()) {
    //         if ($logo != null && file_exists(public_path() . '/' . $logo)) {
    //             unlink(public_path() . '/' . $logo);
    //         }
    //         return redirect()->route('brands.index')->with('success', 'Xóa thương hiệu thành công.');
    //     } else {
    //         return back()->with('error', 'Xóa thương hiệu thất bại!');
    //     }
    // }
}
