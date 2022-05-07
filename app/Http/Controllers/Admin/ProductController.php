<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;

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

        return view('admin.product.create', compact('categories'));
    }
    
    public function store(StoreProduct $request)
    {
        $data = $request->except(['image_path', 'tags']);
        $productImage = $this->uploadImage($request, 'image', 'product');
        $data['image'] = $productImage['file_path'];
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

        if ($request->tags) {
            foreach ($request->tags as $tag) {                
                ProductTag::create([
                    'name' => $tag,
                    'product_id' => $product->id
                ]);
            }
        }

        $notification = [
            'message' => 'Create product successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.products')->with($notification);
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

        return view('admin.product.update', compact('product', 'categories', 'subcategories'));
    }

    public function update(StoreProduct $request, $productId)
    {
        $data = $request->except(['image_path', 'tags']);
        $product = Product::findOrFail($productId);

        if ($request->image) {
            $productImage = $this->uploadImage($request, 'image', 'product');
            $data['image'] = $productImage['file_path'];
        } else {
            $data['image'] = $product->image;
        }

        if (!$request->hot_deals) {
            $data['hot_deals'] = 0;
        }

        if (!$request->special_deals) {
            $data['special_deals'] = 0;
        }

        if (!$request->special_offer) {
            $data['special_offer'] = 0;
        }

        if (!$request->featured) {
            $data['featured'] = 0;
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

        if ($request->tags) {
            ProductTag::where('product_id', $productId)->delete();
            foreach ($request->tags as $tag) {                
                ProductTag::create([
                    'name' => $tag,
                    'product_id' => $product->id
                ]);
            }
        } else {
            ProductTag::where('product_id', $productId)->delete();
        }

        $notification = [
            'message' => 'Update product successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.products')->with($notification);
    }
}
