<?php

namespace App\Core;

use App\Controllers\RoleController;
use App\Models\Role;
use PDO;
use PDOException;

class Database
{
    private static $dbname = "YoudemyDBPro2";
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
            if (self::checkCreatedRoles()) {
                self::seedRoles();
            }
            if (self::checkCreatedAdmin()) {
                self::seedAdmin();
            }
            self::$counter++;
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return self::$pdo;
    }

    private static function createRoles()
    {
        return  [
            Role::instanceWithNameAndDescriptionAndLogo(
                'Admin',
                'Administrator of Application',
                'https://cdn-icons-png.flaticon.com/128/8030/8030198.png'
            ),

            Role::instanceWithNameAndDescriptionAndLogo(
                'Teacher',
                'A User that can create courses',
                'https://cdn-icons-png.flaticon.com/128/18601/18601924.png'
            ),

            Role::instanceWithNameAndDescriptionAndLogo(
                'Student',
                'A User than can subscribe and view the catalog of courses',
                'https://cdn-icons-png.flaticon.com/128/18285/18285965.png'
            )
        ];
    }

    private static function checkCreatedRoles()
    {
        $query = "SELECT COUNT(*) FROM roles";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $rolesCount  =  $stmt->fetchColumn();

        if ($rolesCount > 0) {
            return false;
        }

        return true;
    }

    private static function checkCreatedAdmin()
    {
        $query = "SELECT count(*) FROM users WHERE role_id = 1";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $count  =  $stmt->fetchColumn();

        if ($count > 0) {
            return false;
        }

        return true;
    }

    private static function seedRoles()
    {
        $rolesToCreated = self::createRoles();
        foreach ($rolesToCreated as $role) {

            $query = "INSERT INTO roles (name , description, badge) VALUES ( '" . $role->getName() . "', '" . $role->getDescription() . "', '" . $role->getBadge() . "');";

            $stmt = Database::getInstance()->getConnection()->prepare($query);
            $stmt->execute();
        }
    }

    private static function seedAdmin()
    {
        $query = "INSERT INTO users (firstname, lastname, password, email, phone, photo, status, role_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ? )";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([
            'Admin',
            'Admin',
            'Admin',
            'Admin@admin.com',
            'Admin',
            'https://cdn-icons-png.flaticon.com/128/3281/3281355.png',
            'Active',
            '1'
        ]);
    }
}
