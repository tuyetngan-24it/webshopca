<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đã xóa</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --danger-color: #ef4444; /* Màu đỏ cảnh báo */
            --danger-glow: #f87171;
            --bg-dark: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-sub: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            /* Gradient nền tối pha chút đỏ sẫm */
            background-image: 
                radial-gradient(at 0% 100%, hsla(350, 40%, 15%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225, 39%, 20%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 100%, hsla(340, 50%, 10%, 1) 0, transparent 50%);
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
                0 25px 50px -12px rgba(0, 0, 0, 0.6),
                inset 0 0 0 1px var(--glass-border);
            max-width: 420px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
            border-top: 1px solid rgba(239, 68, 68, 0.2); /* Viền trên đỏ nhẹ */
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Icon Animation Wrapper */
        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: rgba(239, 68, 68, 0.1); /* Nền đỏ nhạt */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
        }
        
        /* Vòng ripple đỏ */
        .icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid var(--danger-color);
            opacity: 0;
            animation: ripple-danger 2s infinite;
        }

        .icon-box {
            font-size: 42px;
            color: var(--danger-color);
            animation: trash-shake 0.5s ease-in-out 0.4s forwards;
            transform-origin: center bottom;
        }

        @keyframes trash-shake {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg); }
            50% { transform: rotate(15deg); }
            75% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }

        @keyframes ripple-danger {
            0% { transform: scale(0.8); opacity: 0.6; }
            100% { transform: scale(1.4); opacity: 0; }
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px;
            background: linear-gradient(to right, #fff, #fca5a5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: var(--text-sub);
            margin-bottom: 35px;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Button Modern - Red Theme */
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--danger-color), #b91c1c);
            color: white;
            padding: 16px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
            filter: brightness(1.1);
        }

        /* Countdown text */
        .redirect-text {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }
        
        .countdown {
            color: var(--danger-color);
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
                <i class="fa-regular fa-trash-can"></i>
            </div>
        </div>
        
        <h1>Xóa Thành Công!</h1>
        <p>Dữ liệu đã được loại bỏ hoàn toàn khỏi hệ thống.<br>Thao tác không thể hoàn tác.</p>
        
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
        // 1. Hiệu ứng "Nổ tung" (Debris Explosion)
        document.addEventListener('DOMContentLoaded', () => {
            // Chỉ bắn 1 lần thật mạnh ngay khi load
            const count = 200;
            const defaults = {
                origin: { y: 0.7 },
                zIndex: 0
            };

            function fire(particleRatio, opts) {
                confetti(Object.assign({}, defaults, opts, {
                    particleCount: Math.floor(count * particleRatio)
                }));
            }

            // Màu sắc: Đỏ, Xám, Trắng (như mảnh vỡ)
            const debrisColors = ['#ef4444', '#7f1d1d', '#52525b', '#ffffff'];

            fire(0.25, {
                spread: 26,
                startVelocity: 55,
                colors: debrisColors
            });
            fire(0.2, {
                spread: 60,
                colors: debrisColors
            });
            fire(0.35, {
                spread: 100,
                decay: 0.91,
                scalar: 0.8,
                colors: debrisColors
            });
            fire(0.1, {
                spread: 120,
                startVelocity: 25,
                decay: 0.92,
                scalar: 1.2,
                colors: debrisColors
            });
            fire(0.1, {
                spread: 120,
                startVelocity: 45,
                colors: debrisColors
            });
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
                backBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Đang điều hướng...`;
            }

            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = backBtn.getAttribute('href');
            }
        }, 1000);
    </script>
</body>
</html>