<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
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

    public function index($categoryId, Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Banner::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        list($products, $currentPage, $lastPage) = $this->productService->getProductsByCategory($request->all(), $categoryId);

        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $lastPage
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        return view('web.category.shop_page', compact('categories', 'sliders', 'products',
            'lastPage', 'currentPage'));
    }

    public function getProductBySubCategory($subCategoryId, Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Banner::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        list($products, $currentPage, $lastPage) = $this->productService->getProductsBySubCategory($request->all(), $subCategoryId);

        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $lastPage
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        return view('web.category.shop_page', compact('categories', 'sliders', 'products',
            'lastPage', 'currentPage'));
    }

    public function allProducts(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Banner::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        list($products, $currentPage, $lastPage) = $this->productService->getAllProduct($request->all());

        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $lastPage
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        return view('web.category.all_products', compact('categories', 'sliders', 'products', 'lastPage', 'currentPage'));
    }
}
