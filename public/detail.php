<?php
$controllerName = $_GET['controller'] ?? 'detail';
$action = $_GET['action'] ?? 'detail';

$controllerClass = ucfirst($controllerName) . 'Controller';
require_once  '../controllers/admin/homeController.php';
$controller = new $controllerClass();

if ($action === 'detail' && isset($_GET['id'])) {
    $controller->$action($_GET['id']);
} else {
    $controller->$action();
}
?>
