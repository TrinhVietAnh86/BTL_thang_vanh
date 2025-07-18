<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/edit.css">
<form method="post" action="admin.php?controller=user&action=update&id=<?= $user['id'] ?>">
    <h2>Cập nhật người dùng</h2>
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    Tên đăng nhập: <input type="text" name="username" value="<?= $user['username'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
    Mật khẩu mới: <input type="password" name="password" placeholder="Để trống nếu không đổi"><br>
    Nhập lại mật khẩu: <input type="password" name="repassword" placeholder="Nhập lại mật khẩu mới"><br>
    Vai trò:
    <select name="role" required>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
    </select><br>
    <button type="submit">Cập nhật</button>
</form>


