<?php

namespace App\Services;

use App\Models\Blog;

class BlogService implements BlogServiceInterface
{
    public function getListBlog($limit)
    {
        $data = Blog::orderBy('created_at', 'desc')->paginate($limit);

        return [
            'listBlogs' =>  $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
            'currentPage' => $data->currentPage()
        ];
    }

    public function createBlog($params)
    {
        $data = Blog::create($params);

        return $data;
    }

    public function getInfoBlog($blogId)
    {
        $data = Blog::findOrFail($blogId);

        return $data;
    }

    public function updateBlog($blog, $params)
    {        
        $data = $blog->update($params);

        return $data;
    }
}
