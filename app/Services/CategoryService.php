<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function create(Category $category)
    {
        if ($category->getId() != 0) {
            throw new Exception("invalide value (id)");
        }

        if (empty($category->getTitle())) {
            throw new Exception("Title is empty");
        }

        if (empty($category->getDescription())) {
            throw new Exception("Description is empty");
        }

        return $this->categoryRepository->create($category);
    }

    public function findByName($name): Category
    {
        return $this->categoryRepository->findByName($name);
    }

    public function findById($id): Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function update($category)
    {
        return $this->categoryRepository->update($category);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
