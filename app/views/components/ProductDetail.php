<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/productDetail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/homePage.css">
<?php
// Xử lý dữ liệu thống kê sao để tránh lỗi nếu chưa có đánh giá nào
$avgRating = isset($avgRating) ? round($avgRating) : 0;
$totalReview = isset($totalReview) ? $totalReview : 0;
?>

<?php if (!empty($product) && !empty($category)) : ?>

    <div class="pd-page-wrapper">
        <div class="container">
            <div class="product-main-box">
                <div class="product-image-col">
                    <div class="main-image-frame">
                        <img src="<?php echo $product['img'] ?>" alt="<?php echo $product['name'] ?>">
                    </div>
                </div>

                <div class="product-info-col">
                    <h1 class="pd-title"><?php echo $product['name'] ?> </h1>

                    <div class="pd-meta">
                        <div>Mã SP: <span>MP-SP-T<?php echo $product['id'] ?></span></div>
                        <div>Danh mục: <span> <?php echo $category['name'] ?> </span></div>
                        <div>Tình trạng: <span style="color:<?php echo ($product['quantity'] > 0) ? '#2ecc71' : 'red' ?>">
                                <?php echo isset($status) ? $status : 'Đang cập nhật' ?>
                            </span></div>
                    </div>

                    <div class="shopee-stats">
                        <a href="#reviewSection" class="stat-item rating-box">
                            <span class="stat-num highlight-star"><?php echo $avgRating ?></span>
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= round($avgRating)): ?>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                    <?php else: ?>
                                        <i class="fa-solid fa-star" style="color: #ddd;"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </a>

                        <div class="stat-divider">|</div>

                        <a href="#reviewSection" class="stat-item">
                            <span class="stat-num"><?php echo $totalReview ?></span>
                            <span class="stat-label">Đánh giá</span>
                        </a>

                        <div class="stat-divider">|</div>

                        <!-- <div class="stat-item">
                            <span class="stat-num"></span> <span class="stat-label"></span>
                        </div> -->
                    </div>

                    <div class="pd-price-box">
                        <span class="pd-price"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</span>
                    </div>

                    <form action="cart/add" method="POST">
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                        <div class="pd-row">
                            <span class="pd-label">Vận chuyển</span>
                            <div class="shipping-info">
                                <i class="fa-solid fa-truck-fast" style="color: var(--primary-color);"></i>
                                <div>
                                    <span>Thanh toán khi nhận hàng hoặc MOMO</span>
                                    <span class="cod-badge">Freeship</span>
                                </div>
                            </div>
                        </div>

                        <div class="pd-row">
                            <span class="pd-label">Số lượng</span>
                            <div style="display: flex;">
                                <div class="qty-control">
                                    <button type="button" onclick="updateQty(-1)">-</button>
                                    <input type="number" name="quantity" id="qtyInput" value="1" min="1">
                                    <button type="button" onclick="updateQty(1)">+</button>
                                </div>
                                <span class="stock-label"><?php echo $product['quantity'] ?> sản phẩm có sẵn</span>
                            </div>
                        </div>

                        <div class="pd-actions">

                            <?php if ($product['quantity'] > 0): ?>
                                <button type="submit" class="btn-add-cart">
                                    <i class="fa-solid fa-cart-plus"></i> Thêm Vào Giỏ Hàng
                                </button>

                                <button type="submit" class="btn-buy-now">
                                    Mua Ngay
                                </button>
                            <?php endif ?>

                            <?php if ($product['quantity'] == 0): ?>
                                <button type="button" class="btn-add-cart">
                                    <i class="" disabled></i> đã hết sản phẩm
                                </button>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>

            <div class="product-desc-box">
                <div class="desc-header">MÔ TẢ SẢN PHẨM</div>
                <div class="desc-content">
                    <?php echo $product['description'] ?>
                </div>

                <div class="review-section" id="reviewSection">
                    <div class="review-header">
                        Đánh giá từ khách hàng
                        <span class="review-count"> (<?php echo $totalReview ?> đánh giá)</span>
                    </div>

                    <div class="review-list">
                        <?php if (!empty($reviews)) : ?>
                            <?php foreach ($reviews as $rv) : ?>
                                <div class="review-item">
                                    <div class="rv-avatar">
                                        <img src="http://localhost/dacs2/public/uploads/<?php echo urlencode($rv['avatar']) ?>">
                                        <span><?php echo $rv['user_name'] ?></span>
                                    </div>
                                    <div class="rv-content">
                                        <div class="rv-top">
                                            <div class="rv-name"><?php echo htmlspecialchars($rv['users']) ?></div>
                                            <div class="rv-date"><?php $date = new DateTime($rv['created_at']);
                                                                    $date->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                                                    echo $date->format('d/m/y'); ?></div>
                                        </div>

                                        <div class="rv-stars">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <?php if ($i <= $rv['rating']) : ?>
                                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-star" style="color: #ddd;"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </div>

                                        <div class="rv-text"><?php echo nl2br(htmlspecialchars($rv['comment'])) ?></div>

                                        <?php if (!empty($rv['image'])) : ?>
                                            <div class="rv-images">
                                                <div class="rv-img-thumb">
                                                    <img src="<?php echo  $rv['image'] ?>" onclick="window.open(this.src)" style="cursor: pointer;">
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div style="font-size: 12px; color: #888; margin-top: 5px;">
                                            Đã mua hàng #ĐMSP<?php echo $rv['orderid'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div style="text-align: center; padding: 30px; color: #777;">
                                <i class="fa-regular fa-comment-dots" style="font-size: 40px; margin-bottom: 10px;"></i>
                                <p>Sản phẩm này chưa có đánh giá nào.</p>
                                <p>Hãy mua hàng và là người đầu tiên đánh giá nhé!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php endif ?>

<script>
    // Xử lý nút tăng giảm (Giữ nguyên code cũ)
    function updateQty(change) {
        const input = document.getElementById('qtyInput');
        let val = parseInt(input.value);
        if (isNaN(val)) val = 1;
        val += change;
        if (val < 1) val = 1;
        // Lấy số lượng max từ PHP in ra
        let maxQty = <?php echo isset($product['quantity']) ? $product['quantity'] : 1 ?>;
        if (val > maxQty) val = maxQty;
        input.value = val;
    }

    const inputElement = document.getElementById('qtyInput');
    inputElement.addEventListener('change', function() {
        let val = parseInt(this.value);
        let maxQty = <?php echo isset($product['quantity']) ? $product['quantity'] : 1 ?>;
        if (isNaN(val) || val < 1) {
            this.value = 1;
        } else if (val > maxQty) {
            this.value = maxQty;
        }
    });
</script>