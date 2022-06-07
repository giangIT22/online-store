<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function getProductsByTag($tagName, $sort = null, $minPrice = null, $maxPrice = null);
    public function getProductsByCategory($categorySlug);
    public function getRelatedProducts($productId);
    public function addReviewProduct($params);
    public function getBestSellProducts();
}
