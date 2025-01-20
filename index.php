
<?php
require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";
session_start();

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;
use App\Controllers\TagController;
use App\Controllers\UserController;
use App\Http\CourseForm;
use App\Http\LoginForm;
use App\Http\RegisterForm;
use App\Models\Category;
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

    case '/topic/getAll':
        $tagController = new TagController();
        $tags = $tagController->getAll();
        $_SESSION['tags'] = $tags;

        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();
        $_SESSION['categories'] = $categories;
        header('location: /admin/topics');
        break;

    case '/admin/category/create':
        $category = new Category();
        $category->instanceWithoutId($_POST['title'], $_POST['description']);
        $categoryController = new CategoryController();
        $categoryController->create($category);
        header("location: /admin/topics");
        break;
    case '/admin/category/update':
        $category = new Category();
        $category->instanceWithAll($_POST['id'], $_POST['title'], $_POST['description']);
        $categoryController = new CategoryController();
        $categoryController->update($category);
        header("location: /admin/topics");
        break;
    case '/admin/category/delete':
        $categoryController = new CategoryController();
        $id = $_POST['id'];
        $categoryController->delete($id);
        header("location: /admin/topics");
        break;
    case '/admin/tag/create':
        $tag =  new Tag();
        $tag->instanceWithoutId($_POST['title'], $_POST['description']);
        $tagController =  new TagController();
        $tagController->create($tag);
        header("location: /admin/topics");
        break;
    case '/admin/tag/update':
        $tag = new Tag();
        $tag->instanceWithAll($_POST['id'], $_POST['title'], $_POST['description']);
        $tagController = new tagController();
        $tagController->update($tag);
        header("location: /admin/topics");
        break;
    case '/admin/tag/delete':
        $tagController = new tagController();
        $id = $_POST['id'];
        $tagController->delete($id);
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
    case '/teacher/courses/one/delete':
        $courseController =  new CourseController();
        $id = $_POST['id'];
        $courseController->delete($id);
        header('location: /teacher/courses');
        break;

    case '/teacher/course/create':
        $courseController =  new CourseController();
        $courseForm =  CourseForm::instanceWithAllArgs(
            $_POST['title'],
            $_POST['description'],
            $_POST['price'],
            0,
            $_POST['content'],
            'Active',
            $_POST['categoryName'],
            $_POST['tags'],
            $_SESSION['user']->getEmail(),
            []
        );

        $courseController->create($courseForm);
        header("location: /teacher/courses");
        break;

    case '/teacher/course/update':
        $courseController =  new CourseController();
        $tags = [];
        if (!empty($_POST['tags'])) {
            $tags = $_POST['tags'];
        }
        $courseForm =  CourseForm::instanceWithAll(
            $_POST['id'],
            $_POST['title'],
            $_POST['description'],
            $_POST['price'],
            $_POST['rating'],
            $_POST['content'],
            $_POST['status'],
            $_POST['categoryName'],
            $tags,
            $_SESSION['user']->getEmail(),
            // todo when subscription is done (students)
            []
        );

        $courseController->update($courseForm);
        header('location: /teacher/courses');
        break;

    case '/teacher/statistics':
        $userController = new UserController();
        $teacher_id = $_SESSION['user']->getId();
        $result = $userController->getNumberOfStudentsByTeacher($teacher_id);
        // $result = $userController->getCoursesByTeacher($teacher_id);
        require __DIR__ . '/views/teacher/dashboard.php';
        break;
    case '/teacher/students':
        $_SESSION['id_course'] = $_POST['id'];
        if (empty($_SESSION['id_course'])) {
            header('location: /teacher/courses');
        }
        $userController = new UserController();
        $result = $userController->getStudentsByCourse($_SESSION['id_course']);
        require __DIR__ . '/views/teacher/dashboard.php';
        break;

    case '/admin':
    case '/admin/statistics':
        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();

        $courseController = new CourseController();
        $countCourses = $courseController->getCountCourses();

        $countCoursesByCategoryArray = $courseController->courseByCategory();

        $courseWithMostStudents = $courseController->courseWithMostStudents();

        $userController = new UserController();
        $topThreeTeachers = $userController->getTopThreeTeachers();

        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/courses':
        $courseController = new CourseController();
        $courses = $courseController->getAll();

        $categoryController = new CategoryController();
        $categories = $categoryController->getAll();

        $tagController = new TagController();
        $tags = $tagController->getAll();

        $userController =  new UserController();
        $teachers = $userController->getAll();

        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/courses/one/delete':
        $courseController =  new CourseController();
        $id = $_POST['id'];
        $courseController->delete($id);
        header('location: /admin/courses');
        break;
    case '/admin/courses/one/archive':
        $courseController =  new CourseController();
        $id = $_POST['id'];
        $courseController->archiveCourse($id);
        header('location: /admin/courses');
        break;
    case '/admin/courses/one/activate':
        $courseController =  new CourseController();
        $id = $_POST['id'];
        $courseController->activateCourse($id);
        header('location: /admin/courses');
        break;
    case '/admin/users':
        $userController = new UserController();
        $users = $userController->getAll();
        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/teachers':
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

    case '/admin/user/suspend':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->suspendUser($id);
        header('location: /admin/users');
        break;

    case '/admin/user/activate':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->activateUser($id);
        header('location: /admin/users');
        break;
    case '/admin/user/delete':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->deleteUser($id);
        header('location: /admin/users');
        break;
    case '/admin/teacher/validate':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->activateUser($id);
        header('location: /admin/teachers');
        break;
    case '/admin/teacher/suspend':
        $userController = new UserController();
        $id = $_POST['id'];
        $userController->suspendUser($id);
        header('location: /admin/teachers');
        break;

    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>