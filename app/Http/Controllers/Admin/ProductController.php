<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) $request->page ?? 1;
        $data = Product::with(['category', 'subCategory'])->orderBy('created_at', 'desc')->get();
        $products = $data->forPage($page, 10);
        $lastPage = ceil(count($data) / Product::PER_PAGE);

        return view('admin.product.index', [
            'products' => $products,
            'lastPage' => $lastPage,
            'total' => count($data)
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.product.create', compact('categories'));
    }
    
    public function store(StoreProduct $request)
    {
        
    }
}
