<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::orderBy('id', 'desc')->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $featuredProducts = Product::where('featured', true)->orderBy('id', 'desc')->limit(6)->get();
        $hotDealProducts = Product::where('hot_deals', true)->where('sale_price', '!=', null)
                            ->orderBy('id', 'desc')->limit(3)->get();
        $specialOfferProducts = Product::where('special_offer', true)->orderBy('id', 'desc')->limit(9)->get();
        $specialDealsProducts = Product::where('special_deals', true)->orderBy('id', 'desc')->limit(9)->get();

        return view('web.index', compact('categories', 'sliders', 'products', 'featuredProducts',
            'specialOfferProducts', 'specialDealsProducts', 'hotDealProducts'));
    }

    public function productDetail($productId)
    {
        $product = Product::findOrFail($productId);
        $categories = Category::with('subCategories')->get();
        $multiImages = $product->images;

        return view('web.product.product_detail', compact('product', 'categories', 'multiImages'));
    }
}
