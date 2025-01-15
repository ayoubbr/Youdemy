<?php

namespace App\Repositories;

use App\DAOs\CourseDao;
use App\Models\Course;

class CourseRepository
{
    private CourseDao $courseDao;
    private TagRepository $tagRepository;
    public function __construct()
    {
        $this->courseDao = new CourseDao();
        $this->tagRepository = new TagRepository();
    }

    public function create(Course $course)
    {
        $tags = $course->getTags();
        $array_tags = [];
        for ($i = 0; $i < count($tags); $i++) {
            array_push($array_tags, $this->tagRepository->findByName($tags[$i]));
        }

        $course->setTags($array_tags);
       
        return $this->courseDao->create($course);
    }
}
