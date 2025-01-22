<?php

namespace App\Services;

use App\Http\LoginForm;
use App\Http\RegisterForm;
use App\Models\Role;
use App\Models\User;
use Exception;

class AuthService
{
    private UserService $userService;
    private RoleService $roleService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->roleService = new RoleService();
    }

    public function register(RegisterForm $registerForm): User
    {
        $this->validation($registerForm);

        $role  = Role::instanceWithName($registerForm->roleName);

        $user = User::instanceWithoutId(
            $registerForm->firstname,
            $registerForm->lastname,
            $registerForm->email,
            $registerForm->password,
            $registerForm->phone,
            $registerForm->photo,
            $registerForm->status,
            $role,
            []
        );

        $this->userService->create($user);
        return $user;
    }

    private function validation($forms)
    {
        foreach ($forms as $key => $value) {
            if (!$this->validationString($value)) {
                throw new Exception($key . " is not valide ");
            }
        }

        if (isset($forms->password) && isset($forms->passwordConfirmation)) {
            $this->passwordValidation($forms->password, $forms->passwordConfirmation);
        }
    }

    private function validationString(string $string): bool
    {
        if (empty($string) || $string == null || is_null($string)) {
            return false;
        }

        return true;
    }

    public function passwordValidation(string $password, string $passwordConfirmation)
    {
        if ($password != $passwordConfirmation) {
            throw new Exception("les mots de passe sont pas les mêmes");
        }

        return true;
    }

    public function login(LoginForm $loginForm): User
    {
        $this->validation($loginForm);
        $user = User::instaceWithEmailAndPassword(
            $loginForm->email,
            $loginForm->password
        );

        $user =  $this->userService->findByEmailAndPassword($user);

        if ($user->getId() == 0) {
            throw new Exception("Email ou le mot de passe incorrect");
        }

        return $user;
    }
}
