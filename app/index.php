<?php
session_start();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$controllerFile = "app/controllers/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . "Controller";
    $controllerInstance = new $controllerClass();
    $controllerInstance->$action();
} else {
    header('Location: index.php?controller=user&action=login');
    exit;
}
?> 