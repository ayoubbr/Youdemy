<?php

namespace App\DAOs;

use App\Core\Database;
use App\Http\CourseForm;
use App\Models\Course;
use PDO;

class CourseDao
{
    private TagDao $tagDao;

    public function __construct()
    {
        $this->tagDao = new TagDao();
    }

    public function create(Course $course)
    {
        $tags = $course->getTags();

        $query = "INSERT INTO courses 
        (title, description, price, rating, content, categorie_id, teacher_id)
         VALUES (?,?,?,?,?,?,?);";

        $stmt = Database::getInstance()->getConnection()->prepare($query);

        $stmt->execute([
            $course->getTitle(),
            $course->getDescription(),
            $course->getPrice(),
            $course->getRating(),
            $course->getContent(),
            $course->getCategory()->getId(),
            $course->getTeacher()->getId()
        ]);

        $course->setId(Database::getInstance()->getConnection()->lastInsertId());

        $course_id = $course->getId();
        $tags_id = [];
        foreach ($tags as $key => $value) {
            array_push($tags_id, $value->getId());
        }

        $sql = '';
        for ($i = 0; $i < count($tags); $i++) {
            var_dump($tags[$i]->getId());
            $sql .= "INSERT INTO course_tags (course_id, tag_id) VALUES ($course_id, $tags_id[$i]);";
        }

        $stmt = Database::getInstance()->getConnection()->prepare($sql);

        $stmt->execute();
    }

    public function getAll()
    {
        $query = "SELECT id, title, description, price, rating, content, categorie_id, teacher_id FROM courses";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Course');
        return $result;
    }
}
