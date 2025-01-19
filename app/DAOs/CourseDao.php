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
        (title, description, price, rating, content, status, categorie_id, teacher_id)
         VALUES (?,?,?,?,?,?,?,?);";

        $stmt = Database::getInstance()->getConnection()->prepare($query);

        $stmt->execute([
            $course->getTitle(),
            $course->getDescription(),
            $course->getPrice(),
            $course->getRating(),
            $course->getContent(),
            $course->getStatus(),
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
        $query = "SELECT courses.id, courses.title, courses.description, courses.price, courses.rating, courses.content, courses.status, 
                    courses.categorie_id, courses.teacher_id , GROUP_CONCAT(tags.title SEPARATOR ', ') AS tags FROM courses 
                    LEFT JOIN course_tags ON courses.id = course_tags.course_id LEFT JOIN tags ON tags.id = course_tags.tag_id GROUP BY courses.id";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Course');
        return $result;
    }

    public function delete($id)
    {
        $query = "DELETE FROM courses WHERE id = ? LIMIT 1";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([$id]);
    }
}
