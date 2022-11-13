<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Services\BlogServiceInterface;
use App\Traits\StoreImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    use StoreImageTrait;

    protected $blogService;

    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        return view('admin.blog.index', $this->blogService->getListBlog(Blog::PER_PAGE));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->all();
        $blogImage = $this->uploadImage($request, 'post_image', 'blog');
        $data['post_image'] = $blogImage['file_path'];
        $data['admin_id'] = auth('admin')->user()->id;
        DB::beginTransaction();
        try {
            $this->blogService->createBlog($data);

            $notification = [
                'message' => 'Thêm bài viết thành công',
                'alert-type' => 'success'
            ];

            DB::commit();

            return redirect()->route('all.blogs')->with($notification);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function edit($blogId)
    {
        $blog = $this->blogService->getInfoBlog($blogId);

        return view('admin.blog.update', compact('blog'));
    }

    public function update($blogId, BlogUpdateRequest $request)
    {
        $blog = Blog::findOrFail($blogId);
        $data = $request->all();

        if (isset($data['post_image'])) {
            $blogImage = $this->uploadImage($request, 'post_image', 'blog');
            $data['post_image'] = $blogImage['file_path'];
        } else {
            $data['post_image'] = $blog->post_image;
        }

        DB::beginTransaction();
        try {
            $this->blogService->updateBlog($blog, $data);

            $notification = [
                'message' => 'Cập nhật bài viết thành công',
                'alert-type' => 'success'
            ];

            DB::commit();

            return redirect()->route('all.blogs')->with($notification);

        } catch (Exception $e) {
            DB::rollBack();
            $notification = [
                'message' => 'Cập nhật bài viết thất bại',
                'alert-type' => 'success'
            ];
            return redirect()->route('blog.edit', ['blog_id' => $blog->id])->with($notification);
        }
    }

    public function delete($blogId)
    {
        try {
            Blog::findOrFail($blogId)->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
                'title' => 'Bài viết'
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
