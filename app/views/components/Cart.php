<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/cart.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="cart-page-wrapper">
    <div class="container">
        <?php $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
        <div class="cart-header">
            <h1 class="cart-title">Giỏ Hàng</h1>
            <span class="cart-count"><?php echo $count ?> Sản phẩm</span>
        </div>

        <div class="cart-layout">
            <div class="cart-list">
                <?php if (!empty($shoppingCart) && $count > 0): ?>
                    <?php foreach ($shoppingCart as $item): ?>
                        <div class="cart-item">
                            <div class="item-img">
                                <img src="<?php echo $item['img'] ?? 'default.jpg' ?>" alt="Product" style="width: 100px;">
                            </div>
                            <div class="item-info">
                                <a href="#" class="item-name"><?php echo $item['name'] ?></a>
                                <div class="item-meta">Phân loại: ...</div>
                                <div class="item-controls">

                                    <div class="item-price" data-price="<?php echo $item['price'] ?>">
                                        <?php echo number_format($item['price'], 0, ',', '.') ?>đ
                                    </div>

                                    <div class="qty-box">
                                        <button class="qty-btn" onclick="changeQty(this, <?php echo $item['id'] ?>, -1)">-</button>

                                        <input type="number" class="qty-input" value="<?php echo $item['quantity'] ?>" min="1" readonly>

                                        <button class="qty-btn" onclick="changeQty(this, <?php echo $item['id'] ?>, 1)">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="item-right">
                                <?php $totalItem = $item['price'] * $item['quantity']; ?>
                                <div class="item-total"><?php echo number_format($totalItem, 0, ',', '.') ?>đ</div>

                                <form action="<?php echo ROOTLINK ?>/cart/remove" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có muốn xóa?');">
                                    <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                                    <button type="submit" class="btn-remove">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <p>Giỏ hàng trống.</p>
                <?php endif ?>
            </div>

            <aside class="cart-sidebar">
                <div class="summary-box">
                    <div class="summary-title">Tóm Tắt Đơn Hàng</div>

                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <span class="total-price-sub">0đ</span>
                    </div>
                    <div class="summary-row">
                        <span>Vận chuyển</span>
                        <span style="color: #2ecc71; font-weight: bold;">Miễn phí</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="total-row">
                        <span>Tổng cộng</span>
                        <span class="total-price-final" style="color: #e74c3c;">0đ</span>
                    </div>

                    <div class="checkout-container">
                        <form method="POST" action="<?php echo ROOTLINK; ?>/order/create" class="payment-form">

                            <div class="address-section">
                                <h3 class="address-header-title">Địa chỉ nhận hàng</h3>

                                <?php if (!empty($my_addresses)): ?>
                                    <div class="address-list">
                                        <?php foreach ($my_addresses as $index => $addr): ?>
                                            <label class="address-card" for="addr_<?php echo $addr['addressid'] ?>">
                                                <input type="radio"
                                                    id="addr_<?php echo $addr['addressid'] ?>"
                                                    name="address_id"
                                                    value="<?php echo $addr['addressid'] ?>"
                                                    <?php echo ($index === 0) ? 'checked' : '' ?>>

                                                <div class="address-label">
                                                    <b><?php echo $addr['receiverName'] ?? $_SESSION['user']['username'] ?></b> |
                                                    <span><?php echo $addr['phone'] ?? $_SESSION['user']['numberPhone'] ?></span>
                                                    <div style="margin-top: 4px; font-size: 13px; color: #666;">
                                                        <?php echo $addr['streetDetail'] ?? $addr['street'] ?>,
                                                        <?php echo $addr['ward'] ?>,
                                                        <?php echo $addr['province'] ?>
                                                    </div>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="no-address">
                                        <div style="color: #e74c3c; font-size: 13px; margin-bottom: 8px;">
                                            <i class="fa-solid fa-triangle-exclamation"></i> Bạn chưa có địa chỉ nhận hàng.
                                        </div>
                                        <a href="<?php echo ROOTLINK ?>/profile" class="btn-add-addr">
                                            <i class="fa-solid fa-plus"></i> Thêm địa chỉ mới
                                        </a>
                                        <input type="hidden" name="address_id" value="" required>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group" style="margin-top: 20px;">
                                <label for="payment_method" style="font-weight: 600; margin-bottom: 8px; display: block;">Phương thức thanh toán:</label>
                                <div class="select-wrapper">
                                    <select name="payment_method" id="payment_method" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ddd;">
                                        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                        <option value="momo">Thanh toán MoMo QR</option>
                                    </select>
                                </div>
                            </div>

                            <?php if($_SESSION['user']['role'] == 'admin'): ?>
                                <div style="color: red ;">Bạn là admin, không thể đặt hàng</div>
                                <?php else: ?>
                                    <button type="submit" class="btn-submit" style="margin-top: 20px;">Đặt hàng ngay</button>
                                    <?php endif;  ?>

                        </form>
                    </div>
                    <a href="<?php echo ROOTLINK ?>" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm</a>
                </div>
            </aside>
        </div>
    </div>
</div>
<script src="<?php echo ROOTLINK ?> /public/assets/js/Jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    // Khai báo biến đường dẫn gốc từ PHP để JS dùng
    const ROOT_URL = '<?php echo ROOTLINK ?>';

    // Biến lưu trạng thái chờ (debounce)
    let debounceTimer;

    // Hàm định dạng tiền tệ (VND)
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    }

    // === HÀM XỬ LÝ CHÍNH ===
    function changeQty(btn, productId, change) {
        // --- PHẦN 1: XỬ LÝ GIAO DIỆN (UI) NGAY LẬP TỨC ---

        // 1. Tìm các phần tử HTML liên quan trong dòng sản phẩm đó
        const row = btn.closest('.cart-item');
        const input = row.querySelector('.qty-input');
        const priceElement = row.querySelector('.item-price');
        const totalElement = row.querySelector('.item-total');

        // 2. Lấy giá trị hiện tại
        let currentQty = parseInt(input.value);
        let pricePerUnit = parseFloat(priceElement.getAttribute('data-price'));

        // 3. Tính toán số lượng mới
        let newQty = currentQty + change;
        if (newQty < 1) newQty = 1; // Không cho xuống dưới 1

        // 4. Cập nhật ngay lên màn hình
        input.value = newQty;

        // Cập nhật thành tiền của món đó
        let newTotalItem = pricePerUnit * newQty;
        totalElement.textContent = formatCurrency(newTotalItem);

        // Cập nhật Tổng tiền bên Sidebar (tính toán tạm thời bằng JS)
        updateCartTotalUI();

        // --- PHẦN 2: GỬI AJAX VỀ SERVER (DEBOUNCE) ---

        // Xóa lệnh hẹn giờ cũ
        clearTimeout(debounceTimer);

        // Hẹn giờ mới: Sau 0.8s mới gửi request
        debounceTimer = setTimeout(() => {
            updateCartServer(productId, newQty);
        }, 800);
    }

    // Hàm tính tổng tiền hiển thị ở Sidebar (Chạy bằng JS để mượt)
    function updateCartTotalUI() {
        let totalOrder = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            let qty = parseInt(item.querySelector('.qty-input').value);
            let price = parseFloat(item.querySelector('.item-price').getAttribute('data-price'));
            totalOrder += (qty * price);
        });

        let formattedTotal = formatCurrency(totalOrder);

        // Update vào Sidebar
        const subTotal = document.querySelector('.total-price-sub');
        const finalTotal = document.querySelector('.total-price-final');

        if (subTotal) subTotal.innerText = formattedTotal;
        if (finalTotal) finalTotal.innerText = formattedTotal;
    }

    // Hàm gửi dữ liệu lên PHP
    function updateCartServer(productId, quantity) {
        console.log(`Đang lưu Session: ID ${productId} - SL ${quantity}`);

        $.ajax({
            url: ROOT_URL + `/cart/update/${productId}/${quantity}`, // URL giữ nguyên logic của bạn
            type: 'POST', // Tương đương method: 'POST'
            dataType: 'json', // Báo cho jQuery biết server sẽ trả về JSON để nó tự parse
            success: function(data) {
                console.log('Server trả về:', data);

                if (data.status === 'success') {
                    // jQuery selector ngắn gọn hơn document.querySelector
                    // .text() thay thế cho .innerText
                    $('.total-price-final').text(data.total_money_formatted);
                    $('.total-price-sub').text(data.total_money_formatted);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi:', error);
                // Log thêm cái này để xem chi tiết lỗi server nếu có
                console.log('Chi tiết lỗi:', xhr.responseText);
            }
        });
    }
    // Chạy 1 lần khi load trang để tính tổng tiền ban đầu
    document.addEventListener('DOMContentLoaded', function() {
        updateCartTotalUI();
    });
</script>