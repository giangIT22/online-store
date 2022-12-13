<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\SupplyCompany;
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

    public function detail($receiptId)
    {
        $data = Receipt::join('receipt_details', 'receipts.id', 'receipt_details.receipt_id')
            ->join('product_details', 'receipt_details.product_detail_id', 'product_details.id')
            ->join('products', 'product_details.product_id', 'products.id')
            ->join('colors', 'product_details.color_id', 'colors.id')
            ->join('sizes', 'product_details.size_id', 'sizes.id')
            ->where('receipts.id', $receiptId)
            ->select(
                'receipt_details.product_detail_id',
                'products.name as product_name',
                'sizes.name as product_size',
                'colors.name as product_color',
                'receipt_details.import_amount',
                'receipt_details.import_price',
                'receipts.sum_price'
            )
            ->get();
        $receipt = Receipt::findOrFail($receiptId);
        $companyName = $receipt->supplyCompany->name;
        $notes = $receipt->notes;
        return view('admin.receipt.detail', compact('data', 'companyName', 'notes'));
    }
}
