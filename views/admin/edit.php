<h2>Cập nhật sản phẩm</h2>
<form method="post" action="index.php?action=update">
    <input type="hidden" name="id" value="<?= $sp['id'] ?>">
    Tên: <input type="text" name="name" value="<?= $sp['name'] ?>"><br>
    Giá: <input type="number" name="price" value="<?= $sp['price'] ?>"><br>
    <button type="submit">Cập nhật</button>
</form>
