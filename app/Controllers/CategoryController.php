<?php

namespace App\Controllers;

use App\Models\Category;
use App\Services\CategoryService;

class CategoryController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function create(Category $category)
    {
        return $this->categoryService->create($category);
    }
}
