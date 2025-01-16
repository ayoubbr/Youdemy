<?php

namespace App\Repositories;

use App\Core\Database;
use App\DAOs\CategoryDao;
use App\Models\Category;

class CategoryRepository
{
    private CategoryDao $categoryDao;
    public function __construct()
    {
        $this->categoryDao = new CategoryDao();
    }

    public function create(Category $category): Category
    {
        return $this->categoryDao->create($category);
    }

    public function findByName(string $name): Category
    {
        $query = "SELECT id, title, description FROM categories WHERE title = '" . $name . "';";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchObject(Category::class);
        return $result;
    }

    public function getAll()
    {  
        return $this->categoryDao->getAll();
    }
}
