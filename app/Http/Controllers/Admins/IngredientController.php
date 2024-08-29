<?php
namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Ingredient\IngredientRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
    protected $_ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
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

        $this->_ingredientRepository = $ingredientRepository;
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
        $columns = ['id','title','description','created_by','status'];
        $ingredients = $this->_ingredientRepository->paginateWhereLikeOrderBy(
            $conditions, $condition_likes, 'updated_at', 'ASC', $page ?: 1, $limit, $columns
        );
        return view('admins.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('admins.ingredients.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);

            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'created_by' => auth()->id(),
                'status' => $request->status ? 1 : 0,
            ];
            $this->_ingredientRepository->create($data);
            return redirect('/admin/ingredients')->with('success', 'Thêm thành phần thành công!');
        } catch (\Exception $e) {
            Log::notice("Add ingredient failed ". $e->getMessage() );
            return redirect('/admin/ingredients/create')->with('error', 'Thêm thành phần lỗi!');
        }

    }

    public function edit($id)
    {
        $ingredient = $this->_ingredientRepository->findById($id);

        return view('admins.ingredients.edit', compact( 'ingredient') );
    }

    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ],[
                '*.required' => 'Vui lòng điền đầy  đủ thông tin.',
            ]);
            if($validator->fails()){
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'created_by' => auth()->id(),
                'status' => $request->status ? 1 : 0,
            ];

            $this->_ingredientRepository->update($data, $id);
            return redirect('/admin/ingredients')->with('success', 'Sửa thành phần thành công!');

        } catch (\Exception $e) {
            Log::notice("Ingredient update failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/ingredients')->with('error', 'Sửa ingredient thất bại!');
        }
    }

    public function destroy($id)
    {
        try {
            if ($this->_ingredientRepository->delete($id)) {
                return redirect('/admin/ingredients')->with('success', 'Xóa thành phần thành công!');
            }
        } catch (\Exception $e) {
            Log::notice("Ingredient delete failed ". $e->getMessage() . ' ' . Carbon::now());
            return redirect('/admin/ingredients')->with('error', 'Xóa ingredients lỗi!');
        }
    }
}
