<?php

namespace App\Controllers;

use App\Models\Tag;
use App\Services\TagService;

class TagController
{
    private TagService $tagService;

    public function __construct()
    {
        $this->tagService = new TagService();
    }

    public function create(Tag $tag)
    {
        return $this->tagService->create($tag);
    }

    public function getAll()
    {   
        return $this->tagService->getAll();
    }

    public function update($tag)
    {
        return $this->tagService->update($tag);
    }

    public function delete($id)
    {
        return $this->tagService->delete($id);
    }
}
