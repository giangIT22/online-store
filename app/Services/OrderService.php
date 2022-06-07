<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function storeOrder($params)
    {
        $data = $params;

        if ($params['payment_type'] == 'COD') {
            //create oder
            $data['user_id'] = Auth::id();
            $data['order_code'] = rand(1000000, 2000000);
            $order = Order::create($data);

            //create order_item
            $cart = Cart::where('user_id', Auth::id())->first();
            $products = DB::table('product_cart')->where('cart_id', $cart->id)->get();

            foreach ($products as $item) {
                DB::table('order_item')->insert([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'product_price' => $item->price,
                    'created_at' => now()
                ]);

                //caculate amount of product
                $product = Product::findOrFail($item->product_id);
                $product->product_qty = $product->product_qty - $item->amount;
                $product->save();

                DB::table('product_cart')->where('cart_id', $cart->id)->delete();
                $cart->delete();
            }
        }
    }

    public function getOrdersOfUser($userId)
    {
        $orders = Order::where('user_id', $userId)->orderByDesc('created_at')->get();

        return $orders;
    }

    public function getOrderDetail($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            abort(404);
        } else {
            if ($order->coupon_code) {
                $coupon = Coupon::where('coupon_name', $order->coupon_code)->first()->coupon_discount;
            } else {
                $coupon = 0;
            }

            $orderItem = DB::table('order_item')
                ->select('products.name', 'products.product_code', 'order_item.amount', 'order_item.product_price', 'products.image')
                ->join('products', 'order_item.product_id', 'products.id',)
                ->where('order_id', $order->id)
                ->get();
        }

        return [$order, $orderItem, $coupon];
    }

    public function getOrders()
    {
        $data = Order::orderByDesc('created_at')->paginate(Order::PER_PAGE);

        return [
            'listOrder' =>  $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
        ];
    }

    public function cancelOrder($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();

        $order->update([
            'cancel_date' => now(),
            'status' => Order::CANCELED
        ]);

        $products = DB::table('order_item')->where('order_id', $order->id)->get();

            foreach ($products as $item) {
                //caculate amount of product after cancel order
                $product = Product::findOrFail($item->product_id);
                $product->product_qty = $product->product_qty + $item->amount;
                $product->save();
            }
    }
}
