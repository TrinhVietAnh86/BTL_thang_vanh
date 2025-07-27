

      <link rel="stylesheet" href="/BTL_thang_vanh/public/css/menu/menu.css" />
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/font/detail.css">

<body>
    <div>
    <?php
        include '../public/php/menu/menudangnhap.php';
    ?>
    </div>
    <div class="container">  
    <?php if (isset($product)): ?>
        <div class="anhsp"><img src="/BTL_thang_vanh/public/image/anhsp/<?php echo $product['anh']; ?>" alt=""></div>
        <div class="tt">
        <h2><?php echo htmlspecialchars($product['tensp']); ?></h2>
        <p>Giá: <?php echo number_format($product['giasp'], 0, ',', '.'); ?> đ</p>
        <p>Mô tả: <?php echo htmlspecialchars($product['mota']); ?></p>
        <a href="/BTL_thang_vanh/public/admin.php?controller=product&action=addToCart&id=<?php echo $product['id']; ?>" class="account-button">Thêm vào giỏ</a>
        </div>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm.</p>
    <?php endif; ?>
    </div>
</body>
