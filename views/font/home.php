

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/font/home.css">
</head>
<body>
    <h2 class="title">Danh sách sản phẩm</h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
        <div class="product-card">
            <a href="/BTL_thang_vanh/public/detail.php?controller=home&action=detail&id=<?= $product['id'] ?>"><img class="avatar" src="/BTL_thang_vanh/public/image/anhsp/<?php echo $product['anh']; ?>" alt=""></a>
            <h3><?= $product['tensp'] ?></h3>
            <p class="price"><?= number_format($product['giasp'], 0, ',', '.') ?> đ/kg</p>
            <p class="desc"><?= $product['mota'] ?></p>
            <a href="/BTL_thang_vanh/public/admin.php?controller=product&action=addToCart&id=<?= $product['id'] ?>" class="account-button">thêm vào giỏ</a>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
