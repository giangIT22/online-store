<?php

namespace App\Services;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\SupplyCompany;

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

    public function store($params)
    {
        
    }
}
