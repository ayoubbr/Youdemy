<?php

namespace App\DAOs;

use App\Core\Database;
use App\Models\User;
use PDO;

class UserDao
{

    public function create(User $user): User
    {

        $query = "INSERT INTO users (firstname, lastname, email, password, photo, phone, status, role_id ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute([
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhoto(),
            $user->getPhone(),
            $user->getStatus(),
            $user->getRole()->getId()
        ]);

        $user->setId(Database::getInstance()->getConnection()->lastInsertId());
        return $user;
    }
    public function getAll()
    {
        $query = "SELECT id, firstname, lastname,
         password, email, phone, photo, status, role_id FROM users;";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\User');
        return $users;
    }
}
