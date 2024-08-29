<?php
namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Ingredient\IngredientRepositoryInterface;
use App\Repositories\ProductUses\ProductUsesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\AdminService;
class ProductUsesController extends Controller
{
    protected $productUsesRepository;
    protected $ingredientRepository;
    protected $adminService;
    public function __construct(
        IngredientRepositoryInterface   $ingredientRepository,
        ProductUsesRepositoryInterface $productUsesRepository,
        AdminService $adminService
    )
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('18', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->productUsesRepository = $productUsesRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {
        $conditions = [];
        $condition_likes = [];
        $limit = $request->num_show ?? 20;
        $page = $request->page ?? 1;
        if ($request->keyword) {
            $condition_likes['title'] = $request->keyword;
        }
        if ($request->status) {
            $conditions['status'] = $request->status == 1 ? 1 : 0;
        }
        $columns = ['id','title','icon_uses','created_by','status'];
        $productUses = $this->productUsesRepository->paginateWhereLikeOrderBy(
            $conditions, $condition_likes, 'updated_at', 'DESC', $page, $limit, $columns
        );
        return view('admins.product_uses.index', compact('productUses'));
    }

    public function create()
    {
        $ingredients = $this->ingredientRepository->findWhere(['status' => 1]);
        return view('admins.product_uses.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ],[
                '*.required' => 'Vui lòng điền trường bắt buộc!.'
            ]);

            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $data = $this->adminService->addImage($request,'product_uses',"storage/uploads/product_uses/",80)['arrList'];

            $this->productUsesRepository->create($data);
            return redirect('/admin/product_uses')->with('success', 'Thêm thành phần thành công!');
        } catch (\Exception $e) {
            Log::notice("Add ProductUse failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/product_uses/create')->with('error', $e->getMessage());
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $productUses = $this->productUsesRepository->findById($id);
        $ingredients = $this->ingredientRepository->findWhere(['status' => 1], ['id','title', 'description']);
        return view('admins.product_uses.edit', compact( 'productUses', 'ingredients') );
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            $data = $this->adminService->addImage($request,'product_uses',"storage/uploads/product_uses/",80)['arrList'];
            $flag_img = $this->adminService->addImage($request,'product_uses',"storage/uploads/product_uses/",80)['flag_photo'];

            if($request->previous_photo && file_exists(public_path().'/'.$request->previous_photo) && $flag_img){
                unlink(public_path().'/'.$request->previous_photo);
            }

            $this->productUsesRepository->update($data, $id);
            return redirect('/admin/product_uses')->with('success', 'Sửa thành phần thành công!');

        } catch (\Exception $e) {
            Log::notice("ProductUse update failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/product_uses')->with('error', 'Sửa ProductUse thất bại!');
        }
    }

    public function destroy($id)
    {
        try {
            if ($this->productUsesRepository->delete($id)) {
                return redirect('/admin/product_uses')->with('success', 'Xóa thành phần thành công!');
            }
        } catch (\Exception $e) {
            Log::notice("ProductUse delete failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/product_uses')->with('error', 'Xóa ProductUse lỗi!');
        }
    }
}
