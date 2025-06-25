<?php
require_once '../../models/connect/connect.php';
$pdo = Database::connect(); // Thêm dòng này để có biến $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    // So sánh mật khẩu
    if ($password !== $repassword) {
        echo "Mật khẩu nhập lại không khớp. <a href='../../views/acc/register.php'>Thử lại</a>";
        exit;
    }

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
       header("Location: ../../views/acc/login.php");
exit();
    } else {
        echo "Đã xảy ra lỗi.";
    }
}
?>
