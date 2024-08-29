<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Repositories\Articles\ArticlesRepositoryInterface;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\Policy\PolicyRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Slider\SliderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Components\FlashMessages;
use App\Services\ProductService;
class HomeController extends BaseController
{
    protected $policyRepository;
    protected $newsRepository;
    protected $contactRepository;
    protected $productRepository;
    protected $categoryRepository;
    protected $bannerRepository;
    protected $brandRepository;
    protected $sliderRepository;
    use FlashMessages;
    protected $productService;
    public function __construct(
        BrandRepositoryInterface    $brandRepository,
        PolicyRepositoryInterface   $policyRepository,
        ArticlesRepositoryInterface $newsRepository,
        ContactRepositoryInterface  $contactRepository,
        ProductRepositoryInterface  $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BannerRepositoryInterface   $bannerRepository,
        SliderRepositoryInterface   $sliderRepository,
        ProductService $productService
    )
    {
        $this->brandRepository = $brandRepository;
        $this->policyRepository = $policyRepository;
        $this->newsRepository = $newsRepository;
        $this->contactRepository = $contactRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->bannerRepository = $bannerRepository;
        $this->sliderRepository = $sliderRepository;
        $this->productService = $productService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // get banner
        $bannerHeader = collect([]);
        $bannerBody = collect([]);
        $bannerBodyEnd = collect([]);
        $dataBanner = $this->bannerRepository->findWhereOrderBy(
            ['status' => 1], ['id', 'type_show', 'image', 'link'],'updated_at', 'DESC'
        );
      
        foreach ($dataBanner as $item) {
            if ($item->type_show == 2 && count($bannerHeader) < 3) {
                $bannerHeader->push($item);
            }
            if ($item->type_show == 3 && count($bannerBody) < 4) {
                $bannerBody->push($item);
            }
            if ($item->type_show == 5 && count($bannerBodyEnd) < 3) {
                $bannerBodyEnd->push($item);
            }
        }
        // get slider
        $slider_home = $this->sliderRepository->whereLimit(['published' => 1], 'updated_at', 'DESC', 5, ['id', 'title', 'link', 'photo']);
        //get product new
        $column = ['id','title','featured_img','slug','is_new','number_sold','sale_price','price','discount'];
        $prod_new = $this->productRepository->findWhereOrderByLimit(
            ['status' => 1, 'is_new' => 1], $column, 'updated_at', 'DESC', 8
        );
//        $prod_favourite = $this->productRepository->findWhereOrderByLimit(
//            ['status' => 1, 'is_favourite' => 1], $column, 'updated_at', 'DESC', 8
//        );

        //get featured brands
        $brandsData = $this->brandRepository->findWhereOrderByLimit(
            ['top' => 1, 'status' => 1], ['id','title','slug','logo'],'updated_at', 'DESC', 3
        );

        // get featured categories
        $categories_main = $this->categoryRepository->findWhereOrderByLimit(
            ['featured' => 1, 'status' => 1], ['id','title','slug','parent_id','image'],'sort_order', 'DESC', 3
        );
        // get news
        $columnNews = ['title', 'slug', 'content', 'tags', 'description', 'thumbnail', 'status', 'is_featured', 'updated_at'];
        $featured_articles = $this->newsRepository->findWhereOrderByLimit(['is_featured' => 1, 'status' => 1], $columnNews, 'updated_at', 'DESC', 4);
        $articles_newest = $this->newsRepository->findWhereOrderByLimit(['status' => 1], $columnNews, 'updated_at', 'DESC', 3);

        return view('frontend.main', compact(
            'prod_new', 'brandsData', 'slider_home', 'bannerHeader',
            'bannerBody', 'bannerBodyEnd', 'featured_articles', 'articles_newest', 'categories_main'
        ));
    }

    //
    public function aboutUs()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'about_us']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.aboutus', compact('page'));
    }

    //
    public function contactUs()
    {
        return view('frontend.contactus');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|digits:10',
            'content_data' => 'required'
//            'captcha' => 'required|captcha'
        ], [
            '*.required' => 'Vui lòng nhập đủ trường bắt buộc.',
            'email.email' => 'Định dạng không phải email',
            'phone_number.numeric' => 'Định dạng số điện thoại không hợp lệ',
            'phone_number.digits' => 'Số điện thoại không hợp lệ'
        ]);

        try {
            DB::beginTransaction();
            $contact = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'content' => $request->content_data
            ];
            $this->contactRepository->create($contact);

            DB::commit();
            self::message('success', 'Gửi liên hệ thành công, cám ơn quý khách.');
            return back()->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Send contact failed" . $e . ' ' . Carbon::now());
            return redirect('/lien-he')->with('error', 'Lỗi xảy ra, vui lòng thử lại');
        }

    }

    public function deliveryPolicy()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'delivery_policy']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function purchasePay()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'purchase_pay']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function pricePolicy()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'price_policy']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function warrantyExchange()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'warranty_exchange']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function contactPolicy()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'contact_us']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function termAndCondition()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'terms_and_conditions']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function termOfService()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'terms_of_service']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function sellPolicy()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'use_manual']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function privacyPolicy()
    {
        $page = $this->policyRepository->findWhereFirst(['name' => 'privacy_policy']);
        if (!$page) {
            abort(404);
        }
        return view('frontend.policies', compact('page'));
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function autocompleteSearch(Request $request)
    {
        try {
            
            //search by product
            $data = $this->productService->searchProduct($request);
            return response()->json($data);
            
        } catch (\Exception $exception) {
            Log::notice("Không tìm thấy sản phẩm nào..." . $exception->getMessage());
            return response()->json([
                'data' => array(),
                'totalProd' => 0,
                'check'=>'kkakakkak'
            ]);
        }
    }
}
