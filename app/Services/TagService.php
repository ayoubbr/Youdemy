<?php

namespace App\Services;

use App\Models\Tag;
use App\Repositories\TagRepository;
use Exception;

class TagService
{
    private TagRepository $tagRepository;

    public function __construct()
    {
        $this->tagRepository = new TagRepository();
    }

    public function create(Tag $tag)
    {
        if ($tag->getId() != 0) {
            throw new Exception("invalide value (id)");
        }

        if (empty($tag->getTitle())) {
            throw new Exception("Title is empty");
        }

        if (empty($tag->getDescription())) {
            throw new Exception("Description is empty");
        }

        return $this->tagRepository->create($tag);
    }

    public function getAll()
    {
        return $this->tagRepository->getAll();
    }

    public function findByName($name){
        return $this->tagRepository->findByName($name);
    }

    public function update($tag)
    {
        return $this->tagRepository->update($tag);
    }

    public function delete($id)
    {
        return $this->tagRepository->delete($id);
    }
}
