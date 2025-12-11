<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/homePage.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<main class="hero-section">
    <div class="video-overlay"></div>
    <video src="<?php echo ROOTLINK ?>/public/assets/video/videohome.mp4" autoplay muted loop playsinline></video>

    <div class="hero-content">
        <h1 class="hero-title">MP AQUATRIC</h1>
        <p class="hero-subtitle">Đánh thức đam mê thủy sinh & Kiến tạo không gian sống</p>
        <a href="categories.html" id="btnHeroJS" class="btn-hero">
            Khám phá ngay
        </a>
    </div>
</main>

<section class="home-section bg-gradient-dark">
    <div class="container">
        <div class="flash-sale-wrapper">
            <div class="flash-header">
                <div class="flash-title-box">
                    <i class="fa-solid fa-fire bolt-icon" style="color: #eeb422;"></i>
                    <h2>SẢN PHẨM HOT</h2>
                </div>
            </div>

            <div class="product-grid">
                <?php if (!empty($hotproducts) && $products->num_rows > 0):  ?>
                    <?php foreach ($hotproducts as  $item): ?>
                        <div class="product-card">
                            <div class="card-badge" style="background: #d0021b; color: white;">HOT</div>
                            <div class="product-thumb">
                                <img src="<?php echo $item['img'] ?>" alt="Sản phẩm">
                                <div class="card-actions">
                                    <form action="<?php echo ROOTLINK ?>/cart/add" method="POST" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                                        <?php if ($item['quantity'] > 0): ?>
                                            <button type="submit" class="action-btn">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        <?php endif ?>
                                    </form>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3><a href="#" style="color: #fff;"><?php echo $item['name'] ?></a></h3>
                                <div class="price-box">
                                    <span class="current-price"><?php echo $item['price']
                                                                ?>VNĐ</span>
                                </div>
                                <div class="price-box">
                                    <span class="current-price"><?php $item['price'] ?></span>
                                </div>

                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<section class="home-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Sản phẩm mới về</h2>
            <div class="section-line"></div>
        </div>

        <div class="product-grid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $products): ?>
                    <?php $formattedPrice = number_format($products['price'], 0, ',', '.') . ' VNĐ'; ?>
                    <div class="product-card">
                        <div class="card-badge" style="background: #d0021b; color: white;">HOT</div>
                        <div class="product-thumb">
                            <img src="<?php echo $products['img'] ?>" alt="Sản phẩm">
                            <div class="card-actions">
                                <form action="<?php echo ROOTLINK ?>/cart/add" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $products['id'] ?>">
                                    <button type="submit" class="action-btn">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3><a href="#" style="color: #fff;"><?php echo $products['name'] ?></a></h3>
                            <div class="price-box">
                                <div class="price-box">
                                    <span class="current-price"><?php echo $formattedPrice
                                                                ?></span>
                                </div>
                            </div>


                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <div class="see-more-wrap">
            <a href="http://localhost/dacs2/categories" class="btn-view-all">Xem tất cả sản phẩm</a>
        </div>
    </div>
</section>

<section class="home-section bg-dark-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">KIẾN THỨC NUÔI CÁ</h2>
        </div>
        <div class="blog-grid">
            <?php if (!empty($blogs)): ?>

                <?php foreach ($blogs as $item): ?>
                    <article class="blog-card">
                        <div class="blog-img">
                            <img src="<?php echo !empty($item['image']) ?  $item['image'] : 'https://via.placeholder.com/600' ?>" alt="Blog Image">
                            <div class="blog-date"><?php echo date('d M', strtotime($item['created_at'])) ?></div>
                        </div>
                        <div class="blog-body">
                            <h3><?php echo $item['title'] ?></h3>
                            <p><?php echo $item['description'] ?></p>
                            <a href="blogdetail/<?php echo $item['id'] ?>" class="link-more">Đọc tiếp <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<!-- TEST -->
<script>
    const btn = document.getElementById('btnHeroJS');

    // 1. Ép trong suốt ngay khi tải trang
    // setProperty(tên, giá trị, độ ưu tiên)
    btn.style.setProperty('background-color', 'transparent', 'important');
    btn.style.setProperty('background', 'transparent', 'important');
    btn.style.setProperty('border', '2px solid #fff', 'important');
    btn.style.setProperty('color', '#fff', 'important');
    btn.style.setProperty('box-shadow', 'none', 'important');

    // 2. Xử lý khi di chuột vào (Hover)
    btn.addEventListener('mouseenter', function() {
        btn.style.setProperty('background-color', '#ffffff', 'important'); // Nền trắng
        btn.style.setProperty('color', '#0a6dc2', 'important'); // Chữ xanh
        btn.style.setProperty('border-color', '#ffffff', 'important');
        btn.style.transform = 'translateY(-3px)';
        btn.style.transition = 'all 0.3s ease';
    });

    // 3. Xử lý khi di chuột ra (Bình thường)
    btn.addEventListener('mouseleave', function() {
        btn.style.setProperty('background-color', 'transparent', 'important'); // Trả về trong suốt
        btn.style.setProperty('color', '#fff', 'important'); // Trả về chữ trắng
        btn.style.transform = 'translateY(0)';
    });
</script>