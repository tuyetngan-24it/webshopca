<style>
    /* --- BIẾN MÀU SẮC --- */
    :root {
        --bg-body: #111827;
        --bg-card: #1f2937;
        --primary: #0a6dc2;
        --text-white: #fff;
        --border: #374151;
        --status-success: #059669;
        --status-pending: #4b5563;
    }

    /* --- CẤU HÌNH CƠ BẢN --- */
    body {
        background-color: var(--bg-body) !important;
        margin: 0;
        font-family: 'Outfit', 'Segoe UI', sans-serif;
    }

    .order-detail-wrapper {
        background-color: var(--bg-body);
        color: #f3f4f6;
        padding-top: 100px; /* Khoảng cách header */
        padding-bottom: 40px;
        min-height: calc(100vh - 200px);
    }

    /* --- CARD STYLE --- */
    .dark-card {
        background-color: var(--bg-card);
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
        padding: 24px;
        margin-bottom: 24px;
        border: 1px solid var(--border);
    }

    .section-title {
        color: #60a5fa;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 16px;
        text-transform: uppercase;
        border-bottom: 2px solid var(--border);
        padding-bottom: 10px;
    }

    /* --- TABLE STYLES --- */
    .table-responsive {
        width: 100%;
        margin-bottom: 1rem;
        overflow-y: hidden;
        overflow-x: auto; /* Cho phép trượt ngang trên mobile */
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        min-width: 600px; /* Đặt chiều rộng tối thiểu để kích hoạt thanh trượt */
    }

    .custom-table th {
        text-align: left;
        padding: 12px;
        background-color: #111827;
        color: #9ca3af;
        border-bottom: 2px solid var(--border);
        white-space: nowrap; /* Giữ tiêu đề trên 1 dòng */
    }

    .custom-table td {
        padding: 12px;
        border-bottom: 1px solid var(--border);
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

    /* --- BUTTONS --- */
    .btn-rate {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        white-space: nowrap; /* Không xuống dòng chữ trong nút */
        display: inline-block;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-rate:hover {
        background: var(--primary);
        color: #fff;
    }

    /* --- INFO ROWS --- */
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        border-bottom: 1px dashed var(--border);
        padding-bottom: 8px;
    }

    .info-label { color: #9ca3af; font-weight: 500; }
    .info-value { color: #fff; font-weight: 600; }

    /* --- BADGES --- */
    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: bold;
    }
    .status-success { background-color: #065f46; color: #34d399; border: 1px solid var(--status-success); }
    .status-pending { background-color: #374151; color: #d1d5db; border: 1px solid #6b7280; }

    /* =========================================
       RESPONSIVE CSS (MOBILE & TABLET)
       ========================================= */
    @media (max-width: 991px) {
        .order-detail-wrapper {
            padding-top: 150px; /* Giảm khoảng cách top trên mobile */
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Đảm bảo cột full màn hình nếu chưa có bootstrap */
        .col-md-8 {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .dark-card {
            padding: 15px; /* Giảm padding card */
        }

        /* Tinh chỉnh bảng trên mobile */
        .custom-table th, .custom-table td {
            padding: 10px 8px;
            font-size: 0.9rem; /* Giảm cỡ chữ chút */
        }

        /* Cột Tên sản phẩm (cột thứ 2): Cho phép xuống dòng và set độ rộng tối thiểu */
        .custom-table td:nth-child(2) {
            min-width: 160px; 
            white-space: normal; /* Cho phép tên dài xuống dòng */
            line-height: 1.4;
        }

        /* Các cột số liệu: Giữ trên 1 dòng */
        .custom-table td:nth-child(3), 
        .custom-table td:nth-child(4), 
        .custom-table td:nth-child(5) {
            white-space: nowrap;
        }

        .custom-table img {
            width: 50px;
            height: 50px;
        }
        
        .section-title {
            font-size: 1.1rem;
        }
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
                                    <th class="text-end">Hành động</th>
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
                                                <img src="<?php echo !empty($item['image']) ? '/dacs2/public/images/' . $item['image'] : 'https://placehold.co/60x60/1f2937/FFF?text=SP'; ?>" alt="SP">
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
                                                <a href="<?php echo ROOTLINK ?>/review/add/<?php echo $item['orderId']?>/<?php echo $item['productId'] ?>" class="btn-rate" onclick="openRateModal('<?php echo $orderCode ?>')">
                                                    <i class="fa-regular fa-star"></i> Đánh giá
                                                </a>
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
                                    <td colspan="5" class="text-end" style="padding-top: 20px; font-size: 1.1rem;">Tổng tiền hàng:</td>
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