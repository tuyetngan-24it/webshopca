<style>
    :root {
        --bg-body: #0f0f0f;
        --bg-card: #1e1e1e;
        --primary: #0a6dc2;
        --text-white: #fff;
        --text-gray: #bbb;
        --border: #333;
        --status-success: #2ecc71;
        /* Xanh lá (Giao thành công) */
        --status-pending: #f1c40f;
        /* Vàng (Đang xử lý) */
        --font-main: "Outfit", sans-serif;
    }

    /* 1. ÉP MÀU NỀN TRANG WEB THÀNH ĐEN LUÔN (Trị triệt để vệt trắng) */
    body {
        background-color: #111827 !important;
    }

    /* CSS Cục bộ cho trang chi tiết đơn hàng */
    .order-detail-wrapper {
        background-color: #111827;
        color: #f3f4f6;

        /* Cách header: Dùng padding thay vì margin để không lòi nền trắng */
        padding-top: 100px;

        /* Chiều cao tối thiểu: Trừ hao đi Header + Footer để vừa khít màn hình */
        /* Giả sử Header + Footer cao tầm 200px. Nếu vẫn bị cuộn thì tăng số 200 lên */
        min-height: calc(100vh - 200px);

        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dark-card {
        background-color: #1f2937;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
        padding: 24px;
        margin-bottom: 24px;
        border: 1px solid #374151;
    }

    .section-title {
        color: #60a5fa;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 16px;
        text-transform: uppercase;
        border-bottom: 2px solid #374151;
        padding-bottom: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        border-bottom: 1px dashed #374151;
        padding-bottom: 8px;
    }

    .info-label {
        color: #9ca3af;
        font-weight: 500;
    }

    .info-value {
        color: #fff;
        font-weight: 600;
    }

    /* Table Styles */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .custom-table th {
        text-align: left;
        padding: 12px;
        background-color: #111827;
        color: #9ca3af;
        border-bottom: 2px solid #374151;
    }

    .custom-table td {
        padding: 12px;
        border-bottom: 1px solid #374151;
        vertical-align: middle;
        color: #e5e7eb;
    }

    .custom-table img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #4b5563;
    }

    /* Badge trạng thái */
    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: bold;
    }

    .status-success {
        background-color: #065f46;
        color: #34d399;
        border: 1px solid #059669;
    }

    .status-pending {
        background-color: #4b5563;
        color: #d1d5db;
        border: 1px solid #6b7280;
    }

    .status-danger {
        background-color: #7f1d1d;
        color: #fca5a5;
        border: 1px solid #b91c1c;
    }

     .btn-back {
        display: inline-block;
        background-color: transparent;
        color: #60a5fa;
        border: 1px solid #60a5fa;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        margin-bottom: 20px;
    }

    

    .btn-back:hover {
        background-color: #60a5fa;
        color: #fff;
    }


    .btn-rate {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;   
    }

    

    .btn-rate:hover {
        background: var(--primary);
        color: #ffffffff;
    }

    .btn-rate.disabled {
        border-color: #444;
        color: #666;
        cursor: not-allowed;
        background: transparent;
    }

    .btn-rate.disabled:hover {
        background: transparent;
        color: #666;
    } 
</style>

<div class="order-detail-wrapper">
    <div class="container">

        <!-- 
        <div class="col-md-4">
            <div class="dark-card">
                <h3 class="section-title">Thông tin đơn hàng</h3>

                <div class="info-row">
                    <span class="info-label">Mã đơn hàng:</span>
                    <span class="info-value">#<?php echo $orderData['madonhang']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ngày đặt:</span>
                    <span class="info-value"><?php echo $orderData['ngaydat']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Trạng thái:</span>
                    <span class="info-value">
                        <?php if ($orderData['status'] == 'Đã thanh toán'): ?>
                            <span class="badge-status status-success">Đã thanh toán</span>
                        <?php else: ?>
                            <span class="badge-status status-pending"><?php echo $orderData['status']; ?></span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>

            <div class="dark-card">
                <h3 class="section-title">Người nhận</h3>
                <div class="info-row">
                    <span class="info-label">Họ tên:</span>
                    <span class="info-value"><?php echo $orderData['fullname']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Số điện thoại:</span>
                    <span class="info-value"><?php echo $orderData['phone']; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Địa chỉ:</span>
                    <span class="info-value" style="text-align: right; max-width: 60%;">
                        <?php echo $orderData['address']; ?>
                    </span>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-8">
                <div class="dark-card">
                    <h3 class="section-title">Chi tiết sản phẩm</h3>

                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                    <!-- <th class="text-end">Hành động</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalMoney = 0;
                                // Kiểm tra nếu có dữ liệu chi tiết
                                if (!empty($orderItems)):
                                    foreach ($orderItems as $item):
                                        $subtotal = $item['price'] * $item['productQuantity'];
                                        $totalMoney += $subtotal;
                                ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $item['img']?>">
                                            </td>
                                            <td>
                                                <div style="font-weight: bold;"><?php echo $item['productName']; ?></div>
                                            </td>
                                            <td class="text-center">x<?php echo $item['productQuantity']; ?></td>
                                            <td class="text-end"><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
                                            <td class="text-end" style="color: #60a5fa; font-weight: bold;">
                                                <?php echo number_format($subtotal, 0, ',', '.'); ?> đ
                                            </td>
                                            <td>
                                                <!-- <button class="btn-rate" onclick="openRateModal('<?php echo $orderCode ?>')">
                                                    <i class="fa-regular fa-star"></i> Đánh giá
                                                </button> -->
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Chưa có dữ liệu chi tiết sản phẩm</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end" style="padding-top: 20px; font-size: 1.1rem;">Tổng tiền hàng:</td>
                                    <td class="text-end" style="padding-top: 20px; font-size: 1.2rem; color: #34d399; font-weight: bold;">
                                        <?php echo number_format($totalMoney, 0, ',', '.'); ?> vnđ
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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