<?php

namespace App\Controllers;

use App\Http\LoginForm;
use App\Services\AuthService;
use Exception;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        session_start();
        $this->authService = new AuthService();
    }

    // public function register(RegisterForm $registerForm)
    // {
    //     try {
    //         $user = $this->authService->register($registerForm);
    //     } catch (Exception $e) {
    //     }
    // }

    public function login(LoginForm $loginForm)
    {

        try {
        
            $user = $this->authService->login($loginForm);

            if ($user) {
                $_SESSION['user'] = $user;
            } else {
                session_destroy();
            }

        } catch (Exception $e) {
        }
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
    }
}
