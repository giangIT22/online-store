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
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use StoreImageTrait;

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
        $sizes = Size::all();
        $colors = Color::all();

        return view('admin.product.create', compact('categories', 'sizes', 'colors'));
    }

    public function store(StoreProduct $request)
    {
     
        $data = $request->except(['image_path']);
        $data['product_code'] = 'SP' . rand();
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
            ->select('colors.name as color_name', 'product_details.size_id', 'product_details.amount')
            ->addSelect('sizes.name as size_name', 'product_details.color_id' )
            ->where('product_id', $product->id)
            ->get();

        return view('admin.product.update', compact('product', 
            'categories', 'subcategories', 'options', 'sizes', 'colors'));
    }

    public function update(UpdateProduct $request, $productId)
    {
        $data = $request->except(['image_path', 'tags', 'sizes', 'amounts']);
        $product = Product::findOrFail($productId);
        $data['product_qty'] = array_sum($request->amounts);

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

        //Update product_size
        foreach ($request->sizes as $key => $size) {
            DB::table('product_size')
                ->updateOrInsert([
                    'product_id' => $product->id,
                    'size_id' => $size,
                ], ['amount' => $request->amounts[$key]]);
        }

        $notification = [
            'message' => 'Thông tin sản phẩm đã được cập nhật',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.products')->with($notification);
    }
}
