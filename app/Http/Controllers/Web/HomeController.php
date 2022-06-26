<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Review;
use App\Models\Size;
use App\Models\Slider;
use App\Services\BlogServiceInterface;
use App\Services\ProductServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    protected $productService;
    protected $blogService;

    public function __construct(ProductServiceInterface $productService, BlogServiceInterface $blogService)
    {
        $this->productService = $productService;
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::orderBy('id', 'desc')
            ->where('created_at', '>', Carbon::now()->subDays(15))
            ->where('created_at', '<=', Carbon::now())
            ->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $featuredProducts = Product::where('featured', true)->orderBy('id', 'desc')->get();
        $hotDealProducts = Product::where('hot_deals', true)->where('sale_price', '!=', null)
            ->orderBy('id', 'desc')->get();
        $specialOfferProducts = Product::where('special_offer', true)->orderBy('id', 'desc')->limit(6)->get();
        $specialDealsProducts = Product::where('special_deals', true)->orderBy('id', 'desc')->limit(6)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        $blogs = $this->blogService->getListBlog(Blog::BLOG_SLIDER)['listBlogs'];
        $bestSellProducts = $this->productService->getBestSellProducts();
        $converse = Product::where('category_id', 1)->get();
        $vans = Product::where('category_id', 2)->get();

        return view('web.index', compact(
            'categories',
            'sliders',
            'products',
            'featuredProducts',
            'specialOfferProducts',
            'specialDealsProducts',
            'hotDealProducts',
            'productTags',
            'blogs',
            'bestSellProducts',
            'converse',
            'vans'
        ));
    }

    public function productDetail($productId)
    {
        $productDetail = Product::findOrFail($productId);
        $categories = Category::with('subCategories')->get();
        $multiImages = $productDetail->images;
        $hotDealProducts = Product::where('hot_deals', true)->where('sale_price', '!=', null)
            ->orderBy('id', 'desc')->limit(3)->get();
        $relatedProducts = $this->productService->getRelatedProducts($productId);
        $reviews = Review::where('product_id', $productId)
                    ->where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
        $sizes = Size::all();

        return view('web.product.product_detail', compact('productDetail', 'categories', 'multiImages',
            'hotDealProducts', 'relatedProducts', 'reviews', 'sizes'));
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

    public function storeReview(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'comment' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false
        //     ]);
        // }

        $data = $request->all();
        $data['product_id'] = $data['product_id'];
        $data['user_id'] = Auth::id();
        $review = $this->productService->addReviewProduct($data);
        
        return response()->json([
            'status' => true
        ]);
    }

    public function checkExistProduct(Request $request)
    {
        $status = $this->productService->checkExistProduct($request->all());

        return response()->json([
            'status' => $status
        ]);
    }
}
