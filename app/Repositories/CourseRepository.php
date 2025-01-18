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

        // $tags = $course->getTags();

        // $array_tags = [];
        // for ($i = 0; $i < count($tags); $i++) {
        //     array_push($array_tags, $this->tagRepository->findByName($tags[$i]));
        // }

        // $course->setTags($array_tags);

        return $this->courseDao->create($course);
    }

    public function getAll()
    {
        $courses = $this->courseDao->getAll();
        // $tags_array = [];
        // $tags_object = [];

        foreach ($courses as $key => $course) {
            // TODO return tags as objects
            // $tags_array = explode(', ', $course->getTags());
            // $tags_object = [];
            // foreach ($tags_array as $key => $tag_string) {
            //     array_push($tags_object, $this->tagRepository->findByName($tag_string));
            //     $course->setTags($this->tagRepository->findByName($tag_string));
            // }

            // foreach ($tags_object as $key => $value) {
            // $course->setTags($tags_object);
            // }
            // var_dump($tags_object);
            $course->setTeacher($this->userRepository->findById($course->teacher_id));
            $course->setCategory($this->categoryRepository->findById($course->categorie_id));
        };

        // var_dump($courses);
        // die();

        return $courses;
    }

    public function findById($id)
    {
        $query = "SELECT courses.id, courses.title, courses.description, courses.price, courses.rating, courses.content, 
        courses.categorie_id, courses.teacher_id , GROUP_CONCAT(tags.title SEPARATOR ', ') AS tags FROM courses 
        INNER JOIN course_tags ON courses.id = course_tags.course_id JOIN tags ON tags.id = course_tags.tag_id WHERE courses.id = ? GROUP BY courses.id";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchObject(Course::class);
        
        return $result;
    }
}
