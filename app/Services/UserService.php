<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    private User $user;
    private UserRepository $userRepository;
    private RoleService $roleService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->roleService = new RoleService();
    }

    public function create(User $user)
    {
        if ($user->getId() != 0) {
            throw new Exception("invalide value (id)");
        }

        if (empty($user->getFirstname())) {
            throw new Exception("Firstname is empty");
        }

        if (empty($user->getLastname())) {
            throw new Exception("lastname is empty");
        }

        if (empty($user->getEmail())) {
            throw new Exception("email is empty");
        }

        if (empty($user->getPhone())) {
            throw new Exception("phone is empty");
        }

        if (empty($user->getPhoto())) {
            throw new Exception("Photo is empty");
        }

        if (empty($user->getRole()->getName())) {
            throw new Exception("Role name is empty");
        }

        $roleName = $user->getRole()->getName();
        $user->setRole($this->roleService->getRoleByName($roleName));

        if ($this->checkEmailifExist($user->getEmail())) {
            throw new Exception("Email is already exist !");
        }

        return $this->userRepository->create($user);
    }

    public function checkEmailifExist(string $email)
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user != null) {
            return true;
        }

        return false;
    }

    // public function delete() {}

    // public function findAll() {}

    // public function findById() {}

    // public function update() {}

    public function findByEmailAndPassword(User $user): User
    {
        $user = $this->userRepository->findByEmailAndPassword($user);

        if (!$user) {
            return new User();
        }

        $user->setRole($this->roleService->getRoleById($user->role_id));

        return $user;
    }

    public function findByEmail(string $email): User
    {
        $user = $this->userRepository->findByEmail($email);
        return $user;
    }
}
