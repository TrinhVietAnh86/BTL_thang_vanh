<?php
ob_start();
?>
<div>
    <div class="form-container">
<form method="post" action="admin.php?controller=category&action=update&id=<?= $category['id'] ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <div class="form-step active">
                <h2>Chỉnh sửa loại sản phẩm</h2>
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" id="name" name="name" value="<?= $category['name']?>">
                </div>
                <button type="submit" id="nextBtn" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include './../views/admin/layout.php'; 
?>