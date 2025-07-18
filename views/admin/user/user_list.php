<?php
$obstart = ob_start();
?>
<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/admin.css">
<h2>Danh sách người dùng </h2>
<div>
    <a href="./admin.php?controller=user&action=add" class="ws-btn mb-2">Thêm mới</a>
</div>
<table class="my_table">
    <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>mật khẩu</th>
            <th>role</th>
            <th>hành động</th>
        </tr>
      <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
            <td>
                <a class="ws-btn" href="admin.php?controller=user&action=edit&id=<?= $user['id'] ?>">Sửa</a>
                <a class="ws-btn" href="admin.php?controller=user&action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
            </td>
            </tr>
           
        </tr>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();
include './../views/admin/layout.php';
?>

