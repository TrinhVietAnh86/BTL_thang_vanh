<?php
session_start();

// Debug: Ghi log khi admin.php được truy cập
error_log("admin.php accessed with controller: " . ($_GET['controller'] ?? 'none') . ", action: " . ($_GET['action'] ?? 'none'));

// Thêm 'category' vào danh sách hợp lệ
$validControllers = ['acc', 'user', 'product', 'category', 'home', 'cart', 'detail'];
$controllerName = isset($_GET['controller']) ? strtolower(trim($_GET['controller'])) : 'user';
$action = isset($_GET['action']) ? trim($_GET['action']) : 'index';

if (!in_array($controllerName, $validControllers)) {
    http_response_code(404);
    error_log("Invalid controller: $controllerName");
    echo "Controller không tồn tại!";
    exit;
}

// Định nghĩa đường dẫn đến file controller dựa trên $controllerName
$controllerDir = $_SERVER['DOCUMENT_ROOT'] . '/BTL_thang_vanh/controllers/';
$controllerFile = $controllerDir . ($controllerName === 'acc' ? 'acc/' : 'admin/') . ucfirst($controllerName) . 'Controller.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    error_log("Controller file not found: $controllerFile");
    echo "Controller không tồn tại!";
    exit;
}

require_once $controllerFile;

$controllerClass = ucfirst($controllerName) . 'Controller';
if (!class_exists($controllerClass)) {
    http_response_code(404);
    error_log("Controller class not found: $controllerClass");
    echo "Controller không tồn tại!";
    exit;
}

$controller = new $controllerClass();

// Lấy tất cả tham số từ URL để truyền vào action
$params = $_GET; // Lấy tất cả tham số GET
unset($params['controller'], $params['action']); // Loại bỏ controller và action khỏi params

// Gọi action với tham số động
if (method_exists($controller, $action)) {
    call_user_func_array([$controller, $action], array_values($params));
} else {
    http_response_code(404);
    error_log("Action not found: $action in $controllerClass");
    echo "Action không tồn tại!";
    exit;
}
?>