<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('web.checkout.checkout_view', compact('categories'));
        } else {
            $notification = [
                'message' => 'Bạn cần phải đăng nhập',
                'alert-type' => 'error'
            ];
            
            return redirect()->route('user.login')->with($notification);
        }
    }
}
