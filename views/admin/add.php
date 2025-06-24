<h2>Thêm sản phẩm mới</h2>
<form method="post" action="admin.php?controller=product&action=store" enctype="multipart/form-data">
    Tên: <input type="text" name="tensp" required><br>
    Giá: <input type="number" name="giasp" required><br>
    Ảnh: <input type="file" name="anh" required><br>
    Mô tả: <textarea name="mota" required></textarea><br>
    <button type="submit">Lưu</button>
</form>
