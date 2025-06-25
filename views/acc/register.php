<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/acc/style.css">
    <title>Đăng ký</title>
</head>
<body>
    <form action="../../controllers/acc/register.php" method="POST">
        <h2>Đăng ký tài khoản</h2>
        <input type="text" name="username" placeholder="Tên đăng nhập" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mật khẩu" required />
        <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required />
        <input type="submit" value="Đăng ký" />
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </form>
</body>
</html>
