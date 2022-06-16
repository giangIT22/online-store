<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Review;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    public function getProductsByTag($tagName, $sort = 0)
    {
        $tag = ProductTag::where('name', $tagName)->first();

        if (!$tag) {
            abort(404);
        }

        $productIds = ProductTag::where('name', $tagName)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', array_unique($productIds))
            ->orderBy('product_price')
            ->paginate(Product::PER_PAGE);

        if ($sort == 1) {
            $products = Product::whereIn('id', array_unique($productIds))
                ->orderBy('product_price', 'desc')
                ->paginate(Product::PER_PAGE);
        }

        return $products;
    }

    public function getProductsByCategory($categorySlug)
    {
        $subCategory = SubCategory::where('sub_category_slug', $categorySlug)->first();
        $category = Category::where('slug', $categorySlug)->first();

        if ($subCategory) {
            $products = Product::where('subcategory_id', $subCategory->id)->orderBy('product_price')->paginate(Product::PER_PAGE);
        } elseif ($category) {
            $products = Product::where('category_id', $category->id)->orderBy('product_price')->paginate(Product::PER_PAGE);
        } else {
            abort(404);
        }

        return $products;
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
}
