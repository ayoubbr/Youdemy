<?php

namespace App\Models;

abstract class Topic
{
    protected int $id = 0;
    protected string $name = "";
    protected string $description = "";

    public function __construct() {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
        return "id: " . $this->id . " , name: " . $this->name . " , description: " . $this->description . " .";
    }
}
