<?php

namespace App\Services;

interface CartServiceInterface
{
    public function addProductToCart($params);
    public function deleteCart($productId);
}