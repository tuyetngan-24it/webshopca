<style>
    :root {
        --primary: #3699ff;
        --bg-body: #151521;
        --bg-card: #1e1e2d;
        --text-main: #ffffff;
        --text-muted: #b5b5c3;
        --border-color: #323248;
        --danger: #f64e60;
        --warning: #ffa800;
        --success: #1bc5bd;
    }

    .content-header { margin-bottom: 20px; }
    
    /* Layout Header Action */
    .header-actions {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 25px;
    }
    
    .search-wrapper {
        flex: 1; 
        max-width: 400px; 
        margin: 0 20px; 
        position: relative;
    }

    .btn-add {
        background: var(--primary); 
        color: white; 
        border: none; 
        padding: 10px 20px; 
        border-radius: 6px; 
        cursor: pointer; 
        font-weight: 500; 
        box-shadow: 0 4px 10px rgba(54, 153, 255, 0.3);
        white-space: nowrap;
    }

    /* Table Styles */
    .card-custom {
        background: var(--bg-card); 
        border-radius: 8px; 
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        overflow: hidden;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-dark {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px; /* Đảm bảo bảng không bị co dúm trên mobile */
    }

    .table-dark th {
        background-color: #1b1b29;
        color: var(--text-muted);
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        white-space: nowrap;
    }

    .table-dark td {
        padding: 15px;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(2px);
    }

    .modal-content {
        margin: 5% auto;
        width: 600px;
        max-width: 95%; /* Responsive width */
        border-radius: 8px;
        position: relative;
        animation: slideDown 0.3s;
        background-color: var(--bg-card);
        color: #fff;
        border: 1px solid var(--border-color);
    }

    .modal-header {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
    }

    .modal-body { padding: 20px; }

    .form-row-2col {
        display: flex; 
        gap: 15px;
    }

    .form-group { margin-bottom: 15px; }

    .form-control {
        background: #151521;
        border: 1px solid var(--border-color);
        color: #fff;
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        box-sizing: border-box;
    }
    .form-control:focus { border-color: var(--primary); outline: none; }

    .modal-footer {
        padding: 15px 20px;
        text-align: right;
        border-radius: 0 0 8px 8px;
        border-top: 1px solid var(--border-color);
        background: #1b1b29;
    }

    @keyframes slideDown {
        from { top: -30px; opacity: 0; }
        to { top: 0; opacity: 1; }
    }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 10px !important;
        }

        /* Header xếp dọc */
        .header-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .header-actions h3 {
            text-align: center;
            font-size: 24px;
        }

        .search-wrapper {
            margin: 0;
            max-width: 100%;
            width: 100%;
        }

        .btn-add {
            width: 100%;
        }

        /* Modal: Chuyển hàng ngang thành hàng dọc */
        .form-row-2col {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<div class="content-header">
    <h1>Quản lý Khách hàng</h1>
</div>

<div class="container-fluid" style="padding: 20px;">

   <div class="header-actions">
        <h3 style="margin: 0; color: #fff;">Danh sách Khách hàng</h3>
        
        <div class="search-wrapper">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Tìm kiếm (Tên, Email, SĐT)..." 
                style="width: 100%; padding: 10px 15px; border-radius: 20px; border: 1px solid #3a3a50; background: #151521; color: #fff; outline: none;">
            <i class="fa-solid fa-search" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
        </div>

        <button id="btnOpenModal" class="btn-add">
            <i class="fa-solid fa-plus"></i> Thêm mới
        </button>
    </div>

    <div class="card-custom">
        <div class="table-responsive">
            <table class="table-dark">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 8px;">ID</th>
                        <th>Username</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th style="text-align: center; border-top-right-radius: 8px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers) && mysqli_num_rows($customers) > 0): ?>
                        <?php foreach ($customers as $cus): ?>
                            <tr>
                                <td>#<?= $cus['id'] ?></td>
                                <td style="color: var(--primary); font-weight: bold;"><?= htmlspecialchars($cus['username']) ?></td>
                                <td style="color: #fff;"><?= htmlspecialchars($cus['name']) ?></td>
                                <td><?= htmlspecialchars($cus['email']) ?></td>
                                <td><?= htmlspecialchars($cus['numberPhone']) ?></td>

                                <td style="text-align: center;">
                                    <a href="<?= ROOTLINK ?>/admin/customers/edit/<?= $cus['id'] ?>" style="color: var(--warning); margin-right: 15px; font-size: 16px;">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="<?= ROOTLINK ?>/admin/customers/delete/<?= $cus['id'] ?>" onclick="return confirm('Xóa khách hàng <?= $cus['username'] ?>?')" style="color: var(--danger); font-size: 16px;">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-muted);">
                                <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                Chưa có dữ liệu nào cả!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="addCustomerModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4 style="margin: 0; color: #fff;">Thêm khách hàng mới</h4>
            <span class="close-modal" style="cursor: pointer; font-size: 24px;">&times;</span>
        </div>

        <form action="<?= ROOTLINK ?>/admin/customers/addCustomer" method="POST">
            <div class="modal-body">

                <div class="form-row-2col">
                    <div class="form-group" style="flex: 1;">
                        <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Username <span style="color: var(--danger);">*</span></label>
                        <input type="text" name="username" class="form-control" required placeholder="VD: user123">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Họ tên <span style="color: var(--danger);">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="VD: Nguyễn Văn A">
                    </div>
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Email <span style="color: var(--danger);">*</span></label>
                    <input type="email" name="email" class="form-control" required placeholder="VD: abc@gmail.com">
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Số điện thoại</label>
                    <input type="text" name="numberPhone" class="form-control" placeholder="090xxxxxxx">
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Mật khẩu <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="password" class="form-control" required placeholder="Nhập mật khẩu...">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="close-btn-action" style="padding: 8px 15px; border: 1px solid #3a3a50; background: transparent; color: #fff; border-radius: 4px; cursor: pointer; margin-right: 10px;">Hủy</button>
                <button type="submit" style="padding: 8px 20px; border: none; background: var(--primary); color: white; border-radius: 4px; cursor: pointer;">Lưu lại</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById("addCustomerModal");
    const btnOpen = document.getElementById("btnOpenModal");
    const btnCloseList = document.querySelectorAll(".close-modal, .close-btn-action");

    if (btnOpen) btnOpen.onclick = () => modal.style.display = "block";
    btnCloseList.forEach(btn => btn.onclick = () => modal.style.display = "none");
    window.onclick = (e) => {
        if (e.target == modal) modal.style.display = "none";
    }
</script>
<script>
    function searchTable() {
        var input = document.getElementById("searchInput");
        var filter = input.value.toLowerCase();
        
        var table = document.querySelector(".table-dark"); 
        var tr = table.getElementsByTagName("tr");
        var tbody = table.getElementsByTagName("tbody")[0];
        var rows = tbody.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            var tdUsername = rows[i].getElementsByTagName("td")[1]; 
            var tdName = rows[i].getElementsByTagName("td")[2];
            var tdEmail = rows[i].getElementsByTagName("td")[3];
            var tdPhone = rows[i].getElementsByTagName("td")[4];

            if (tdUsername || tdName || tdEmail || tdPhone) {
                var txtUsername = tdUsername.textContent || tdUsername.innerText;
                var txtName = tdName.textContent || tdName.innerText;
                var txtEmail = tdEmail.textContent || tdEmail.innerText;
                var txtPhone = tdPhone.textContent || tdPhone.innerText;

                if (
                    txtUsername.toLowerCase().indexOf(filter) > -1 || 
                    txtName.toLowerCase().indexOf(filter) > -1 || 
                    txtEmail.toLowerCase().indexOf(filter) > -1 || 
                    txtPhone.toLowerCase().indexOf(filter) > -1
                ) {
                    rows[i].style.display = ""; 
                } else {
                    rows[i].style.display = "none"; 
                }
            }       
        }
    }
</script>