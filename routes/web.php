<?php

use App\Http\Controllers\Web\HomeController;
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
});