<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService implements CartServiceInterface
{
    public function addProductToCart($params)
    {
        $product = Product::findOrFail($params['product_id']);
        $cart = Cart::where('product_id', $params['product_id'])->first();

        // if ($cart) {
        //     $cart->update([
        //         ''
        //     ])
        // }
    }
}