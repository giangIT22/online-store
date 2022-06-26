<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function getProductsByTag($tagName, $params);
    public function getProductsByCategory($params, $categorySlug, $categoryId);
    public function getRelatedProducts($productId);
    public function addReviewProduct($params);
    public function getBestSellProducts();
    public function checkExistProduct($params);
    public function getAllProduct($params);
}
