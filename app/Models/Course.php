<?php

namespace App\Models;

#[\AllowDynamicProperties]
class Course
{
    private int $id = 0;
    private string $title = "";
    private string $description = "";
    private float $price = 0;
    private float $rating = 0;
    private string $content = "";
    private string $status = "";
    private Category $category;
    private $tags = [];
    private User $teacher;
    private $students = [];

    public function __construct() {}

    public function __call($name, $arguments)
    {
        if ($name == 'instanceWithoutId') {
            if (count($arguments) == 10) {
                $this->title = $arguments[0];
                $this->description = $arguments[1];
                $this->price = $arguments[2];
                $this->rating = $arguments[3];
                $this->status = $arguments[4];
                $this->content = $arguments[5];
                $this->category = $arguments[6];
                $this->tags = $arguments[7];
                $this->teacher = $arguments[8];
                $this->students = $arguments[9];
            }
        }
        if ($name == 'instanceWithAll') {
            if (count($arguments) == 11) {
                $this->id = $arguments[0];
                $this->title = $arguments[1];
                $this->description = $arguments[2];
                $this->price = $arguments[3];
                $this->rating = $arguments[4];
                $this->status = $arguments[5];
                $this->content = $arguments[6];
                $this->category = $arguments[7];
                $this->tags = $arguments[8];
                $this->teacher = $arguments[9];
                $this->students = $arguments[10];
            }
        }
    }

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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tag): void
    {
        if (!is_array($this->tags)) {
            $this->tags = [];
        }
        array_push($this->tags, $tag);
    }

    public function getTeacher(): User
    {
        return $this->teacher;
    }

    public function setTeacher(User $teacher): void
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
