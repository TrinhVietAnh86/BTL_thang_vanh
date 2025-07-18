<?php
$obstart = ob_start();
?>
<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/admin.css">
<h2>Danh sách sản phẩm</h2>
<div>
    <a href="./admin.php?controller=product&action=add" class="ws-btn mb-2">Thêm mới</a>
</div>
<table class="my_table">
    <tr>
        <th>ID</th>
        <th>Hình ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Mô tả</th>
        <th>Loại sản phẩm</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($products as $sp): ?>
        <tr>
            <td><?= $sp['id'] ?></td>
            <td><img class="avatar" src="/BTL_thang_vanh/public/image/anhsp/<?php echo $sp['anh']; ?>" alt=""></td>
            <td><?= $sp['tensp'] ?></td>
            <td><?= $sp['giasp'] ?></td>
            <td><?= $sp['mota'] ?></td>
            <td><?= $sp['category_name'] ?></td>
            <td>
                <a class="ws-btn" href="admin.php?controller=product&action=edit&id=<?= $sp['id'] ?>">Sửa</a>
                <a class="ws-btn" href="admin.php?controller=product&action=delete&id=<?= $sp['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();
include 'layout.php';
?>

