<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    private User $user;
    private UserRepository $userRepository;
    private RoleService $roleService;
    private CourseService $courseService;

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

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

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

    public function findById($id): User
    {
        $user = $this->userRepository->findById($id);
        return $user;
    }

    public function suspendUser($id)
    {
        $this->userRepository->suspendUser($id);
    }

    public function activateUser($id)
    {
        $this->userRepository->activateUser($id);
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);
    }

    public function getTopThreeTeachers()
    {
        return $this->userRepository->getTopThreeTeachers();
    }

    public function getStudentsByCourse($id)
    {
        return $this->userRepository->getStudentsByCourse($id);
    }

    public function getNumberOfStudentsByTeacher($teacher_id)
    {
        return $this->userRepository->getNumberOfStudentsByTeacher($teacher_id);
    }

    public function getCoursesByTeacher($teacher_id)
    {
        return $this->userRepository->getCoursesByTeacher($teacher_id);
    }

    public function subscribe($student_id, $course_id)
    {
        $this->courseService = new CourseService();

        $course = $this->courseService->findById($course_id);
        $student = $this->findById($student_id);

        $course->setStudent($student);
     
        $this->userRepository->subscribe($student_id, $course_id);
        
        return $course;
    }
}
