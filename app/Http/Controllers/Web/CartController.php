<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Services\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $products = $this->cartService->addProductToCart($request->all());
            
            return response()->json(
                [
                    'status' => true,
                    'products' => $products
                ]
            );
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function view()
    {
        $categories = Category::with('subCategories')->get();        
        $cart = Cart::where('user_id', Auth::id())->first() ?? 0;
        
        if ($cart) {
            $productsInCart = collect([]);

            $products = DB::table('product_cart')->select('product_id', 'amount', 'price')->where('cart_id', $cart->id)->get();

            foreach ($products as $item) {
                $product = DB::table('products')->where('id', $item->product_id)->first();
                $productsInCart->push([
                    'id' => $item->product_id,
                    'product_image' => $product->image,
                    'product_name' => $product->name,
                    'product_price' => $item->price,
                    'amount' => $item->amount,
                ]);
            }
        } else {
            $productsInCart = 0;
        }

        return view('web.cart.shopping_cart', compact('categories', 'productsInCart'));
    }

    public function deleteCart(Request $request)
    {
        list($status, $flag, $products) = $this->cartService->deleteCart($request->product_id);

        if ($status) {
            return response()->json([
                'status' => true,
                'flag' => $flag,
                'products' => $products
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
    
    public function updateCart(Request $request)
    {
        list($product, $sumTotal) = $this->cartService->updateCart($request->all());

        return response()->json([
            'product' => $product,
            'sumTotal' => $sumTotal
        ]);
    }
}
