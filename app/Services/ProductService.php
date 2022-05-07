<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductTag;

class ProductService implements ProductServiceInterface
{
    public function getProductsByTag($tagName, $sort = 0, $minPrice = null, $maxPrice = null)
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

        if ($minPrice && $maxPrice) {
            $products = Product::whereIn('id', array_unique($productIds))
                            ->where('product_price' , '>=', $minPrice)
                            ->where('product_price', '<=', $maxPrice)
                            ->paginate(Product::PER_PAGE);
        }
        
        
        return $products;
    }

    public function getProductsByCategory($categoryId)
    {
        
    }
}