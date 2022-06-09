<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function getInvoiceMonthy()
    {
        return view('admin.dashboard.invoice');
    }

    public function getInvoiceYearLy()
    {

    }
}
