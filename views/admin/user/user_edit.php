<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/add/userstyle.css">

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="admin.php?controller=user&action=update&id=<?= htmlspecialchars($user['id']) ?>">
    <h2>Cập nhật người dùng</h2>
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
    <label>Tên đăng nhập:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
    <label>Số điện thoại:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"><br>
    <label>Địa chỉ:</label>
    <input type="text" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>"><br>
    <label>Mật khẩu mới:</label>
    <input type="password" name="password" placeholder="Để trống nếu không đổi"><br>
    <label>Nhập lại mật khẩu:</label>
    <input type="password" name="repassword" placeholder="Nhập lại mật khẩu mới"><br>
    <label>Vai trò:</label>
    <select name="role" required>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
    </select><br>
    <button type="submit">Cập nhật</button>
</form>