<?php

namespace App\Controllers;

use App\Http\CourseForm;
use App\Models\Course;
use App\Services\CourseService;

class CourseController
{
    private CourseService $courseService;

    public function __construct()
    {
        $this->courseService = new CourseService();
    }

    public function create(CourseForm $courseForm)
    {
        return $this->courseService->create($courseForm);
    }

    public function getAll()
    {
        return $this->courseService->getAll();
    }
}
