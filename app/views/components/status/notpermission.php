<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Truy cập bị từ chối</title>
    <style>
        body {
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        .lock-icon {
            font-size: 80px;
            color: #ef4444; /* Màu đỏ cảnh báo */
            margin-bottom: 20px;
        }
        h1 {
            margin: 0;
            font-size: 2.5em;
            color: #1f2937;
        }
        p {
            color: #6b7280;
            font-size: 1.1em;
            margin: 15px 0 30px;
            line-height: 1.6;
        }
        .btn-home {
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-home:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lock-icon">🔒</div>
        <h1>Truy cập bị từ chối!</h1>
        <p>Xin lỗi, bạn không có thẩm quyền truy cập vào trang này. <br>Đây là khu vực dành riêng cho Quản trị viên.</p>
        <a href="<?php echo ROOTLINK ?>" class="btn-home">Quay về Trang chủ</a>
    </div>
</body>
</html>