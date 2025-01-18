<?php

namespace App\Repositories;

use App\Core\Database;
use App\DAOs\TagDao;
use App\Models\Tag;

class TagRepository
{
    private TagDao $tagDao;

    public function __construct()
    {
        $this->tagDao = new TagDao();
    }

    public function create(Tag $tag): Tag
    {
        return $this->tagDao->create($tag);
    }

    public function findByName(string $name)
    {
        $query = "SELECT id, title, description FROM tags WHERE title = '" . $name . "';";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchObject(Tag::class);
        return $result;
    }

    public function getAll()
    {
        return $this->tagDao->getAll();
    }
}
