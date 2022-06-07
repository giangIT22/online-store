<?php

namespace App\Services;

interface CategoryServiceInterface
{
    public function getCategories();

    public function saveCategories($params);

    public function getInfoCategory($id);

    public function validateStoreCategory($params = []);

    public function updateCategory($categoryId, $params);

    public function deleteCategory($categoryId);
}
