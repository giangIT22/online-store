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
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id()
            ]);

            DB::table('product_cart')->insert([
                'cart_id' => $cart->id,
                'product_id' => $params['product_id'],
                'amount' => $params['amount'],
                'price' => $product->sale_price ?? $product->product_price
            ]);
        } else {
            $productInCart = DB::table('product_cart')
                        ->where('cart_id', $cart->id)
                        ->where('product_id', $params['product_id'])->first();

            if ($productInCart) {
                DB::table('product_cart')->where('product_id', $params['product_id'])->where('cart_id', $cart->id)->update([
                    'amount' => $params['amount'] + $productInCart->amount,
                    'price' => $product->sale_price ?? $product->product_price
                ]);
            } else {
                DB::table('product_cart')->insert([
                    'cart_id' => $cart->id,
                    'product_id' => $params['product_id'],
                    'amount' => $params['amount'],
                    'price' => $product->sale_price ?? $product->product_price
                ]);
            }
        }
        $productsInCart = collect([]);

        $products = DB::table('product_cart')->select('product_id', 'amount', 'price')->where('cart_id', $cart->id)->get();

        foreach ($products as $item) {
            $product = DB::table('products')->where('id', $item->product_id)->first();
            $productsInCart->push([
                'product_image' => $product->image,
                'product_name' => $product->name,
                'product_price' => $item->price,
                'amount' => $item->amount,
            ]);
        }

        return $productsInCart;
    }

    public function deleteCart($productId)
    {
        $cart = Auth::user()->cart;
        $flag = false;
        $product = DB::table('product_cart')->where('cart_id', $cart->id)->where('product_id', $productId)->first();

        if ($product) {
            DB::table('product_cart')->where('cart_id', $cart->id)->where('product_id', $productId)->delete();
        }

        $productsInCart = collect([]);

        $products = DB::table('product_cart')->select('product_id', 'amount', 'price')->where('cart_id', $cart->id)->get();

        if ($products) {
            foreach ($products as $item) {
                $product = DB::table('products')->where('id', $item->product_id)->first();
                $productsInCart->push([
                    'product_image' => $product->image,
                    'product_name' => $product->name,
                    'product_price' => $item->price,
                    'amount' => $item->amount,
                ]);
            }
        }

        $carts = DB::table('product_cart')->where('cart_id', $cart->id)->first();

        if (empty($carts)) {
            $cart->delete();
            $flag = true;
        }
        
        return [true, $flag, $productsInCart];
    }
}