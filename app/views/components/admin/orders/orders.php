<div class="content-header" style="margin-bottom: 20px;">
    <h1 class="page-title" style="color: #fff; font-size: 24px; font-weight: 700;">Quản lý Đơn hàng</h1>
</div>

<div class="container-fluid" style="padding: 0 20px 20px 20px;">

    <div class="action-bar" style="display: flex; justify-content: flex-end; margin-bottom: 15px;">
        <div class="search-box">
            <input type="text" id="searchOrder" onkeyup="searchTable()" placeholder="Tìm kiếm đơn hàng..." class="search-input">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
        </div>
    </div>

    <div class="table-container">
        <table class="table-flat" id="orderTable">
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 15%;">KHÁCH HÀNG</th>
                    <th style="width: 15%;">ĐỊA CHỈ</th>
                    <th style="width: 12%;">TỔNG TIỀN</th>
                    <th style="width: 13%;">THANH TOÁN</th>
                    <th style="width: 13%;">VẬN CHUYỂN</th>
                    <th style="width: 15%;">NGÀY ĐẶT</th>
                    <th style="width: 10%; text-align: center;">CẬP NHẬT</th>
                    <th style="width: 8%; text-align: center;">XÓA</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $item): ?>
                        <tr>
                            <td><span class="id-text">#<?= $item['id'] ?></span></td>
                            
                            <td>
                                <span class="user-text"><?= $item['username'] ?></span>
                            </td>
                            
                            <td style="color: #ccc; min-width: 150px;"><?=  $item['street'] ." ". $item['ward'] ." ". $item['province']  ?></td>
                            
                            <td>
                                <span class="money-text"><?= number_format($item['total'], 0, ',', '.') ?> đ</span>
                            </td>
                            
                            <td>
                                <?php if($item['status'] == 'paid'): ?>
                                    <span class="status-pill success">Đã thanh toán</span>
                                <?php else: ?>
                                    <span class="status-pill warning">Chờ thanh toán</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php 
                                    $classStatus = 'secondary';
                                    $txtStatus = $item['deliveryStatus'];
                                    
                                    if($txtStatus == 'pending') $classStatus = 'warning';
                                    if($txtStatus == 'shipping') $classStatus = 'info';
                                    if($txtStatus == 'delivered') $classStatus = 'success';
                                    if($txtStatus == 'cancelled') $classStatus = 'danger';
                                ?>
                                <span class="status-pill <?= $classStatus ?>"><?= ucfirst($txtStatus) ?></span>
                            </td>

                            <td style="color: #ccc;">
                                <?= date('d/m/Y H:i', strtotime($item['created_at'])) ?>
                            </td>
                            
                            <td style="text-align: center;">
                                <button onclick="openEditModal(<?= $item['id'] ?>, '<?= $item['deliveryStatus'] ?>')" class="btn-xu-ly">
                                    <i class="fa-solid fa-truck-fast"></i> Xử lý
                                </button>
                            </td>

                            <td style="text-align: center;">
                                <a href="<?= ROOTLINK ?>/admin/orders/delete/<?= $item['id'] ?>" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng #<?= $item['id'] ?>?')"
                                   class="btn-trash">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9" style="text-align: center; padding: 30px; color: #888;">Không có dữ liệu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="statusModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật đơn hàng <span id="displayOrderId"></span></h4>
                <span class="close-modal">&times;</span>
            </div>
            <form action="<?= ROOTLINK ?>/admin/orders/updateStatus" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="order_id" id="modalOrderId">
                    <div class="form-group">
                        <label class="form-label">Trạng thái vận chuyển</label>
                        <div class="select-wrapper">
                            <select name="deliveryStatus" id="modalStatus" class="form-control custom-select">
                                <option value="pending">Waiting (Chờ xử lý)</option>
                                <option value="shipping">Shipping (Đang giao)</option>
                                <option value="delivered">Delivered (Đã giao)</option>
                                <option value="cancelled">Cancelled (Đã hủy)</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal btn-cancel close-btn-action">Hủy</button>
                    <button type="submit" class="btn-modal btn-save">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Tổng thể */
    .table-container {
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        /* UPDATE: Thêm thuộc tính này để cuộn ngang trên mobile */
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; 
        background-color: #2b2b2b;
    }

    .table-flat {
        width: 100%;
        border-collapse: collapse;
        background-color: #2b2b2b;
        font-family: 'Segoe UI', sans-serif;
        /* UPDATE: Min-width để đảm bảo bảng không bị bóp méo khi màn hình nhỏ */
        min-width: 1000px; 
    }

    /* HEADER XANH ĐẬM */
    .table-flat thead th {
        background-color: #103454;
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 18px 15px;
        text-align: left;
        border: none;
        white-space: nowrap; /* UPDATE: Giữ tiêu đề trên 1 dòng */
    }

    /* DÒNG DỮ LIỆU */
    .table-flat tbody tr {
        border-bottom: 1px solid #3d3d3d;
        transition: background 0.2s;
    }
    .table-flat tbody tr:hover {
        background-color: #363636;
    }

    .table-flat td {
        padding: 15px;
        color: #e0e0e0;
        font-size: 14px;
        vertical-align: middle;
    }

    /* ID */
    .id-text { color: #aaa; }

    /* Tên khách hàng (Bold trắng) */
    .user-text {
        font-weight: 700;
        color: #fff;
        font-size: 15px;
    }

    /* Tiền (Xanh lá sáng) */
    .money-text {
        color: #4cd137;
        font-weight: 700;
        white-space: nowrap; /* Không xuống dòng tiền */
    }

    /* BADGE TRẠNG THÁI */
    .status-pill {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        min-width: 100px;
        white-space: nowrap;
    }

    .status-pill.warning { background-color: #3b3018; color: #fbc531; border: 1px solid #5c4b1e; }
    .status-pill.success { background-color: #1e3b28; color: #4cd137; border: 1px solid #2a5236; }
    .status-pill.info { background-color: #182e45; color: #00a8ff; border: 1px solid #204060; }
    .status-pill.danger { background-color: #401818; color: #e84118; border: 1px solid #602020; }

    /* NÚT XỬ LÝ */
    .btn-xu-ly {
        background: transparent;
        color: #fff;
        border: 1px solid #555;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: 0.2s;
        white-space: nowrap;
    }
    .btn-xu-ly:hover { background: #fff; color: #000; }

    /* NÚT THÙNG RÁC */
    .btn-trash {
        color: #fff;
        font-size: 14px;
        opacity: 0.7;
        transition: 0.2s;
        cursor: pointer;
    }
    .btn-trash:hover { opacity: 1; color: #e84118; }

    /* SEARCH BOX */
    .search-box { position: relative; }
    .search-input {
        background: #2b2b2b;
        border: 1px solid #444;
        padding: 8px 15px 8px 35px;
        border-radius: 4px;
        color: #fff;
        outline: none;
        width: 250px; /* Default width */
        transition: width 0.3s;
    }
    .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
    }

    /* MODAL STYLE */
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); backdrop-filter: blur(5px); }
    .modal-dialog { 
        position: absolute; 
        top: 50%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
        width: 100%; 
        max-width: 420px; 
        padding: 0 15px; /* Thêm padding để không dính mép màn hình mobile */
    }
    .modal-content { background: #1e1e2d; border-radius: 10px; border: 1px solid #333; overflow: hidden; }
    .modal-header { padding: 15px 20px; border-bottom: 1px solid #333; display: flex; justify-content: space-between; align-items: center; background: #151520; }
    .modal-title { margin: 0; color: #fff; font-size: 16px; }
    .close-modal { color: #aaa; font-size: 20px; cursor: pointer; }
    .modal-body { padding: 20px; }
    .form-group { margin-bottom: 0; }
    .form-label { display: block; margin-bottom: 8px; color: #aaa; font-size: 13px; }
    .custom-select { width: 100%; padding: 10px; background: #111; border: 1px solid #444; color: #fff; border-radius: 5px; outline: none; }
    .modal-footer { padding: 15px 20px; background: #151520; border-top: 1px solid #333; display: flex; justify-content: flex-end; gap: 10px; }
    .btn-modal { padding: 8px 15px; border-radius: 5px; cursor: pointer; border: none; font-size: 13px; font-weight: 600; }
    .btn-cancel { background: transparent; color: #aaa; border: 1px solid #444; }
    .btn-save { background: #0d6efd; color: #fff; }

    /* --- RESPONSIVE CSS (NEW) --- */
    @media (max-width: 768px) {
        /* Container giảm padding */
        .container-fluid {
            padding: 0 10px 10px 10px !important;
        }

        /* Tiêu đề nhỏ lại và căn giữa */
        .page-title {
            font-size: 20px !important;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Thanh Action (Search) thành cột dọc */
        .action-bar {
            flex-direction: column;
            width: 100%;
        }

        /* Ô tìm kiếm full width */
        .search-box {
            width: 100%;
        }
        .search-input {
            width: 100%; /* Full màn hình */
        }

        /* Modal responsive */
        .modal-dialog {
            width: 95%; /* Chiếm 95% màn hình */
            max-width: none;
        }
    }
</style>

<script>
    const modal = document.getElementById("statusModal");
    const closeBtns = document.querySelectorAll(".close-modal, .close-btn-action");

    function openEditModal(id, currentStatus) {
        var inputId = document.getElementById("modalOrderId");
        if (inputId) inputId.value = id;
        document.getElementById("modalStatus").value = currentStatus;
        document.getElementById("displayOrderId").innerText = "#" + id;
        modal.style.display = "block";
    }

    closeBtns.forEach(btn => btn.onclick = () => modal.style.display = "none");
    window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; }

    function searchTable() {
        var input = document.getElementById("searchOrder");
        var filter = input.value.toLowerCase();
        var rows = document.getElementById("orderTable").getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            var found = false;
            if(cells.length > 1) {
                if (cells[0].innerText.toLowerCase().indexOf(filter) > -1 || 
                    cells[1].innerText.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
            rows[i].style.display = found ? "" : "none";
        }
    }
</script>