<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\AdminServiceInterface;
use App\Services\BlogService;
use App\Services\BlogServiceInterface;
use App\Services\CartService;
use App\Services\CartServiceInterface;
use App\Services\CategoryService;
use App\Services\CategoryServiceInterface;
use App\Services\CouponService;
use App\Services\CouponServiceInterface;
use App\Services\OrderService;
use App\Services\OrderServiceInterface;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use App\Services\ReceiptService;
use App\Services\ReceiptServiceInterface;
use App\Services\ReviewService;
use App\Services\ReviewServiceInterface;
use App\Services\SupplyCompanyService;
use App\Services\SupplyCompanyServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   $this->app->singleton(AdminServiceInterface::class, AdminService::class);
        $this->app->singleton(CouponServiceInterface::class, CouponService::class);
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
        $this->app->singleton(ReviewServiceInterface::class, ReviewService::class);
        $this->app->singleton(UserServiceInterface::class, UserService::class);
        $this->app->singleton(CategoryServiceInterface::class, CategoryService::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
        $this->app->singleton(CartServiceInterface::class, CartService::class);
        $this->app->singleton(BlogServiceInterface::class, BlogService::class);
        $this->app->singleton(SupplyCompanyServiceInterface::class, SupplyCompanyService::class);
        $this->app->singleton(ReceiptServiceInterface::class, ReceiptService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
