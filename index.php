
<?php
require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";
session_start();

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;
use App\Controllers\TagController;
use App\Controllers\UserController;
use App\Core\Database;
use App\Http\CourseForm;
use App\Http\LoginForm;
use App\Http\RegisterForm;
use App\Models\Category;
use App\Models\Tag;

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$userInSession = isset($_SESSION['user']) ? $_SESSION['user'] : null;

$userLoggedRole = !is_null($userInSession) ? $userInSession->getRole()->getName() : '';

$isLoggedIn = !is_null($userInSession) ? true : false;
// var_dump($loggedIn);
// var_dump($userInSession);
// var_dump($userLoggedRole);
// die();
switch ($request) {
    case '':
    case '/':
        Database::getInstance();
        require __DIR__ . '/views/Home.php';
        break;
    case '/login':
        if ($isLoggedIn) {
            header('location: /');
        } else {
            require __DIR__ . '/views/login.php';
        }
        break;

    case '/signup':
        if ($isLoggedIn) {
            header('location: /');
        } else {
            require __DIR__ . '/views/signup.php';
        }
        break;

    case '/profile':
        if ($isLoggedIn) {
            require __DIR__ . '/views/profile.php';
        } else {
            header('location: /');
        }
        break;

    case '/auth/register':
        if (isset(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['password'],
            $_POST['passwordConfirmation'],
            $_POST['phone'],
            $_POST['photo'],
            $_POST['roleName']
        )) {

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

            if (isset($_SESSION['error_register'])) {
                header("location: /signup");
            } else {
                header("location: /profile");
            }
        } else {
            header('location: /');
        }
        break;

    case '/auth/login':
        if (isset(
            $_POST['email'],
            $_POST['password']
        )) {
            $auth = new AuthController();
            $loginForm = LoginForm::instanceWithAllArgs($_POST['email'], $_POST['password']);
            $auth->login($loginForm);

            if (isset($_SESSION['error'])) {
                header("location: /login");
            } else {
                header("location: /profile");
            }
        } else {
            header('location: /');
        }
        break;

    case '/auth/logout':
        if ($isLoggedIn) {
            $auth = new AuthController();
            $auth->logout();
        }

        header("location: /");
        break;

    case '/courses':
        if ($userLoggedRole == "Admin" || $userLoggedRole == "Teacher") {
            header('location: /');
        } else {
            $courseController = new CourseController();
            $categoryController = new CategoryController();
            $tagController = new TagController();

            $searchParams = [
                'search' => $_GET['search'] ?? '',
                'category' => $_GET['category'] ?? ''
            ];

            $courses = !empty($searchParams['search']) || !empty($searchParams['category'])
                ? $courseController->searchCourses($searchParams)
                : $courseController->getAll();

            $categories = $categoryController->getAll();
            $tags = $tagController->getAll();

            require __DIR__ . '/views/courses.php';
        }
        break;


    case '/student/courses':
        if ($userLoggedRole != "Student") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $user_id = $_SESSION['user']->getId();
            $subscriptions = $courseController->getAllSubscriptions($user_id);
            require __DIR__ . '/views/student/mycourses.php';
        }
        break;

    case '/student/courses/details':
        if ($userLoggedRole != "Student") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $id = $_POST['id'];
            $user_id = $_SESSION['user']->getId();
            $course = $courseController->findById($id);
            $subscriptions = $courseController->getAllSubscriptions($user_id);

            require __DIR__ . '/views/student/courseDetails.php';
        }
        break;

    case '/student/course/subscribe':
        if ($userLoggedRole != "Student") {
            header('location: /');
        } else {
            $student_id = $_SESSION['user']->getId();
            $course_id = $_POST['course_id'];
            $userController = new UserController();

            $resultCourse = $userController->subscribe($student_id, $course_id);

            header("location: /student/courses");
        }
        break;

    case '/student/courses/enrolled':
        if ($userLoggedRole != "Student") {
            header('location: /');
        } else {
            require __DIR__ . '/views/student/mycourses.php';
        }
        break;

    case '/teacher':
    case '/teacher/courses':
        if ($userLoggedRole != "Teacher") {
            header('location: /');
        } else {
            if (isset($_SESSION['course_id'])) {
                unset($_SESSION['course_id']);
            }
            $courseController = new CourseController();
            $categoryController = new CategoryController();
            $tagController = new TagController();
            $userController = new UserController();

            $courses = $courseController->getAll();
            $categories = $categoryController->getAll();
            $tags = $tagController->getAll();
            $teacher_id = $_SESSION['user']->getId();

            $result = $userController->getNumberOfStudentsByTeacher($teacher_id);
            $coursesNumber = $userController->getCoursesByTeacher($teacher_id);
            require __DIR__ . '/views/teacher/dashboard.php';
        }
        break;

    case '/teacher/courses/one/delete':
        if ($userLoggedRole != "Teacher") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $id = $_POST['id'];
            $courseController->delete($id);
            header('location: /teacher/courses');
        }
        break;

    case '/teacher/course/create':
        if ($userLoggedRole != "Teacher") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $courseForm =  CourseForm::instanceWithAllArgs(
                $_POST['title'],
                $_POST['description'],
                $_POST['price'],
                0,
                $_POST['content'],
                'Archived',
                $_POST['categoryName'],
                $tags,
                $_SESSION['user']->getEmail(),
                []
            );

            $courseController->create($courseForm);
            header("location: /teacher/courses");
        }
        break;

    case '/teacher/course/update':
        if ($userLoggedRole != "Teacher") {
            header('location: /');
        } else {
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
        }
        break;
    case '/teacher/students':
        if ($userLoggedRole != "Teacher") {
            header('location: /');
        } else {
            $_SESSION['id_course'] = $_POST['id'];
            if (empty($_SESSION['id_course'])) {
                header('location: /teacher/courses');
            }
            $userController = new UserController();
            $result = $userController->getStudentsByCourse($_SESSION['id_course']);
            require __DIR__ . '/views/teacher/dashboard.php';
        }
        break;

    case '/admin':
    case '/admin/statistics':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $categoryController = new CategoryController();
            $categories = $categoryController->getAll();

            $courseController = new CourseController();
            $countCourses = $courseController->getCountCourses();

            $countCoursesByCategoryArray = $courseController->courseByCategory();

            $courseWithMostStudents = $courseController->courseWithMostStudents();

            $userController = new UserController();
            $topThreeTeachers = $userController->getTopThreeTeachers();

            require __DIR__ . '/views/admin/dashboard.php';
        }
        break;
    case '/admin/courses':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $courseController = new CourseController();
            $courses = $courseController->getAll();

            $categoryController = new CategoryController();
            $categories = $categoryController->getAll();

            $tagController = new TagController();
            $tags = $tagController->getAll();

            $userController =  new UserController();
            $teachers = $userController->getAll();

            require __DIR__ . '/views/admin/dashboard.php';
        }
        break;
    case '/admin/courses/one/delete':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $id = $_POST['id'];
            $courseController->delete($id);
            header('location: /admin/courses');
        }
        break;
    case '/admin/courses/one/archive':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $id = $_POST['id'];
            $courseController->archiveCourse($id);
            header('location: /admin/courses');
        }
        break;
    case '/admin/courses/one/activate':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $courseController =  new CourseController();
            $id = $_POST['id'];
            $courseController->activateCourse($id);
            header('location: /admin/courses');
        }
        break;
    case '/admin/users':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $users = $userController->getAll();
            require __DIR__ . '/views/admin/dashboard.php';
        }
        break;
    case '/admin/teachers':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $users = $userController->getAll();
            require __DIR__ . '/views/admin/dashboard.php';
        }
        break;

    case '/admin/topics':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $tagController = new TagController();
            $tags = $tagController->getAll();
            $_SESSION['tags'] = $tags;

            $categoryController = new CategoryController();
            $categories = $categoryController->getAll();
            $_SESSION['categories'] = $categories;
            require __DIR__ . '/views/admin/dashboard.php';
        }
        break;

    case '/admin/user/suspend':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $id = $_POST['id'];
            $userController->suspendUser($id);
            header('location: /admin/users');
        }
        break;

    case '/admin/user/activate':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $id = $_POST['id'];
            $userController->activateUser($id);
            header('location: /admin/users');
        }
        break;
    case '/admin/user/delete':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $id = $_POST['id'];
            $userController->deleteUser($id);
            header('location: /admin/users');
        }
        break;
    case '/admin/teacher/validate':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $id = $_POST['id'];
            $userController->activateUser($id);
            header('location: /admin/teachers');
        }
        break;
    case '/admin/teacher/suspend':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $userController = new UserController();
            $id = $_POST['id'];
            $userController->suspendUser($id);
            header('location: /admin/teachers');
        }
        break;

    case '/admin/topic/getAll':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $tagController = new TagController();
            $tags = $tagController->getAll();
            $_SESSION['tags'] = $tags;

            $categoryController = new CategoryController();
            $categories = $categoryController->getAll();
            $_SESSION['categories'] = $categories;
            header('location: /admin/topics');
        }
        break;

    case '/admin/category/create':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $category = new Category();
            $category->instanceWithoutId($_POST['title'], $_POST['description']);
            $categoryController = new CategoryController();
            $categoryController->create($category);
            header("location: /admin/topics");
        }
        break;
    case '/admin/category/update':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $category = new Category();
            $category->instanceWithAll($_POST['id'], $_POST['title'], $_POST['description']);
            $categoryController = new CategoryController();
            $categoryController->update($category);
            header("location: /admin/topics");
        }
        break;
    case '/admin/category/delete':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $categoryController = new CategoryController();
            $id = $_POST['id'];
            $categoryController->delete($id);
            header("location: /admin/topics");
        }
        break;
    case '/admin/tag/create':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $tag =  new Tag();
            $tag->instanceWithoutId($_POST['title'], $_POST['description']);
            $tagController =  new TagController();
            $tagController->create($tag);
            header("location: /admin/topics");
        }
        break;
    case '/admin/tag/update':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $tag = new Tag();
            $tag->instanceWithAll($_POST['id'], $_POST['title'], $_POST['description']);
            $tagController = new tagController();
            $tagController->update($tag);
            header("location: /admin/topics");
        }
        break;
    case '/admin/tag/delete':
        if ($userLoggedRole != "Admin") {
            header('location: /');
        } else {
            $tagController = new tagController();
            $id = $_POST['id'];
            $tagController->delete($id);
            header("location: /admin/topics");
        }
        break;
    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>