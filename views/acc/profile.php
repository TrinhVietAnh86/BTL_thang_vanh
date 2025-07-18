<?php
$pageTitle = "Thông tin cá nhân";
?>
    <h2>Thông tin cá nhân</h2>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>
    <?php if (isset($success)) { ?>
        <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
    <?php } ?>
    <form action="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=doEditProfile" method="POST">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required />
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />
        <label>Số điện thoại:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" />
        <label>Địa chỉ:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" />
        <label>Mật khẩu mới (để trống nếu không đổi):</label>
        <input type="password" name="password" placeholder="Mật khẩu mới" />
        <label>Nhập lại mật khẩu:</label>
        <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" />
        <input type="submit" value="Cập nhật" />
    </form>
    <form action="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=deleteAccount" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản? Hành động này không thể hoàn tác!');">
        <input type="submit" value="Xóa tài khoản" style="background-color: red; color: white;" />
    </form>
    <p><a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=logout">Đăng xuất</a></p>
</body>
</html>