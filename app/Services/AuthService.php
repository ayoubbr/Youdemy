<?php

namespace App\Services;

use App\Http\LoginForm;
use App\Models\User;
use Exception;

class AuthService
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
        // Message::in("AuthService constructor");
    }

    // public function register(RegisterForm $registerForm) : Utilisateur {
    //     $this->validation($registerForm);

    //     // $firstname, string $lastname, string $email, string $password, string $phone, string $photo, Role $role, array $reservations

    //     //Utilisateur

    //     $user = Utilisateur::instanceWithoutId(
    //         $registerForm->firstname,
    //         $registerForm->lastname,
    //         $registerForm->email,
    //         $registerForm->password,
    //         $registerForm->phone,
    //         $registerForm->photo,
    //         new Role(),
    //         []
    //     );

    //     $user->getRole()->setRoleName("Utilisateur");

    //     $this->userService->create($user);
    //     return new Utilisateur();
    // }

    // private function validation($forms) {
    //     // Message::in("la méthode validation dans la classe authService");
    //     foreach ($forms as $key => $value) {
    //         // Message::in("la validation du champ : " . $key);
    //         if (!$this->validationString($value)) {
    //             throw new Exception($key . " is not valide ");
    //         }
    //     }



    //     if (isset($forms->password) && isset($forms->passwordConfirmation)) {
    //         $this->passwordValidation($forms->password, $forms->passwordConfirmation);
    //     }



    // }

    // private function validationString(string $string): bool {
    //     // Message::in("validation des string la valeur est : " . $string);
    //     if (empty($string) || $string == null || is_null($string)) {
    //         return false;
    //     }

    //     return true;
    // }

    // public function passwordValidation(string $password, string $passwordConfirmation) {
    //     // Message::in("validation des password ");
    //     // Message::in("pass 1 : " . $password . " pass 2 : " . $passwordConfirmation);
    //     if ($password != $passwordConfirmation) {
    //         throw new Exception("les mots de passe sont pas les mêmes");
    //     }

    //     return true;
    // }

    public function login(LoginForm $loginForm): User
    {
        // $this->validation($loginForm);
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
