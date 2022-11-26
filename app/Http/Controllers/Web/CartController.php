<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductCart;
use App\Models\Size;
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

    /**
     * Add product to cart
     */
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
            $products = $this->cartService->addProductToCart($request->all());

            return response()->json(
                [
                    'status' => true,
                    'products' => $products
                ]
            );
        }
    }

    public function view()
    {
        $categories = Category::with('subCategories')->get();
        $cart = Cart::where('user_id', Auth::id())->first() ?? 0;

        if ($cart) {
            $productsInCart = collect([]);
            $products = ProductCart::join('product_details', 'product_cart.product_detail_id', 'product_details.id')
                            ->select('product_id', 'product_cart.amount', 'product_price', 'size_id', 'color_id')
                            ->where('cart_id', $cart->id)->get();
            foreach ($products as $item) {
                $product = DB::table('products')->where('id', $item->product_id)->first();
                $size = Size::findOrFail($item->size_id);
                $color = Color::findOrFail($item->color_id);
                $productsInCart->push([
                    'id' => $item->product_id,
                    'product_image' => $product->image,
                    'product_name' => $product->name,
                    'product_price' => $item->product_price,
                    'amount' => $item->amount,
                    'product_size' => $size->name,
                    'product_color' => $color->name,
                    'size_id' => $size->id,
                    'color_id' => $color->id
                ]);
            }
        } else {
            $productsInCart = 0;
        }

        return view('web.cart.shopping_cart', compact('categories', 'productsInCart'));
    }

    public function deleteCart(Request $request)
    {
        list($status, $flag, $products, $sumTotal) = $this->cartService->deleteCart($request->all());

        if ($status) {
            return response()->json([
                'status' => true,
                'flag' => $flag,
                'products' => $products,
                'sumTotal' => $sumTotal
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        list($product, $sumTotal, $count) = $this->cartService->updateCart($request->all());

        return response()->json([
            'product' => $product,
            'sumTotal' => $sumTotal,
            'count' => $count
        ]);
    }
}
