<?php

namespace App\Services;

interface BlogServiceInterface
{
    public function getListBlog($limit);
    public function createBlog($params);
    public function getInfoBlog($blogId);
    public function updateBlog($blog, $params);
}
