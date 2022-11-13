<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Services\BlogServiceInterface;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;    
    }

    public function view()
    {
        $categories = Category::with('subCategories')->get();
        $data = $this->blogService->getListBlog(Blog::BLOG_PAGE);

        return view('web.blog.view', compact('categories', 'data'));
    }

    public function detailBlog()
    {
        $categories = Category::with('subCategories')->get();
        $blog = Blog::where('id', request()->blog_id)->first();

        if (!$blog) {
            abort(404);
        }

        return view('web.blog.detail_blog', compact('blog', 'categories'));
    }
}
