<?php
session_start();

// Kiểm tra xem controller được yêu cầu
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Chuyển đổi tên controller thành đúng format
$controllerName = ucfirst(strtolower($controller)) . 'Controller';
$controllerFile = "app/controllers/{$controllerName}.php";

// Kiểm tra file controller tồn tại
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Kiểm tra class controller tồn tại
    if (class_exists($controllerName)) {
        $controllerInstance = new $controllerName();
        
        // Kiểm tra method action tồn tại
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            die("Action '{$action}' không tồn tại trong controller '{$controllerName}'!");
        }
    } else {
        die("Controller class '{$controllerName}' không tồn tại!");
    }
} else {
    die("Controller file '{$controllerFile}' không tồn tại!");
}
?>