<link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/HomePage.css">
<link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/blogPage.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="blog-page-wrapper">
    <div class="container">
        
        <div class="slider-container-outer">
            <section id="hero-slider">
                <div class="slider-wrapper">
                    <div class="slide-item active">
                        <div class="container">
                            <div class="slide-grid">
                                <div class="slide-text">
                                    <span class="slide-subtitle">KỸ THUẬT CƠ BẢN</span>
                                    <h1>Quy Trình <br><span>Cycle Bể</span></h1>
                                    <p>Hướng dẫn tạo hệ vi sinh ổn định trước khi thả cá.</p>
                                </div>
                                <div class="slide-image">
                                    <img src="http://localhost/uploads/cycle_bể.png" alt="Cycle bể cá" onerror="this.src='https://via.placeholder.com/600';">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="container">
                            <div class="slide-grid">
                                <div class="slide-text">
                                    <span class="slide-subtitle">XỬ LÝ SỰ CỐ</span>
                                    <h1>Diệt Rêu <br><span>Tảo Hại</span></h1>
                                    <p>Cách nhận biết và xử lý triệt để rêu tóc, tảo nâu.</p>
                                </div>
                                <div class="slide-image">
                                    <img src="http://localhost/uploads/reuhong.jpg" alt="Trị rêu hại" onerror="this.src='https://via.placeholder.com/600';">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="container">
                            <div class="slide-grid">
                                <div class="slide-text">
                                    <span class="slide-subtitle">PHONG CÁCH</span>
                                    <h1>Bố Cục <br><span>Iwagumi</span></h1>
                                    <p>Nghệ thuật sắp đặt đá đỉnh cao của Nhật Bản.</p>
                                </div>
                                <div class="slide-image">
                                    <img src="http://localhost/uploads/bocuciwagumi.jpg" alt="Phong cách Iwagumi" onerror="this.src='https://via.placeholder.com/600';">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slider-dots">
                    <span class="dot active" onclick="currentSlide(0)"></span>
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                </div>
            </section>
            <button class="slider-control prev" onclick="moveSlide(-1)"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="slider-control next" onclick="moveSlide(1)"><i class="fa-solid fa-chevron-right"></i></button>
        </div>

        <div class="blog-layout">
            
            <main class="blog-content-area">
                <div class="blog-list" id="blogContainer">
                    <?php 
                        $listBlogs = isset($initial_blogs) ? $initial_blogs : []; 
                    ?>
                    
                    <?php if (!empty($listBlogs)): ?>
                        <?php foreach ($listBlogs as $blog): ?>
                        
                        <?php 
                            // --- XỬ LÝ ĐƯỜNG DẪN ẢNH PHP ---
                            $imgSrc = $blog['image'];
                            $baseUploadUrl = 'http://localhost/uploads/';
                            
                            // Nếu không có ảnh -> dùng ảnh mẫu
                            if (empty($imgSrc)) {
                                $imgSrc = 'https://via.placeholder.com/600';
                            } 
                            // Nếu ảnh chưa có http (tức là chỉ có tên file) -> nối thêm localhost/uploads/
                            elseif (strpos($imgSrc, 'http') === false) {
                                $imgSrc = $baseUploadUrl . $imgSrc;
                            }
                        ?>

                        <article class="blog-card" data-cat-id="<?php echo $blog['category_id']; ?>">
                            <div class="blog-img">
                                <img src="<?php echo $imgSrc; ?>" onerror="this.src='https://via.placeholder.com/600';">
                                <span class="blog-date"><?php echo date('d/m', strtotime($blog['created_at'])); ?></span>
                            </div>
                            <div class="blog-content">
                                <div class="blog-category"><?php echo $blog['cat_name'] ?? 'Kiến thức'; ?></div>
                                <a href="blogdetail/<?php echo $blog['id']?>" class="blog-title-link"><?php echo $blog['title']; ?></a>
                                <p class="blog-desc"><?php echo mb_strimwidth($blog['description'], 0, 100, "..."); ?></p>
                                <a href="blogdetail/<?php echo $blog['id']?>" class="btn-read-more">Đọc tiếp <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align:center; color:#fff;">Chưa có bài viết nào.</p>
                    <?php endif; ?>
                </div>
                
                <div id="loading" style="display:none; text-align:center; color:#fff; padding:20px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size: 30px;"></i>
                </div>
                
                <div id="noResult" style="display: none; text-align: center; padding: 40px; color: #bbb;">
                    <i class="fa-solid fa-filter-circle-xmark" style="font-size: 40px; margin-bottom: 15px; display: block;"></i>
                    <p>Không có bài viết nào thuộc mục này.</p>
                </div>
            </main>

            <aside class="blog-sidebar">
            
                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fa-solid fa-list"></i> Chuyên mục</h3>
                    <ul class="cat-list">
                        <li>
                            <a href="javascript:void(0)" class="cat-filter active" onclick="filterByCategory('all', this)">Tất cả</a>
                        </li>
                        <?php 
                            $listCats = isset($categories) ? $categories : [];
                        ?>
                        <?php if (!empty($listCats)): ?>
                            <?php foreach ($listCats as $cat): ?>
                            <li>
                                <a href="javascript:void(0)" class="cat-filter" onclick="filterByCategory(<?php echo $cat['id']; ?>, this)">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</div>

<script>
    // CẤU HÌNH ĐƯỜNG DẪN ẢNH GỐC
    const BASE_UPLOAD_URL = 'http://localhost/uploads/'; 

    // 1. FILTER CATEGORY (Client-side)
    function filterByCategory(catId, element) {
        // Active class UI
        document.querySelectorAll('.cat-filter').forEach(el => el.classList.remove('active'));
        if(element) element.classList.add('active');
        
        // Logic ẩn hiện bài viết
        const cards = document.querySelectorAll('.blog-card');
        let countVisible = 0;
        
        cards.forEach(card => {
            const cardCatId = card.getAttribute('data-cat-id');
            if (catId === 'all' || cardCatId == catId) {
                card.style.display = 'flex'; 
                countVisible++;
            } else { 
                card.style.display = 'none'; 
            }
        });

        // Hiển thị thông báo nếu không có bài nào
        const noResultDiv = document.getElementById('noResult');
        if (countVisible > 0) { 
            noResultDiv.style.display = 'none'; 
        } else { 
            noResultDiv.style.display = 'block'; 
        }
    }

    // 2. SEARCH (Server-side AJAX)
    let searchTimeout = null;
    
    function handleSearch() { 
        clearTimeout(searchTimeout); 
        // Debounce 300ms để tránh gọi API liên tục khi gõ
        searchTimeout = setTimeout(() => { fetchBlogs(); }, 300); 
    }

    function fetchBlogs() {
        const keyword = document.getElementById('searchInput').value;
        const container = document.getElementById('blogContainer');
        const loading = document.getElementById('loading');

        // Reset bộ lọc Category về All khi tìm kiếm
        document.querySelectorAll('.cat-filter').forEach(el => el.classList.remove('active'));
        if(document.querySelector('.cat-filter:first-child')) {
            document.querySelector('.cat-filter:first-child').classList.add('active');
        }
        document.getElementById('noResult').style.display = 'none';

        if(keyword.length === 0) {
            // Nếu xóa trắng ô tìm kiếm -> Có thể reload trang hoặc giữ nguyên
            // Ở đây mình return để không làm gì, hoặc bạn có thể gọi lại list mặc định
             return; 
        }

        loading.style.display = 'block'; 
        container.style.opacity = '0.5';
    }

        //
    // 3. SLIDER LOGIC
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slide-item");
    const dots = document.querySelectorAll(".dot");
    let slideInterval;

    function showSlides(n) {
        if (!slides.length) return;
        if (n >= slides.length) slideIndex = 0;
        if (n < 0) slideIndex = slides.length - 1;
        
        slides.forEach(slide => slide.classList.remove("active"));
        dots.forEach(dot => dot.classList.remove("active"));
        
        slides[slideIndex].classList.add("active");
        if(dots[slideIndex]) dots[slideIndex].classList.add("active");
    }

    function moveSlide(n) { slideIndex += n; showSlides(slideIndex); resetTimer(); }
    function currentSlide(n) { slideIndex = n; showSlides(slideIndex); resetTimer(); }
    
    function startTimer() { 
        slideInterval = setInterval(() => { 
            slideIndex++; showSlides(slideIndex); 
        }, 5000); 
    }
    function resetTimer() { clearInterval(slideInterval); startTimer(); }
    
    // Init Slider
    if(slides.length > 0) {
        showSlides(slideIndex); 
        startTimer();
    }
</script>   