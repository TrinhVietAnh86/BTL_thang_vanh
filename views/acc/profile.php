<link rel="stylesheet" href="/BTL_thang_vanh/public/css/acc/profile.css">
<body>
    <div class="container">
        <h2>Thông tin cá nhân</h2>
        <?php if (isset($user) && $user): ?>
            <div class="info-group">
                <span class="info-label">Tên đăng nhập:</span>
                <span class="info-value"><?php echo htmlspecialchars($user['username'] ?? 'Chưa cập nhật'); ?></span>
            </div>
            <div class="info-group">
                <span class="info-label">Email:</span>
                <span class="info-value"><?php echo htmlspecialchars($user['email'] ?? 'Chưa cập nhật'); ?></span>
            </div>
            <div class="info-group">
                <span class="info-label">Số điện thoại:</span>
                <span class="info-value"><?php echo htmlspecialchars($user['phone'] ?? 'Chưa cập nhật'); ?></span>
            </div>
            <div class="info-group">
                <span class="info-label">Địa chỉ:</span>
                <span class="info-value"><?php echo htmlspecialchars($user['address'] ?? 'Chưa cập nhật'); ?></span>
            </div>
            <div class="buttons">
                <a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=editProfile" class="btn btn-edit">Sửa thông tin</a>
                <form action="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=logout" method="POST" style="width: 100%;">
                    <input type="submit" value="Đăng xuất" class="btn btn-logout" style="width: 100%;">
                </form>
            </div>
        <?php else: ?>
            <p>Không tìm thấy thông tin người dùng.</p>
        <?php endif; ?>
    </div>
</body>