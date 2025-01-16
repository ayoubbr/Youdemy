<?php

namespace App\DAOs;

use App\Core\Database;
use App\Models\Category;
use PDO;

class CategoryDao
{

    public function create(Category $category): Category
    {
        $query = "INSERT INTO categories (title , description) VALUES (?,?);";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$category->getTitle(), $category->getDescription()]);
       
        $category->setId(Database::getInstance()->getConnection()->lastInsertId());

        return $category;
    }
    public function getAll()
    {

        $query = "SELECT id, title , description FROM categories;";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        return $tags;
    }
}
