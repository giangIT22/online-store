<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReceiptServiceInterface;

class ReceiptController extends Controller
{
    protected $receiptService;

    public function __construct(ReceiptServiceInterface $receiptService)
    {
        $this->receiptService = $receiptService;
    }

    public function all()
    {
        return view('admin.receipt.index');
    }

    public function create()
    {
        return view('admin.receipt.create', $this->receiptService->getData());
    }
}
