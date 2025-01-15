<?php

namespace App\DAOs;

use App\Core\Database;
use App\Models\Tag;

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
}
