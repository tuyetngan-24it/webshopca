<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không Tìm Thấy Trang</title>
    <style>
        /* CSS được nhúng trực tiếp để đảm bảo nó luôn tải được */
        :root {
            --mau-chinh: #007bff;
            --mau-nen: #f8f9fa;
            --mau-chu: #333;
            --mau-chu-phu: #6c757d;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--mau-nen);
            color: var(--mau-chu);
            display: grid;
            place-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 500px;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .emoji {
            font-size: 5rem;
            line-height: 1;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--mau-chinh);
            margin: 1rem 0;
        }
        p {
            font-size: 1.125rem;
            color: var(--mau-chu-phu);
            margin-bottom: 2rem;
        }
        .button-home {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background-color: var(--mau-chinh);
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }
        .button-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="emoji">🤷‍♂️</div>
        <h1>404 - Không Tìm Thấy</h1>
        <p>Rất tiếc, trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.</p>
        <a href="<?php echo ROOTLINK ?>" class="button-home">Quay Về Trang Chủ</a>
    </div>
</body>
</html>