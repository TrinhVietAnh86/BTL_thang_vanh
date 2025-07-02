<?php
include_once '../models/connect/connect.php';
// giả sử bạn đã có biến $products chứa danh sách sản phẩm
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/style.css">
</head>
<body>
    <h2 class="title">Danh sách sản phẩm</h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img class="avatar" src="/BTL_thang_vanh/public/image/anhsp/<?php echo $product['anh']; ?>" alt="">
            <h3><?= $product['tensp'] ?></h3>
            <p class="price"><?= number_format($product['giasp'], 0, ',', '.') ?> đ</p>
            <p class="desc"><?= $product['mota'] ?></p>
            <button class="btn-order" data-id="<?= $product['id'] ?>">Đặt hàng</button>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
