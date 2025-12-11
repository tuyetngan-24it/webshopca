<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đã có lỗi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --warn-color: #f59e0b; /* Amber 500 */
            --warn-dark: #d97706;
            --bg-dark: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-sub: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            /* Gradient nền tối pha màu cam cháy */
            background-image: 
                radial-gradient(at 50% 100%, hsla(30, 80%, 15%, 1) 0, transparent 50%), 
                radial-gradient(at 0% 0%, hsla(220, 30%, 20%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(220, 30%, 20%, 1) 0, transparent 50%);
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
            opacity: 0;
            /* Animation kết hợp: Hiện lên + Rung lắc */
            animation: appearShake 0.6s cubic-bezier(0.36, 0.07, 0.19, 0.97) forwards;
            border-top: 3px solid var(--warn-color);
        }

        @keyframes appearShake {
            0% { opacity: 0; transform: translateY(20px); }
            40% { opacity: 1; transform: translateY(0); }
            50% { transform: translateX(-10px); }
            60% { transform: translateX(10px); }
            70% { transform: translateX(-5px); }
            80% { transform: translateX(5px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* Icon Wrapper */
        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: rgba(245, 158, 11, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
        }
        
        /* Hiệu ứng sóng cảnh báo */
        .icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid var(--warn-color);
            animation: ping-alert 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .icon-box {
            font-size: 45px;
            color: var(--warn-color);
            /* Nhấp nháy như đèn hỏng */
            animation: glitch-light 2s infinite;
        }

        @keyframes ping-alert {
            75%, 100% { transform: scale(1.5); opacity: 0; }
        }

        @keyframes glitch-light {
            0%, 100% { opacity: 1; text-shadow: 0 0 10px var(--warn-color); }
            50% { opacity: 0.7; text-shadow: none; }
            52% { opacity: 0.2; }
            54% { opacity: 0.7; }
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px;
            background: linear-gradient(to right, #fff, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: var(--text-sub);
            margin-bottom: 25px;
            font-size: 16px;
            line-height: 1.6;
            background: rgba(0,0,0,0.2);
            padding: 15px;
            border-radius: 8px;
            border: 1px dashed rgba(245, 158, 11, 0.3);
        }

        /* Button Modern - Amber Theme */
        .btn-retry {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--warn-color), var(--warn-dark));
            color: white;
            padding: 16px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            border: none;
            cursor: pointer;
        }

        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
            filter: brightness(1.1);
        }

        .redirect-text {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }
        
        .countdown {
            color: var(--warn-color);
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
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>
        
        <h1>Rất Tiếc, Có Lỗi Xảy Ra!</h1>
        
        <p>
            <?php echo isset($errorMsg) ? $errorMsg : "Hệ thống gặp sự cố khi xử lý yêu cầu của bạn. Vui lòng thử lại sau."; ?>
        </p>
        
        <a href="<?php echo isset($redirectUrl) ? $redirectUrl : 'javascript:history.back()' ?>" class="btn-retry" id="backBtn">
            <i class="fa-solid fa-rotate-left"></i> 
            <span>Thử lại ngay</span>
        </a>

        <div class="redirect-text">
            Tự động quay lại sau <span class="countdown" id="timer">10</span>s
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        // 1. Hiệu ứng "Sparks" (Tàn lửa rơi) - Mô phỏng chập điện
        document.addEventListener('DOMContentLoaded', () => {
            const duration = 2000;
            const end = Date.now() + duration;

            (function frame() {
                // Bắn 2 luồng từ 2 bên cạnh
                confetti({
                    particleCount: 3,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 },
                    colors: ['#f59e0b', '#dc2626', '#fbbf24'], // Cam, Đỏ, Vàng
                    gravity: 3, // Rơi rất nhanh (nặng)
                    drift: 0,
                    ticks: 100, // Tồn tại ngắn
                    startVelocity: 50,
                    shapes: ['square'] // Hình vuông nhỏ như tia lửa điện
                });
                
                confetti({
                    particleCount: 3,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 },
                    colors: ['#f59e0b', '#dc2626', '#fbbf24'],
                    gravity: 3,
                    drift: 0,
                    ticks: 100,
                    startVelocity: 50,
                    shapes: ['square']
                });

                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            }());
        });

        // 2. Countdown Logic (Thời gian chờ lâu hơn cho Lỗi: 10s)
        const timerElement = document.getElementById('timer');
        const backBtn = document.getElementById('backBtn');
        let timeLeft = 10; // Lỗi thường cần đọc kỹ hơn, nên để 10s

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                // Kiểm tra nếu là link JS hay link thật
                const href = backBtn.getAttribute('href');
                if (href.startsWith('javascript:')) {
                    history.back();
                } else {
                    window.location.href = href;
                }
            }
        }, 1000);
    </script>
</body>
</html>