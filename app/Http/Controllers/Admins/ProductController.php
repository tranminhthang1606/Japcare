<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Ingredient\IngredientRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductSize\ProductSizeRepositoryInterface;
use App\Repositories\ProductUses\ProductUsesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\AdminService;
class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $productSizeRepository;
    protected $brandRepository;
    protected $ingredientRepository;
    protected $prodUsesRepository;

    protected $adminService;

    public function __construct(
        CategoryRepositoryInterface     $categoryRepository,
        ProductRepositoryInterface      $productRepository,
        ProductSizeRepositoryInterface  $productSizeRepository,
        BrandRepositoryInterface        $brandRepository,
        IngredientRepositoryInterface   $ingredientRepository,
        ProductUsesRepositoryInterface  $productUsesRepository,
        AdminService $adminService
    )
    {
        $this->middleware(function ($request, $next) {
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('2', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productSizeRepository = $productSizeRepository;
        $this->brandRepository = $brandRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->prodUsesRepository = $productUsesRepository;
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {
        $allBrands = $this->brandRepository->findWhereOrderBy(['status' => 1], ['id', 'title', 'slug'], 'title', 'ASC');
        $allCategories = $this->categoryRepository->findWhereOrderBy(['status' => 1, 'parent_id' => null], ['id', 'title','parent_id'], 'title', 'ASC');

        $page = $request->page ?: 1;
        $limit = $request->product_show ?: 25;
        $conditions = [];
        $conditions_like = [];

        if ($request->product_is_new) {
            $conditions['is_new'] = $request->product_is_new == 'on' ? 1 : 0;
        }
        if ($request->product_is_favourite) {
            $conditions['is_favourite'] = $request->product_is_favourite == 'on' ? 1 : 0;
        }
        if ($request->product_featured) {
            $conditions['featured'] = $request->product_featured == 1 ? 1 : 0;
        }
        if ($request->product_status) {
            $conditions['status'] = $request->product_status == 1 ? 1 : 0;
        }
        if ($request->product_brand) {
            $conditions['brand_id'] = $request->product_brand;
        }
        if ($request->product_category) {
            $conditions['category_id'] = $request->product_category;
        }
        if ($request->keyword) {
            $conditions_like['title'] = $request->keyword;
            $conditions_like['price'] = $request->keyword;
            $conditions_like['discount'] = $request->keyword;
        }
        $columns = ['id','title','slug','featured_img','category_id','brand_id','is_new','is_favourite','featured','status'];
        $products = $this->productRepository->paginateWhereLikeOrderBy(
            $conditions, $conditions_like, 'updated_at', 'DESC', $page, $limit, $columns
        );
        return view('admins.products.index', compact('products', 'limit', 'allBrands', 'allCategories'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->findWhere(['parent_id' => null, 'status' => 1], ['id','title','parent_id']);
        $brands = $this->brandRepository->findWhere(['status' => 1], ['id','title']);
        $ingredients = $this->ingredientRepository->findWhere(['status' => 1],['id','title','status']);
        $productUses = $this->prodUsesRepository->findWhere(['status' => 1],['id','title','status']);

        return view('admins.products.create', compact('categories', 'brands', 'ingredients', 'productUses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'title' => 'required|max:200',
                'category_id' => 'required',
                'brand_id' => 'required',
                'description' => 'required',
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:720000',
                'item' => 'required|array',
            ],
            [
                'item.required' => 'Mỗi màu sản phẩm phải đăng ký ít nhất 1 màu.',
                '*.required' => 'Vui lòng điền đầy đủ các trường bắt buộc.',
                'title.max' => 'Tiêu đề không được vượt quá 200 ký tự.',
                'item.array' => 'Phân loại sản phẩm phải dạng mảng.',
                'image.max' => 'Ảnh quá kích thước 720px.'
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }
        try {
            DB::beginTransaction();

            $monthYearCurrent = date('dmY');
            $data = $this->adminService->addImage($request,'product_image',"storage/uploads/products/$monthYearCurrent/",500)['arrList'];

            $slug = Str::slug($request->title, '-', 'vi');
            $checkSlug = $this->productRepository->findWhereFirst(['slug' => $slug], ['id']);
            if ($checkSlug) {
                $data['slug'] = $slug. '-' . Str::random(3);
            }else{
                $data['slug'] = $slug;
            }

            $product = $this->productRepository->create($data);

            // insert product size
           $this->adminService->handleProductSize($request,$product,$monthYearCurrent);

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công.');
        } catch (\Exception $exception) {
            Log::notice("Add product failed " . $exception);
            return back()->withInput()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->findWhere(['parent_id' => null, 'status' => 1], ['id','title','parent_id']);
        $brands = $this->brandRepository->findWhere(['status' => 1], ['id','title']);
        $ingredients = $this->ingredientRepository->findWhere(['status' => 1],['id','title','status']);
        $productUses = $this->prodUsesRepository->findWhere(['status' => 1],['id','title','status']);


        $product = $this->productRepository->findById($id);
        $columns = ['id','title','product_id','photo_color','code','stock','price','sale_price','discount','is_default'];
        $product_size = $this->productSizeRepository->findWhereOrderBy(['product_id' => $id], $columns, 'id', 'ASC');
        $countSize = count($product_size);

//        $defaultColor = null;
//        foreach ($product_colors as $key => $val) {
//            if ($val->is_default == 1) {
//                $defaultColor = $val;
//                unset($product_colors[$key]);
//                break;
//            }
//        }

        return view('admins.products.edit', compact(
            'categories', 'brands', 'product', 'product_size',
            'countSize', 'ingredients', 'productUses'
        ));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => 'required|unique:products,slug,'.$id,
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:720000',
                'item' => 'required|array'
            ],
            [
                '*.required' => 'Vui lòng nhập đầy đủ trường bắt buộc',
                'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
                'slug.unique' => 'Link phải là duy nhất',
                'image.mimes' => 'Ảnh không đúng định dạng.',
                'image.max' => 'Ảnh quá kích thước 720px.',
                'item.array' => 'Phân loại sản phẩm phải dạng mảng.'
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->with('error', $validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            //handle price
            
            $monthYearCurrent = date('dmY');

            $data = $this->adminService->addImage($request,'product_image',"storage/uploads/products/$monthYearCurrent/",760)['arrList'];
            
            // save update
            $product = $this->productRepository->update($data, $id);

            // add product color
            $this->adminService->handleProductSize($request,$product,$monthYearCurrent);

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
        } catch (\Exception $exception) {
            Log::notice("Update product failed " . $exception);
            return back()->with('error', 'Có lỗi ' . $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->productRepository->delete($id);
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Delete product fail because " . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại!');
        }
    }

    public function delete_size(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->productSizeRepository->deleteData($request->id);
            DB::commit();
            return 1;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Delete product size fail because " . $e->getMessage());
            return 0;
        }
    }

    public function appendItem(Request $request)
    {
        $key = $request->key;
        return view('admins.products.add_size', compact('key'));
    }

}
