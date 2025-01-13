<?php

namespace App\Utils;

use App\Models\User;

class Test
{
    public function __construct() {}

    public function display($obj)
    {
        $user = new User();
        echo $obj;
        echo "<br />";
        echo "===================================================================================";
        echo "<br />";
    }
}
