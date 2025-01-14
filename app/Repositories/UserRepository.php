<?php

namespace App\Repositories;

use App\Core\Database;
use App\DAOs\UserDao;
use App\Models\User;

class UserRepository
{
    private UserDao $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function create(User $user): User
    {
        return $this->userDao->create($user);
    }

    public function findByEmail(string $email): mixed
    {
        $query = "SELECT id, firstname, lastname, email, phone, photo, role_id, password FROM users WHERE email = '" . $email . "';";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchObject(User::class);
    }

    public function findByEmailAndPassword(User $user): mixed
    {
        $query = "SELECT id, firstname, lastname, email, phone, photo, status, role_id, password FROM users WHERE email = '" . $user->getEmail() . "' AND password = '" . $user->getPassword() . "';";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();

        return $stmt->fetchObject(User::class);
    }
}
