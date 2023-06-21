<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductTag;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\Size;
use App\Models\Slider;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    public function getProductsByCategory($params, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $query = Product::where('category_id', $category->id)->orderBy('product_price');
        return $this->getData($params, $query);
    }

    public function getProductsBySubCategory($params, $categoryId)
    {
        $category = SubCategory::findOrFail($categoryId);
        $query = Product::where('subcategory_id', $category->id)->orderBy('product_price');
        return $this->getData($params, $query);
    }

    public function getRelatedProducts($productId)
    {
        $product = Product::findOrFail($productId);
        $categoryId = $product->category->id;
        $products = Product::where('category_id', $categoryId)
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
            ->join('orders', 'order_item.order_id', 'orders.id')
            ->join('product_details', 'order_item.product_detail_id', 'product_details.id')
            ->join('products', 'product_details.product_id', 'products.id')
            ->select(
                'order_item.product_detail_id',
                'products.name',
                'products.id as product_id',
                'products.image',
                'products.product_price',
                'products.sale_price',
                DB::raw('SUM(order_item.amount) as total_amount')
            )
            ->where('orders.status', Order::DELIVERED)
            ->groupBy(
                'order_item.product_detail_id',
                'products.name',
                'products.image',
            )
            ->orderBy('total_amount', 'desc')
            ->limit(8)
            ->get();

        return $products;
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
            ->where('status', Product::PUBLIC)
            ->limit(6)->get();
        $banners = Banner::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $productByCategory = Category::with('products')->get();
        
        return compact(
            'categories',
            'banners',
            'products',
            'productByCategory'
        );
    }

    public function checkExistProduct($params)
    {
        $status = true;
        $productVariant = ProductDetail::where('color_id', $params['color_id'])
            ->where('size_id', $params['size_id'])
            ->where('product_id', $params['product_id'])->first();

        if (empty($productVariant) || $productVariant->amount == 0) {
            return $status = false;
        }

        return $status;
    }

    public function getSizeByColor($params)
    {
        $data = ProductDetail::where('product_id', $params['product_id'])
            ->where('color_id', $params['color_id'])
            ->pluck('size_id')->all();

        $sizes = Size::whereIn('id', $data)->get();
        return $sizes;
    }

    public function all()
    {
        $data = Product::with(['category', 'subCategory'])->orderBy('created_at', 'desc')->paginate(Product::PER_PAGE);
        return [
            'listProducts' =>  $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage()
        ];
    }

    public function search($params)
    {
        $dataSearch = Product::search($params)->query(function ($builder) {
            $builder->with('category');
        })->paginate(Product::PER_PAGE);

        return [
            'listProducts' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }
}
