<style>
    /* --- CẤU HÌNH CHUNG --- */
    body { 
        background-color: #111827; 
        color: #f3f4f6;
        margin: 0;
    }

    .write-review-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        /* Đổi từ center sang flex-start để dễ kiểm soát khoảng cách trên */
        align-items: flex-start; 
        
        /* QUAN TRỌNG: Tăng padding-top lên 100px (hoặc cao hơn header của bạn) 
           để đẩy form xuống, không bị Header che mất */
        padding: 100px 15px 40px 15px; 
        
        font-family: 'Segoe UI', sans-serif;
        box-sizing: border-box; 
    }

    .form-card {
        background-color: #1f2937;
        width: 100%;
        max-width: 600px;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #374151;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease;
        position: relative;
        z-index: 1; /* Đảm bảo form nổi lên trên nền */
    }

    .page-title {
        text-align: center;
        color: #60a5fa;
        margin-bottom: 30px;
        font-size: 1.8rem;
        font-weight: bold;
    }

    /* --- THÔNG TIN SẢN PHẨM --- */
    .product-preview {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #111827;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px dashed #4b5563;
    }

    .pp-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .pp-info h3 {
        margin: 0 0 5px 0;
        font-size: 1.1rem;
        color: #fff;
        line-height: 1.4;
    }

    .pp-info p {
        margin: 0;
        color: #9ca3af;
        font-size: 0.9rem;
    }

    /* --- STAR RATING --- */
    .rating-group {
        text-align: center;
        margin-bottom: 25px;
    }

    .rating-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #d1d5db;
    }

    .star-widget {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 10px;
        justify-content: center;
    }

    .star-widget input { display: none; }

    .star-widget label {
        font-size: 40px;
        color: #4b5563;
        cursor: pointer;
        transition: 0.2s;
        padding: 0 2px;
    }

    .star-widget input:checked ~ label,
    .star-widget label:hover,
    .star-widget label:hover ~ label {
        color: #fbbf24;
        transform: scale(1.1);
    }

    /* --- FORM INPUTS --- */
    .form-group { margin-bottom: 20px; }

    .form-control {
        width: 100%;
        background-color: #374151;
        border: 1px solid #4b5563;
        color: #fff;
        padding: 12px;
        border-radius: 8px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #60a5fa;
        background-color: #4b5563;
    }

    /* --- BUTTONS --- */
    .btn-submit {
        width: 100%;
        padding: 14px;
        background-color: #2563eb;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover { background-color: #1d4ed8; }
    .btn-submit:active { transform: scale(0.98); }

    .btn-cancel {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #9ca3af;
        text-decoration: none;
        padding: 10px;
    }
    .btn-cancel:hover { color: #fff; }

    /* =========================================
       RESPONSIVE CONFIG
       ========================================= */

    /* Tablet & Laptop nhỏ (Max-width: 768px) */
    @media (max-width: 768px) {
        .write-review-wrapper {
            /* Giữ khoảng cách top để tránh header trên tablet */
            padding-top: 100px; 
            padding-left: 10px;
            padding-right: 10px;
        }

        .form-card {
            padding: 25px 20px;
        }
    }

    /* Mobile (Max-width: 480px) */
    @media (max-width: 480px) {
        .write-review-wrapper {
            /* Trên mobile header thường nhỏ hơn, có thể giảm padding một chút nếu muốn */
            padding-top: 90px; 
        }

        .page-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .product-preview {
            padding: 12px;
            gap: 15px;
        }

        .pp-img {
            width: 60px;
            height: 60px;
        }

        .pp-info h3 {
            font-size: 1rem;
        }

        .star-widget label {
            font-size: 32px;
        }
        
        .star-widget {
            gap: 5px;
        }

        .btn-submit {
            font-size: 1rem;
            padding: 12px;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="write-review-wrapper">
    <div class="form-card">
        <div class="page-title">Đánh giá sản phẩm</div>

        <div class="product-preview">
            <div class="pp-info">
                <h3><?php echo $productName ?></h3>
                <p>Mã đơn hàng: #<?php echo $order_id ?></p>
            </div>
        </div>

        <form action="<?php echo ROOTLINK ?>/review/submit" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="product_id" value="<?php echo $productId ?>">
            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">

            <div class="rating-group">
                <span class="rating-label">Bạn thấy sản phẩm thế nào?</span>
                <div class="star-widget">
                    <input type="radio" name="rating" id="rate-5" value="5" checked>
                    <label for="rate-5" title="Tuyệt vời"><i class="fa-solid fa-star"></i></label>

                    <input type="radio" name="rating" id="rate-4" value="4">
                    <label for="rate-4" title="Tốt"><i class="fa-solid fa-star"></i></label>

                    <input type="radio" name="rating" id="rate-3" value="3">
                    <label for="rate-3" title="Bình thường"><i class="fa-solid fa-star"></i></label>

                    <input type="radio" name="rating" id="rate-2" value="2">
                    <label for="rate-2" title="Tệ"><i class="fa-solid fa-star"></i></label>

                    <input type="radio" name="rating" id="rate-1" value="1">
                    <label for="rate-1" title="Rất tệ"><i class="fa-solid fa-star"></i></label>
                </div>
            </div>

            <div class="form-group">
                <label class="rating-label">Chia sẻ cảm nhận:</label>
                <textarea name="comment" class="form-control" rows="5" 
                    placeholder="Chất lượng sản phẩm, thời gian giao hàng, thái độ phục vụ..."></textarea>
            </div>

            <div class="form-group">
                <label class="rating-label">Thêm hình ảnh (Nếu có):</label>
                <input type="file" name="review_img" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn-submit">Hoàn thành & Gửi đánh giá</button>
            
            <a href="<?php echo ROOTLINK ?>/myorderdetail/<?php echo $order_id ?>" class="btn-cancel">
                Hủy bỏ, quay lại
            </a>
        </form>

    </div>
</div>