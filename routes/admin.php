<?php

use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\DeliveryFeeController;
use App\Http\Controllers\Admins\HomeController;
use App\Http\Controllers\Admins\ContactController;
use App\Http\Controllers\Admins\ArticlesCateController;
use App\Http\Controllers\Admins\ArticlesController;
use App\Http\Controllers\Admins\OrderController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\PolicyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\Admins\CustomerController;
use App\Http\Controllers\Admins\ReviewController;
use App\Http\Controllers\Admins\ProductUsesController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'web']], function(){

    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::resources([
        'roles' =>'Admins\RoleController',
        'admin'=>'Admins\AdminController',
        'settings'=>'Admins\SettingsController',
        'customers' =>'Admins\CustomerController',
        'articles-categories' =>'Admins\ArticlesCateController',
        'articles' =>'Admins\ArticlesController',
        'sliders' =>'Admins\SlidersController',
        'categories' =>'Admins\CategoryController',
        'brands' =>'Admins\BrandController',
        'product_uses' =>'Admins\ProductUsesController',
        'products' =>'Admins\ProductController',
        'banners' =>'Admins\BannerController',
        'delivery_fees' =>'Admins\DeliveryFeeController',
        'colors' =>'Admins\ColorController',
        'popups' =>'Admins\PopupController',
        'ingredients' =>'Admins\IngredientController',
    ]);
    Route::delete('/orders/delete/{id?}',[OrderController::class, 'delete'])->name('order.delete_order');

    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete_product');
    Route::delete('/products/delete/{id?}',[ProductController::class, 'delete'])->name('products.delete_product_subm');
    Route::post('/product-sizes/delete',[ProductController::class, 'delete_size'])->name('admin.products.delete_size');

    Route::post('/products/append-item',[ProductController::class, 'appendItem'])->name('admin.products.appendItem');

    Route::get('/articles/edit/{id?}',[ArticlesController::class, 'edit'])->name('admin.article.edit');
    Route::post('/articles/edit/{id?}',[ArticlesController::class, 'update']);
    Route::get('/articles/delete/{id?}',[ArticlesController::class, 'destroy'])->name('admin.article.delete');

    Route::delete('/articles-categories/delete/{id?}',[ArticlesCateController::class, 'delete']);

    Route::delete('/categories/delete/{id}',[CategoryController::class, 'delete'])->name('categories.delete');
    Route::get('/categories-sort', [CategoryController::class, 'sortCategory']);
    Route::post('/categories-update-sort-order', [CategoryController::class, 'updateSortOrder']);

    //Policy Controller
    Route::get('/aboutus/{type}', [PolicyController::class, 'index'])->name('about_us.index');//giới thiệu
    Route::get('/usemanual/{type}', [PolicyController::class, 'index'])->name('use_manual.index');//Sử dụng & Bảo quản
    Route::get('/warrantyexchange/{type}', [PolicyController::class, 'index'])->name('warranty_exchange.index');//đổi trả
    Route::get('/privacypolicy/{type}', [PolicyController::class, 'index'])->name('privacy_policy.index');//bảo mật
    Route::get('/termsofservice/{type}', [PolicyController::class, 'index'])->name('terms_of_service.index');//điều khoản dịch vụ - đặt hàng
    Route::get('/deliverypolicy/{type}', [PolicyController::class, 'index'])->name('delivery_policy.index');//vận chuyển
    Route::get('/purchasepay/{type}', [PolicyController::class, 'index'])->name('purchase_pay.index');//thanh toán
    Route::get('/pricepolicy/{type}', [PolicyController::class, 'index'])->name('price_policy.index');//giá cả
    Route::post('/policies/store', [PolicyController::class, 'store'])->name('policies.store');

    //Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.admin');
    Route::get('/orders/show/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/update_delivery_status', [OrderController::class, 'update_delivery_status'])->name('orders.update_delivery_status');
    Route::post('/orders/update_payment_status', [OrderController::class, 'update_payment_status'])->name('orders.update_payment_status');
    Route::post('/orders/update_order_status', [OrderController::class, 'update_order_status'])->name('orders.update_order_status');
    //Contact_us
    Route::get('/contacts',[ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/delete/{id?}',[ContactController::class, 'destroy'])->name('admin.contacts.delete');

    Route::delete('/brands/delete/{id}',[BrandController::class, 'delete']);

    //viewed product, bought product
    Route::get('customers/viewed_products/{customer_id}', [CustomerController::class, 'viewed_products'])->name('admin.customers.viewed_products');
    Route::get('customers/bought_products/{customer_id}', [CustomerController::class, 'bought_products'])->name('admin.customers.bought_products');
    Route::get('customers/orders/{customer_id}', [CustomerController::class, 'orders'])->name('admin.customers.orders');

    Route::get('/reviews',[ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/delete/{id}',[ReviewController::class, 'delete'])->name('admin.reviews.delete');
    Route::post('/reviews/change_status',[ReviewController::class, 'change_status'])->name('admin.reviews.change_status');

    //delivery fee
    Route::get('/delivery_fees/edit/{id?}', [DeliveryFeeController::class, 'edit'])->name('delivery_fees.edit');
    Route::post('/delivery_fees/edit/{id?}', [DeliveryFeeController::class, 'update']);
    Route::get('/delivery_fees/delete/{id?}', [DeliveryFeeController::class, 'delete'])->name('delivery_fees.delete');


});
Route::post('admin/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');

