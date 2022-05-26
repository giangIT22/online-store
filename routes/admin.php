<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Web\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:' . config('fortify.guard')])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'store'])->name('admin.login.store');
    Route::get('/register', [RegisterController::class, 'index'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('admin.register.store');
});

Route::get('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    //====All route category==========
    Route::prefix('/category')->group(function () {
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

    //====All route product==========
    Route::prefix('/product')->group(function () {
        Route::get('/view', [ProductController::class, 'index'])->name('all.products');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::post('/update/{product_id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/edit/{product_id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('/delete/{product_id}', [ProductController::class, 'delete'])->name('product.delete');
    });

    //All route slider admin
    Route::prefix('/slider')->group(function () {
        Route::get('/view', [SliderController::class, 'index'])->name('all.sliders');
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::post('/update/{slider_id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('/edit/{slider_id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::get('/delete/{slider_id}', [SliderController::class, 'delete'])->name('slider.delete');
    });

    // all route blog admin 
    Route::prefix('/blog')->group(function () {
        Route::get('/view', [BlogController::class, 'index'])->name('all.blogs');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
        Route::post('/update/{blog_id}', [BlogController::class, 'update'])->name('blog.update');
        Route::get('/edit/{blog_id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::get('/delete/{blog_id}', [BlogController::class, 'delete'])->name('blog.delete');
    });

    // all route review admin 
    Route::prefix('/review')->group(function () {
        Route::get('/view', [ReviewController::class, 'view'])->name('all.reviews');
        Route::get('/pending-review', [ReviewController::class, 'viewPending'])->name('review.pending');
        Route::get('/update/{review_id}', [ReviewController::class, 'update'])->name('review.update');
        Route::get('/delete/{review_id}', [ReviewController::class, 'delete'])->name('review.delete');
    });
});
