<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {   
        $this->productService = $productService;
    }
    
    public function index($categorySlug, Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        $products = $this->productService->getProductsByCategory($categorySlug);
        $currentPage = $products ? $products->currentPage() : 0;
        $lastPage = $products ? $products->lastPage() : 0;

        return view('web.category.shop_page', compact('categories', 'sliders', 'products', 'productTags', 'lastPage', 'currentPage'));
    }
}
