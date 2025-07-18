<?php
session_start();
require_once '../controllers/acc/accController.php';

$validControllers = ['acc'];
$controllerName = isset($_GET['controller']) ? strtolower(trim($_GET['controller'])) : 'acc';
$action = isset($_GET['action']) ? trim($_GET['action']) : 'login';

if (!in_array($controllerName, $validControllers)) {
    http_response_code(404);
    echo "Controller không tồn tại!";
    exit;
}

$controllerClass = ucfirst($controllerName) . 'Controller';
if (!class_exists($controllerClass)) {
    http_response_code(404);
    echo "Controller không tồn tại!";
    exit;
}

$controller = new $controllerClass();
if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo "Action không tồn tại!";
    exit;
}

$controller->$action();
?>