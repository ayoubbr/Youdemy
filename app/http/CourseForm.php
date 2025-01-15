<?php

namespace App\Http;

class CourseForm
{
    public string $title;
    public string $description;
    public string $price;
    public string $rating;
    public string $content;
    public string $categoryName;
    public $tags;
    public string $teacherEmail;
    public $students;


    public static function instanceWithAllArgs(
        $title,
        $description,
        $price,
        $rating,
        $content,
        $categoryName,
        $tags,
        $teacherEmail,
        $students

    ): self {
        $instance = new self();
        $instance->title = $title;
        $instance->description = $description;
        $instance->price = $price;
        $instance->rating = $rating;
        $instance->content = $content;
        $instance->categoryName = $categoryName;
        $instance->tags = $tags;
        $instance->teacherEmail = $teacherEmail;
        $instance->students = $students;

        return $instance;
    }
}
