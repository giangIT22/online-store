<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Review;
use App\Models\Size;
use App\Models\Slider;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    public function getProductsByTag($tagName, $params)
    {
        $tag = ProductTag::where('name', $tagName)->first();

        if (!$tag) {
            abort(404);
        }

        $productIds = ProductTag::where('name', $tagName)->pluck('product_id')->toArray();
        $query = Product::whereIn('id', array_unique($productIds))
            ->orderBy('product_price');

        return $this->getData($params, $query);
    }

    public function getProductsByCategory($params,$categorySlug, $categoryId)
    {
        $subCategory = SubCategory::where('sub_category_slug', $categorySlug)->where('id', $categoryId)->first();
        $category = Category::where('slug', $categorySlug)->where('id', $categoryId)->first();

        if ($subCategory) {
            $query = Product::where('subcategory_id', $subCategory->id)->orderBy('product_price');
        } elseif ($category) {
            $query = Product::where('category_id', $category->id)->orderBy('product_price');
        } else {
            abort(404);
        }

        return $this->getData($params, $query);
    }

    public function getRelatedProducts($productId)
    {
        $product = Product::findOrFail($productId);
        $categoryId = $product->category->id;
        $tags = ProductTag::where('product_id', $productId)->pluck('name')->toArray();
        $productIds = ProductTag::whereIn('name', array_unique($tags))
            ->where('product_id', '<>', $productId)
            ->pluck('product_id')->toArray();
        $products = Product::where('category_id', $categoryId)
            ->whereIn('id', array_unique($productIds))
            ->get();

        return $products;
    }

    public function addReviewProduct($params)
    {
        $review = Review::create($params);

        return $review;
    }

    public function getBestSellProducts()
    {
        $products = DB::table('order_item')
            ->join('products', 'order_item.product_id', 'products.id')
            ->join('orders', 'order_item.order_id', 'orders.id')
            ->select(
                'order_item.product_id',
                'products.name',
                'products.product_slug',
                'products.image',
                'products.product_price',
                'products.sale_price',
                DB::raw('SUM(order_item.amount) as total_amount')
            )
            ->where('orders.status', Order::DELIVERED)
            ->groupBy(
                'order_item.product_id',
                'products.name',
                'products.product_slug',
                'products.image',
                'products.product_price',
                'products.sale_price'
            )
            ->orderBy('total_amount', 'desc')
            ->limit(8)
            ->get();

        return $products;
    }

    public function checkExistProduct($params)
    {
        $status = true;
        $productSize = DB::table('product_size')->where('size_id', $params['size_id'])
            ->where('product_id', $params['product_id'])->first();

        if (empty($productSize) || $productSize->amount == 0) {
            return $status = false;
        }

        return $status;
    }

    public function getAllProduct($params)
    {
        $query = Product::orderBy('product_price');

        return $this->getData($params, $query);
        
    }

    public function getData($params, $query)
    {
        $data = $query->paginate(Product::PER_PAGE);
        
        if (!empty($params['filter_value']) && in_array($params['filter_value'], Product::FILTER_VALUES)) {
            if ($params['filter_value'] == '<500000') {
                $data = $query->where('product_price', '<', 500000)->paginate(Product::PER_PAGE);
            } else if ($params['filter_value'] === '500000-1000000') {
                $data = $query->where('product_price', '>=', 500000)
                    ->where('product_price', '<=', 1000000)
                    ->paginate(Product::PER_PAGE);
            } else if ($params['filter_value'] == '1000000-2000000') {
                $data = $query->where('product_price', '>=', 1000000)
                    ->where('product_price', '<=', 2000000)
                    ->paginate(Product::PER_PAGE);
            } else if ($params['filter_value'] == '2000000-3000000') {
                $data = $query->where('product_price', '>=', 2000000)
                    ->where('product_price', '<=', 3000000)
                    ->paginate(Product::PER_PAGE);
            } else if ($params['filter_value'] == '>3000000') {
                $data = $query->where('product_price', '>', 3000000)->paginate(Product::PER_PAGE);
            }
        }

        if (!empty($params['sort']) && $params['sort'] == 1) {
            $products = array_reverse($data->items());
        }

        $currentPage = $data ? $data->currentPage() : 0;
        $lastPage = $data ? $data->lastPage() : 0;

        return [$products ?? $data->items(), $currentPage, $lastPage];
    }

    public function getDataForHomePage()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::orderBy('id', 'desc')
            ->where('created_at', '>', Carbon::now()->subDays(15))
            ->where('created_at', '<=', Carbon::now())
            ->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productTags = ProductTag::select('name')->limit(8)->groupBy('name')->get();
        $productByCategory = Category::with('products')->get();
        
        return compact(
            'categories',
            'sliders',
            'products',            
            'productTags',
            'productByCategory'
        );
    }
}
