<?php

namespace App\Controllers;

use App\Http\LoginForm;
use App\Http\RegisterForm;
use App\Services\AuthService;
use Exception;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register(RegisterForm $registerForm)
    {
        try {
            $user = $this->authService->register($registerForm);

            if ($user) {
                $_SESSION['user'] = $user;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function login(LoginForm $loginForm)
    {
        try {
            $user = $this->authService->login($loginForm);

            if ($user) {
                $_SESSION['user'] = $user;
            }
        } catch (Exception $e) {
            $_SESSION['error'] =  $e->getMessage();
        }
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
    }
}
