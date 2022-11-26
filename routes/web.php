<?php

use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\ResetPasswordController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\UserController;
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
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/not-found', function () {
    return view('layouts.error');
})->name('error');

//==========================Auth user====================================
Route::middleware(['guest:web', 'prevent-back-history'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('user.login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/forgot-password', [ResetPasswordController::class, 'forgetPassword'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'verify'])->name('password.reset');
    Route::post('/reset-password/{user_id}', [ResetPasswordController::class, 'updatePassword'])->name('password.user-update');
});

Route::get('/register/verify/{code}', [RegisterController::class, 'verify'])->name('verify.email'); // xac thuc email khi dky user

Route::get('/user/logout', [LoginController::class, 'destroy'])->name('user.logout');

//=============Profile user===========================
Route::middleware(['auth:web', 'prevent-back-history'])->group(function () {

    Route::get('/user', [UserController::class, 'home'])->name('user.home');

    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');

    Route::get('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'userPasswordUpdate'])->name('user.password.update');

    Route::get('user/orders', [UserController::class, 'getListOrder'])->name('user.orders');

    Route::get('user/orders/{order_code}', [UserController::class, 'getOrderDetail'])->name('user.order_detail');

    Route::post('user/cancel-order/{order_code}', [UserController::class, 'cancelOrder'])->name('user.order.cancel');

}); 

//=============Product detail=========================

Route::prefix('/product')->group(function () {
    Route::get('/detail/{product_id}', [HomeController::class, 'productDetail'])->name('product.detail');
    Route::get('/preview-product/{product_id}', [HomeController::class, 'previewProduct'])->name('preview.product');
    Route::post('/add-review', [HomeController::class, 'storeReview'])->name('review.store');
    Route::post('/check-exist', [HomeController::class, 'checkExistProduct']);
    //===========Get size compress with color of product ================
    Route::post('/get-size', [HomeController::class, 'getSizeByColor'])->name('get-size');
});

//============Shopping===============================
Route::get('/category/{category_id}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/sub-category/{sub_category_id}', [CategoryController::class, 'getProductBySubCategory'])->name('sub_category.index');
Route::get('/all-product', [CategoryController::class, 'allProducts'])->name('category.all.products');

//=======================cart=====================

Route::post('/store-cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/shopping-cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/delete-cart', [CartController::class, 'deleteCart'])->name('cart.delete');

//====================Blog========================
Route::get('/tin-tuc', [BlogController::class, 'view'])->name('blog.view');
Route::get('/tin-tuc/{blog_id}', [BlogController::class, 'detailBlog'])->name('blog.detail');

//=====================Search============================
Route::get('/search', [ShopController::class, 'viewSearch'])->name('search.view');

//====================Checkout===================================
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/store', [CheckoutController::class, 'storeOrder'])->name('checkout.store');
Route::get('/get-district/{province_id}', [CheckoutController::class, 'getDistrict'])->name('checkout.district');
Route::get('/get-ward/{district_id}', [CheckoutController::class, 'getWard'])->name('checkout.ward');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply_coupon');
Route::get('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.remove_coupon');
// Route::post('/checkout/momo-payment', [CheckoutController::class, 'paymentByMomo'])->name('checkout.momo');
