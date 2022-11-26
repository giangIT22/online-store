<?php

namespace App\Services;

interface CartServiceInterface
{
    public function addProductToCart($params);
    public function deleteCart($params);
    public function updateCart($params);
    public function addProductToSection($params);
}
