<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Exception;

class UserController
{

    private User $user;
    private RoleService $roleService;
    private UserService $userService;

    public function __construct()
    {
        $this->roleService = new RoleService();
        $this->userService = new UserService();
    }

    public function create()
    {
        $firstname = "first";
        $lastname = "last";
        $password = "998877";
        $email = "adminsssdsd@example.com";
        $phone = "0607189671";
        $photo = "Logo.png";
        $status = "Pending";
        $rolename = "Teacher";

        $role = Role::instanceWithName($rolename);

        $user = User::instanceWithoutId(
            $firstname,
            $lastname,
            $password,
            $email,
            $phone,
            $photo,
            $status,
            $role,
            []
        );

        try {
            $user = $this->userService->create($user);
            return $user;
        } catch (Exception $e) {
            die("Erreur de base de données : " . $e->getMessage());
        }
    }
}
