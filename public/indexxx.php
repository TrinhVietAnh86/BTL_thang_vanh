<?php
$controllerName = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'home';

$controllerClass = ucfirst($controllerName) . 'Controller';
require_once  '../controllers/admin/homeController.php';
$controller = new $controllerClass();

if ($action === 'detail' && isset($_GET['id'])) {
    $controller->$action($_GET['id']);
} else {
    $controller->$action();
}
?>
