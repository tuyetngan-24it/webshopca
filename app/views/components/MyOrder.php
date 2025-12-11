<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/MyOrder.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="orders-wrapper">
    <div class="container">
        <h1 class="page-title">Đơn hàng của tôi</h1>

        <div class="orders-list">

            <?php $orderCode = '' ?>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $item): ?>
                    <?php $orderCode = $item['id'] ?>
                    <div class="order-card">
                
                        <div class="od-info">
                            <!-- <div class="od-name">Đèn LED RGB 60cm Pro</div> -->
                            <div class="od-meta"> #ĐHMP-SHOP- <?php echo    $item['id'] ?> | <?php echo $item['created_at'] ?></div>
                            <div class="od-price"><?php echo $item['total'] ?> vnđ</div>
                        </div>
                        <div class="od-status">
                            <?php if ($item['status'] == 'paid') {
                                echo "<span class='status-badge st-success'>Đã thanh toán</span>";
                            } else {
                                echo "<span class='status-badge st-danger'>Chưa thanh toán</span>";
                            }
                            ?>
                        </div>
                        <div class="od-status">
                            <?php if ($item['deliveryStatus'] == 'delivered') {
                                echo "<span class='status-badge st-success'>Giao thành công</span>";
                            } else {
                                echo "<span class='status-badge st-danger'>Đang xử lý</span>";
                            }
                            ?>
                        </div>


                        <a href="myorderdetail/<?php echo $item['id']  ?>"   class="btn-secondary btn-rate" onclick="" style="text-decoration: none">
                            <i class="fa-regular fa-star"></i> Xem chi tiết
                        </a>
                         <?php if ($item['deliveryStatus'] == 'delivered'):?>
                         <a href="review/<?php echo $item['id']  ?>"   class="btn-secondary btn-rate" onclick="" style="text-decoration: none">
                             Đánh giá đơn hàng
                        </a>
                        <?php endif ?>

                        <?php $orderCode = "#ĐHMP-SHOP $orderCode" ?>
                        <?php if ($item['deliveryStatus'] == 'delivered') : ?>
                          
                        <?php endif ?>

                    </div>
                <?php endforeach ?>
            <?php endif ?>


        </div>
    </div>
</div>

<div id="rateModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Đánh giá sản phẩm</h3>
            <p id="modalProductName" style="text-align: center; color: #888; font-size: 14px; margin-bottom: 20px;"></p>
        </div>

        <form action="<?php echo ROOTLINK ?>/review/submit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" id="rateProductId">
            <input type="hidden" name="order_id" id="rateOrderId">

            <div class="star-rating">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2"><i class="fa-solid fa-star"></i></label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1"><i class="fa-solid fa-star"></i></label>
            </div>

            <div class="form-group">
                <textarea name="comment" class="form-control" rows="4" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm..."></textarea>
            </div>

            <div class="form-group">
                <label style="font-size: 13px; color: #bbb; display:block; margin-bottom:5px;">Thêm hình ảnh (Tùy chọn):</label>
                <input type="file" name="review_img" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn-submit-review">Gửi đánh giá</button>
            <button type="button" class="btn-close" onclick="closeRateModal()">Hủy bỏ</button>
        </form>
    </div>
</div>

<script>
    const rateModal = document.getElementById('rateModal');

    // Mở modal và điền thông tin
    function openRateModal(productId, productName = '', orderId = '') {
        document.getElementById('rateProductId').value = productId;
        document.getElementById('rateOrderId').value = orderId;
        document.getElementById('modalProductName').innerText = productName;
        rateModal.classList.add('show');
    }

    function closeRateModal() {
        rateModal.classList.remove('show');
    }

    window.onclick = function(event) {
        if (event.target == rateModal) closeRateModal();
    }
</script>