
<?php
require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";
session_start();

use App\Controllers\AuthController;
use App\Http\LoginForm;
use App\Http\RegisterForm;

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

    case '/courses':
        require __DIR__ . '/views/courses.php';
        break;

    case '/admin':
        require __DIR__ . '/views/admin.php';
        break;

    case '/login':
        require __DIR__ . '/views/login.php';
        break;

    case '/signup':
        require __DIR__ . '/views/signup.php';
        break;

    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>