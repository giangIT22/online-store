<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Size;
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
                'product_price' => $product->sale_price ?? $product->product_price,
                'size_id' => $params['size_id'],
                'color_id' => $params['color_id']
            ]);
        } else {
            $productInCart = DB::table('product_cart')
                ->where('cart_id', $cart->id)
                ->where('size_id', $params['size_id'])
                ->where('color_id', $params['size_id'])
                ->where('product_id', $params['product_id'])->first();

            if ($productInCart) {
                DB::table('product_cart')
                    ->where('product_id', $params['product_id'])
                    ->where('cart_id', $cart->id)
                    ->where('size_id', $params['size_id'])
                    ->where('color_id', $params['color_id'])
                    ->update([
                        'amount' => $params['amount'] + $productInCart->amount,
                        'product_price' => $product->sale_price ?? $product->product_price
                    ]);
            } else {
                DB::table('product_cart')->insert([
                    'cart_id' => $cart->id,
                    'product_id' => $params['product_id'],
                    'amount' => $params['amount'],
                    'product_price' => $product->sale_price ?? $product->product_price,
                    'size_id' => $params['size_id'],
                    'color_id' => $params['color_id']
                ]);
            }
        }
        $productsInCart = collect([]);

        $products = DB::table('product_cart')
            ->select('product_id', 'amount', 'product_price', 'size_id', 'color_id')
            ->where('cart_id', $cart->id)->get();

        foreach ($products as $item) {
            $product = DB::table('products')->where('id', $item->product_id)->first();
            $productsInCart->push([
                'product_id' => $product->id,
                'product_slug' => $product->product_slug,
                'product_image' => $product->image,
                'product_name' => $product->name,
                'product_price' => $item->product_price,
                'amount' => $item->amount,
            ]);
        }

        return $productsInCart;
    }

    public function deleteCart($params)
    {
        $cart = Auth::user()->cart;
        $flag = false;
        $query = DB::table('product_cart')->where('cart_id', $cart->id)
            ->where('product_id', $params['product_id'])
            ->where('size_id', $params['size_id'])
            ->where('color_id', $params['color_id']);
        $product = $query->first();

        if ($product) {
            $query->delete();
        }

        $productsInCart = collect([]);

        $products = DB::table('product_cart')
            ->select('product_id', 'amount', 'product_price')
            ->where('cart_id', $cart->id)->get();

        if ($products) {
            foreach ($products as $item) {
                $product = Product::where('id', $item->product_id)->first();
                $productsInCart->push([
                    'product_id' => $product->id,
                    'product_slug' => $product->product_slug,
                    'product_image' => $product->image,
                    'product_name' => $product->name,
                    'product_price' => $item->product_price,
                    'amount' => $item->amount,
                ]);
            }
        }

        $carts = DB::table('product_cart')->where('cart_id', $cart->id)->get();
        $sumTotal = 0;

        if (empty($carts->all())) {
            $cart->delete();
            $flag = true;
        } else {
            foreach ($carts as $cart) {
                $price = $cart->amount * $cart->product_price;
                $sumTotal += $price;
            }
        }

        return [true, $flag, $productsInCart, $sumTotal];
    }

    public function updateCart($params)
    {
        $cart = Auth::user()->cart;
        $query = DB::table('product_cart')->where('cart_id', $cart->id)
            ->where('product_id', $params['product_id'])
            ->where('size_id', $params['size_id'])
            ->where('color_id', $params['color_id']);
        $product = $query->first();

        if ($params['amount'] > $product->amount) {
            $amount = ++$product->amount;
            $query->update([
                'amount' => $amount
            ]);
        }

        if ($params['amount'] < $product->amount) {
            $amount = --$product->amount;
            $query->update([
                'amount' => $amount
            ]);
        }

        $sumTotal = 0;
        $products = DB::table('product_cart')->where('cart_id', $cart->id)->get();
        $count = $products->sum('amount');

        foreach ($products as $product) {
            $price = $product->amount * $product->product_price;
            $sumTotal += $price;
        }

        return [$query->first(), $sumTotal, $count];
    }
}
