<?php

namespace App\DAOs;

use App\Core\Database;
use App\Models\Tag;

use PDO;

class TagDao
{


    public function create(Tag $tag): Tag
    {

        $query = "INSERT INTO tags (title , description) VALUES (?,?);";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$tag->getTitle(), $tag->getDescription()]);

        $tag->setId(Database::getInstance()->getConnection()->lastInsertId());

        return $tag;
    }

    public function getAll()
    {

        $query = "SELECT id, title , description FROM tags;";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');
        return $tags;
    }
}
