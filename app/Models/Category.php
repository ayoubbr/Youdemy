<?php

namespace App\Models;

class Category extends Topic
{
    public function __construct()
    {
        parent::__construct();
    }
    public function __call($name, $arguments)
    {
        parent::__call($name, $arguments);
    }
}
