<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductDetail;
use App\Models\Size;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService implements CartServiceInterface
{
    public function addProductToCart($params)
    {
        $product = Product::findOrFail($params['product_id']);
        $productDetail = ProductDetail::where('product_id', $product->id)
                        ->where('color_id', $params['color_id'])
                        ->where('size_id', $params['size_id'])
                        ->first();
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id()
            ]);
 
            ProductCart::create([
                'cart_id' => $cart->id,
                'amount' => $params['amount'],
                'product_price' => $product->sale_price != 0 ? $product->sale_price : $product->product_price,
                'product_detail_id' => $productDetail->id
            ]);
        } else {
            $productInCart = ProductCart::where('cart_id', $cart->id)
                ->where('product_detail_id', $productDetail->id)
                ->first();

            if ($productInCart) {
                DB::table('product_cart')
                    ->where('cart_id', $cart->id)
                    ->where('product_detail_id', $productDetail->id)
                    ->update([
                        'amount' => $params['amount'] + $productInCart->amount,
                        'product_price' => $product->sale_price != 0 ? $product->sale_price : $product->product_price,
                    ]);
            } else {
                DB::table('product_cart')->insert([
                    'cart_id' => $cart->id,
                    'amount' => $params['amount'],
                    'product_price' => $product->sale_price != 0 ? $product->sale_price : $product->product_price,
                    'product_detail_id' => $productDetail->id
                ]);
            }
        }
        $productsInCart = collect([]);

        $products = ProductCart::select('product_detail_id', 'amount', 'product_price')
            ->where('cart_id', $cart->id)->get();

        foreach ($products as $item) {
            $productDetail = $item->productDetail;
            $product = DB::table('products')->where('id', $productDetail->product_id)->first();
            $productsInCart->push([
                'product_id' => $product->id,
                'product_image' => $product->image,
                'product_name' => $product->name,
                'product_price' => $item->product_price,
                'amount' => $item->amount,
            ]);
        }

        return $productsInCart;
    }

    public function addProductToSection($params)
    {
        
    }

    public function deleteCart($params)
    {
        $cart = Auth::user()->cart;
        $flag = false;
        $productDetail = ProductDetail::where('product_id', $params['product_id'])
                        ->where('size_id', $params['size_id'])
                        ->where('color_id', $params['color_id'])
                        ->first();
        $query = ProductCart::where('cart_id', $cart->id)
            ->where('product_detail_id', $productDetail->id);
        $product = $query->first();

        if ($product) {
            $query->delete();
        }

        $productsInCart = collect([]);

        $products = ProductCart::select('product_detail_id', 'amount', 'product_price')
            ->where('cart_id', $cart->id)->get();

        if ($products) {
            foreach ($products as $item) {
                $productDetail = ProductDetail::findOrFail($item->product_detail_id);
                $product = Product::where('id', $productDetail->product_id)->first();
                $productsInCart->push([
                    'product_id' => $product->id,
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
        $productDetail = ProductDetail::where('product_id', $params['product_id'])
                        ->where('size_id', $params['size_id'])
                        ->where('color_id', $params['color_id'])
                        ->first();
        $query = ProductCart::where('cart_id', $cart->id)
            ->where('product_detail_id', $productDetail->id);
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
        $products = ProductCart::where('cart_id', $cart->id)->get();
        $count = $products->sum('amount');

        foreach ($products as $product) {
            $price = $product->amount * $product->product_price;
            $sumTotal += $price;
        }

        return [$query->first(), $sumTotal, $count];
    }
}
