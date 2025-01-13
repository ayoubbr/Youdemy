
<?php
session_start();

use App\Controllers\AuthController;
use App\Http\LoginForm;

require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/':
        require __DIR__ . '/views/Home.php';
        break;

    case '/auth/login':
        $auth = new AuthController();
        $loginForm = LoginForm::instanceWithAllArgs("adminsssdsd@example.com", "998877");
        $auth->login($loginForm);
        header("location: /profile");
        break;

    case '/profile':
        require __DIR__ . '/views/profile.php';
        break;

    case '/auth/logout':
        $auth = new AuthController();
        $auth->logout();
        header("location: /profile");
        break;

    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>