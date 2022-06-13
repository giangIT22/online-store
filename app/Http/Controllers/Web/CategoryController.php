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
use Illuminate\Support\Facades\Validator;

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
        $data = $this->productService->getProductsByCategory($categorySlug);
        $products = $data->items();

        if ($request->sort == 1) {
            $products = array_reverse($data->items());
        }
        
        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $data->lastPage()
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        $currentPage = $data ? $data->currentPage() : 0;
        $lastPage = $data ? $data->lastPage() : 0;

        return view('web.category.shop_page', compact('categories', 'sliders', 'products', 'productTags', 'lastPage', 'currentPage'));
    }

    public function allProducts(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        $data = Product::orderBy('product_price')->paginate(Product::PER_PAGE);
        $products = $data->items();

        if ($request->sort == 1) {
            $products = array_reverse($data->items());
        }
        
        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $data->lastPage()
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        $currentPage = $data ? $data->currentPage() : 0;
        $lastPage = $data ? $data->lastPage() : 0;

        return view('web.category.all_products', compact('categories', 'sliders', 'products', 'productTags', 'lastPage', 'currentPage'));   
    }
}
