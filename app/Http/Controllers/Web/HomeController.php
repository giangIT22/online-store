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
        $data = $this->productService->getDataForHomePage();
        $data['blogs'] = $this->blogService->getListBlog(Blog::BLOG_SLIDER)['listBlogs'];
        $data['bestSellProducts'] = $this->productService->getBestSellProducts();

        return view('web.index', $data);
    }

    public function productDetail($productId)
    {
        $productDetail = Product::findOrFail($productId);
        $categories = Category::with('subCategories')->get();
        $multiImages = $productDetail->images;
        $relatedProducts = $this->productService->getRelatedProducts($productId);
        $reviews = Review::where('product_id', $productId)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $sizes = Size::all();

        return view('web.product.product_detail', compact(
            'productDetail',
            'categories',
            'multiImages',
            'relatedProducts',
            'reviews',
            'sizes'
        ));
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
