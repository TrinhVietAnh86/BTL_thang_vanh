<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/acc/style.css">
    <title><?php echo htmlspecialchars($pageTitle ?? 'BTL Thắng Vành'); ?></title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/BTL_thang_vanh/public/indexfull.php">Trang chủ</a></li>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li><a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=showProfile">Hồ sơ</a></li>
                    <?php if ($_SESSION['user']['role'] === 'admin') { ?>
                        <li><a href="/BTL_thang_vanh/public/adminuser.php?controller=user&action=list">Quản lý người dùng</a></li>
                        <li><a href="/BTL_thang_vanh/public/admin.php">Quản trị</a></li>
                    <?php } ?>
                    <li><a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=logout">Đăng xuất</a></li>
                <?php } else { ?>
                    <li><a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=login">Đăng nhập</a></li>
                    <li><a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=register">Đăng ký</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>