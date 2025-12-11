<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/categoriesPage.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/HomePage.css">

<style>
    /* Class chung cho skeleton */
    .skeleton-box {
        background: #e1e1e1;
        position: relative;
        overflow: hidden;
        border-radius: 4px;
    }

    /* Hiệu ứng vệt sáng chạy qua (Shimmer Effect) */
    .skeleton-box::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: translateX(-100%);
        background-image: linear-gradient(90deg,
                rgba(255, 255, 255, 0) 0,
                rgba(255, 255, 255, 0.2) 20%,
                rgba(255, 255, 255, 0.5) 60%,
                rgba(255, 255, 255, 0));
        animation: shimmer 2s infinite;
        content: '';
    }

    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }

    /* Định dạng riêng cho Card Skeleton để khớp với Product Card của bạn */
    .product-card.skeleton .product-thumb {
        background-color: #ddd;
        /* Màu nền xám */
        height: 200px;
        /* Chiều cao cố định ảnh giả */
    }

    .product-card.skeleton h3 {
        height: 20px;
        margin: 10px 0;
        width: 80%;
    }

    .product-card.skeleton .price-box {
        height: 15px;
        width: 40%;
        margin-bottom: 10px;
    }

    .product-card.skeleton .sold-bar {
        height: 10px;
        width: 100%;
    }
</style>    

<div class="section-shop" style="padding-top: 130px !important; min-height: 100vh;">
    <div class="container shop-container">

        <aside class="shop-sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title"><i class="fa-solid fa-list"></i> Danh mục</h3>
                <ul class="cat-list">
                    <li><a href="#" class="category-link active" data-id="all">Tất cả sản phẩm</a></li>

                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $item): ?>
                            <li>
                                <a href="#" class="category-link" data-id="<?php echo $item['id'] ?>">
                                    <?php echo $item['name'] ?> <span class="count"></span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>

          
        </aside>

        <main class="shop-content">
            <div class="search-container">
                <form action="" method="GET" class="search-form">
                    <div class="input-wrapper">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" name="keyword" placeholder="Tìm kiếm cá, cây, phụ kiện..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-search">Tìm kiếm</button>
                </form>
            </div>
            <div class="shop-toolbar">
                <div class="result-count"></div>
            </div>
            <div class="product-grid">

            </div>

            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
            </div>

        </main>
    </div>
</div>

<script src="<?php echo ROOTLINK ?> /public/assets/js/Jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="<?php echo ROOTLINK ?> /public/assets/js/categories.js"></script>
<script src="<?php echo ROOTLINK ?> /public/assets/js/pagetination.js"></script>