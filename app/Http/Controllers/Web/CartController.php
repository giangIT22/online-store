<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

    public function view()
    {
        dd("giang");
        // return view('web.cart.shopping_cart');
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
}
