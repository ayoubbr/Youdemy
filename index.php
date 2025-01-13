
<?php
require dirname(__DIR__) . "\\Youdemy\\vendor\\autoload.php";

$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '':
    case '/':
        require __DIR__ . '/views/Home.php';
        break;

    default:
        require __DIR__ . '/views/Home.php';
        break;
}
?>