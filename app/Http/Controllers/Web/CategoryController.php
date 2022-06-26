<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductTag;
use App\Models\Slider;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index($categorySlug, $categoryId, Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        list($products, $currentPage, $lastPage) = $this->productService->getProductsByCategory($request->all(), $categorySlug, $categoryId);

        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $lastPage
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        return view('web.category.shop_page', compact('categories', 'sliders', 'products',
            'productTags', 'lastPage', 'currentPage'));
    }

    public function allProducts(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        list($products, $currentPage, $lastPage) = $this->productService->getAllProduct($request->all());

        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $lastPage
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        return view('web.category.all_products', compact('categories', 'sliders', 'products',
            'productTags', 'lastPage', 'currentPage'));
    }
}
