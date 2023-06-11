<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderService implements OrderServiceInterface
{
    public function storeOrder($params)
    {
        $data = $params;

        //create oder
        $data['user_id'] = Auth::id();
        do {
            $data['order_code'] = 'Order' . rand(1000000, 2000000);
            $order = Order::where('order_code', $data['order_code'])->first();
        } while (isset($order));

        $order = Order::create($data);

        //create order_item
        $cart = Cart::where('user_id', Auth::id())->first();
        $products = ProductCart::where('cart_id', $cart->id)->get();

        foreach ($products as $item) {
            DB::table('order_item')->insert([
                'order_id' => $order->id,
                'product_detail_id' => $item->product_detail_id,
                'amount' => $item->amount,
                'product_price' => $item->product_price,
                'created_at' => now()
            ]);

            //caculate amount of product
            $product = ProductDetail::findOrFail($item->product_detail_id)->product;
            $product->amount = $product->amount - $item->amount;
            $product->save();

            $query = DB::table('product_details')
                ->where('id', $item->product_detail_id);
            $productDetail = $query->first();

            $query->update([
                'amount' => $productDetail->amount - $item->amount
            ]);

            DB::table('product_cart')->where('cart_id', $cart->id)->delete();

            $cart->delete();
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
                ->select(
                    'products.name',
                    'products.product_code',
                    'order_item.amount',
                    'order_item.product_price',
                    'products.image',
                    'sizes.name as size_name',
                    'colors.name as color_name'
                )
                ->join('product_details', 'order_item.product_detail_id', 'product_details.id')
                ->join('products', 'product_details.product_id', 'products.id')
                ->join('sizes', 'product_details.size_id', 'sizes.id')
                ->join('colors', 'product_details.color_id', 'colors.id')
                ->where('order_id', $order->id)
                ->get();
        }

        return [$order, $orderItem, $coupon];
    }

    public function getOrders()
    {
        $data = Order::with('admin')->orderByDesc('created_at')->paginate(Order::PER_PAGE);

        return [
            'listOrders' =>  $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
        ];
    }

    public function cancelOrder($orderCode, $status)
    {
        $order = Order::where('order_code', $orderCode)->first();

        $order->update([
            'cancel_date' => now(),
            'status' => $status,
            'reason_cancel' => request('reason_cancel') ?? $order->reason_cancel,
            'admin_id' => Auth::user()->id
        ]);

        $products = DB::table('order_item')->where('order_id', $order->id)->get();

        foreach ($products as $item) {
            //caculate amount of product after cancel order
            $productDetail = ProductDetail::findOrFail($item->product_detail_id);
            $product = $productDetail->product;
            $product->amount = $product->amount + $item->amount;
            $productDetail->amount = $productDetail->amount + $item->amount;
            $productDetail->save();
            $product->save();
        }
    }
    
    public function returnedOrder($orderCode, $status)
    {
        $this->cancelOrder($orderCode, $status);
    }

    /**
     * Get invoice monthy
     */
    public function getInvoiceMonthy()
    {
        $invoiceTimeEarliest = Order::orderBy('created_at')->first();
        $invoiceTimeLatest = Order::orderBy('created_at', 'desc')->first();

        if ($invoiceTimeEarliest && $invoiceTimeLatest) {
            $maximumDate = request('maximum_date')
                ? Carbon::parse(request('maximum_date'))
                : $invoiceTimeLatest->created_at;
            $invoices = Order::where('created_at', '<=', $maximumDate)->get();

            if (($maximumDate->year > $invoiceTimeLatest->created_at->year) || ($maximumDate->year < $invoiceTimeEarliest->created_at->year)) {
                abort(404);
            }

            $invoices = $invoices->groupBy(function ($invoice) {
                return $invoice->created_at->year;
            })->transform(function ($invoice) {
                return $invoice->mapToGroups(function ($item) {
                    return [$item['created_at']->month => $item['sum_price']];
                })->transform(function ($item) {
                    return $item->sum();
                });
            });
        }

        return [
            'invoices' => $invoices ?? collect(),
            'min_year' => $invoiceTimeEarliest ? $invoiceTimeEarliest->created_at->year : 0,
            'max_year' => $invoiceTimeLatest ? $invoiceTimeLatest->created_at->year : 0,
            'maximum_date' => $maximumDate->year ?? 0
        ];
    }

    /**
     * Get invoice yearly
     * 
     */
    public function getInvoiceYearLy()
    {
        $invoiceTimeEarliest = Order::orderBy('created_at')->first();
        $invoiceTimeLatest = Order::orderBy('created_at', 'desc')->first();

        if ($invoiceTimeEarliest && $invoiceTimeLatest) {
            $maximumDate = request('maximum_date') ? Carbon::parse(request('maximum_date')) : $invoiceTimeLatest->created_at;
            $invoices = Order::where('created_at', '<=', $maximumDate)->get();

            if ($maximumDate->year > $invoiceTimeLatest->created_at->year) {
                abort(404);
            }

            $invoices = $invoices->mapToGroups(function ($invoice) {
                return [$invoice['created_at']->year => $invoice['sum_price']];
            })->transform(function ($item) {
                return $item->sum();
            });
        }

        return [
            'invoices' => $invoices ?? collect(),
            'min_year' => $invoiceTimeEarliest ? $invoiceTimeEarliest->created_at->year : 0,
            'max_year' => $invoiceTimeLatest ? $invoiceTimeLatest->created_at->year : 0,
            'maximum_date' => $maximumDate->year ?? 0
        ];
    }

    public function search($params)
    {
        $dataSearch = Order::search($params)->query(function($builder){
            return $builder->with('admin');
        })->paginate(Coupon::PER_PAGE);

        return [
            'listOrders' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }
}
