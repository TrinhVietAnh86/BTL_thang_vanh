<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm tìm kiếm</title>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/font/search.css">
</head>
<body>

<div class="product-container">
    <h2>Sản phẩm tìm kiếm</h2>

    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img class="avatar" src="/BTL_thang_vanh/public/image/anhsp/<?php echo $product['anh']; ?>" alt="">
                <h3><?= htmlspecialchars($product['tensp']) ?></h3>
                <p class="price"><?= number_format($product['giasp'], 0, ',', '.') ?> đ</p>
                <p class="desc"><?= htmlspecialchars($product['mota']) ?></p>
                <a href="/BTL_thang_vanh/public/admin.php?controller=product&action=addToCart&id=<?= $product['id'] ?>" class="account-button">Thêm vào giỏ</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-product">Không tìm thấy sản phẩm nào phù hợp.</p>
    <?php endif; ?>
</div>

</body>
</html>
