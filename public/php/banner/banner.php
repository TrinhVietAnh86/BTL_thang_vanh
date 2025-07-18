    <link rel="stylesheet" href="/BTL_thang_vanh/public/css/banner/banner.css">
    <script src="/BTL_thang_vanh/public/js/banner/banner.js" defer></script>
    
    <?php
    $images = [
        '/BTL_thang_vanh/public/image/anh/anh1.jpg',
        '/BTL_thang_vanh/public/image/anh/anh2.jpg',
        '/BTL_thang_vanh/public/image/anh/anh3.jpg',
    ];
    ?>
    <div class="slider-container">
        <div class="slider">
            <?php foreach ($images as $image): ?>
                <div class="slide">
                    <img src="<?php echo $image; ?>" alt="Slide">
                </div>
            <?php endforeach; ?>
        </div>
        <button class="nav-button left">&#10094;</button>
        <button class="nav-button right">&#10095;</button>
    </div>