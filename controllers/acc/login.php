<?php
session_start();
require_once __DIR__ . '/../../models/connect/connect.php';
$pdo = Database::connect(); 

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user"] = $user;
        if ($user['email'] === 'baitaplon@gmail.com') {
            header("Location: /BTL_thang_vanh/public/admin.php");
            exit();
        } else {
            header("Location: ../../views/index/index.php");
            exit();
        }
    } else {
        // Nếu là admin nhưng sai mật khẩu thì quay về login.php
        if ($email === 'baitaplon@gmail.com') {
            header("Location: ../../views/acc/login.php");
            exit();
        } else {
            header("Location: ../../views/acc/login.php");
            exit();
        }
    }
}
?>
