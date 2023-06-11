<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductCart;
use App\Notifications\SendOrderNotification;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create()
    {
        $categories = Category::with('subCategories')->get();

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $products = ProductCart::join('product_details', 'product_cart.product_detail_id', 'product_details.id')
                    ->join('sizes', 'product_details.size_id', 'sizes.id')
                    ->join('colors', 'product_details.color_id', 'colors.id')
                    ->join('products', 'product_details.product_id', 'products.id')
                    ->select(
                        'products.id',
                        'products.name',
                        'products.image',
                        'product_cart.amount',
                        'product_cart.product_price',
                        'product_details.size_id',
                        'product_details.color_id',
                        'sizes.name as size_name',
                        'colors.name as color_name'
                    )
                    ->where('cart_id', $cart->id)
                    ->get();

                return view('web.checkout.checkout_view', compact('categories', 'products'));
            } else {
                return redirect()->route('cart.view');
            }
        } else {
            $notification = [
                'message' => 'Bạn cần phải đăng nhập',
                'alert-type' => 'error'
            ];

            return redirect()->route('user.login')->with($notification);
        }
    }

    public function storeOrder(OrderRequest $request)
    {
        DB::beginTransaction();
        try {  
            $this->orderService->storeOrder($request->all());
            DB::commit();
            if ($request->payment_type == 'Visa') {
                return redirect()->route('checkout.pay');
            }

            $notification = [
                'message' => 'Đặt hàng thành công',
                'alert-type' => 'success'
            ];

            return redirect()->route('index')->with($notification);
        } catch(\Exception $e) {
            DB::rollBack();
        }
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('status', 1)->first();
        if (!isset($coupon)) {
            return response()->json([
                'status' => false
            ]);
        }
        
        if ($coupon->minimum_price <= $request->sum_price) {
            if ($coupon) {
                return response()->json([
                    'status' => true,
                    'coupon_discount' => $coupon->coupon_discount,
                    'total_price' => $request->sum_price
                ]);
            }
        }

        return response()->json([
            'status' => false
        ]);
    }

    public function removeCoupon()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $products = ProductCart::select('product_cart.product_detail_id', DB::raw('SUM(product_cart.amount * product_cart.product_price) as totalPrice'))
            ->where('cart_id', $cart->id)
            ->groupBy('product_cart.product_detail_id')
            ->get();

        return response()->json([
            'status' => true,
            'total_price' => $products->sum('totalPrice')
        ]);
    }

    /**
     * Open form checkout payment with credit card
     */
    public function pay()
    {
        if (Auth::check()) {
            $order = Order::where('user_id', auth()->id())
                ->where('payment_status', 0)
                ->latest()->firstOrfail();

            $categories = Category::with('subCategories')->get();
            $paymentIntent = auth()->user()->createSetupIntent();//same csrf , it should have before post

            return view('web.checkout.checkout_pay', compact('order', 'categories', 'paymentIntent'));
        }

        return redirect()->route('index');
    }

    public function storePay(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $user = auth()->user();
        $price = round($order->sum_price / 23000, 2);
        $paymentMethod = $request->payment_method;

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($price * 100, $paymentMethod);
            $order->update([
                'payment_status' => Order::PAID
            ]);
        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }

        $notification = [
            'message' => 'Đặt hàng thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('index')->with($notification);
    }
}
