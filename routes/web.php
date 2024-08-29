<?php

use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ProductsController;
use App\Http\Controllers\Frontend\CartsController;
use App\Http\Controllers\Frontend\LoginController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gioi-thieu', [HomeController::class, 'aboutUs'])->name('aboutus');
Route::get('/huong-dan-mua-hang', [HomeController::class, 'termOfService'])->name('termOfService');
Route::get('/chinh-sach/bao-mat', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/chinh-sach/ban-hang', [HomeController::class, 'sellPolicy'])->name('sellPolicy');
Route::get('/chinh-sach/doi-tra', [HomeController::class, 'warrantyExchange'])->name('warrantyExchange');
Route::get('/chinh-sach/van-chuyen', [HomeController::class, 'deliveryPolicy'])->name('deliveryPolicy');
Route::get('/chinh-sach/thanh-toan', [HomeController::class, 'purchasePay'])->name('purchasePay');
Route::get('/chinh-sach/kiem-hang', [HomeController::class, 'pricePolicy'])->name('pricePolicy');

Route::get('/lien-he', [HomeController::class, 'contactUs'])->name('contactus');
Route::post('/lien-he', [HomeController::class, 'sendContact'])->name('send_contact');
Route::get('/autocomplete-search', [HomeController::class, 'autocompleteSearch'])->name('auto_search');

Route::get('/blogs/all', [NewsController::class, 'index'])->name('allBlog');
Route::get('/blogs/{slug?}', [NewsController::class, 'newsCategory'])->name('news-category');
Route::get('/blogs/{slug_cat?}/{slug?}', [NewsController::class, 'show'])->name('news-detail');

Route::get('/tim-kiem', [ProductsController::class, 'search'])->name('home.search');
Route::get('/product_filter_result', [ProductsController::class, 'filterProducts'])->name('product_filter_result');
Route::get('/productSale_filter_result', [ProductsController::class, 'filterProductsSale'])->name('productSale_filter_result');
Route::get('/trang-tim-kiem', [ProductsController::class, 'searchPage'])->name('search-page');
Route::get('/san-pham', [ProductsController::class, 'index'])->name('products');
Route::get('/san-pham-khuyen-mai', [ProductsController::class, 'productSale'])->name('products_sale');
Route::get('/danh-muc/{cate_slug?}', [ProductsController::class, 'productCate'])->name('products_cate');
Route::get('/san-pham/{slug}', [ProductsController::class, 'detail'])->name('product-detail');

Route::get('/san-pham-size/{id?}', [ProductsController::class, 'detailBySize'])->name('product-detail-size');
Route::post('/quick-view/{id?}', [ProductsController::class, 'quickView'])->name('products.view-quick');

Route::get('/gio-hang/san-pham-ban-chon', [CartsController::class, 'index'])->name('cart');
Route::post('/gio-hang/add-to-cart', [CartsController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/gio-hang/preview-cart', [CartsController::class, 'previewCart'])->name('cart.previewCart');
Route::post('/gio-hang/remove-fromCart', [CartsController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::post('/gio-hang/updateQuantity', [CartsController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/gio-hang/get-districts-by-province', [CartsController::class, 'getDistrictsByProvince'])->name('cart.getDistrictsByProvince');
Route::get('/gio-hang/get-wards-by-district', [CartsController::class, 'getWardsByProvince'])->name('cart.getWardsByProvince');
Route::get('/gio-hang/get-fee-by-province', [CartsController::class, 'getShipFeeByProvince'])->name('cart.getShipFeeByProvince');

Route::get('/gio-hang/thanh-toan', [CartsController::class, 'payments'])->name('payment');
Route::post('/gio-hang/checkout', [CartsController::class, 'checkout'])->name('checkout');
Route::get('/gio-hang/thank-you', [CartsController::class, 'thankYou'])->name('thank-you');


Route::group(['prefix' => 'khach-hang', 'namespace' => 'Customer'], function () {

    Route::get('/dang-ky', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'registerPost'])->name('registerPost');
    Route::get('/dang-nhap', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('loginPost');
    Route::get('/dang-xuat', [LoginController::class, 'logout'])->name('logout');

    Route::get('/quen-mat-khau', [LoginController::class, 'forgotPass'])->name('forget_password');
    Route::post('/forget_password', [LoginController::class, 'sendMailUpdatePass'])->name('sendMailUpdatePass');
    Route::get('/reset_password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('showResetPasswordForm');
    Route::post('/reset_password', [LoginController::class, 'submitResetPasswordForm'])->name('submitResetPasswordForm');

    Route::group(['middleware' => 'customer.auth'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customer.info');
        Route::get('/ho-so', [CustomerController::class, 'profile'])->name('profile');
        Route::post('/change-password', [CustomerController::class, 'changePwd'])->name('profile.change_pwd');
        Route::get('/lich-su-mua-hang', [CustomerController::class, 'purchase_history'])->name('purchase_history');
        Route::get('/lich-su-mua-hang/{order_code?}', [CustomerController::class, 'purchase_history_detail'])->name('purchase_history_detail');

    });

});
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reloadCaptcha');




