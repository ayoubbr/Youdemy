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
    private CourseController $courseController;

    public function __construct()
    {
        $this->roleService = new RoleService();
        $this->userService = new UserService();
        $this->courseController = new CourseController();
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
        $user =  new User();
        $user->instanceWithoutId(
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

    public function getAll()
    {
        return $this->userService->getAll();
    }

    public function suspendUser($id)
    {
        $this->userService->suspendUser($id);
    }

    public function activateUser($id)
    {
        $this->userService->activateUser($id);
    }

    public function deleteUser($id)
    {
        $this->userService->delete($id);
    }

    public function getTopThreeTeachers()
    {
        return $this->userService->getTopThreeTeachers();
    }

    public function getStudentsByCourse($id)
    {
        return $this->userService->getStudentsByCourse($id);
    }

    public function getNumberOfStudentsByTeacher($teacher_id)
    {
        return $this->userService->getNumberOfStudentsByTeacher($teacher_id);
    }

    public function getCoursesByTeacher($teacher_id)
    {
        return $this->userService->getCoursesByTeacher($teacher_id);
    }

    public function subscribe($student_id, $course_id)
    {
        $course = $this->userService->subscribe($student_id, $course_id);

        return $course;
    }

    public function findById($id): User
    {
        $user = $this->userService->findById($id);
        return $user;
    }
}
