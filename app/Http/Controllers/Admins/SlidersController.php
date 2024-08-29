<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Slider\SliderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use App\Services\AdminService;

class SlidersController extends Controller
{
    protected $sliderRepository;
    protected $adminService;
    public function __construct(SliderRepositoryInterface $sliderRepository, AdminService $adminService)
    {
        $this->middleware(function ($request, $next) {
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('11', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });
        $this->sliderRepository = $sliderRepository;
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
        if ($request->type) {
            $conditions['type'] = $request->type;
        }
        if ($request->published) {
            $conditions['published'] = $request->published == 1 ? 1 : 0;
        }

        $columns = ['id', 'title', 'link', 'type', 'photo', 'photo_mb', 'published', 'created_at'];
        $sliders = $this->sliderRepository->paginateWhereLikeOrderBy($conditions, $condition_likes, 'updated_at', 'ASC', $page, $limit, $columns);

        return view('admins.sliders.index', compact('sliders'));
    }

    public function create()
    {

        return view('admins.sliders.add');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'slider_photo' => 'required|image',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            if ($request->file('slider_photo')) {
                $arrList = $this->adminService->addImage($request, 'slider_photo', "storage/uploads/logo_banner/", 1320)['arrList'];
            }
            if ($request->file('slider_photo_mb')) {
                $arrList = $this->adminService->addImage($request, 'slider_photo_mb', "storage/uploads/logo_banner/", 522)['arrList'];
            }

            $this->sliderRepository->create($arrList);
            return redirect('/admin/sliders')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            Log::notice("sliders create failed " . $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/sliders/create')->with('error', 'Thêm thất bại!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dataDetail = $this->sliderRepository->findById($id);

        return view('admins.sliders.edit', compact('dataDetail'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'photo' => 'image',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            $flag_photo = false;
            $flag_photo_mb = false;

            if ($request->file('slider_photo')) {
                $arrList = $this->adminService->addImage($request, 'slider_photo', "storage/uploads/logo_banner/", 1320)['arrList'];
                $flag_photo = $this->adminService->addImage($request, 'slider_photo', "storage/uploads/logo_banner/", 1320)['flag_photo'];
            }
            if ($request->file('slider_photo_mb')) {
                $arrList = $this->adminService->addImage($request, 'slider_photo_mb', "storage/uploads/logo_banner/", 522)['arrList'];
                $flag_photo_mb = $this->adminService->addImage($request, 'slider_photo', "storage/uploads/logo_banner/", 1320)['flag_photo'];
            }

            $this->sliderRepository->update($arrList, $id);

            if ($request->previous_photo != null && file_exists(public_path() . '/' . $request->previous_photo) && $flag_photo) {
                unlink(public_path() . '/' . $request->previous_photo);
            }
            if ($request->previous_photo_mb != null && file_exists(public_path() . '/' . $request->previous_photo_mb) && $flag_photo_mb) {
                unlink(public_path() . '/' . $request->previous_photo_mb);
            }

            return redirect('/admin/sliders')->with('success', 'Sửa slider thành công!');
        } catch (\Exception $e) {
            Log::notice("sliders create failed " . $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/sliders')->with('error', 'Sửa slider thất bại!');
        }
    }

    public function destroy($id)
    {
        try {
            if ($id) {
                $arrList = [
                    'deleted_at' => Carbon::now()->toDateTimeString()
                ];
                $this->sliderRepository->update($arrList, $id);
                return redirect('/admin/sliders')->with('success', 'Xóa slider thành công!');
            }
        } catch (\Exception $e) {
            Log::notice("sliders delete failed " . $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/sliders')->with('error', 'Xóa slider lỗi!');
        }
    }
}
