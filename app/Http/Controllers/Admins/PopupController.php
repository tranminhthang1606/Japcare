<?php
namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Popup\PopupRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\AdminService;
class PopupController extends Controller
{
    protected $_popupRepository;
    protected $adminService;

    public function __construct(PopupRepositoryInterface $popupRepository,AdminService $adminService)
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('10', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->_popupRepository = $popupRepository;
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {
        $page = $request->page;
        $conditions = [];
        $condition_likes = [];
        $status = $request->status;
        $num_show = $request->num_show;
        $keyword = $request->keyword;
        if ($keyword) {
            $condition_likes['title'] = $keyword;
        }
        if ($status) {
            $conditions['status'] = $status == 1 ? 1 : 0;
        }
        $limit = isset($num_show) > 0 ? $num_show : 20;
        $columns = ['id','title','image','link','status','created_at','deleted_at'];
        $popups = $this->_popupRepository->paginateWhereLikeOrderBy(
            $conditions, $condition_likes, 'updated_at', 'ASC', $page ?: 1, $limit, $columns
        );
        return view('admins.popups.index', compact('popups'));
    }

    public function create()
    {
        return view('admins.popups.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'pop_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024000',
            ]);
            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            
            $data = $this->adminService->addImage($request,'pop_image',"storage/uploads/popups/",520)['arrList'];

            $this->_popupRepository->create($data);
            return redirect('/admin/popups')->with('success', 'Thêm popup thành công!');
        } catch (\Exception $e) {
            Log::notice("Add popup failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/popups/create')->with('error', $e->getMessage());
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $popup = $this->_popupRepository->findById($id);

        return view('admins.popups.edit', compact( 'popup') );
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'pop_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024000',
            ]);
            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }

           $flag_img = $this->adminService->addImage($request,'pop_image',"storage/uploads/popups/",520)['flag_photo'];
           $data = $this->adminService->addImage($request,'pop_image',"storage/uploads/popups/",520)['arrList'];

            if($request->previous_photo && file_exists(public_path().'/'.$request->previous_photo) && $flag_img){
                unlink(public_path().'/'.$request->previous_photo);
            }
            $this->_popupRepository->update($data, $id);
            return redirect('/admin/popups')->with('success', 'Sửa popup thành công!');

        } catch (\Exception $e) {
            Log::notice("Popup update failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/popups')->with('error', 'Sửa popup thất bại!');
        }
    }

    public function destroy($id)
    {
        try {
            if ($this->_popupRepository->delete($id)) {
                return redirect('/admin/popups')->with('success', 'Xóa popup thành công!');
            }
        } catch (\Exception $e) {
            Log::notice("Popup delete failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/popups')->with('error', 'Xóa popup lỗi!');
        }
    }
}
