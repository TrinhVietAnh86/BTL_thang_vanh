<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/font/detail.css">
    
</head>
<body>
    <?php if (isset($product)): ?>
        <h2><?php echo htmlspecialchars($product['tensp']); ?></h2>
        <img src="/BTL_thang_vanh/public/image/anhsp/<?php echo $product['anh']; ?>" alt="" style="max-width:300px;">
        <p>Giá: <?php echo number_format($product['giasp'], 0, ',', '.'); ?> đ</p>
        <p>Mô tả: <?php echo htmlspecialchars($product['mota']); ?></p>
        <a href="/BTL_thang_vanh/public/admin.php?controller=product&action=addToCart&id=<?php echo $product['id']; ?>" class="account-button">Thêm vào giỏ</a>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm.</p>
    <?php endif; ?>
</body>
</html>