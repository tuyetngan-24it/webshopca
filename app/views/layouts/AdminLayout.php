<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - MP AQUATRIC</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/admin.css">
</head>

<body>
<!-- <?php print_r($subcontent)?> -->
    <div class="overlay" id="overlay"></div>

    <div class="admin-dashboard">
        <div class="mobile-toggle d-block d-md-none"> <button id="sidebarToggle" class="btn-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <?php $this->render('components/admin/sidebar', $subcontent) ?>

        <div class="main-wrapper" id="main-wrapper">


            <main class="content-area">
                <?php
                $this->render($content, $subcontent);
                $subcontent ?>
            </main>

        </div>
    </div>
    

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleMenu() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        if (menuToggle) {
            menuToggle.addEventListener('click', toggleMenu);
            overlay.addEventListener('click', toggleMenu);
        }

        document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            // Thêm hoặc bỏ class 'active' cho sidebar
            sidebar.classList.toggle('active');
            
            // Nếu ông có làm cái overlay (lớp phủ đen mờ) thì toggle nó luôn ở đây
            // document.querySelector('.overlay').classList.toggle('active');
        });
    }
});

// (Tùy chọn) Click ra ngoài thì đóng menu lại cho chuyên nghiệp
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    
    // Nếu click không nằm trong sidebar và không phải là nút toggle
    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});
    </script>

    
</body>

</html>