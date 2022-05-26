<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;

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
        $provinces = Province::get();

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $products = DB::table('product_cart')
                            ->join('products', 'product_cart.product_id', 'products.id')
                            ->select('products.id', 'products.name', 'products.image', 'amount', 'price')
                            ->where('cart_id', $cart->id)
                            ->get();            

            return view('web.checkout.checkout_view', compact('categories', 'provinces', 'products'));
        } else {
            $notification = [
                'message' => 'Bạn cần phải đăng nhập',
                'alert-type' => 'error'
            ];
            
            return redirect()->route('user.login')->with($notification);
        }
    }

    public function getDistrict($provinceId)
    {
        $province = Province::find($provinceId);

        if ($province) {
            return response()->json([
                'status' => true,
                'districts' => $province->districts
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function getWard($districtId)
    {
        $district = District::find($districtId);

        if ($district) {
            return response()->json([
                'status' => true,
                'wards' => $district->wards
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function storeOrder(Request $request)
    {
        dd($request->all());
    }
}
