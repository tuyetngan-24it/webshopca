<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảnh Báo</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Đổi màu chủ đạo sang Vàng Cam (Amber) cho cảnh báo */
            --primary-color: #f59e0b; 
            --primary-dark: #d97706;
            --bg-dark: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-sub: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            /* Background giữ nguyên nhưng chỉnh lại tone màu gradient nền một chút cho hợp */
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(30,39%,20%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            font-family: "Outfit", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            color: var(--text-main);
        }

        .status-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 50px 40px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 0 0 1px var(--glass-border);
            max-width: 450px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            border-top: 2px solid rgba(245, 158, 11, 0.3); /* Viền trên màu cam nhẹ */
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Icon Animation */
        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: rgba(245, 158, 11, 0.1); /* Màu nền icon cam nhạt */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
        }
        
        .icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            animation: pulse-ring 2s infinite;
        }

        .icon-box {
            font-size: 48px;
            color: var(--primary-color);
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both 0.5s; /* Đổi animation sang lắc nhẹ */
            transform: translate3d(0, 0, 0);
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        /* Hiệu ứng rung lắc để gây chú ý */
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px;
            color: #fff;
        }

        p {
            color: var(--text-sub);
            margin-bottom: 35px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        /* Highlight text quan trọng */
        .highlight {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Button Modern */
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            /* Gradient Cam -> Đỏ cam */
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 16px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
            filter: brightness(1.1);
        }
        
        .btn-back:active { transform: translateY(0); }

        /* Countdown text */
        .redirect-text {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }
        
        .countdown {
            color: var(--primary-color);
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="status-card">
        <div class="icon-wrapper">
            <div class="icon-box">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>
        
        <h1>Không thể xóa danh mục!</h1>
        <p>
            Hệ thống phát hiện danh mục này vẫn còn dữ liệu liên kết.<br>
            Vui lòng <span class="highlight">xóa các sản phẩm</span> thuộc danh mục này trước khi thực hiện xóa.
        </p>
        
        <a href="<?php echo isset($redirectUrl) ? $redirectUrl : (defined('ROOTLINK') ? ROOTLINK : '/') ?>" class="btn-back" id="backBtn">
            <i class="fa-solid fa-arrow-left"></i> 
            <span>Quay lại kiểm tra</span>
        </a>

        <div class="redirect-text">
            Tự động quay lại sau <span class="countdown" id="timer">10</span>s
        </div>
    </div>

    <script>
        // Xử lý đếm ngược (Countdown) & Redirect
        const timerElement = document.getElementById('timer');
        const backBtn = document.getElementById('backBtn');
        let timeLeft = 10; // Tăng thời gian lên 10s để người dùng kịp đọc cảnh báo

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if(timeLeft <= 3) {
                backBtn.style.opacity = '0.7';
                backBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Đang quay lại...`;
            }

            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = backBtn.getAttribute('href');
            }
        }, 1000);
    </script>
</body>
</html>