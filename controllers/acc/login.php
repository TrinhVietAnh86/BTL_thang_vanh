<?php
session_start();
require_once __DIR__ . '/../../models/connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user"] = $user;
        header("Location: ../../views/index/index.php");
        exit();
    } else {
        echo "Sai email hoặc mật khẩu.";
    }
}
?>
