<?php
ob_start();
?>
<link rel="stylesheet" href="/BTL_thang_vanh/public/css/admin/add/category.css">
<div>
    <div class="form-container">
        <form id="multiStepDonationForm"
            action="./admin.php?controller=category&action=store"
            method="POST">
            <!-- Step 1: Personal Information -->
            <div class="form-step active">
                <h2>Thêm mới loại sản phẩm</h2>

                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" id="name" name="name">
                </div>

                <button type="submit" id="nextBtn" class="btn btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
</div>

<?php
    $content = ob_get_clean();
    include './../views/admin/layout.php';
    
?>