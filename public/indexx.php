<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu/menu.css">
    <link rel="stylesheet" href="css/banner/banner.css">
    <link rel="stylesheet" href="../public/css/font/home.css">
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/style.css">
    <link rel="stylesheet" href="css/footer/footer.css">
</head>

<body>
    <div id="khung">
        <div><?php include '../models/connect/connect.php' ?></div>
        <div><?php include 'php/menu/menu.php' ?></div>
        <div><?php include 'php/banner/banner.php' ?></div>
        <div><?php include './indexxx.php' ?></div>
        <div><?php include '../views/layout/footter.php' ?></div>

    </div>
    <?php
    require_once '../controllers/admin/homeController.php';
    ?>
</body>
</html>