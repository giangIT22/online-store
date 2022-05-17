<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::orderBy('id', 'desc')->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $featuredProducts = Product::where('featured', true)->orderBy('id', 'desc')->limit(6)->get();
        $hotDealProducts = Product::where('hot_deals', true)->where('sale_price', '!=', null)
                            ->orderBy('id', 'desc')->limit(3)->get();
        $specialOfferProducts = Product::where('special_offer', true)->orderBy('id', 'desc')->limit(9)->get();
        $specialDealsProducts = Product::where('special_deals', true)->orderBy('id', 'desc')->limit(9)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();

        return view('web.index', compact('categories', 'sliders', 'products', 'featuredProducts',
            'specialOfferProducts', 'specialDealsProducts', 'hotDealProducts', 'productTags'));
    }

    public function productDetail($productId)
    {
        $productDetail = Product::findOrFail($productId);
        $categories = Category::with('subCategories')->get();
        $multiImages = $productDetail->images;
        $hotDealProducts = Product::where('hot_deals', true)->where('sale_price', '!=', null)
                            ->orderBy('id', 'desc')->limit(3)->get();

        return view('web.product.product_detail', compact('productDetail', 'categories', 'multiImages', 'hotDealProducts'));
    }

    public function previewProduct($productId)
    {
        $productDetail = Product::findOrFail($productId);
        $multiImages = $productDetail->images;

        return response()->json([
            'product_detail' => $productDetail,
            'multi_images' => $multiImages
        ]);
    }
}
