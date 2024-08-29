<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Setting\SettingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Services\AdminService;
class SettingsController extends Controller
{
    protected $settingRepository;
    protected $adminService;
    public function __construct(SettingRepositoryInterface $settingRepository,AdminService $adminService)
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('15', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->settingRepository = $settingRepository;
        $this->adminService = $adminService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $settings = $this->settingRepository->findByField('id', 1);
        $customer_service = json_decode($settings->customer_service);

        return view('admins.settings.index', compact('settings', 'customer_service'));
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
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'st_name_site' => 'required',
                'phone' => 'required'
            ]);

            if($validator->fails()){
                return redirect('/admin/settings')->with('error', $validator->errors());
            }
            $fl_logo = false;
            $fl_logo_footer = false;
            $fl_favicon = false;


            if ($request->file('st_logo')) {
                $arrList = $this->adminService->addImage($request, 'st_logo', "storage/uploads/logo_banner/", 520)['arrList'];
                $fl_logo = $this->adminService->addImage($request, 'st_logo', "storage/uploads/logo_banner/", 520)['flag_photo'];
            }

            if ($request->file('admin_logo')) {
                $arrList = $this->adminService->addImage($request, 'admin_logo', "storage/uploads/logo_banner/", 200);
                $fl_logo_footer = $this->adminService->addImage($request, 'admin_logo', "storage/uploads/logo_banner/", 200)['flag_photo'];
            }

            if ($request->file('favicon')) {
                $arrList = $this->adminService->addImage($request, 'favicon', "storage/uploads/logo_banner/", 32);
                $fl_favicon = $this->adminService->addImage($request, 'favicon', "storage/uploads/logo_banner/", 32)['flag_photo'];
            }



            //handle service
            $save_path_service_img = public_path("storage/uploads/customer_service/");
            $customer_service = [];
            if ($request->service_title) {
                $arrList['customer_service'] = $this->adminService->handleCustomerService($request, $save_path_service_img, $customer_service);
            }

            $this->settingRepository->update($arrList, $id);

            if($request->prv_st_logo && file_exists(public_path().'/'.$request->prv_st_logo) && $fl_logo){
                unlink(public_path().'/'.$request->prv_st_logo);
            }
            if($request->prv_admin_logo && file_exists(public_path().'/'.$request->prv_admin_logo) && $fl_logo_footer){
                unlink(public_path().'/'.$request->prv_admin_logo);
            }
            if($request->prv_favicon && file_exists(public_path().'/'.$request->prv_favicon) && $fl_favicon){
                unlink(public_path().'/'.$request->prv_favicon);
            }

            DB::commit();
            return redirect('/admin/settings')->with('success', 'Update success!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("settings page failed ". $e . ' ' . Carbon::now());
            return redirect('/admin/settings')->with('error', $e->getMessage());
        }
    }

}
