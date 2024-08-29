<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Repositories\ArticlesCate\ArticlesCateRepositoryInterface;
use App\Repositories\Articles\ArticlesRepositoryInterface;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\ProductSize\ProductSizeRepositoryInterface;
use Carbon\Carbon;

class AdminService extends Controller
{
    // Add your service methods here
    protected $articlesCateRepository;
    protected $articlesRepository;
    protected $brandRepository;
    protected $categoryRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $customerRepository;
    protected $productSizeRepository;
    public function __construct(
        ArticlesCateRepositoryInterface $articlesCateRepository,
        ArticlesRepositoryInterface $articlesRepository,
        BrandRepositoryInterface $brandRepository,
        CategoryRepositoryInterface $categoryRepository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        CustomerRepositoryInterface $customerRepository,
        ProductSizeRepositoryInterface $productSizeRepository
    ) {
        $this->articlesCateRepository = $articlesCateRepository;
        $this->articlesRepository = $articlesRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->productSizeRepository = $productSizeRepository;
    }

    function saveImage($file, $filePath, $changeName, $width = null, $height = null)
    {
        if (!File::isDirectory($filePath)) {
            File::makeDirectory($filePath, 0777, true, true);
        }

        $img = Image::make($file->path());
        $img->resize($width, $height, function ($const) {
            $const->aspectRatio();
            $const->upsize();
        })->save($filePath . $changeName);
    }

    public function addImage($request, $type, $storage_path, $size)
    {
        $flag_photo = false;
        switch ($type) {
            case 'file':
                $arrList = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role_id' => $request->role_id,
                    'isAdmin' => 1,
                    'isActive' => $request->status == 'on' ? 1 : 0
                ];
                if ($request->password != '') {
                    $arrList['password'] = bcrypt($request->password);
                }
                break;
            case 'banner':
                $arrList = [
                    'title' => $request->title,
                    'description' => $request->description,
                    'content' => $request->content_cate,
                    'status' => $request->status == 'on' ? 1 : 2,
                    'admin_id' => Auth::user()->id,
                    'is_show' => $request->is_show == 'on' ? 1 : 2,
                    'sort_order' => '0',
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description
                ];
                if ($request->parent_id) {
                    $arrList['parent_id'] = $request->parent_id;
                }
                $slug = Str::slug($request->title, '-', 'vi');
                $checkSlug = $this->articlesCateRepository->findWhereFirst(['slug' => $slug], ['id']);

                if ($checkSlug) {
                    $arrList['slug'] = $slug . '-' . Str::random(3);
                } else {
                    $arrList['slug'] = $slug;
                }
                break;
            case 'logo':

                $arrList = [
                    'title' => $request->title,
                    'slug' => Str::random(3) . '-' . Str::slug($request->title, '-', 'vi'),
                    'status' => $request->status ? 1 : 0,
                    'description' => $request->description,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description
                ];
                $slug = Str::slug($request->title, '-', 'vi');
                $checkSlug = $this->brandRepository->findWhereFirst(['slug' => $slug], ['id']);
                if ($checkSlug) {
                    $arrList['slug'] = $slug . '-' . Str::random(3);
                } else {
                    $arrList['slug'] = $slug;
                }
                break;

            case 'image':
                $arrList = [
                    'title' => $request->title,
                    'featured' => $request->featured ? 1 : 0,
                    'is_menu' => $request->is_menu ? 1 : 0,
                    'status' => $request->status ? 1 : 0,
                    'description' => $request->description,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'added_by' => Auth::user()->id
                ];
                if ($request->parent_id) {
                    $arrList['parent_id'] = $request->parent_id;
                }
                $slug = Str::slug($request->title, '-', 'vi');
                $checkSlug = $this->categoryRepository->findWhereFirst(['slug' => $slug], ['id']);
                if ($checkSlug) {
                    $arrList['slug'] = $slug . '-' . Str::random(3);
                } else {
                    $arrList['slug'] = $slug;
                }
                break;
            case 'pop_image':
                $arrList = [
                    'title' => $request->title,
                    'link' => $request->link_detail,
                    'status' => $request->status ? 1 : 0,
                ];
                break;
            case 'product_image':
                $arrList = [
                    'added_by' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'brand_id' => $request->brand_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'is_new' => isset($request->is_new) ? 1 : 0,
                    'is_favourite' => isset($request->is_favourite) ? 1 : 0, // yeu thich
                    'featured' => isset($request->featured) ? 1 : 0, // ban chay
                    'status' => isset($request->status) ? 1 : 0,
                    'content' => $request->content_prd,
                    'txt_manual' => $request->txt_manual,
                    'txt_uses' => $request->txt_uses,
                    'uses' => json_encode($request->uses) ?? null,
                    'txt_info' => $request->txt_info,
                    'txt_ingredient' => $request->txt_ingredient,
                    'ingredients' => json_encode($request->ingredients) ?? null,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description
                ];

                break;
            case 'product_uses':
                $arrList = [
                    'title' => $request->title,
                    'created_by' => auth()->id(),
                    'description' => $request->description ? json_encode($request->description) : null,
                    'status' => $request->status ? 1 : 0,
                ];

                break;

            case 'st_logo':
            case 'admin_logo':
            case 'favicon':
                $arrList = [
                    'st_name_site' => $request->st_name_site,
                    'phone' => $request->phone,
                    'hotline' => $request->hotline,
                    'email' => $request->email,
                    'address' => $request->address,
                    'working_time' => $request->working_time,
                    'facebook' => $request->facebook,
                    'youtube' => $request->youtube,
                    'instagram' => $request->instagram,
                    'tiktok' => $request->tiktok,
                    'shopee' => $request->shopee,
                    'copyright' => $request->copyright,
                    'meta_keywords' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'url_website' => $request->url_website,
                    'bank_transfer_guide' => $request->bank_transfer_guide,
                ];
                if ($request->product_service) {
                    $arrList['product_service'] = json_encode($request->product_service);
                }
            case 'slider_photo':
            case 'slider_photo_mb':
                $arrList = [
                    'title' => $request->title,
                    'link' => $request->link_detail,
                    'published' => $request->published == 'on' ? 1 : 0,
                    'type' => $request->type
                ];
                break;

            default:
                # code...
                break;
        }
        if ($image = $request->file($type)) {
            $save_path = public_path($storage_path);
            $imgNameNew = time() . '.' . $image->extension();
            $this->saveImage($image, $save_path, $imgNameNew, $size);

            switch ($type) {
                case 'file':
                    $arrList['avatar'] = $storage_path . $imgNameNew;
                    break;
                case 'banner':
                    $arrList['photos'] = $storage_path . $imgNameNew;
                    break;
                case 'logo':
                    $arrList['logo'] = $storage_path . $imgNameNew;
                    break;
                case 'image':
                    $arrList['image'] = $storage_path . $imgNameNew;
                    break;
                case 'pop_image':
                    $arrList['image'] = $storage_path . $imgNameNew;
                    break;
                case 'product_image':
                    $arrList['featured_img'] = $storage_path . $imgNameNew;
                    break;
                case 'product_uses':
                    $arrList['icon_uses'] = $storage_path . $imgNameNew;
                    break;
                case 'st_logo':
                    $arrList['st_logo'] = $storage_path . $imgNameNew;
                    break;
                case 'admin_logo':
                    $arrList['admin_logo'] = $storage_path . $imgNameNew;
                    break;
                case 'favicon':
                    $arrList['favicon'] = $storage_path . $imgNameNew;
                    break;
                case 'slider_photo':
                    $arrList['photo'] = $storage_path . $imgNameNew;
                    break;
                case 'slider_photo_mb':
                    $arrList['photo_mb'] = $storage_path . $imgNameNew;
                    break;
                default:
                    # code...
                    break;
            }

            $flag_photo = true;
        }

        return ['flag_photo' => $flag_photo, 'arrList' => $arrList];
    }

    public function addImageWithThumb($request)
    {
        $flag_img = false;
        $article = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content_article,
            'article_category_id' => $request->category_id,
            'status' => $request->status == 'on' ? 1 : 0,
            'is_featured' => $request->is_featured == 'on' ? 1 : 0,
            'is_hot' => $request->is_hot == 'on' ? 1 : 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'admin_id' => Auth::user()->id
        ];
        $slug = Str::slug($request->title, '-', 'vi');
        $checkSlug = $this->articlesRepository->findWhereFirst(['slug' => $slug], ['id']);
        if ($checkSlug) {
            $article['slug'] = $slug . '-' . Str::random(3);
        } else {
            $article['slug'] = $slug;
        }

        if ($image = $request->file('image')) {
            $monthYearFl = date('dmY');
            $save_path = public_path("storage/uploads/post/$monthYearFl/");
            if (!File::isDirectory($save_path)) {
                File::makeDirectory($save_path, 0777, true, true);
            }

            $imgNamethumb = time() . '_thumb.' . $image->extension();
            $img = Image::make($image->path());
            $img->backup();
            // img thumb
            $img->resize(360, null, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })->save($save_path . $imgNamethumb);
            // img full
            $imgNameNew = time() . '.' . $image->extension();
            $img->reset();
            $img->resize(760, null, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })->save($save_path . $imgNameNew);

            $article['thumbnail'] = "storage/uploads/post/$monthYearFl/" . $imgNamethumb;
            $article['photos'] = "storage/uploads/post/$monthYearFl/" . $imgNameNew;
            $flag_img = true;
        }

        return ['flag_photo' => $flag_img, 'arrList' => $article];
    }

    public function handleCategorySameLevel($request)
    {
        $category_id = $request->category_id;
        $parent_id = $request->parent_id;
        $change = $request->change;
        $arrCategorySameLevel = $this->categoryRepository->findWhereOrderBy(['parent_id' => $parent_id, 'status' => 1], array('*'), 'sort_order', ($change == 'up' ? 'DESC' : 'ASC'));
        $isChange = false;

        if ($change == 'up') {
            $i = count($arrCategorySameLevel);
            foreach ($arrCategorySameLevel as $categorySameLevel) {
                if ($categorySameLevel->id == $category_id) {
                    $categorySameLevel->sort_order = $i - 1;
                    $categorySameLevel->save();
                    $isChange = true;
                } else {
                    if ($isChange) {
                        $categorySameLevel->sort_order = $i + 1;
                        $categorySameLevel->save();
                        $isChange = false;
                    } else {
                        $categorySameLevel->sort_order = $i;
                        $categorySameLevel->save();
                    }
                }
                $i--;
            }
        } else {
            $i = 1;
            foreach ($arrCategorySameLevel as $categorySameLevel) {
                if ($categorySameLevel->id == $category_id) {
                    $categorySameLevel->sort_order = $i + 1;
                    $categorySameLevel->save();
                    $isChange = true;
                } else {
                    if ($isChange) {
                        $categorySameLevel->sort_order = $i - 1;
                        $categorySameLevel->save();
                        $isChange = false;
                    } else {
                        $categorySameLevel->sort_order = $i;
                        $categorySameLevel->save();
                    }
                }
                $i++;
            }
        }
    }


    public function handleDataShow($dataShow)
    {
        $dataShow['total_product'] = $this->productRepository->countData(['id', 'status']);
        $dataShow['total_product_m'] = $this->productRepository->countWhere(
            [
                'created_at' => [
                    'created_at', '>', Carbon::now()->startOfMonth()
                ],
                'created_at1' => [
                    'created_at', '<', Carbon::now()->endOfMonth()
                ],
            ],
            ['id', 'created_at']
        );

        $dataShow['total_order'] = $this->orderRepository->countData(['id', 'code']);
        $dataShow['total_order_m'] = $this->orderRepository->countWhere(
            [
                'created_at' => [
                    'created_at', '>', Carbon::now()->startOfMonth()
                ],
                'created_at1' => [
                    'created_at', '<', Carbon::now()->endOfMonth()
                ],
            ],
            ['id', 'created_at']
        );

        $dataShow['total_news'] = $this->articlesRepository->countData(['id', 'status']);
        $dataShow['total_news_m'] = $this->articlesRepository->countWhere(
            [
                'created_at' => [
                    'created_at', '>', Carbon::now()->startOfMonth()
                ],
                'created_at1' => [
                    'created_at', '<', Carbon::now()->endOfMonth()
                ],
            ],
            ['id', 'created_at']
        );

        $dataShow['total_customer'] = $this->customerRepository->countData(['id']);
        $dataShow['total_customer_m'] = $this->customerRepository->countWhere(
            [
                'created_at' => [
                    'created_at', '>', Carbon::now()->startOfMonth()
                ],
                'created_at1' => [
                    'created_at', '<', Carbon::now()->endOfMonth()
                ],
            ],
            ['id', 'created_at']
        );
        return $dataShow;
    }


    public function updateOrderStatus($request, $colData, $column)
    {
        $flag = 0;
        $order = $this->orderRepository->findById($request->order_id, ['id']);
        if ($order && $column) {
            if ($colData == 'status') {
                $arrUpdate = [
                    'status' => $request->status,
                    'delivery_status' => $request->status == 2 ? 5 : 4,
                    'payment_status' => $request->status == 2 ? 3 : 4,
                ];
                $this->orderRepository->update($arrUpdate, $request->order_id);
            } else {
                $this->orderRepository->update([$colData => $column], $order->id);
            }
            $flag = 1;
        }

        return $flag;
    }


    public function handleProductSize($request, $product, $monthYearCurrent)
    {
        $itemKey = $request->item;
        $filePath = public_path("storage/uploads/products/$monthYearCurrent/");
        foreach ($itemKey as $val) {
            $product_size_data = [
                'title' => $val['title'],
                'product_id' => $product->id,
                'code' => $val['codes'],
                'stock' => $val['stocks'],
                'is_default' => $val['get_show']
            ];

            //handle image
            if (isset($val['photos'])) {
                $photos = array();
                foreach ($val['photos'] as $photo) {
                    $photo_name = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                    $this->saveImage($photo, $filePath, $photo_name, 500); //480

                    $photo_path = "storage/uploads/products/$monthYearCurrent/" . $photo_name;
                    array_push($photos, $photo_path);
                }
                $product_size_data['photo_color'] = json_encode($photos);
            } else {
                if ($val['get_show']) {
                    return back()->withInput()->with('error', 'Bắt buộc phải nhập hình ảnh sản phẩm cho kích thước mặc định.');
                }
            }

            //handle price
            $prodPrice = str_replace(',', '', $val['prices']);
            $product_size_data['price'] = $prodPrice;

            $prodSalePrice = $val['sale_prices'] ? str_replace(',', '', $val['sale_prices']) : null;
            $prodDiscount = null;
            if ($prodSalePrice > 0 && $prodSalePrice < $prodPrice) {
                $prodDiscount = round((($prodPrice - $prodSalePrice) * 100) / $prodPrice);

                $product_size_data['sale_price'] = $prodSalePrice;
                $product_size_data['discount'] = $prodDiscount;
            }

            $this->productSizeRepository->create($product_size_data);

            if ($val['get_show'] == 1) {
                $this->productRepository->update(['price' => $prodPrice, 'sale_price' => $prodSalePrice, 'discount' => $prodDiscount], $product->id);
            }
        }
    }


    public function handleCustomerService($request, $save_path_service_img, $arrList)
    {
        foreach ($request->service_title as $index => $service_title) {
            if ($request->service_img && isset($request->service_img[$index]) && $image_serivce = $request->service_img[$index]) {
                $imgNameNew = Str::random(15) . '.' . $image_serivce->getClientOriginalExtension();
                $this->saveImage($image_serivce, $save_path_service_img, $imgNameNew, 50, 50);
                $customer_service[$index] = [
                    'service_img' => "storage/uploads/customer_service/" . $imgNameNew,
                    'service_title' => $service_title,
                    'service_content' => isset($request->service_content[$index]) ? $request->service_content[$index] : "",
                ];
            } else {
                $customer_service[$index] = [
                    'service_img' => $request->current_service_img[$index],
                    'service_title' => $service_title,
                    'service_content' => isset($request->service_content[$index]) ? $request->service_content[$index] : "",
                ];
            }
        }

        return json_encode($customer_service);
    }
}
