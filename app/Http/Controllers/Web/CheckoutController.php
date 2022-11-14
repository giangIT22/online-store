<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\ProductCart;
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
        $this->orderService->storeOrder($request->all());

        $notification = [
            'message' => 'Đặt hàng thành công',
            'alert-type' => 'success'
        ];

        return redirect()->route('index')->with($notification);
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
            // $cart = Cart::where('user_id', Auth::id())->first();
            // $products = DB::table('product_cart')
            //     ->select('product_cart.product_detail_id', DB::raw('SUM(product_cart.amount * product_cart.price) as totalPrice'))
            //     ->where('cart_id', $cart->id)
            //     ->groupBy('product_cart.product_detail_id')
            //     ->get();

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
}
