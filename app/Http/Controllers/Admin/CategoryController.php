<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $page = (int) $request->page ?? 1;
        $data = $this->categoryService->getCategories();
        $categories = $data->forPage($page, 10);
        $lastPage = ceil(count($data) / Category::PER_PAGE);

        return view('admin.category.index', [
            'categories' => $categories,
            'lastPage' => $lastPage,
            'total' => count($data)
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $params = $request->all();

        $this->categoryService->saveCategories($params);

        $notification = [
            'message' => 'Create category successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('all.categories')->with($notification);
    }

    public function update($categoryId)
    {
        $category = $this->categoryService->getInfoCategory($categoryId);

        return view('admin.category.update', compact('category'));
    }

    public function updateCategory(CategoryRequest $request, $categoryId)
    {
        $data = $this->categoryService->updateCategory($categoryId, $request->all());

        if ($data) {
            $notification = [
                'message' => 'Updated category successfully',
                'alert-type' => 'success'
            ];
        }
        
        return redirect()->route('all.categories')->with($notification);
    }

    public function delete($categoryId)
    {
        try {
            $this->categoryService->deleteCategory($categoryId);
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
}
