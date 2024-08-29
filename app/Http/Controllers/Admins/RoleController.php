<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function __construct()
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admins.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'permissions' => 'required'
            ]);
            if($validator->fails()){
                return redirect('/admin/roles/create')->with('error', $validator->errors());
            }

            $role = new Role();
            $role->name = $request->name;
            $role->permissions = json_encode($request->permissions);
            if($role->save()){
                return redirect('/admin/roles')->with('success', 'Thêm quyền thành công!');
            }else{
                return redirect('/admin/roles/create')->with('error', 'Thêm quyền thất bại!');
            }

        }catch (\Exception $e) {
            return redirect('/admin/roles/create')->with('error', 'Thêm quyền thất bại!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataDetail = Role::findOrFail($id);
        $permissions = json_decode($dataDetail->permissions);

        return view('admins.roles.edit', compact('dataDetail', 'permissions'));
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
            $role = Role::findOrFail($id);
            if($request->has('permissions')){
                $role->name = $request->name;
                $role->permissions = json_encode($request->permissions);
                if($role->save()){
                    return redirect('/admin/roles')->with('success', 'Sửa quyền thành công!');
                }
            }

            return redirect('/admin/roles')->with('success', 'Sửa quyền thất bại!');
        } catch (\Exception $e) {
            return redirect('/admin/roles')->with('error', 'Sửa quyền thất bại!');
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
        try {
            if (Role::destroy($id) ) {
                return redirect('/admin/roles')->with('success', 'Xóa thành công!');
            }
        } catch (\Exception $e) {
            return redirect('/admin/roles')->with('error', 'Xóa quyền lỗi!');
        }
    }
}
