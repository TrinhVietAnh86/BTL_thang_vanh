<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/acc/style.css">
    <title>Đăng nhập</title>
</head>
<body>
    <form action="../../controllers/acc/login.php" method="POST">
        <h2>Đăng nhập</h2>
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mật khẩu" required />
        <input type="submit" value="Đăng nhập" />
        <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </form>
</body>
</html>