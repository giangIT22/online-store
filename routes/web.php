<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

//=============Product detail=========================

Route::prefix('/product')->group(function(){
    Route::get('/detail/{product_id}/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
    Route::get('/tag/{tag_name}', [ShopController::class, 'index'])->name('product.tag');
});

Route::get('/{category}', [CategoryController::class, 'index'])->name('category.index');