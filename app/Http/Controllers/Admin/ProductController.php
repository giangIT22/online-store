<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\Size;
use App\Services\ProductServiceInterface;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use StoreImageTrait;

    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return view('admin.product.index', $this->productService->all());
    }

    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.product.create', compact('categories', 'sizes', 'colors'));
    }

    public function store(StoreProduct $request)
    {
        $data = $request->except(['image_path']);
        do {
            $data['product_code'] = 'SP' . rand();
            $product = Product::where('product_code', $data['product_code'])->first();       
        } while (isset($product));

        $productImage = $this->uploadImage($request, 'image', 'product', $data['product_code']);
        $data['image'] = $productImage['file_path'];
        DB::beginTransaction();
        try {
            $product = Product::create($data);

            if ($request->has('image_path')) {
                foreach ($request->image_path as $path) {
                    $path = $this->uploadImageMultiple($path, 'product');
                    ProductImage::create([
                        'image_path' => $path['file_path'],
                        'product_id' => $product->id
                    ]);
                }
            }

            //Create product_detail
            // if ($request->sizes && $request->colors) {
            //     foreach ($request->sizes as $key => $size) {
            //         $productDetail = ProductDetail::where('size_id', $size)
            //             ->where('color_id', $request->colors[$key])
            //             ->where('product_id', $product->id)
            //             ->first();
                    
            //         if ($productDetail) {
            //             $productDetail->update(['amount' => $productDetail->amount + $request->amounts[$key]]);
            //         } else {
            //             ProductDetail::create([
            //                 'amount' => $request->amounts[$key],
            //                 'product_id' => $product->id,
            //                 'color_id' => $request->colors[$key],
            //                 'size_id' => $size,
            //             ]);
            //         }
            //     }
            // }
            
            DB::commit();
            $notification = [
                'message' => 'Thêm sản phẩm thành công',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('all.products')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function delete($productId)
    {
        try {
            Product::findOrFail($productId)->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        $categories = Category::all();
        $subcategories = Category::findOrFail($product->category_id)->subCategories;
        $sizes = Size::all();
        $colors = Color::all();
        $options = ProductDetail::join('sizes', 'product_details.size_id', 'sizes.id')
            ->join('colors', 'product_details.color_id', 'colors.id')
            ->select('colors.name as color_name', 'product_details.size_id', 'product_details.amount as product_amount')
            ->addSelect('sizes.name as size_name', 'product_details.color_id' )
            ->where('product_id', $product->id)
            ->get();

        return view('admin.product.update', compact('product', 
            'categories', 'subcategories', 'options', 'sizes', 'colors'));
    }

    public function update(UpdateProduct $request, $productId)
    {
        $data = $request->except(['image_path']);
        $product = Product::findOrFail($productId);

        if ($request->image) {
            $productImage = $this->uploadImage($request, 'image', 'product', $product->product_code);
            $data['image'] = $productImage['file_path'];
        } else {
            $data['image'] = $product->image;
        }
        $product->update($data);

        if ($request->image_path) {
            ProductImage::where('product_id', $productId)->delete();
            foreach ($request->image_path as $path) {
                $path = $this->uploadImageMultiple($path, 'product');
                $product->images()->create([
                    'image_path' => $path['file_path'],
                ]);
            }
        }

        $notification = [
            'message' => 'Thông tin sản phẩm đã được cập nhật',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.products')->with($notification);
    }

    public function search(Request $request)
    {
        try {
            if ($request->search_key) {
                $data = $this->productService->search($request->search_key);
                return response()->json($data);
            } else {
                $data = $this->productService->all();
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
