<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\ProductSize;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Policy\PolicyRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\ViewedProduct\ViewedProductRepositoryInterface;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductsController extends BaseController
{
    protected $categoryRepository;
    protected $productRepository;
    protected $userRepository;
    protected $customerRepository;
    protected $reviewRepository;
    protected $brandRepository;
    protected $policyRepository;
    protected $orderRepository;
    protected $orderDetailColorRepository;
    protected $viewedProductRepository;


    protected $productService;
    public function __construct(
        CategoryRepositoryInterface      $categoryRepository,
        ProductRepositoryInterface       $productRepository,
        UserRepositoryInterface          $userRepository,
        CustomerRepositoryInterface      $customerRepository,
        ReviewRepositoryInterface        $reviewRepository,
        BrandRepositoryInterface         $brandRepository,
        PolicyRepositoryInterface        $policyRepository,
        OrderRepositoryInterface         $orderRepository,
        OrderDetailRepositoryInterface   $orderDetailColorRepository,
        ViewedProductRepositoryInterface $viewedProductRepository,
        ProductService $productService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
        $this->reviewRepository = $reviewRepository;
        $this->brandRepository = $brandRepository;
        $this->policyRepository = $policyRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailColorRepository = $orderDetailColorRepository;
        $this->viewedProductRepository = $viewedProductRepository;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        //        $productColors

        $order_by = 'created_at';
        $order = 'DESC';
        $product_options = array(
            'status' => 1
        );
        $column = array('*');
        $products = $this->productRepository->findWhereOrderBy($product_options, $column, $order_by, $order);
        $paginationPage = $this->paginationAjax($products, 1, 24);

        $newProducts = $this->productService->pushProducts($products);

        return view('frontend.products.index', [
            'products' => $newProducts,
            'paginationPage' => $paginationPage,

        ]);
    }

    public function productSale(Request $request)
    {


        $order_by = 'created_at';
        $order = 'DESC';
        $product_options = array(
            'status' => 1
        );
        $column = array('*');
        $products_sale = $this->productRepository->findWhereOrderBy($product_options, $column, $order_by, $order);
        $paginationPage = $this->paginationAjax($products_sale, 1, 24);

        $saleProducts = $this->productService->pushProducts($products_sale);

        return view('frontend.products.product_sale', [
            'sale_products' => $saleProducts,
            'paginationPage' => $paginationPage,

        ]);
    }
    public function productCate(Request $request, $cate_slug = null)
    {
        $category = array();
        $order_by = 'created_at';
        $order = 'DESC';

        $product_options = array(
            'status' => 1
        );

        if ($cate_slug) {
            $category = $this->categoryRepository->findWhereFirst(
                ['slug' => $cate_slug, 'status' => 1],
                ['id', 'parent_id', 'title', 'slug', 'status']
            );
        }

        if ($category) {
            $in_categories[0] = $category->id;
            foreach ($category->children as $i => $cate) {
                $in_categories[$i + 1] = $cate->id;
            }
            $product_options['category_id'] = ['category_id', 'in', $in_categories];
        }
        $column = array('*');
        $products = $this->productRepository->findWhereOrderBy($product_options, $column, $order_by, $order);

        $paginationPage = $this->paginationAjax($products, 1, 24);

        $newProducts = $this->productService->pushProducts($products);;

        return view('frontend.products.products_cate', [
            'products' => $newProducts,
            'paginationPage' => $paginationPage,

        ]);
    }

    //search
    public function search(Request $request)
    {
        try {
            $keyword = trim($request->input('keyword'));
            $order_by = 'created_at';
            $order = 'DESC';

            //search by product
            $products = Product::select("*")->where(['status' => 1, 'deleted_at' => null])
                ->where('title', 'like', "%$keyword%")
                ->orderBy($order_by, $order)
                ->get();

            $paginationPage = $this->paginationAjax($products, 1, 24);

            $newProducts = $this->productService->pushProducts($products);


            return view('frontend.products.index', [
                'products' => $newProducts,
                'paginationPage' => $paginationPage,

            ]);
        } catch (\Exception $exception) {
            Log::notice("Search failed" . $exception->getMessage() . ' ' . Carbon::now());
            return back();
        }
    }

    public function searchPage()
    {
        return view('frontend.search_page');
    }
    //
    public function detail_old($slug)
    {
        $product = $this->productRepository->findWhereFirst(['slug' => $slug, 'status' => 1]);
        if (!$product) abort(404);

        $prodSize = $product->productSizes;
        $allImgSize = array();
        $prdColorArr = array();
        foreach ($prodSize as $value) {
            if ($value->photo_color != null) {
                $prdColor = json_decode($value->photo_color);
                $prdColorArr = array_merge($prdColor, $prdColorArr);
            }
        }
        //
        if (count($prdColorArr) > 0) {
            foreach ($prdColorArr as $it) {
                if (isset($it->color_img)) {
                    array_push($allImgSize, $it->color_img);
                }
            }
        }

        $whereRel = [
            ['status', '=', 1],
            ['id', '!=', $product->id],
            ['brand_id', '=', $product->brand_id]
        ];

        $relatedProducts = $this->productRepository->findWhereLimit(
            $whereRel,
            8,
            ['id', 'title', 'featured_img', 'slug', 'status', 'is_new', 'brand_id', 'price', 'sale_price', 'discount']
        );

        $allBrands = $this->brandRepository->findWhereOrderBy(['status' => 1], ['id', 'title', 'status', 'slug'], 'title', 'ASC');

        //handle viewed product
        if (Auth::guard('customer')->check()) {
            if ($viewedProduct = $this->viewedProductRepository->findWhereFirst(['customer_id' => Auth::guard('customer')->id(), 'product_id' => $product->id])) {
                $viewedProduct->updated_at = Carbon::now();
                $viewedProduct->save();
            } else {
                $this->viewedProductRepository->create([
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $product->id,
                ]);
            }
        }
        if (session()->has('viewed_products')) {
            $viewed_products = session()->pull('viewed_products');
            if (!in_array($product->id, $viewed_products)) {
                array_unshift($viewed_products, $product->id);
            }
            if (count($viewed_products) > 10) {
                array_shift($viewed_products);
            }
            session(['viewed_products' => $viewed_products]);
        } else {
            session(['viewed_products' => [$product->id]]);
        }

        //end handle viewed product
        return view('frontend.products.product_detail', compact(
            'product',
            'relatedProducts',
            'allBrands',
            'allImgSize',
            'prodSize',
            'prdColorArr'
        ));
    }
    public function detail($slug)
    {

        $product = $this->productRepository->findByField('slug', $slug);
        $isValid = 0;
        foreach ($product->productSizes as $key => $value) {
            $isValid += $value->stock;
        }

        return view('frontend.products.product_detail', compact('product', 'isValid'));
    }

    public function detailBySize($id)
    {
        $productSize = ProductSize::where('id', $id)->get();
        return response()->json([
            'code' => 200,
            'data' => $productSize
        ]);
    }

    public function filterProducts(Request $request)
    {
        $price_filter = $request->price_filter;
        $color_filter = $request->color_filter;
        $size_filter = $request->size_filter;
        $sort_filter = $request->sort_filter;
        $page_filter = $request->page_filter;
        $keyword = $request->keyword;
        $products = $this->productRepository->filterProducts($price_filter, $color_filter, $size_filter, $sort_filter, $keyword);

        $paginationPage = $this->paginationAjax($products, $page_filter, 24);

        $newProducts = $this->productService->pushProducts($products);


        return view('frontend.products.product_filter_result', [
            'products' => $newProducts,
            'paginationPage' => $paginationPage,

        ]);
    }

    public function filterProductsSale(Request $request)
    {
        $price_filter = $request->price_filter;
        $color_filter = $request->color_filter;
        $size_filter = $request->size_filter;
        $sort_filter = $request->sort_filter;
        $page_filter = $request->page_filter;
        $keyword = $request->keyword;
        $products = $this->productRepository->filterProductsSale($price_filter, $color_filter, $size_filter, $sort_filter, $keyword);

        $paginationPage = $this->paginationAjax($products, $page_filter, 24);

        $newProducts = $this->productService->pushProducts($products);

        return view('frontend.products.product_filter_result', [
            'products' => $newProducts,
            'paginationPage' => $paginationPage,

        ]);
    }

    public function paginationAjax($data, $page, $limit = 24)
    {
        $total = count($data);
        $current_page = $page ?: 1;

        $page_number = ceil($total / $limit);

        $page_arr_before = $this->productService->paginatePage($current_page, $page_number, 'before');
        $page_arr_after = $this->productService->paginatePage($current_page, $page_number, 'after');

        $page_arr = array_merge($page_arr_before, $page_arr_after);
        return  [
            'current_page' => $current_page,
            'page_arr' => $page_arr,
            'page_number' => $page_number,
        ];
    }
}
