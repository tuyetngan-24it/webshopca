<style>
    /* Container của user dropdown */
  .user-dropdown {
      position: relative;
      display: inline-block;
      cursor: pointer;
      margin-right: 15px;
  }

  .user-toggle {
      color: #fff; /* Màu chữ header của ông */
      padding: 10px;
      display: flex;
      align-items: center;
      gap: 5px;
  }

  /* Cái hộp Popup ẩn đi */
  .dropdown-content {
      display: none; /* Mặc định ẩn */
      position: absolute;
      right: 0;
      top: 100%; /* Nằm ngay dưới tên user */
      background-color: #fff;
      min-width: 200px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1000;
      border-radius: 8px; /* Bo góc cho mềm mại */
      overflow: hidden;
      animation: fadeIn 0.3s ease; /* Hiệu ứng hiện ra từ từ */
  }

  /* Link bên trong dropdown */
  .dropdown-content a {
      color: #333;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      font-size: 14px;
      transition: 0.2s;
  }

  .dropdown-content .dropdown-header {
      padding: 12px 16px;
      background-color: #f1f1f1;
      color: #555;
      font-size: 13px;
      border-bottom: 1px solid #ddd;
  }

  /* Hover vào link */
  .dropdown-content a:hover {
      background-color: #e9ecef;
      color: #007bff; /* Màu xanh chủ đạo */
  }

  /* Nút đăng xuất màu đỏ cho ngầu */
  .dropdown-content a.logout-btn:hover {
      background-color: #ffebee;
      color: #d32f2f;
  }

  /* Class để JS kích hoạt hiện menu */
  .show {
      display: block;
  }

  /* Hiệu ứng fade in nhẹ */
  @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
  }


  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.navbar {
  width: 100%;
  background: transparent;
  padding: clamp(8px, 1vw, 12px) 0;
  font-family: "Open Sans", sans-serif;
  position: fixed;
  top: 0;
  z-index: 1000;
  transition: background 0.4s ease, box-shadow 0.4s ease;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.navbar.scrolled {
  background: #000000;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

/* Logo */
.navbar-logo {
  display: flex;
  align-items: center;
  margin-left: clamp(20px, 4vw, 50px);
}

.navbar-logo .logo img {
  max-width: 80px;
  height: auto;
  transition: all 0.4s ease;
}
.navbar.scrolled .navbar-logo .logo img {
  max-width: 60px;
}

.navbar-logo .text-container {
  display: flex;
  flex-direction: column;
  margin-left: 10px;
  transition: all 0.4s ease;
}

.text-main {
  color: #ffffff;
  font-size: clamp(16px, 1.8vw, 20px);
  font-weight: 700;
  font-family: "Montserrat", sans-serif;
}

.text-sub {
  color: #cccccc;
  font-size: clamp(10px, 1.2vw, 12px);
}

/* Menu */
.navbar-menu {
  list-style: none;
  display: flex;
  align-items: center;
  gap: clamp(15px, 2.5vw, 30px);
  margin: 0 auto;
  padding: 0;
  flex: 1;
  max-width: clamp(600px, 60%, 1000px);
  justify-content: center;
}

.navbar-menu li a {
  color: #ffffff;
  font-size: clamp(14px, 1.5vw, 12px);
  font-weight: 500;
  text-transform: uppercase;
  padding: clamp(8px, 1vw, 12px) clamp(12px, 1.5vw, 15px);
  border-radius: 8px;
  text-decoration: none;
  display: flex;
  align-items: center;
  transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
  white-space: nowrap;
  position: relative;
}

.navbar-menu li a:hover {
  color: #6da7e5;
  transform: translateY(-2px);
}

.navbar-menu li a::after {
  content: "";
  position: absolute;
  width: 0;
  height: 2px;
  bottom: 6px;
  left: 50%;
  background-color: #104e91;
  transition: width 0.3s ease, left 0.3s ease;
}

.navbar-menu li a:hover::after {
  width: 60%;
  left: 20%;
}

/* Actions */
.navbar-actions {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-right: clamp(20px, 4vw, 50px);
}

.nav-login {
  color: #ffffff;
  font-size: clamp(14px, 1.5vw, 16px);
  font-weight: 500;
  text-transform: uppercase;
  padding: clamp(6px, 1vw, 8px) clamp(15px, 2vw, 20px);
  background-color: #11467e;
  border-radius: 20px;
  text-decoration: none;
  display: flex;
  align-items: center;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.nav-login:hover {
  background-color: #040caf;
  transform: translateY(-2px);
}

.menu-toggle {
  display: none;
  color: #ffffff;
  font-size: 24px;
  cursor: pointer;
}

main {
  position: relative;
  min-height: 100vh; /* Đổi height thành min-height để nó giãn được */
  height: auto; /* Thêm cái này để tự động cao theo nội dung */
  width: 100%;
overflow: visible; /* Đổi hidden thành visible để hiện thanh cuộn */
}

main video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
}

.hero-content {
  position: relative;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #fff;
  background: rgba(0, 0, 0, 0.3);
}

.hero-content h1 {
  font-size: clamp(28px, 5vw, 60px);
  margin-bottom: 20px;
  font-weight: 700;
}

.hero-content p {
  font-size: clamp(16px, 2vw, 22px);
  margin-bottom: 30px;
}

.hero-content a {
  background: #0a6dc2;
  color: #fff;
  text-decoration: none;
  padding: 12px 30px;
  border-radius: 25px;
  font-size: 16px;
  transition: all 0.3s ease;
}

.hero-content a:hover {
  background: #09427c;
  transform: translateY(-3px);
}
/* --- RESPONSIVE CHO TABLET & MOBILE --- */
@media (max-width: 992px) {
  /* 1. Chỉnh thanh Navbar chính */
  .navbar {
    padding: 10px 15px;
    background-color: #000; /* Nền đen để dễ nhìn trên đt */
  }

  /* 2. Menu chính (Ẩn đi và biến thành menu dọc) */
  .navbar-menu {
    position: fixed;
    top: 0;
    right: -100%; /* Giấu menu sang bên phải */
    width: 250px; /* Chiều rộng menu khi mở ra */
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.95); /* Màu nền menu */
    flex-direction: column; /* Xếp dọc các link */
    padding-top: 80px; /* Cách top để không đè nút đóng */
    transition: 0.4s ease; /* Hiệu ứng trượt mượt */
    z-index: 998;
    justify-content: flex-start; /* Xếp từ trên xuống */
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.5);
  }

  /* Class này sẽ được JS thêm vào để hiện menu */
  .navbar-menu.active {
    right: 0; /* Trượt ra hiển thị */
  }

  /* 3. Chỉnh từng mục trong menu */
  .navbar-menu li {
    width: 100%;
    margin: 0;
  }

  .navbar-menu li a {
    display: block;
    width: 100%;
    padding: 15px 25px;
    font-size: 16px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Đường kẻ mờ giữa các mục */
  }

  .navbar-menu li a:hover {
    background-color: #11467e;
    transform: none; /* Tắt hiệu ứng nhảy của desktop */
  }

  /* 4. Xử lý nút 3 gạch (Hamburger) */
  .menu-toggle {
    display: block; /* Hiện nút này lên */
    font-size: 28px;
    color: #fff;
    cursor: pointer;
    z-index: 999; /* Luôn nổi trên cùng */
    margin-left: 15px;
  }

  /* 5. Tinh chỉnh khu vực nút Đăng nhập/User */
  .navbar-actions {
    /* Đảm bảo các nút nằm ngang hàng */
    display: flex;
    align-items: center;
  }

  /* Thu gọn nút đăng nhập trên mobile chỉ hiện icon (nếu muốn) */
  .nav-login {
    padding: 8px 12px;
    font-size: 13px;
  }

  /* Ẩn bớt text logo nếu màn hình quá nhỏ */
  .navbar-logo .text-container .text-sub {
    display: none;
  }
}
  </style>

  <nav class="navbar">
    <div class="navbar-logo">
      <a class="logo" href="#">
        <img src="http://localhost/DACS2/public/assets/img/logo3.png" alt="Logo MPt AQUATRIC" />
      </a>
      <div class="text-container">
        <span class="text-main">MP AQUATRIC</span>
        <span class="text-sub">Tinh hoa trong từng bể cá</span>
      </div>
    </div>

  <ul class="navbar-menu">
      <li>

        <a href="<?php  echo ROOTLINK?>"><i class="fa fa-home"></i>&nbsp;TRANG CHỦ</a>

      </li>
      <li>
        <a href="<?php  echo ROOTLINK?>/categories"><i class="fa-solid fa-layer-group"></i>&nbsp;DANH MỤC SẢN PHẨM</a>
      </li>
    
      <li>
        <a href="<?php  echo ROOTLINK?>/knowledge"><i class="fa-solid fa-book-open"></i>&nbsp;KIẾN THỨC NUÔI CÁ</a>
      </li>
      <li>
        <a href="<?php  echo ROOTLINK?>/about"><i class="fa-solid fa-circle-info"></i>&nbsp;GIỚI THIỆU</a>
      </li>
      
    </ul>

    <div class="navbar-actions">
      <div class="navbar-actions">
        <?php if (!empty($username)): ?>
          <div class="user-dropdown">
            <div class="user-toggle" onclick="toggleUserMenu()">
              <i class="fa fa-user"></i>&nbsp;
<span class="username-text"><?php echo $username ?></span>
              <i class="fa fa-caret-down"></i>
            </div>

          <div id="userMenuPopup" class="dropdown-content">
      <div class="dropdown-header">
          <span>Xin chào, <b><?php echo $username ?></b></span>
      </div>
      
      <a href="profile"><i class="fa fa-id-card"></i> Hồ sơ của tôi</a>
      <a href="<?php echo ROOTLINK ?>/myorder"><i class="fa fa-shopping-bag"></i> Đơn hàng</a>

      <?php 
      // Giả sử biến $role chứa quyền user (0=user, 1=admin) hoặc chuỗi 'admin'
      // Bạn cần thay điều kiện trong ngoặc () cho khớp với logic trong database của bạn
      if (isset($role) && $role == 'admin'): 
      ?>
          <a href="<?php echo ROOTLINK?>/admin/dashboard" style="color: #e67e22; font-weight: 600;">
              <i class="fa fa-user-shield"></i> Trang quản lý
          </a>
      <?php endif; ?>
      <hr> 
      <a href="<?php echo ROOTLINK ?>/logout" class="logout-btn"><i class="fa fa-sign-out-alt"></i> Đăng xuất</a>
  </div>
          </div>
        <?php else: ?>
          <a href="login" class="nav-login"><i class="fa fa-user"></i>&nbsp;Đăng nhập</a>
        <?php endif; ?>

        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
      </div>
    </div>
  </nav>
</body>
  <!-- $this -> render('path) -->
   <script>
  function toggleMenu() {
    // Tìm class .navbar-menu và thêm/bớt class .active
    var menu = document.querySelector('.navbar-menu');
    menu.classList.toggle('active');
  }
</script>
