<?php
$pageTitle = "Đăng nhập";
?>
    <h2>Đăng nhập</h2>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>
    <form action="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=doLogin" method="POST">
        <label for="email">Tên đăng nhập hoặc Email:</label>
        <input type="text" id="email" name="email" placeholder="Tên đăng nhập hoặc Email" required />
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required />
        <input type="submit" value="Đăng nhập" />
        <p>Chưa có tài khoản? <a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=register">Đăng ký</a></p>
    </form>
</body>
</html>