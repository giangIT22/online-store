<?php

namespace App\Services;

interface ProductServiceInterface
{    
    public function getProductsByCategory($params, $categoryId);
    public function getProductsBySubCategory($params, $subCategoryId);
    public function getRelatedProducts($productId);
    public function addReviewProduct($params);
    public function getBestSellProducts();
    public function checkExistProduct($params);
    public function getAllProduct($params);
    public function getDataForHomePage();
    public function getSizeByColor($params);
}
