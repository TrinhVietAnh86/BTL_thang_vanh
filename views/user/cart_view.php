<?php
// Lấy dữ liệu từ controller
$cart = $data['cart'] ?? [];
$total = $data['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng của bạn</title>
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/layout.css">
    <!-- Thêm file CSS riêng nếu cần -->
    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/cart/cart.css" type="text/css">
</head>
<body>
    

    <div class="main">
        <h2>Giỏ hàng của bạn</h2>
        <?php if (empty($cart)): ?>
            <p>Giỏ hàng trống.</p>
        <?php else: ?>
            <table border="1" class="cart-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                            <td><img src="/BTL_thang_vanh/public/image/anhsp/<?php echo htmlspecialchars($item['anh']); ?>" alt="Product Image" class="product-image"></td>
                            <td><?php echo htmlspecialchars($item['tensp']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($item['giasp'], 0, ',', '.')) . " VNĐ"; ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($item['giasp'] * $item['quantity'], 0, ',', '.')) . " VNĐ"; ?></td>
                            <td><?php echo htmlspecialchars($item['mota']); ?></td>
                            <td>
                                <a href="/BTL_thang_vanh/public/admin.php?controller=product&action=removeFromCart&id=<?php echo $item['product_id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ?');" class="remove-btn">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Tổng cộng: <?php echo htmlspecialchars(number_format($total, 0, ',', '.')) . " VNĐ"; ?></strong></p>
        <?php endif; ?>
        <p><a href="/BTL_thang_vanh/public/indexfull.php" class="back-btn">Quay lại danh sách</a></p>
        <p><a href="/BTL_thang_vanh/public/admin.php?controller=product&action=checkout" class="checkout-btn">Thanh toán</a></p>
    </div>
</body>
</html>