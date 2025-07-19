<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/add/spstyle.css">

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="admin.php?controller=product&action=update&id=<?= htmlspecialchars($product['id']) ?>" enctype="multipart/form-data">
    <h2>Cập nhật sản phẩm</h2>
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
    <label>Tên:</label>
    <input type="text" name="tensp" value="<?= htmlspecialchars($product['tensp'] ?? '') ?>"><br>
    <label>Giá:</label>
    <input type="number" name="giasp" value="<?= htmlspecialchars($product['giasp'] ?? '') ?>" min="0"><br>
    <label>Ảnh:</label>
    <input type="file" name="anh"><br>
    <img class="avatar" src="/BTL_thang_vanh/public/image/anhsp/<?= htmlspecialchars($product['anh'] ?? '') ?>" alt="">
    <label>Mô tả:</label>
    <textarea name="mota"><?= htmlspecialchars($product['mota'] ?? '') ?></textarea><br>
    <label>Loại sản phẩm:</label>
    <select name="category_id" id="category_id">
        <?php foreach ($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat['id']) ?>" <?= ($product['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Cập nhật</button>
</form>