<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đã cập nhật</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --info-color: #3b82f6; /* Blue 500 */
            --info-glow: #60a5fa;
            --bg-dark: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-sub: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            /* Gradient nền xanh dương sâu thẳm */
            background-image: 
                radial-gradient(at 100% 0%, hsla(217, 91%, 25%, 1) 0, transparent 50%), 
                radial-gradient(at 0% 50%, hsla(199, 89%, 20%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 100%, hsla(243, 75%, 15%, 1) 0, transparent 50%);
            font-family: "Outfit", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            color: var(--text-main);
        }

        /* Thẻ kính */
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
            max-width: 420px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            border-bottom: 2px solid rgba(59, 130, 246, 0.3); /* Line xanh dưới đáy */
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Icon Wrapper */
        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: rgba(59, 130, 246, 0.1);
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
            border: 2px solid var(--info-color);
            border-top-color: transparent; /* Tạo hiệu ứng vòng xoay hở */
            animation: spin-slow 3s linear infinite;
        }

        .icon-box {
            font-size: 42px;
            color: var(--info-color);
            /* Animation viết/lắc lư */
            animation: writing-motion 2s ease-in-out infinite; 
            transform-origin: center center;
        }

        @keyframes spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes writing-motion {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(-10deg) scale(1.1); }
            75% { transform: rotate(10deg) scale(1.1); }
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px;
            background: linear-gradient(to right, #fff, #93c5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: var(--text-sub);
            margin-bottom: 35px;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Button Modern - Blue Theme */
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--info-color), #2563eb);
            color: white;
            padding: 16px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            filter: brightness(1.1);
        }

        .redirect-text {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }
        
        .countdown {
            color: var(--info-color);
            font-weight: 700;
        }

        #confetti-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 5;
        }
    </style>
</head>
<body>

    <canvas id="confetti-canvas"></canvas>

    <div class="status-card">
        <div class="icon-wrapper">
            <div class="icon-box">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
        </div>
        
        <h1>Cập Nhật Thành Công!</h1>
        <p>Thông tin mới đã được lưu và áp dụng ngay lập tức.<br>Hệ thống đã ghi nhận thay đổi.</p>
        
        <a href="<?php echo isset($redirectUrl) ? $redirectUrl : (defined('ROOTLINK') ? ROOTLINK : '/') ?>" class="btn-back" id="backBtn">
            <i class="fa-solid fa-arrow-left"></i> 
            <span>Quay lại danh sách</span>
        </a>

        <div class="redirect-text">
            Tự động chuyển trang sau <span class="countdown" id="timer">5</span>s
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        // 1. Hiệu ứng "Stars Refresh" (Ngôi sao lấp lánh)
        document.addEventListener('DOMContentLoaded', () => {
            const defaults = {
                spread: 360,
                ticks: 50,
                gravity: 0,
                decay: 0.94,
                startVelocity: 30,
                shapes: ['star'], // Chỉ dùng hình ngôi sao
                colors: ['#3b82f6', '#60a5fa', '#FFE578', '#ffffff'] // Xanh dương và Vàng nhạt
            };

            function shoot() {
                confetti({
                    ...defaults,
                    particleCount: 40,
                    scalar: 1.2,
                    shapes: ['star']
                });
                
                confetti({
                    ...defaults,
                    particleCount: 10,
                    scalar: 0.75,
                    shapes: ['circle']
                });
            }

            // Bắn 3 đợt nhỏ, tượng trưng cho việc "làm mới" (refresh/shine)
            setTimeout(shoot, 0);
            setTimeout(shoot, 200);
            setTimeout(shoot, 400);
        });

        // 2. Countdown & Redirect Logic
        const timerElement = document.getElementById('timer');
        const backBtn = document.getElementById('backBtn');
        let timeLeft = 5;

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if(timeLeft <= 2) {
                backBtn.style.opacity = '0.8';
                backBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Đang tải lại...`;
            }

            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = backBtn.getAttribute('href');
            }
        }, 1000);
    </script>
</body>
</html>