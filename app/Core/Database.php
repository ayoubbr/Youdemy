<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $dbname = "YoudemyDB";
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $pdo;
    private static $instance;
    private static $counter = 0;

    private function __construct()
    {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$servername .
                        "; dbname=" . self::$dbname,
                    self::$username,
                    self::$password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::FETCH_DEFAULT, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance =  new Database();
            self::$counter++;
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return self::$pdo;
    }
}
