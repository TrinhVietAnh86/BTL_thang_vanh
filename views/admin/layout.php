<!DOCTYPE html>
<html lang="vi">
<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/layout.css">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <h2>Tổng quan</h2>
        <nav>
            <ul>
                <li>
                    <a href="./admin.php?controller=category&action=index">loại Sản phẩm</a>
                    <a href="./admin.php?controller=product&action=index"> Sản phẩm</a>
                    <a href="./admin.php?controller=user&action=index"> Người dùng</a>
                    <a href="/BTL_thang_vanh/public/adminuser.php?controller=acc&action=logout">đang xuất</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="main">
        <?php echo  $content ?? '' ?>
    </div>
</body>

</html>