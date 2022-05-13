<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService implements CartServiceInterface
{
    public function addProductToCart($params)
    {
        $product = Product::findOrFail($params['product_id']);
        $cart = Cart::whereHas('products', function($query) use ($params) {
                    $query->where('product_id', $params['product_id']); 
                })->where('user_id', Auth::id())
                ->first();

        if ($cart && $cart->products[0]->id== $params['product_id']) {
            $cart->update([
                'amount' => $params['amount'] + $cart->amount
            ]);
        } else {
            DB::beginTransaction();
            try {
                $cart = Cart::create([
                    'product_image' => $product->image,
                    'product_name' => $product->name,
                    'product_price' => $product->product_price,
                    'amount' => $params['amount'],
                    'user_id' => Auth::id()
                ]);

                DB::table('product_cart')->insert([
                    'cart_id' => $cart->id,
                    'product_id' => $params['product_id']
                ]);

                DB::commit();
            
            } catch(Exception $e) {
                
                DB::rollBack();
            }
        }

        $carts = Cart::where('user_id', Auth::id())->get();

        return $carts;
    }
}