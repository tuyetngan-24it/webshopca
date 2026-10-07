<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- <link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/homePage.css"> -->
<link rel="stylesheet" href="/DACS2/public/assets/css/aboutPage.css">
<style>
    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }

        .banner-slider {
            height: 400px;
        }

        .flash-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-top {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
</style>

<div class="about-wrapper">

    <section class="about-hero parallax">
        <div class="overlay"></div>
        <div class="container hero-content" data-aos="fade-up">
            <span class="badge-text">SINCE 2023</span>
            <h1 class="glitch-text" data-text="MP AQUATRIC">MP AQUATRIC</h1>
            <p class="slogan">Kiến tạo hệ sinh thái - Đánh thức đam mê</p>
            <div class="scroll-down">
                <span>Kéo xuống để khám phá</span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <section class="section-story">
        <div class="container">
            <div class="story-grid">
                <div class="story-text" data-aos="fade-right">
                    <h2 class="section-heading">Hành Trình <span class="highlight">Đam Mê</span></h2>
                    <p>
                        MP Aquatric không bắt đầu từ một kế hoạch kinh doanh, mà từ những bể cá nhỏ trong phòng trọ sinh viên. Nơi đó, <strong>Mạnh</strong> và <strong>Phúc</strong> đã dành hàng ngàn giờ để nghiên cứu về bố cục đá, lũa và hệ vi sinh.
                    </p>
                    <p>
                        Chúng tôi nhận ra rằng, thú chơi thủy sinh tại Việt Nam đang thiếu đi sự chuyên nghiệp và tận tâm. Với khát khao thay đổi điều đó, MP Aquatric ra đời với sứ mệnh: <strong>"Đưa chuẩn mực thủy sinh quốc tế về Việt Nam"</strong>.
                    </p>

                    <div class="stats-box">
                        <div class="stat">
                            <span class="counter" data-target="500">0</span><span>+</span>
                            <p>Dự án Setup</p>
                        </div>
                        <div class="stat">
                            <span class="counter" data-target="1200">0</span><span>+</span>
                            <p>Khách hàng thân thiết</p>
                        </div>
                        <div class="stat">
                            <span class="counter" data-target="100">0</span><span>%</span>
                            <p>Đam mê</p>
                        </div>
                    </div>
                </div>

                <div class="story-images" data-aos="fade-left">
                    <div class="img-box main-img">
                        <img src="/DACS2/public/assets/uploads/about2.png" alt="Aquarium Setup">
                    </div>
                    <div class="img-box sub-img">
                        <img src="/DACS2/public/assets/uploads/about1.png" alt="Detail">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-values">
        <div class="container">
            <h2 class="section-heading text-center">Giá Trị <span class="highlight">Cốt Lõi</span></h2>
            <div class="values-grid">
                <div class="value-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-circle"><i class="fa-solid fa-gem"></i></div>
                    <h3>Tinh Hoa</h3>
                    <p>Mỗi sản phẩm là một tác phẩm nghệ thuật được chọn lọc kỹ lưỡng, đảm bảo tính thẩm mỹ cao nhất.</p>
                </div>
                <div class="value-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-circle"><i class="fa-solid fa-leaf"></i></div>
                    <h3>Bền Vững</h3>
                    <p>Chúng tôi ưu tiên các giải pháp sinh học tự nhiên, an toàn cho cá và thân thiện với môi trường.</p>
                </div>
                <div class="value-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-circle"><i class="fa-solid fa-users"></i></div>
                    <h3>Cộng Đồng</h3>
                    <p>Không chỉ bán hàng, chúng tôi xây dựng cộng đồng chia sẻ kiến thức và đam mê thủy sinh.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-team">
        <div class="container">
            <h2 class="section-heading text-center">Nhà Sáng Lập</h2>
            <div class="team-grid">

                <div class="team-card" data-aos="flip-left">
                    <div class="card-inner">
                        <div class="card-front">
                            <img src="http://localhost/uploads/thanhvien.jpg" alt="TV1">
                            <div class="info">
                                <h3>Thành viên 1</h3>
                                <span>Founder & Art Director</span>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Thành viên 1</h3>
                            <p class="quote">"Một bể cá đẹp là bể cá có hồn. Tôi thổi hồn vào đá và lũa để kể câu chuyện của riêng bạn."</p>
                            <div class="socials">
                                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="team-card" data-aos="flip-right">
                    <div class="card-inner">
                        <div class="card-front">
                            <img src="http://localhost/uploads/thanhvien.jpg~" alt="TV2">
                            <div class="info">
                                <h3>Thành viên 2</h3>
                                <span>Co-Founder & Tech Lead</span>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Thành viên 2</h3>
                            <p class="quote">"Kỹ thuật là nền tảng của nghệ thuật. Tôi đảm bảo hệ sinh thái của bạn luôn vận hành ổn định nhất."</p>
                            <div class="socials">
                                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section-cta">
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="cta-box">
                <h2 class="cta-title" style="font-size: 30px;">Sẵn sàng kiến tạo <span class="text-gradient">Không Gian Xanh?</span></h2>
                <p class="cta-desc">Đừng để đam mê chỉ là ý tưởng. Hãy để MP Aquatric biến nó thành hiện thực ngay trong ngôi nhà của bạn.</p>

                <a href="http://localhost/dacs2/contact" class="btn-cta-shine">
                    <span>Liên hệ tư vấn ngay</span>

                </a>
            </div>
        </div>
    </section>
</div>

<script>
    // 1. Hiệu ứng số chạy (Counter Up)
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    // 2. Intersection Observer để kích hoạt Animation khi cuộn tới
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                if (entry.target.classList.contains('stats-box')) {
                    animateCounters(); // Chạy số khi cuộn tới stats
                }
            }
        });
    });

    document.querySelectorAll('[data-aos], .stats-box').forEach(el => {
        observer.observe(el);
    });
</script>