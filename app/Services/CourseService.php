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
    private TagService $tagService;

    public function __construct()
    {
        $this->courseRepository = new CourseRepository();
        $this->categoryService = new CategoryService();
        $this->userService = new UserService();
        $this->tagService = new TagService();
    }

    public function create(CourseForm $courseForm)
    {
        $teacher = $this->userService->findByEmail($courseForm->teacherEmail);
        $category = $this->categoryService->findByName($courseForm->categoryName);
        $tags = $courseForm->tags;
        $tagObjects = [];

        for ($i = 0; $i < count($tags); $i++) {
            array_push($tagObjects, $this->tagService->findByName($tags[$i]));
        }

        $course = new Course();
        $course->instanceWithoutId(
            $courseForm->title,
            $courseForm->description,
            $courseForm->price,
            $courseForm->rating,
            $courseForm->status,
            $courseForm->content,
            $category,
            $tagObjects,
            $teacher,
            $courseForm->students
        );

        return $this->courseRepository->create($course);
    }
    public function update(CourseForm $courseForm)
    {
        
        $teacher = $this->userService->findByEmail($courseForm->teacherEmail);
        $category = $this->categoryService->findByName($courseForm->categoryName);
        $tags = $courseForm->tags;
        $tagObjects = [];

        for ($i = 0; $i < count($tags); $i++) {
            array_push($tagObjects, $this->tagService->findByName($tags[$i]));
        }

        $course = new Course();
        $course->instanceWithAll(
            $courseForm->id,
            $courseForm->title,
            $courseForm->description,
            $courseForm->price,
            $courseForm->rating,
            $courseForm->status,
            $courseForm->content,
            $category,
            $tagObjects,
            $teacher,
            $courseForm->students
        );
       
        return $this->courseRepository->update($course);
    }

    public function getAll()
    {
        return $this->courseRepository->getAll();
    }

    public function findById($id)
    {
        $result = $this->courseRepository->findById($id);

        $teacher = $this->userService->findById($result->teacher_id);
        $category = $this->categoryService->findById($result->categorie_id);
        $result->setTeacher($teacher);
        $result->setCategory($category);
        return $result;
    }

    public function delete($id)
    {
        $this->courseRepository->delete($id);
    }

    public function activate($id)
    {
        $this->courseRepository->activate($id);
    }

    public function archive($id)
    {
        $this->courseRepository->archive($id);
    }

    public function getCountCourses(): int
    {
        return $this->courseRepository->getCountCourses();
    }

    public function courseByCategory()
    {
        $arrayAssoc = $this->courseRepository->courseByCategory();
        $returnArray = [];

        foreach ($arrayAssoc as $key => $value) {

            $category = $this->categoryService->findById($key);

            $categoryName = $category->getTitle();

            $returnArray[$categoryName] = $value;
        }

        return $returnArray;
    }

    public function courseWithMostStudents()
    {
        return $this->courseRepository->courseWithMostStudents();
    }

    public function searchCourses($searchParams)
    {
        return $this->courseRepository->searchCourses($searchParams);
    }

    public function getAllSubscriptions($user_id)
    {
        return $this->courseRepository->getAllSubscriptions($user_id);
    }
}
