<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../../css/menu/menu.css" />

  <nav class="menu-nav">
    <div class="menu-left">
      <img src="/BTL_thang_vanh/public/image/logo/logo.png" alt="Logo" class="logo-img">
      <div class="tenhang"><p>RAU CỦ STORE</p></div>
    </div>
    <div class="menu-links">
      <a href="/BTL_thang_vanh/public/indexx.php">Trang chủ</a>
      <a href="./indexxx.php">Sản phẩm</a>
      <a href="#">Thông tin</a>
    </div>
    <div class="menu-right">
       <form class="search-box" method="GET" action="./indexx.php">
          <input type="hidden" name="controller" value="home">
          <input type="hidden" name="action" value="search">
          <input type="text" name="keyword" placeholder="Tìm kiếm..." />
          <button class="search-button" type="submit">🔍</button>
        </form>
      <a href="./adminuser.php?controller=acc&action=login" class="account-button">Tài khoản</a>
    </div>
    
  </nav>

