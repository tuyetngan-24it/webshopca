<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi đánh giá thành công</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --star-color: #fbbf24; /* Vàng hổ phách */
            --star-glow: #fde68a;
            --purple-bg: #4c1d95;
            --bg-dark: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-sub: #cbd5e1;
        }

        body {
            background-color: var(--bg-dark);
            /* Gradient nền tím mộng mơ (Royal Vibe) */
            background-image: 
                radial-gradient(at 100% 0%, hsla(267, 83%, 28%, 1) 0, transparent 50%), 
                radial-gradient(at 0% 100%, hsla(250, 70%, 20%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 50%, hsla(260, 60%, 15%, 1) 0, transparent 50%);
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
            border-bottom: 2px solid var(--star-color);
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Icon Wrapper */
        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(76, 29, 149, 0.2));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
            box-shadow: 0 0 30px rgba(251, 191, 36, 0.15);
        }
        
        /* Hiệu ứng hào quang xoay */
        .icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px dashed var(--star-color);
            opacity: 0.5;
            animation: rotate-star 8s linear infinite;
        }

        .icon-box {
            font-size: 48px;
            color: var(--star-color);
            filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.6));
            animation: pulse-star 2s ease-in-out infinite;
        }

        @keyframes rotate-star {
            to { transform: rotate(360deg); }
        }

        @keyframes pulse-star {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.6)); }
            50% { transform: scale(1.1); filter: drop-shadow(0 0 20px rgba(251, 191, 36, 1)); }
        }

        h1 {
            font-size: 26px;
            font-weight: 700;
            margin: 0 0 10px;
            /* Gradient chữ vàng kim */
            background: linear-gradient(to right, #fff, #fcd34d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: var(--text-sub);
            margin-bottom: 35px;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Button Modern - Purple/Gold Theme */
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: white;
            padding: 16px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5);
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
        }

        .redirect-text {
            margin-top: 20px;
            font-size: 13px;
            color: #94a3b8;
        }
        
        .countdown {
            color: #a78bfa; /* Tím nhạt */
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
                <i class="fa-solid fa-star"></i>
            </div>
        </div>
        
        <h1>Cảm Ơn Đánh Giá Của Bạn!</h1>
        <p>Ý kiến của bạn rất quan trọng với chúng tôi.<br>Hệ thống đã ghi nhận và sẽ hiển thị sớm.</p>
        
        <a href="<?php echo isset($redirectUrl) ? $redirectUrl : 'javascript:history.back()' ?>" class="btn-back" id="backBtn">
            <i class="fa-solid fa-arrow-left"></i> 
            <span>Quay lại trang trước</span>
        </a>

        <div class="redirect-text">
            Tự động quay lại sau <span class="countdown" id="timer">5</span>s
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        // 1. Hiệu ứng "Starfall" (Mưa sao)
        document.addEventListener('DOMContentLoaded', () => {
            var defaults = {
                spread: 360,
                ticks: 50,
                gravity: 0,
                decay: 0.94,
                startVelocity: 30,
                shapes: ['star'], // Chỉ dùng hình ngôi sao
                colors: ['#FFE400', '#FFBD00', '#E89400', '#FFCA6C', '#FDFFB8'] // Các tone vàng
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

            // Bắn ra các ngôi sao ngay khi load
            setTimeout(shoot, 0);
            setTimeout(shoot, 100);
            setTimeout(shoot, 200);
        });

        // 2. Countdown Logic
        const timerElement = document.getElementById('timer');
        const backBtn = document.getElementById('backBtn');
        let timeLeft = 5;

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
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