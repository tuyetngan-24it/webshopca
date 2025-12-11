<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($blog['title']) ? $blog['title'] : 'Chi tiết bài viết'; ?></title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        :root {
            /* Palette Dark Mode */
            --bg-body: #0f1115;
            /* Nền trang rất tối */
            --bg-card: #1c1f26;
            /* Nền bài viết sáng hơn chút */
            --text-main: #e0e0e0;
            /* Chữ chính màu trắng xám */
            --text-muted: #9ca3af;
            /* Chữ phụ màu xám */
            --accent-color: #00e5ff;
            /* Màu điểm nhấn (Cyan neon) */
            --border-color: #2d3748;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);

            padding: 0;
            line-height: 1.8;
        }

        /* Thêm đoạn này vào cuối css */
        html,
        body {
            height: auto !important;
            /* Đảm bảo trang web được cuộn */
            overflow-y: auto !important;
        }

        .main-content {
            height: auto !important;
            /* Cho phép khung nội dung giãn nở */
            overflow: visible !important;
            /* Không được ẩn phần thừa */
            display: block;
            /* Đảm bảo khối hoạt động đúng */
        }

        a {
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            color: var(--accent-color);
        }

        /* --- Layout Container --- */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 15px;
            display: flex;
            gap: 30px;
            margin-top: 70px;
            margin-bottom: 60px;
        }


        /* --- Main Content Column (Left) --- */
        .main-content {
            /* flex: 3;  <-- Xóa hoặc comment dòng này đi */
            width: 100%;
            /* Cho full màn hình */
            background: var(--bg-card);
            padding: 40px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            height: auto;
            /* Quan trọng */
        }

        /* --- Sidebar Column (Right) --- */
        .sidebar {
            flex: 1;
        }

        /* --- Blog Components --- */
        .breadcrumb {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .breadcrumb a {
            color: var(--accent-color);
            font-weight: bold;
        }

        .breadcrumb span {
            color: var(--text-muted);
        }

        .blog-header h1 {
            font-size: 36px;
            color: #fff;
            /* Tiêu đề trắng hoàn toàn */
            margin-bottom: 20px;
            line-height: 1.3;
            font-weight: 700;
        }

        .meta-info {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
        }

        .meta-info span {
            margin-right: 25px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-info i {
            color: var(--accent-color);
        }

        .featured-image-wrapper {
            margin-bottom: 35px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .featured-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .featured-image:hover {
            transform: scale(1.02);
        }

        /* Nội dung bài viết */
        .article-body {
            font-family: 'Merriweather', serif;
            font-size: 18px;
            color: #d1d5db;
            /* Màu chữ dịu mắt */
        }

        .description-box {
            background-color: #161920;
            /* Nền sẫm hơn card */
            border-left: 4px solid var(--accent-color);
            padding: 25px;
            font-style: italic;
            margin-bottom: 35px;
            color: #fff;
            font-size: 1.1em;
            border-radius: 0 8px 8px 0;
        }

        .content-detail p {
            margin-bottom: 25px;
        }

        .content-detail h2,
        .content-detail h3 {
            color: #fff;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .content-detail img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        /* --- Sidebar Widgets --- */
        .widget {
            background: var(--bg-card);
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .widget-title {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--accent-color);
            display: inline-block;
            padding-bottom: 8px;
        }

        .related-posts ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .related-posts li {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .related-posts li:last-child {
            margin-bottom: 0;
        }

        .related-posts img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #333;
        }

        .related-posts a {
            color: var(--text-main);
            font-weight: 500;
            font-size: 15px;
            line-height: 1.4;
        }

        .related-posts a:hover {
            color: var(--accent-color);
        }

        /* Category List Style */
        .cat-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #2d3748;
            color: var(--text-muted);
            transition: 0.3s;
        }

        .cat-item:hover {
            color: var(--accent-color);
            padding-left: 5px;
            /* Hiệu ứng đẩy nhẹ sang phải */
        }

        .cat-item:last-child {
            border-bottom: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .main-content {
                padding: 25px;
            }

            .blog-header h1 {
                font-size: 28px;
            }
        }

        #post-container {
            margin-top: 100px;
        }


        .article-body {
            overflow: hidden;
            /* Clear float nếu có ảnh float bên trong */
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Cột trái: Nội dung chính -->
        <main class="main-content" id="post-container">

            <?php if (!empty($blog)): ?>



                <header class="blog-header">
                    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
                    <div class="meta-info">
                        <span><i class="fa-regular fa-calendar"></i> <?php echo date("d/m/Y", strtotime($blog['created_at'])); ?></span>
                        <span><i class="fa-regular fa-user"></i> Admin</span>

                    </div>
                </header>

                <div class="featured-image-wrapper">
                    <?php
                    // Xử lý đường dẫn ảnh
                   
                    $imgSrc = !empty($blog['image']) ? $blog['image'] : "https://via.placeholder.com/800x400?text=No+Image";
                    ?>
                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="featured-image">
                </div>

                <div class="article-body">
                    <!-- Phần Sapo / Mô tả ngắn -->
                    <?php if (!empty($blog['description'])): ?>
                        <div class="description-box">
                            <i class="fa-solid fa-quote-left" style="color:var(--accent-color); margin-right: 10px;"></i>
                            <?php echo $blog['description']; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Phần nội dung chính -->
                    <div class="content-detail">
                        <?php
                        // Nếu content rỗng thì hiện thông báo (Optional)
                        if (!empty($blog['content'])) {
                            echo $blog['content'];
                        } else {
                            echo "<p style='text-align:center; color:#777;'>Nội dung bài viết đang được cập nhật...</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Nút chia sẻ cuối bài -->
                <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid var(--border-color); text-align: center;">
                    <span style="color: var(--text-muted); margin-right: 15px;">Chia sẻ bài viết:</span>
                    <a href="#" style="color: #3b5998; font-size: 24px; margin: 0 10px;"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" style="color: #00e5ff; font-size: 24px; margin: 0 10px;"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" style="color: #c32aa3; font-size: 24px; margin: 0 10px;"><i class="fa-brands fa-instagram"></i></a>
                </div>

            <?php else: ?>
                <div style="text-align: center; padding: 50px;">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 50px; color: var(--accent-color); margin-bottom: 20px;"></i>
                    <h2>Không tìm thấy bài viết!</h2>
                    <p style="color: var(--text-muted);">Bài viết này có thể đã bị xóa hoặc đường dẫn không tồn tại.</p>
                    <a href="/" style="display: inline-block; margin-top: 20px; padding: 10px 25px; background: var(--accent-color); color: #000; font-weight: bold; border-radius: 5px;">Quay lại trang chủ</a>
                </div>
            <?php endif; ?>

        </main>

    </div>

</body>

</html>