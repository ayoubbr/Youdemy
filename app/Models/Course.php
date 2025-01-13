<?php

namespace App\Models;

class Course
{
    private int $id = 0;
    private string $title = "";
    private string $description = "";
    private float $price = 0;
    private float $rating = 0;
    private string $content = "";
    private Category $category;
    private $tags = [];
    private User $teacher;
    private $students = [];

    public function __construct() {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getTeacher(): string
    {
        return $this->teacher;
    }

    public function setTeacher(string $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function setStudents(array $students): void
    {
        $this->students = $students;
    }

    public function __toString()
    {
        return "(Course) =>
            id : " . $this->id . " , 
            title : " . $this->title . " , 
            description: " . $this->description . " , 
            price: " . $this->price . " , 
            rating: " . $this->rating . " , 
            content: " . $this->content . " , 
            category: " . $this->category . " , 
            tags: " . implode(" , ", $this->tags) . " , 
            teacher: " . $this->teacher . " , 
            students: " . implode(",", $this->students) . ".";
    }
}
