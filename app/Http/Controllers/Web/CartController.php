<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Services\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $carts = $this->cartService->addProductToCart($request->all());
            
            return response()->json(
                [
                    'status' => true,
                    'carts' => $carts
                ]
            );
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function view()
    {
        $categories = Category::with('subCategories')->get();        
        $carts = Cart::where('user_id', Auth::id())->get() ?? 0;

        return view('web.cart.shopping_cart', compact('categories', 'carts'));
    }

    public function deleteCart(Request $request)
    {
        
    }
}
