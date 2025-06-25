<?php
// đường dẫn có tham số controller và action
// nếu không có thì mặc định vào dashboard / index

$controllerName = $_GET['controller'] ?? 'Admin';
$action = $_GET['action'] ?? 'index';

$controllerClass = $controllerName . 'Controller';
require_once "../controllers/Admin/{$controllerClass}.php";

$controller = new $controllerClass();

// Nếu có tham số id thì truyền vào action
if (isset($_GET['id'])) {
    $controller->$action($_GET['id']);
} else {
    $controller->$action();
}
?>