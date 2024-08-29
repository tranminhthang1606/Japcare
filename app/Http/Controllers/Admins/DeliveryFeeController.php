<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\DeliveryFee\DeliveryFeeRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeliveryFeeController extends Controller
{
    protected $deliveryFeeRepository;
    protected $provinceRepository;
    public function __construct(DeliveryFeeRepositoryInterface $deliveryFeeRepository, ProvinceRepositoryInterface $provinceRepository)
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('16', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->deliveryFeeRepository = $deliveryFeeRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request)
    {
        $provinces = $this->provinceRepository->findWhereOrderBy([], ['matp', 'name'], 'slug', 'asc');

        $page = $request->page;
        $conditions = [];
        $num_show = $request->num_show;
        $matp = $request->matp;
        $status = $request->status;
        if ($matp) {
            $conditions['matp'] = $matp;
        }
        if ($status) {
            $conditions['status '] = $status;
        }

        $limit = isset($num_show) > 0 ? $num_show : 20;
        $fees = $this->deliveryFeeRepository->paginateWhereOrderBy($conditions, 'matp', 'ASC', $page ?: 1, $limit);
        return view('admins.delivery_fees.index', compact('fees', 'provinces', 'limit'));
    }

    public function create() {
        $provinces = $this->provinceRepository->findWhereOrderBy([], ['matp', 'name'], 'slug', 'asc');
        return view('admins.delivery_fees.add', ['provinces' => $provinces]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'matp' => 'required',
                'fee' => 'required',
            ],
                [
                    '*.required' => 'Vui lòng điền đầy  đủ thông tin.',
                ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $check = $this->deliveryFeeRepository->findWhereFirst(['matp' => $request->matp, 'status' => 'NOW'], ['id']);
            if ($check) return back()->withInput()->with('error', 'Tỉnh/Thành phố này đã được cập nhật phí vận chuyển.');

            $data = [
                'matp' => $request->matp,
                'fee' => str_replace(',', '', $request->fee),
                'admin_id' => Auth::id(),
                'status' => 'NOW',
            ];
            $this->deliveryFeeRepository->create($data);

            DB::commit();
            return redirect('/admin/delivery_fees')->with('success', 'Thêm phí vận chuyển thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Create delivery fee failed because " . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        $fee = $this->deliveryFeeRepository->findById($id);
        if (!$fee) return back()->with('error', 'Phí vận chuyển không tồn tại.');

        $provinces = $this->provinceRepository->findWhereOrderBy([], ['matp', 'name'], 'slug', 'asc');

        return view('admins.delivery_fees.edit', compact('fee', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'fee' => 'required',
            ],
                [
                    '*.required' => 'Vui lòng điền đầy  đủ thông tin.',
                ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $delv_fee = $this->deliveryFeeRepository->findById($id);
            if (!$delv_fee) return back()->with('error', 'Phí vận chuyển không tồn tại.');

            $fee = str_replace(',', '', $request->fee);
            if ($fee == $delv_fee->fee) return back()->withInput()->with('error', 'Phí vận chuyển không có thay đổi.');

            $this->deliveryFeeRepository->update([
                'admin_change' => Auth::id(),
                'time_change' => date('Y-m-d H:i:s'),
                'status' => 'OLD',
            ], $id);

            $data = [
                'matp' => $delv_fee->matp,
                'fee' => str_replace(',', '', $request->fee),
                'admin_id' => Auth::id(),
                'status' => 'NOW',
            ];
            $this->deliveryFeeRepository->create($data);

            DB::commit();
            return redirect('/admin/delivery_fees')->with('success', 'Sửa vận chuyển thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Update delivery fee failed because " . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $fee = $this->deliveryFeeRepository->findById($id);

            if (!$fee) return back()->with('error', 'Phí vận chuyển không tồn tại.');

            $fee->delete();

            DB::commit();
            return redirect('/admin/delivery_fees')->with('success', 'Xóa phí vận chuyển thành công');
        } catch (\Exception $e) {
            Log::notice("Delete delivery fee failed" . $e . ' ' . Carbon::now());
            return redirect('/admin/delivery_fees')->with('error', 'Có lỗi xảy ra! Vui lòng thử lại.');
        }
    }
}
