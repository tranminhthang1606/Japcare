<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\BaseController;
use App\Models\Policy;
use App\Models\Role;
use App\Repositories\Policy\PolicyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function abort;
use function back;
use function view;

class PolicyController extends BaseController
{
    protected $policyRepository;

    public function __construct(PolicyRepositoryInterface $policyRepository)
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('13', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->policyRepository = $policyRepository;
    }

    public function index($type)
    {
        $policy = Policy::where('name', $type)->first();
        if (!$policy) {
            //create page not in data
            if (in_array($type,
                [
                    'about_us', //giới thiệu
                    'contact_us', //liên hệ
                    'warranty_exchange',//đổi trả
                    'privacy_policy',//bảo mật
                    'terms_of_service',//điều khoản dịch vụ - đặt hàng
                    'purchase_pay',//thanh toán
                    'delivery_policy',//vận chuyển
                    'price_policy',//giá cả
                    'use_manual', //sử dụng và bảo quản
                ])) {
                $policy = $this->policyRepository->create([
                    'name' => $type,
                    'content' => $type
                ]);
            } else {
                abort(404);
            }
        }
        return view('admins.policies.index', [
            'policy' => $policy
        ]);
    }

    //updates the policy pages
    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'title_page' => 'required|max:255',
            ]);
            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            DB::beginTransaction();
            $policy = $this->policyRepository->findWhereFirst(['name' => $request->name]);
            if (!$policy) return back()->withInput()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
            $policy->name = $request->get('name');
            $policy->title_page = $request->get('title_page');
            $policy->content = $request->get('content_policy');
            $policy->meta_title = $request->get('meta_title');
            $policy->meta_description = $request->get('meta_description');
            $policy->save();
            DB::commit();
            return back()->with('success', 'Cập nhật trang thành công.');
        } catch (\Exception $e) {
            Log::notice("Policy update failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/banners')->with('error', 'Cập nhật trang thất bại!');
        }
    }
}
