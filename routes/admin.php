<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SupplyCompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:admin', 'prevent-back-history'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'store'])->name('admin.login.store');
    Route::get('/register', [RegisterController::class, 'index'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('admin.register.store');
    Route::get('/forgot-password', [ResetPasswordController::class, 'forgetPassword'])->name('admin-password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'store'])->name('admin-password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'verifyEmail'])->name('admin-password.reset');
    Route::post('/reset-password/{admin_id}', [ResetPasswordController::class, 'updatePassword'])->name('password.admin-update');
});

Route::get('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

//================================Tabs of Admin Page==============================================================================
Route::middleware(['auth:admin', 'prevent-back-history'])->group(function () {
    Route::get('/invoice-monthy', [InvoiceController::class, 'getInvoiceMonthy'])->name('invoice.monthy');
    Route::get('/invoice-yearly', [InvoiceController::class, 'getInvoiceYearLy'])->name('invoice.yearly');

    //===== Admin progile =====
    Route::get('/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');

    Route::get('/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');

    Route::post('/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');

    Route::get('/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');

    Route::post('/update/change/password', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.update.password');

    //===== All route category =====
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('all.categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/update/{category_id}', [CategoryController::class, 'updateCategory'])->name('category.update');
        Route::get('/edit/{category_id}', [CategoryController::class, 'update'])->name('category.edit');
        Route::get('/delete/{category_id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/search', [CategoryController::class, 'searchCategory'])->name('category.search');

        //===== All route subcategory admin =====
        Route::get('/sub/view', [SubCategoryController::class, 'index'])->name('all.sub_categories');
        Route::get('/sub/create', [SubCategoryController::class, 'create'])->name('sub_category.create');
        Route::post('/sub/store', [SubCategoryController::class, 'store'])->name('sub_category.store');
        Route::post('/sub/update/{sub_category_id}', [SubCategoryController::class, 'update'])->name('sub_category.update');
        Route::get('/sub/edit/{sub_category_id}', [SubCategoryController::class, 'edit'])->name('sub_category.edit');
        Route::get('/sub/delete/{sub_category_id}', [SubCategoryController::class, 'delete'])->name('sub_category.delete');
        Route::get('/sub/{sub_category_id}', [SubCategoryController::class, 'getSubcategories']);
    });

    //===== All route product =====
    Route::prefix('/product')->group(function () {
        Route::get('/view', [ProductController::class, 'index'])->name('all.products');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::post('/update/{product_id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/edit/{product_id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::get('/delete/{product_id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    });

    //===== All route receipt =====
    Route::prefix('/receipt')->group(function () {
        Route::get('/view', [ReceiptController::class, 'all'])->name('all.receipts');
        Route::get('/create', [ReceiptController::class, 'create'])->name('receipt.create');
        Route::post('/store', [ReceiptController::class, 'store'])->name('receipt.store');
        Route::post('/update/{receipt_id}', [ReceiptController::class, 'update'])->name('receipt.update');
        Route::get('/detail/{receipt_id}', [ReceiptController::class, 'detail'])->name('receipt.edit');
        Route::get('/delete/{receipt_id}', [ReceiptController::class, 'delete'])->name('receipt.delete');
        Route::get('/search', [ReceiptController::class, 'search'])->name('receipt.search');
    });

     //===== All route supply company =====
     Route::prefix('/company')->group(function () {
        Route::get('/view', [SupplyCompanyController::class, 'index'])->name('all.companies');
        Route::get('/create', [SupplyCompanyController::class, 'create'])->name('company.create');
        Route::post('/store', [SupplyCompanyController::class, 'store'])->name('company.store');
        Route::post('/update/{company_id}', [SupplyCompanyController::class, 'update'])->name('company.update');
        Route::get('/edit/{company_id}', [SupplyCompanyController::class, 'edit'])->name('company.edit');
        Route::get('/delete/{company_id}', [SupplyCompanyController::class, 'delete'])->name('company.delete');
        Route::get('/search', [SupplyCompanyController::class, 'search'])->name('company.search');
    });

    //===== All route slider admin =====
    Route::prefix('/banner')->group(function () {
        Route::get('/view', [BannerController::class, 'index'])->name('all.sliders');
        Route::get('/create', [BannerController::class, 'create'])->name('slider.create');
        Route::post('/store', [BannerController::class, 'store'])->name('slider.store');
        Route::post('/update/{slider_id}', [BannerController::class, 'update'])->name('slider.update');
        Route::get('/edit/{slider_id}', [BannerController::class, 'edit'])->name('slider.edit');
        Route::get('/delete/{slider_id}', [BannerController::class, 'delete'])->name('slider.delete');
    });

    //===== all route blog admin =====
    Route::prefix('/blog')->group(function () {
        Route::get('/view', [BlogController::class, 'index'])->name('all.blogs');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
        Route::post('/update/{blog_id}', [BlogController::class, 'update'])->name('blog.update');
        Route::get('/edit/{blog_id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::get('/delete/{blog_id}', [BlogController::class, 'delete'])->name('blog.delete');
    });

    //===== all route review admin =====
    Route::prefix('/review')->group(function () {
        Route::get('/view', [ReviewController::class, 'view'])->name('all.reviews');
        Route::get('/pending-review', [ReviewController::class, 'viewPending'])->name('review.pending');
        Route::get('/update/{review_id}', [ReviewController::class, 'update'])->name('review.update');
        Route::get('/delete/{review_id}', [ReviewController::class, 'delete'])->name('review.delete');
    });

    //===== all route coupon admin =====
    Route::prefix('/coupon')->group(function () {
        Route::get('/view', [CouponController::class, 'index'])->name('all.coupons');
        Route::get('/create', [CouponController::class, 'create'])->name('coupon.create')->middleware('role');
        Route::post('/store', [CouponController::class, 'store'])->name('coupon.store')->middleware('role');
        Route::post('/update/{coupon_id}', [CouponController::class, 'update'])->name('coupon.update')->middleware('role');
        Route::get('/edit/{coupon_id}', [CouponController::class, 'edit'])->name('coupon.edit')->middleware('role');
        Route::get('/delete/{coupon_id}', [CouponController::class, 'delete'])->name('coupon.delete')->middleware('role');
        Route::get('/search', [CouponController::class, 'search'])->name('coupon.search');
    });

    //===== all route orders admin =====
    Route::prefix('/orders')->group(function () {
        Route::get('/view', [OrderController::class, 'index'])->name('all.orders');
        Route::get('/detail/{order_code}', [OrderController::class, 'detail'])->name('order.detail');
        Route::get('/confirm-order/{order_code}', [OrderController::class, 'confirmOrder'])->name('order.confirm');
        Route::get('/shipping-order/{order_code}', [OrderController::class, 'shippingOrder'])->name('order.shipping');
        Route::get('/delivered-order/{order_code}', [OrderController::class, 'deliveredOrder'])->name('order.delivered');
        Route::get('/cancel-order/{order_code}', [OrderController::class, 'cancelOrder'])->name('order.cancel');
        Route::get('/dowload/{order_code}', [OrderController::class, 'dowloadOrderPdf'])->name('order.dowload');
        Route::get('/search', [OrderController::class, 'search'])->name('order.search');
    });

    // Admin Get All User Routes 
    Route::prefix('user')->group(function () {
        Route::get('/view', [AdminProfileController::class, 'allUsers'])->name('all.users');
        Route::get('/delete/{user_id}', [AdminProfileController::class, 'deleteUser'])->name('user.delete')->middleware('role');;
        Route::get('/search', [AdminProfileController::class, 'search'])->name('user.search');
    });

    //===== all employee ==================
    Route::prefix('/employee')->group(function() {
        Route::get('/view', [EmployeeController::class, 'index'])->name('all.employees');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware('role');;
        Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store')->middleware('role');;
        Route::post('/update/{employee_id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware('role');;
        Route::get('/edit/{employee_id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('role');;
        Route::get('/delete/{employee_id}', [EmployeeController::class, 'delete'])->name('employee.delete')->middleware('role');;
        Route::get('/search', [EmployeeController::class, 'search'])->name('employee.search');
    });   
});
