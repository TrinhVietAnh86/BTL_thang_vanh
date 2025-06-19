<?php
require_once '../../models/connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Kiểm tra email đã tồn tại chưa
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "Email đã tồn tại. <a href='../../views/acc/register.php'>Thử lại</a>";
        exit;
    }

    // Mã hóa mật khẩu và lưu vào DB
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    
    if ($stmt->execute([$email, $hashedPassword])) {
        echo "Đăng ký thành công. <a href='../../views/acc/login.php'>Đăng nhập</a>";
    } else {
        echo "Đã xảy ra lỗi.";
    }
}
?>
