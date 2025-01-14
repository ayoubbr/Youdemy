<?php

namespace App\Http;

class RegisterForm
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $passwordConfirmation;
    public string $phone;
    public string $photo;
    public string $status;
    public string $roleName;


    public static function instanceWithAllArgs(
        string $firstname,
        string $lastname,
        string $email,
        string $password,
        string $passwordConfirmation,
        string $phone,
        string $photo,
        string $status,
        string $roleName

    ): self {
        $instance = new self();
        $instance->firstname = $firstname;
        $instance->lastname = $lastname;
        $instance->email = $email;
        $instance->password = $password;
        $instance->passwordConfirmation = $passwordConfirmation;
        $instance->phone = $phone;
        $instance->photo = $photo;
        $instance->status = $status;
        $instance->roleName = $roleName;

        return $instance;
    }
}
