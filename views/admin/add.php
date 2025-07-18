<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/add.css">
<form method="post" action="admin.php?controller=product&action=store" enctype="multipart/form-data">
    <h2>Thêm sản phẩm mới</h2>
    Tên: <input type="text" name="tensp" required><br>
    Giá: <input type="number" name="giasp" required><br>
    Ảnh: <input type="file" name="anh" required><br>
    Mô tả: <textarea name="mota" required></textarea><br>
    Loại sản phẩm:
    <select name="category_id" required>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Lưu</button>
</form>