<?php
$pageTitle = "Thêm người dùng";
?>
<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/add/userstyle.css">
<body>
    <h2>Thêm người dùng</h2>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>
    <form action="/BTL_thang_vanh/public/admin.php?controller=user&action=store" method="POST">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" placeholder="Tên đăng nhập" required />
        <label>Email:</label>
        <input type="email" name="email" placeholder="Email" required />
        <label>Số điện thoại:</label>
        <input type="text" name="phone" placeholder="Số điện thoại" />
        <label>Địa chỉ:</label>
        <input type="text" name="address" placeholder="Địa chỉ" />
        <label>Mật khẩu:</label>
        <input type="password" name="password" placeholder="Mật khẩu" required />
        <label>Nhập lại mật khẩu:</label>
        <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required />
        <label>Vai trò:</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" value="Thêm người dùng" />
    </form>
</body>
</html>