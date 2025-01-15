<?php

namespace App\Models;

abstract class Topic
{
    protected int $id = 0;
    protected string $title = "";
    protected string $description = "";

    public function __construct() {}

    public function __call($name, $arguments)
    {
        if ($name == "instanceWithoutId") {
            if (count($arguments) == 2) {
                $this->title = $arguments[0];
                $this->description = $arguments[1];
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

    public function __toString(): string
    {
        return "id: " . $this->id . " , name: " . $this->title . " , description: " . $this->description . " .";
    }
}
