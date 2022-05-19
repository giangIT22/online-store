<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\ShopController;
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

Route::get('/login', [LoginController::class, 'index'])->name('user.login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('user.register')->middleware('guest');;
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/not-found', function () {
    return view('layouts.error');
})->name('error');

//=============Product detail=========================

Route::prefix('/product')->group(function () {
    Route::get('/detail/{product_id}/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
    Route::get('/tag/{tag_name}', [ShopController::class, 'index'])->name('product.tag');
    Route::get('/preview-product/{product_id}', [HomeController::class, 'previewProduct'])->name('preview.product');
});

Route::get('/{category_slug}', [CategoryController::class, 'index'])->name('category.index');

//=======================cart=====================

Route::post('/store-cart', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/shopping-cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/delete-cart', [CartController::class, 'deleteCart'])->name('cart.delete');