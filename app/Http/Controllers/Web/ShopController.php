<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Slider;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {   
        $this->productService = $productService;
    }
    
    public function index($tagName, Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        $products = $this->productService->getProductsByTag($tagName, $request->sort, $request->minPrice, $request->maxPrice);
        $currentPage = $products->currentPage();
        $lastPage = $products->lastPage();

        $validator = Validator::make($request->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $products->lastPage()
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        return view('web.tag.tag_view', compact('categories', 'sliders', 'products', 'productTags', 'lastPage', 'currentPage'));

    }

    public function viewSearch()
    {
        $categories = Category::with('subCategories')->get();
        $dataSearch = Product::search(request('search'))->paginate(Product::PER_PAGE);
        $products = collect([]);

        array_map(function($item) use ($products){
            $products[] = $item;
        }, $dataSearch->items());
        
        $products = $products->sortBy('product_price')->sortBy('sale_price');
        $currentPage = $dataSearch->currentPage();
        $lastPage = $dataSearch->lastPage();

        $validator = Validator::make(request()->all(), [
            'sort' => 'in:0,1',
            'page' => 'integer|between:1,' . $dataSearch->lastPage()
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        if (request()->sort == 1) {
            $products = $products->sortByDesc('product_price');;
        }

        if (!request('search')) {
            return redirect()->route('index');
        }
    
        return view('web.search.view', compact('categories', 'products', 'currentPage', 'lastPage'));
    }
}
