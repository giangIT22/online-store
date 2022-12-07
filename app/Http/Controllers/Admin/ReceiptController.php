<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReceiptServiceInterface;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $receiptService;

    public function __construct(ReceiptServiceInterface $receiptService)
    {
        $this->receiptService = $receiptService;
    }

    public function all()
    {
        $receipts = $this->receiptService->all();
        return view('admin.receipt.index', $receipts);
    }

    public function create()
    {
        return view('admin.receipt.create', $this->receiptService->getData());
    }

    public function store(Request $request)
    {
        $this->receiptService->storeReceipt($request->all());

        $notification = [
            'message' => 'Tạo phiếu nhập kho thành công',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.receipts')->with($notification);
    }

    public function search(Request $request)
    {
        try {
            if ($request->search_key) {
                $data = $this->receiptService->search($request->search_key);
                return response()->json($data);
            } else {
                $data = $this->receiptService->all();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function detail()
    {
        
    }
}
