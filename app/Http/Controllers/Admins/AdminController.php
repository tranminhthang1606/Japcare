<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Services\AdminService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $adminRepository;
    protected $adminService;

    public function __construct(AdminRepositoryInterface $adminRepository, AdminService $adminService)
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('14', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->adminRepository = $adminRepository;
        $this->adminService = $adminService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $page = $request->page;
        $conditions = [];
        $condition_likes = [];
        $admin_active= $request->isActive;
        $num_show = $request->num_show;
        $keyword = $request->keyword;
        if ($keyword) {
            $condition_likes['name'] = $keyword;
            $condition_likes['phone'] = $keyword;
            $condition_likes['email'] = $keyword;
        }
        if ($admin_active) {
            $conditions['isActive'] = $admin_active == 1 ? 1 : 0;
        }
        $limit = isset($num_show) > 0 ? $num_show : 20;
        $columns = ['id', 'name', 'isAdmin', 'isActive', 'role_id', 'phone', 'email', 'avatar', 'avatar'];
        $admins = $this->adminRepository->paginateWhereLikeOrderBy($conditions, $condition_likes, 'updated_at', 'DESC', $page ?: 1, $limit, $columns);

        return view('admins.admin.index', compact('admins','limit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admins.admin.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'role_id' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:8',
                'password_confirmation' => 'required|same:password',
            ]);
            if($validator->fails()){
                return redirect('/admin/admin/create')->with('error', $validator->errors());
            }

            $arrList = $this->adminService->addImage($request,'file',"storage/uploads/logo_banner/",520)['arrList'];
            $this->adminRepository->create($arrList);

            return redirect('/admin/admin')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            Log::notice("Create admin failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/admin/create')->with('error', 'Thêm thất bại!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $data = $this->adminRepository->findById($id);

        return view('admins.admin.edit', compact('data', 'roles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'role_id' => 'required',
                'email' => 'required|email|unique:users,email,'.$id
            ]);
            if($validator->fails()){
                return redirect('/admin/admin')->with('error', $validator->errors());
            }
            $flag_photo = $this->adminService->addImage($request,'file',"storage/uploads/logo_banner/",520)['flag_photo'];
            $arrList = $this->adminService->addImage($request,'file',"storage/uploads/logo_banner/",520)['arrList'];
            $this->adminRepository->update($arrList,$id);

            if($request->previous_photo != null && file_exists(public_path().'/'.$request->previous_photo) && $flag_photo){
                unlink(public_path().'/'.$request->previous_photo);
            }

            return redirect('/admin/admin')->with('success', 'Sửa thành công!');
        } catch (\Exception $e) {
            Log::notice("Update admin failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/admin')->with('error', 'Sửa tài khoản thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //test commit
        try {
            if ($id) {
                $this->adminRepository->delete($id);
                return redirect('/admin/admin')->with('success', 'Xóa nhân viên thành công!');
            }
        } catch (\Exception $e) {
             Log::notice("Delete Admin  failed " . $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/admin')->with('error', 'Xóa nhân viên thất bại!');
        }
    }
}
