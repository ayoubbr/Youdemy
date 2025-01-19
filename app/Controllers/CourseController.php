<?php

namespace App\Controllers;

use App\Http\CourseForm;
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

    public function findById($id)
    {
        $result = $this->courseService->findById($id);
        return $result;
    }

    public function delete($id)
    {
        $this->courseService->delete($id);
    }

    public function activateCourse($id)
    {
        $this->courseService->activate($id);
    }
    
    public function archiveCourse($id)
    {
        $this->courseService->archive($id);
    }

    public function getCountCourses():int{
        return $this->courseService->getCountCourses();
    }

    public function courseByCategory()
    {
        return $this->courseService->courseByCategory();
    }
}
