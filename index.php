
<?php
require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";
session_start();

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;
use App\Controllers\TagController;
use App\Http\CourseForm;
use App\Http\LoginForm;
use App\Http\RegisterForm;
use App\Models\Category;
use App\Models\Course;
use App\Models\Tag;
use App\Models\User;

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/':
        require __DIR__ . '/views/Home.php';
        break;

    case '/profile':
        require __DIR__ . '/views/profile.php';
        break;

    case '/auth/register':
        $auth = new AuthController();
        $registerForm = RegisterForm::instanceWithAllArgs(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['password'],
            $_POST['passwordConfirmation'],
            $_POST['phone'],
            $_POST['photo'],
            'Pending',
            $_POST['roleName']
        );
        $auth->register($registerForm);
        header("location: /profile");
        break;

    case '/auth/login':
        $auth = new AuthController();
        $loginForm = LoginForm::instanceWithAllArgs($_POST['email'], $_POST['password']);
        $auth->login($loginForm);

        if (isset($_SESSION['error'])) {
            header("location: /login");
        } else {
            header("location: /profile");
        }

        break;

    case '/auth/logout':
        $auth = new AuthController();
        $auth->logout();
        header("location: /");
        break;

    case '/login':
        require __DIR__ . '/views/login.php';
        break;

    case '/signup':
        require __DIR__ . '/views/signup.php';
        break;
    case '/courses':
        require __DIR__ . '/views/courses.php';
        break;

    case '/course/create':
        $courseController =  new CourseController();
        $courseForm =  CourseForm::instanceWithAllArgs(
            'HTML & CSS basics',
            'Everything about HTML AND CSS',
            100,
            4,
            'content of the course',
            'Coding',
            ['CSS', 'HTML'],
            'jipi@mailinator.com',
            []
        );

        // $courseController->create($courseForm);
        header("location: /admin/courses");
        break;
    case '/tag/create':
        // $tagC =  new TagController();
        // $tag =  new Tag();
        // $tag->instanceWithoutId('JS', 'javascript tag');
        // $tagC->create($tag);
        header("location: /admin/courses");
        break;
    case '/topic/getAll':

        $tagController = new TagController();
        $tags = $tagController->getAll();
        $_SESSION['tags'] = $tags;

        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $_SESSION['categories'] = $categories;
        header('location: /admin/topics');
        break;
    case '/category/create':
        // $cat = new CategoryController();
        // $newCat = new Category();
        // $newCat->instanceWithoutId('Coding', 'Everything that has code in it.');
        // $cat->create($newCat);
        header("location: /admin/courses");
        break;


    case '/student/courses':
        require __DIR__ . '/views/student/courses.php';
        break;
    case '/student/courses/details':
        require __DIR__ . '/views/student/courseDetails.php';
        break;
    case '/student/courses/enrolled':
        require __DIR__ . '/views/student/mycourses.php';
        break;
    case '/teacher':
    case '/teacher/courses':
    case '/teacher/statistics':
    case '/teacher/students':
        require __DIR__ . '/views/teacher/dashboard.php';
        break;

    case '/admin':
    case '/admin/courses':
    case '/admin/users':
    case '/admin/topics':
        require __DIR__ . '/views/admin/admin.php';
        break;
    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>