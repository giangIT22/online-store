<?php

namespace App\Services;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use App\Models\Size;
use App\Models\SupplyCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiptService implements ReceiptServiceInterface
{
    public function all()
    {
    }

    public function getData()
    {
        $companies = SupplyCompany::all();
        $sizes = Size::all();
        $colors = Color::all();
        $products = Product::all();

        return [
            'companies' => $companies,
            'sizes' => $sizes,
            'colors' => $colors,
            'products' => $products
        ];
    }

    public function storeReceipt($params)
    {
        do {
            $params['receipt_code'] = 'KH' . rand();
            $receipt = Receipt::where('receipt_code', $params['receipt_code'])->first();
        } while (isset($receipt));

        DB::beginTransaction();
        try {
            $receipt = Receipt::create([
                'receipt_code' => $params['receipt_code'],
                'notes' => $params['notes'],
                'sum_price' => $params['sum_price'],
                'supply_company_id' => $params['supply_company_id'],
                'admin_id' => Auth::guard('admin')->user()->id
            ]);
    
            foreach ($params['products'] as $key => $id) {
                $productDetail = ProductDetail::where('product_id', $id)->where('color_id', $params['colors'][$key])
                    ->where('size_id', $params['sizes'][$key])->first();
                $product = Product::findOrfail($id);
                if (isset($productDetail)) {
                    $productDetail->update(['amount' => $productDetail->amount + $params['import_amounts'][$key]]);
                    ReceiptDetail::create([
                        'import_amount' => $params['import_amounts'][$key],
                        'import_price' => $params['import_prices'][$key],
                        'product_detail_id' => $productDetail->id,
                        'receipt_id' => $receipt->id
                    ]);
                    $product->update([
                        'amount' => $product->amount + $productDetail->amount,
                        'import_price' => $params['import_prices'][$key],
                        'product_price' => $params['import_prices'][$key] + ($params['import_prices'][$key] * 10 / 100),
                        'status' => Product::PUBLIC
                    ]);
                } else {
                    $productDetail2 = ProductDetail::create([
                        'amount' => $params['import_amounts'][$key],
                        'product_id' => $id,
                        'size_id' => $params['sizes'][$key],
                        'color_id' => $params['colors'][$key]
                    ]);
    
                    ReceiptDetail::create([
                        'import_amount' => $params['import_amounts'][$key],
                        'import_price' => $params['import_prices'][$key],
                        'product_detail_id' => $productDetail2->id,
                        'receipt_id' => $receipt->id
                    ]);
    
                    $product->update([
                        'amount' => $product->amount + $productDetail2->amount,
                        'import_price' => $params['import_prices'][$key],
                        'product_price' => $params['import_prices'][$key] + ($params['import_prices'][$key] * 10 / 100),
                        'status' => Product::PUBLIC
                    ]);
                }
            }

            DB::commit();
        } catch( \Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
