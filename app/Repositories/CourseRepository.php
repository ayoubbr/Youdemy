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

    public function update($course)
    {
        return $this->courseDao->update($course);
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

    public function getCountCourses(): int
    {
        $query = "SELECT count(*) FROM courses;";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $countCourses = $stmt->fetchColumn();
        return $countCourses;
    }

    public function courseByCategory()
    {
        $query = "SELECT categorie_id, count(*) FROM courses GROUP BY categorie_id";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $count = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        return $count;
    }

    public function courseWithMostStudents()
    {
        $query = "SELECT c.id,c.title,c.price, c.description,cat.title as category,
                CONCAT(u.firstname, ' ', u.lastname) as teacher_name,
                COUNT(s.student_id) as student_count
                FROM courses c
                LEFT JOIN subscriptions s ON c.id = s.course_id
                LEFT JOIN categories cat ON c.categorie_id = cat.id
                LEFT JOIN users u ON c.teacher_id = u.id
                GROUP BY c.id, c.title, c.price, cat.title, teacher_name
                ORDER BY student_count DESC
                LIMIT 1;";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        return $count;
    }
}
