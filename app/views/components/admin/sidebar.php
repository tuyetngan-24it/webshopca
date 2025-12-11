<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <img src="<?php echo ROOTLINK ?>/public/assets/img/logo3.png" alt="Logo MPt AQUATRIC">
        <div class="text-container">
            <span class="text-main">MP AQUATRIC</span>
            <span class="text-sub">Admin Panel</span>
        </div>
    </div>
    
    <ul class="sidebar-nav">
        <li>
            <a href="<?php echo ROOTLINK ?>/admin/dashboard" class="<?= ($page == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li>
            <a href="<?php echo ROOTLINK ?>/admin/categories" class="<?= ($page == 'categories') ? 'active' : '' ?>">
                <i class="fa-solid fa-layer-group"></i>
                <span>Danh mục</span>
            </a>
        </li>
        <li>
            <a href="<?php echo ROOTLINK ?>/admin/products" class="<?= ($page == 'products') ? 'active' : '' ?>">
                <i class="fa-solid fa-fish-fins"></i>
                <span>Sản phẩm</span>
            </a>
        </li>
        <li>
            <a href="<?php echo ROOTLINK ?>/admin/orders" class="<?= ($page == 'orders') ? 'active' : '' ?>">
                <i class="fa-solid fa-box-archive"></i>
                <span>Đơn hàng</span>
            </a>
        </li>
        <li>
            <a href="<?php echo ROOTLINK ?>/admin/customers" class="<?= ($page == 'customers') ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                <span>Khách hàng</span>
            </a>
        </li>
          <li>
            <a href="<?php echo ROOTLINK ?>/admin/blogs" class="<?= ($page == 'blogs') ? 'active' : '' ?>">
                <i class="fa-solid fa-archive"></i>
                <span>Kiến thức nuôi cá</span>
            </a>
        </li>
    </ul>
    
    <div class="sidebar-footer">
        <a href="<?php echo ROOTLINK ?>/logout"> 
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Đăng xuất</span>
        </a>
    </div>
</aside>