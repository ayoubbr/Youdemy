<?php

namespace App\Repositories;

use App\Core\Database;
use App\DAOs\UserDao;
use App\Models\User;
use PDO;

class UserRepository
{
    private UserDao $userDao;
    private RoleRepository $roleRepository;

    public function __construct()
    {
        $this->userDao = new UserDao();
        $this->roleRepository = new RoleRepository();
    }

    public function create(User $user): User
    {
        return $this->userDao->create($user);
    }

    public function getAll()
    {
        $users = $this->userDao->getAll();

        foreach ($users as $key => $user) {
            $user->setRole($this->roleRepository->findById($user->role_id));
        };

        return $users;
    }

    public function findByEmail(string $email): mixed
    {
        $query = "SELECT id, firstname, lastname, email, phone, photo, role_id, password FROM users WHERE email = '" . $email . "';";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();

        return $stmt->fetchObject(User::class);
    }
    public function findById($id): mixed
    {
        $query = "SELECT id, firstname, lastname, email, phone, photo, role_id, password FROM users WHERE id = '" . $id . "';";
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

    public function suspendUser($id)
    {
        $query = "UPDATE users SET `status` = 'Suspended' WHERE id = " . $id;
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
    }

    public function activateUser($id)
    {
        $query = "UPDATE users SET `status` = 'Active' WHERE id = " . $id;
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
    }

    public function delete($id)
    {
        $query = "UPDATE users SET `status` = 'Deleted' WHERE id = " . $id;
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
    }

    public function getTopThreeTeachers()
    {
        $query = "SELECT u.id, u.firstname, u.lastname, r.name as role_name,
                    COUNT(s.student_id) as total_students
                    FROM users u
                    JOIN roles r ON u.role_id = r.id
                    JOIN courses c ON u.id = c.teacher_id
                    JOIN subscriptions s ON c.id = s.course_id
                    WHERE r.name = 'Teacher'
                    GROUP BY u.id, u.firstname, u.lastname, r.name
                    ORDER BY total_students DESC
                    LIMIT 3";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
