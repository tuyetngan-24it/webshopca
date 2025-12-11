<style>
    :root {
        --bg-body: #151521;
        /* Nền chính tối thẫm */
        --bg-card: #1e1e2d;
        /* Nền card/bảng sáng hơn tí */
        --text-main: #e1e1e1;
        /* Chữ trắng đục */
        --text-muted: #92929f;
        /* Chữ xám mờ */
        --border-color: #2b2b40;
        /* Viền tối */
        --primary: #3699ff;
        /* Màu xanh điểm nhấn */
        --danger: #f64e60;
        --warning: #ffa800;
    }

    body {
        color: var(--text-main);
    }

    /* Override scrollbar cho đẹp */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-body);
    }

    ::-webkit-scrollbar-thumb {
        background: #555;
        border-radius: 4px;
    }

    /* Table Style */
    .table-dark {
        width: 100%;
        border-collapse: collapse;
    }

    .table-dark th {
        background: #2b2b40;
        color: #fff;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }

    .table-dark td {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-muted);
        vertical-align: middle;
    }

    .table-dark tr:hover td {
        background: #262635;
        color: #fff;
    }

    /* Input/Modal Style */
    .form-control {
        background: #151521;
        border: 1px solid var(--border-color);
        color: #fff;
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
    }

    .modal-content {
        background-color: var(--bg-card);
        color: #fff;
        border: 1px solid var(--border-color);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
        background: #1b1b29;
    }

    .close-modal {
        color: var(--text-muted);
    }

    .close-modal:hover {
        color: #fff;
    }

    /* =============================================
   RESPONSIVE CSS (MOBILE & TABLET)
============================================= */
    @media (max-width: 768px) {

        /* 1. Xử lý Header (Tiêu đề và Nút thêm) */
        .page-header-flex {
            flex-direction: column;
            /* Xếp dọc */
            align-items: flex-start !important;
            gap: 15px;
        }

        .page-header-flex button {
            width: 100%;
            /* Nút bấm full chiều rộng cho dễ ấn */
            justify-content: center;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* 2. Xử lý Bảng (Table) */
        /* Tạo thanh cuộn ngang cho bảng khi màn hình nhỏ */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* Cuộn mượt trên iOS */
        }

        .table-dark {
            min-width: 600px;
            /* Đảm bảo bảng không bị co dúm lại */
        }

        /* 3. Xử lý Modal */
        .modal-content {
            width: 90% !important;
            /* Chiếm 90% màn hình đt */
            margin: 15% auto;
            /* Căn giữa */
        }

        /* 4. Tinh chỉnh padding chung */
        .container-fluid {
            padding: 10px !important;
        }

        .topbar {
            padding: 10px 15px !important;
        }
    }
</style>

<div class="wrapper" style="display: flex; width: 100%; background: var(--bg-body);">



    <div class="main-content" style="width: 100%; background: var(--bg-body); min-height: 100vh; transition: 0.3s;">

        <div class="container-fluid" style="padding: 20px;">

            <div class="page-header-flex" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h3 style="margin: 0; color: #fff;">Danh sách Danh mục</h3>
                <button id="btnOpenModal" style="background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 500; box-shadow: 0 4px 10px rgba(54, 153, 255, 0.3);">
                    <i class="fa-solid fa-plus"></i> Thêm danh mục
                </button>
            </div>

            <div class="card" style="background: var(--bg-card); border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.2); overflow: hidden;">

                <div class="table-responsive">
                    <table class="table-dark">
                        <thead>
                            <tr>
                                <th style="border-top-left-radius: 8px;">ID</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th style="text-align: center; border-top-right-radius: 8px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): ?>
                                <?php $count = 0 ?>
                                <?php foreach ($categories as $cat): ?>
                                    <?php $count++ ?>
                                    <tr>
                                        <td>#<?= $count ?></td>
                                        <td style="color: #fff; font-weight: 500;"><?= htmlspecialchars($cat['name']) ?></td>
                                        <td><?= htmlspecialchars($cat['description']) ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?= ROOTLINK ?>/admin/categories/edit/<?= $cat['id'] ?>" style="color: var(--warning); margin-right: 15px; font-size: 16px;">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href="<?= ROOTLINK ?>/admin/categories/delete/<?= $cat['id'] ?>" onclick="return confirm('Xóa thật hả?')" style="color: var(--danger); font-size: 16px;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-muted);">
                                        <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                        Chưa có dữ liệu nào cả bro!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
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
        width: 500px;
        max-width: 95%;
        border-radius: 8px;
        position: relative;
        animation: slideDown 0.3s;
    }

    .modal-header {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 15px 20px;
        text-align: right;
        border-radius: 0 0 8px 8px;
    }

    @keyframes slideDown {
        from {
            top: -30px;
            opacity: 0;
        }

        to {
            top: 0;
            opacity: 1;
        }
    }
</style>

<div id="addCategoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4 style="margin: 0; color: #fff;">Thêm danh mục mới</h4>
            <span class="close-modal" style="cursor: pointer; font-size: 24px;">&times;</span>
        </div>

        <form action="<?= ROOTLINK ?>/admin/categories/addCategories" method="POST">
            <div class="modal-body">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Tên danh mục <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="Nhập tên danh mục...">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-muted);">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả ngắn..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="close-btn-action" style="padding: 8px 15px; border: 1px solid #3a3a50; background: transparent; color: #fff; border-radius: 4px; cursor: pointer; margin-right: 10px;">Hủy</button>
                <button type="submit" style="padding: 8px 20px; border: none; background: var(--primary); color: white; border-radius: 4px; cursor: pointer;">Lưu lại</button>
            </div>
        </form>
    </div>
</div>


<div id="toast" class="toast">
    <div class="toast-icon"><i class="fa-solid fa-check"></i></div>
    <div class="toast-body">
        <h4 class="toast-title">Thành công!</h4>
        <p class="toast-message">Thêm nhân viên mới thành công.</p>
    </div>
</div>

<style>
    /* Toast CSS */
    .toast {
        visibility: hidden;
        /* Mặc định ẩn */
        min-width: 300px;
        background-color: #1e1e2d;
        /* Nền tối trùng card */
        border-left: 5px solid #4caf50;
        /* Viền xanh lá */
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 16px;
        position: fixed;
        z-index: 10000;
        left: 20px;
        /* Hiện ở góc trái dưới */
        bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        transform: translateX(-100%);
        /* Dịch sang trái để ẩn hẳn */
        transition: transform 0.5s ease, visibility 0.5s;
    }

    .toast.show {
        visibility: visible;
        transform: translateX(0);
        /* Trượt ra */
    }

    .toast-icon {
        font-size: 24px;
        color: #4caf50;
        margin-right: 15px;
    }

    .toast-body {
        text-align: left;
    }

    .toast-title {
        margin: 0 0 5px 0;
        font-size: 16px;
        font-weight: bold;
    }

    .toast-message {
        margin: 0;
        font-size: 14px;
        color: #b5b5c3;
    }
</style>

<script>
    const modal = document.getElementById("addCategoryModal");
    const btnOpen = document.getElementById("btnOpenModal");
    const btnCloseList = document.querySelectorAll(".close-modal, .close-btn-action");

    if (btnOpen) btnOpen.onclick = () => modal.style.display = "block";
    btnCloseList.forEach(btn => btn.onclick = () => modal.style.display = "none");
    window.onclick = (e) => {
        if (e.target == modal) modal.style.display = "none";
    }

    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (sidebarToggle && sidebar) sidebarToggle.onclick = () => sidebar.classList.toggle('active');
</script>