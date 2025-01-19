
<?php
require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";
session_start();

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;
use App\Controllers\TagController;
use App\Controllers\UserController;
use App\DAOs\CourseDao;
use App\Http\CourseForm;
use App\Http\LoginForm;
use App\Http\RegisterForm;
use App\Models\Category;
use App\Models\Tag;

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
            $_POST['title'],
            $_POST['description'],
            $_POST['price'],
            0,
            $_POST['content'],
            $_POST['categoryName'],
            $_POST['tags'],
            // get email from session
            'rucuw@mailinator.com',
            []
        );
        $courseController->create($courseForm);
        header("location: /admin/courses");
        break;

    case '/tag/create':
        $tag =  new Tag();
        $tag->instanceWithoutId($_POST['title'], $_POST['description']);
        $tagController =  new TagController();
        $tagController->create($tag);
        header("location: /admin/topics");
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
        $category = new Category();
        $category->instanceWithoutId($_POST['title'], $_POST['description']);
        $categoryController = new CategoryController();
        $categoryController->create($category);
        header("location: /admin/topics");
        break;

    case '/student/courses':
        $courseController = new CourseController();
        $courses = $courseController->getAll();
        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $tagController = new TagController();
        $tags = $tagController->getAll();
        require __DIR__ . '/views/student/courses.php';
        break;

    case '/student/courses/details':
        $courseController =  new CourseController();
        $id = $_POST['id'];
        $course = $courseController->findById($id);
        require __DIR__ . '/views/student/courseDetails.php';
        break;

    case '/student/courses/enrolled':
        require __DIR__ . '/views/student/mycourses.php';
        break;

    case '/teacher':
    case '/teacher/courses':
        $courseController = new CourseController();
        $courses = $courseController->getAll();
        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $tagController = new TagController();
        $tags = $tagController->getAll();
        require __DIR__ . '/views/teacher/dashboard.php';
        break;

    case '/teacher/statistics':
    case '/teacher/students':
        require __DIR__ . '/views/teacher/dashboard.php';
        break;

    case '/admin':
    case '/admin/statistics':
        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/courses':
        $courseController = new CourseController();
        $courses = $courseController->getAll();
        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $tagController = new TagController();
        $tags = $tagController->getAll();
        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/courses/one/delete':
        $courseController =  new CourseController();
        $id = $_POST['id'];
        $courseController->delete($id);
        header('location: /admin/courses');
        break;
    case '/admin/users':
        $userController = new UserController();
        $users = $userController->getAll();
        require __DIR__ . '/views/admin/dashboard.php';
        break;

    case '/admin/topics':
        $tagController = new TagController();
        $tags = $tagController->getAll();
        $_SESSION['tags'] = $tags;

        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $_SESSION['categories'] = $categories;
        require __DIR__ . '/views/admin/dashboard.php';
        break;

    case '/user/suspend':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->suspendUser($id);
        header('location: /admin/users');
        break;

    case '/user/activate':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->activateUser($id);
        header('location: /admin/users');
        break;

    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>