<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/edit.css">
<form method="post" action="admin.php?controller=product&action=update&id=<?= $product['id'] ?>" enctype="multipart/form-data">
    <h2>Cập nhật sản phẩm</h2>
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    Tên: <input type="text" name="tensp" value="<?= $product['tensp'] ?>"><br>
    Giá: <input type="number" name="giasp" value="<?= $product['giasp'] ?>"><br>
    Ảnh: <input type="file" name="anh"><br>
    <img class="avatar" src="/BTL_thang_vanh/public/image/anhsp/<?= $product['anh'] ?>" alt="">
    Mô tả: <textarea name="mota"><?= $product['mota'] ?></textarea><br>
    loại sản phẩm: 
        <select name="category_id" id="category_id">
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= $cat['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    <button type="submit">Cập nhật</button>
</form>


