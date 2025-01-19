<?php

namespace App\Repositories;

use App\Core\Database;
use App\DAOs\CourseDao;
use App\Models\Course;
use PDO;

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
        return $this->courseDao->create($course);
    }

    public function getAll()
    {
        $courses = $this->courseDao->getAll();
        $tags_array = [];
        foreach ($courses as $key => $course) {
            $tags_array = [];
            if (!is_null($course->getTags())) {
                $tags_array = explode(', ', $course->getTags());
            }

            foreach ($tags_array as $key => $tag_string) {
                $course->setTags($this->tagRepository->findByName($tag_string));
            }

            $course->setTeacher($this->userRepository->findById($course->teacher_id));
            $course->setCategory($this->categoryRepository->findById($course->categorie_id));
        }

        return $courses;
    }

    public function findById($id)
    {
        $query = "SELECT courses.id, courses.title, courses.description, courses.price, courses.rating, courses.content, 
        courses.categorie_id, courses.teacher_id , GROUP_CONCAT(tags.title SEPARATOR ', ') AS tags FROM courses 
        LEFT JOIN course_tags ON courses.id = course_tags.course_id LEFT JOIN tags ON tags.id = course_tags.tag_id WHERE courses.id = ? GROUP BY courses.id";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchObject(Course::class);

        return $result;
    }

    public function delete($id)
    {
        $this->courseDao->delete($id);
    }

    public function activate($id)
    {
        $query = "UPDATE courses SET `status` = 'Active' WHERE id = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchObject(Course::class);

        return $result;
    }

    public function archive($id)
    {
        $query = "UPDATE courses SET `status` = 'Archived' WHERE id = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchObject(Course::class);

        return $result;
    }
}
