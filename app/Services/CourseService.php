<?php

namespace App\Services;

use App\Http\CourseForm;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Exception;

class CourseService
{
    private CourseRepository $courseRepository;
    private UserService $userService;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->courseRepository = new CourseRepository();
        $this->categoryService = new CategoryService();
        $this->userService = new UserService();
    }

    public function create(CourseForm $courseForm)
    {
        $teacher = $this->userService->findByEmail($courseForm->teacherEmail);
        $category = $this->categoryService->findByName($courseForm->categoryName);
        $course = new Course();
        $course->instanceWithoutId(
            $courseForm->title,
            $courseForm->description,
            $courseForm->price,
            $courseForm->rating,
            $courseForm->content,
            $category,
            $courseForm->tags,
            $teacher,
            $courseForm->students
        );

        return $this->courseRepository->create($course);
    }

    public function getAll()
    {
        return $this->courseRepository->getAll();
    }
}
