<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function() {
    return view('admin.dashboard');
});

//====All route category==========
Route::prefix('/category')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('all.categories');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/update/{category_id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::get('/edit/{category_id}', [CategoryController::class, 'update'])->name('category.edit');
    Route::get('/delete/{category_id}', [CategoryController::class, 'delete'])->name('category.delete');

    //All route subcategory admin
    Route::get('/sub/view', [SubCategoryController::class, 'index'])->name('all.sub_categories');
    Route::get('/sub/create', [SubCategoryController::class, 'create'])->name('sub_category.create');
    Route::post('/sub/store', [SubCategoryController::class, 'store'])->name('sub_category.store');
    Route::post('/sub/update/{sub_category_id}', [SubCategoryController::class, 'update'])->name('sub_category.update');
    Route::get('/sub/edit/{sub_category_id}', [SubCategoryController::class, 'edit'])->name('sub_category.edit');
    Route::get('/sub/delete/{sub_category_id}', [SubCategoryController::class, 'delete'])->name('sub_category.delete');
    Route::get('/sub/{sub_category_id}', [SubCategoryController::class, 'getSubcategories']);
});

Route::prefix('/product')->group(function() {

    //All route product admin
    Route::get('/view', [ProductController::class, 'index'])->name('all.products');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::post('/update/{product_id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/edit/{product_id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/delete/{product_id}', [ProductController::class, 'delete'])->name('product.delete');
});


Route::prefix('/slider')->group(function() {

    //All route product admin
    Route::get('/view', [SliderController::class, 'index'])->name('all.sliders');
    Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::post('/update/{slider_id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/edit/{slider_id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::get('/delete/{slider_id}', [SliderController::class, 'delete'])->name('slider.delete');
});