<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderServiceInterface;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('admin.order.index', $this->orderService->getOrders());
    }

    public function detail($orderCode)
    {
        list($order, $orderItem, $coupon) = $this->orderService->getOrderDetail($orderCode);

        return view('admin.order.order_detail', compact('order', 'orderItem', 'coupon'));
    }

    public function confirmOrder($orderCode)            
    {
        $order = Order::where('order_code', $orderCode)->first();
 
        if (!$order) {
            abort(404);
        }

        $order->update([
            'status' => Order::CONFIRMED
        ]);

        return redirect()->route('all.orders');
    }

    public function shippingOrder($orderCode)            
    {
        $order = Order::where('order_code', $orderCode)->first();
 
        if (!$order) {
            abort(404);
        }
        
        $order->update([
            'status' => Order::SHIPPING
        ]);

        return redirect()->route('all.orders');
    }

    public function deliveredOrder($orderCode)            
    {
        $order = Order::where('order_code', $orderCode)->first();
 
        if (!$order) {
            abort(404);
        }
        
        $order->update([
            'payment_status' => Order::PAID,
            'status' => Order::DELIVERED
        ]);

        return redirect()->route('all.orders');
    }

    public function dowloadOrderPdf($orderCode)
    {
        list($order, $orderItem, $coupon) = $this->orderService->getOrderDetail($orderCode);

        $pdf = \PDF::loadView('admin.order.order_pdf', compact('order', 'orderItem', 'coupon'));

        return $pdf->download('invoice.pdf');
    }

    public function cancelOrder($orderCode)
    {
        $this->orderService->cancelOrder($orderCode);
        
        return redirect()->route('all.orders');
    }
}
