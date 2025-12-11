<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --success-color: #10b981;
            --success-dark: #047857;
            --gold-accent: #fbbf24;
            --bg-dark: #0f172a;
            --glass-bg: rgba(30, 41, 59, 0.75);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-sub: #94a3b8;
        }

        body {
            background-color: var(--bg-dark);
            /* Gradient nền xanh đen sang trọng */
            background-image: 
                radial-gradient(at 0% 100%, hsla(160, 60%, 15%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(200, 50%, 20%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 100%, hsla(160, 60%, 15%, 1) 0, transparent 50%);
            font-family: "Outfit", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            color: var(--text-main);
            padding: 20px;
            box-sizing: border-box;
        }

        /* Thẻ kính */
        .status-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 0 0 1px var(--glass-border);
            max-width: 450px;
            width: 100%;
            position: relative;
            z-index: 10;
            opacity: 0;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            border-top: 4px solid var(--success-color);
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Icon Wrapper */
        .icon-wrapper {
            width: 110px;
            height: 110px;
            background: rgba(16, 185, 129, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            position: relative;
        }
        
        /* Vòng hào quang tỏa ra */
        .icon-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px dashed var(--success-color);
            animation: rotate-slow 10s linear infinite;
        }

        .icon-box {
            font-size: 50px;
            color: var(--success-color);
            animation: bounce-gift 2s infinite;
        }

        @keyframes rotate-slow {
            to { transform: rotate(360deg); }
        }

        @keyframes bounce-gift {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px;
            background: linear-gradient(to right, #fff, #a7f3d0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: var(--text-sub);
            margin-bottom: 25px;
            font-size: 15px;
            line-height: 1.6;
        }

        /* Khu vực mã đơn hàng */
        .order-info {
            background: rgba(15, 23, 42, 0.6);
            border: 1px dashed #475569;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: inline-block;
            width: 100%;
            box-sizing: border-box;
        }

        .order-label {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .order-code {
            font-family: monospace;
            font-size: 22px;
            font-weight: 700;
            color: var(--gold-accent); /* Màu vàng gold cho mã */
            letter-spacing: 2px;
        }

        /* Group Button */
        .btn-group {
            display: flex;
            gap: 15px;
            flex-direction: column; /* Mobile first: xếp dọc */
        }

        @media (min-width: 400px) {
            .btn-group {
                flex-direction: row; /* Desktop/Tablet: xếp ngang */
            }
        }

        .btn {
            padding: 14px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        /* Nút chính */
        .btn-primary {
            background: linear-gradient(135deg, var(--success-color), var(--success-dark));
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            border: none;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        /* Nút phụ (Glass) */
        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-sub);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Countdown text */
        .redirect-text {
            margin-top: 25px;
            font-size: 13px;
            color: #475569;
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
                <i class="fa-solid fa-gift"></i>
            </div>
        </div>
        
        <h1>Đặt Hàng Thành Công!</h1>
        <p>Cảm ơn bạn đã mua sắm. Đơn hàng đang được hệ thống xử lý và sẽ sớm được giao đến bạn.</p>
    
        <div class="redirect-text">
            Tự động về trang chủ sau <span id="timer" style="color:var(--success-color); font-weight:bold">15</span>s
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        // 1. Hiệu ứng Fireworks (Pháo hoa)
        document.addEventListener('DOMContentLoaded', () => {
            const duration = 3000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function() {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 50 * (timeLeft / duration);
                
                // Bắn pháo hoa từ dưới lên ngẫu nhiên
                confetti(Object.assign({}, defaults, { 
                    particleCount, 
                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } 
                }));
                confetti(Object.assign({}, defaults, { 
                    particleCount, 
                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } 
                }));
            }, 250);
        });

        // 2. Countdown Logic
        const timerElement = document.getElementById('timer');
        const homeBtn = document.getElementById('homeBtn');
        let timeLeft = 3; // Cho khách hàng 15s để xem mã đơn hàng

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = homeBtn.getAttribute('href');
            }
        }, 1000);
    </script>
</body>
</html>