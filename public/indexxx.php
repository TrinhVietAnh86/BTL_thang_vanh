<?php
$controllerName = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'home';

$controllerClass = $controllerName . 'Controller';
require_once  '../controllers/admin/homeController.php';
$controller = new $controllerClass();
$controller->$action();
?>
