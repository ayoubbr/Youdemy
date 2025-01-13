<?php

namespace App\Utils;

class Utils
{
    public static function isLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            echo "test yes";
            return true;
        } else {
            return false;

        }
    }
}
