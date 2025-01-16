<?php

namespace App\Repositories;

use App\DAOs\CourseDao;
use App\Models\Course;

class CourseRepository
{
    private CourseDao $courseDao;
    private TagRepository $tagRepository;
    private UserRepository $userRepository;
    private CategoryRepository $categoryRepository;
    public function __construct()
    {
        $this->courseDao = new CourseDao();
        $this->tagRepository = new TagRepository();
        $this->userRepository = new UserRepository();
        $this->categoryRepository = new CategoryRepository();
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

    public function getAll()
    {
        $courses = $this->courseDao->getAll();

        foreach ($courses as $key => $course) {

            $course->setTeacher($this->userRepository->findById($course->teacher_id));
            $course->setCategory($this->categoryRepository->findById($course->categorie_id));
        };

        return $courses;
    }
}
