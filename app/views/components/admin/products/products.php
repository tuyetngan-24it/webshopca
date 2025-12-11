<style>
    :root {
        --bg-body: #151521;
        --bg-card: #1e1e2d;
        --text-main: #e1e1e1;
        --text-muted: #92929f;
        --border-color: #2b2b40;
        --primary: #3699ff;
        --danger: #f64e60;
        --warning: #ffa800;
        --success: #1bc5bd;
    }

    /* Table Style Dark Mode */
    .table-responsive {
        width: 100%;
        overflow-x: auto; /* Cho phép cuộn ngang */
        -webkit-overflow-scrolling: touch;
    }

    .table-dark { 
        width: 100%; 
        border-collapse: collapse; 
        min-width: 800px; /* UPDATE: Đảm bảo bảng không bị bóp méo trên mobile */
    }
    
    .table-dark th { background: #2b2b40; color: #fff; padding: 15px; text-align: left; font-weight: 600; font-size: 14px; white-space: nowrap; }
    .table-dark td { padding: 12px 15px; border-bottom: 1px solid var(--border-color); color: var(--text-muted); vertical-align: middle; font-size: 14px; }
    .table-dark tr:hover td { background: #262635; color: #fff; }

    /* Input & Modal Style */
    .form-control { 
        background: #151521; border: 1px solid var(--border-color); color: #fff; 
        width: 100%; padding: 10px; border-radius: 6px; box-sizing: border-box; 
    }
    .form-control:focus { border-color: var(--primary); outline: none; }
    
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); backdrop-filter: blur(2px); }
    .modal-content { 
        margin: 2% auto; 
        width: 800px; 
        max-width: 95%; /* Responsive width */
        background-color: var(--bg-card); 
        color: #fff; 
        border: 1px solid var(--border-color); 
        border-radius: 8px; 
        position: relative; 
        animation: slideDown 0.3s; 
        display: flex; 
        flex-direction: column; 
        max-height: 90vh; /* Giới hạn chiều cao để không trôi khỏi màn hình */
    }
    .modal-header { padding: 15px 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
    .modal-body { padding: 20px; overflow-y: auto; }
    .modal-footer { padding: 15px 20px; border-top: 1px solid var(--border-color); background: #1b1b29; text-align: right; border-radius: 0 0 8px 8px; }
    
    @keyframes slideDown { from {top: -30px; opacity: 0;} to {top: 0; opacity: 1;} }

    /* CKEditor Dark Mode Fix */
    .ck-editor__editable_inline {
        min-height: 200px;
        color: #000 !important;
        background-color: #fff !important;
    }

    /* --- CUSTOM CLASSES FOR LAYOUT --- */
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

    .form-row {
        display: flex; 
        gap: 20px; 
        margin-bottom: 15px;
    }

    .btn-add {
        background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 500; box-shadow: 0 4px 10px rgba(54, 153, 255, 0.3);
        white-space: nowrap;
    }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 768px) {
        .header-actions {
            flex-direction: column;
            align-items: stretch; /* Kéo dãn full width */
            gap: 15px;
        }

        .header-actions h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        .search-wrapper {
            margin: 0;
            max-width: 100%;
        }

        .btn-add {
            width: 100%;
        }

        .form-row {
            flex-direction: column; /* Chuyển hàng ngang thành dọc trong modal */
            gap: 15px;
        }

        .modal-content {
            margin: 5% auto; /* Tăng margin trên mobile */
            max-height: 85vh;
        }
    }
</style>

<div class="content-header" style="margin-bottom: 20px;">
    <div class="header-actions">
        <h3 style="margin: 0; color: #fff;">Quản lý Sản phẩm</h3>
        
        <div class="search-wrapper">
            <input type="text" id="searchProduct" onkeyup="searchTable()" placeholder="Tìm tên, giá, danh mục..." 
                style="width: 100%; padding: 10px 15px 10px 40px; border-radius: 20px; border: 1px solid #3a3a50; background: #151521; color: #fff; outline: none;">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
        </div>

        <button onclick="openModal()" class="btn-add">
            <i class="fa-solid fa-plus"></i> Thêm mới
        </button>
    </div>
</div>

<div class="card" style="background: var(--bg-card); border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.2);">
    <div class="table-responsive">
        <table class="table-dark">
            <thead>
                <tr>
                    <th style="width: 80px; border-top-left-radius: 8px;">Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Danh mục</th>
                    <th style="text-align: center;">Tồn kho</th>
                    <th style="text-align: center; border-top-right-radius: 8px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $item): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($item['img']) ?>"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #444;">
                            </td>
                            <td style="color: #fff; font-weight: 500; font-size: 15px;">
                                <?php echo htmlspecialchars($item['name']) ?>
                            </td>
                            <td style="color: var(--warning); font-weight: bold;">
                                <?php echo number_format($item['price'], 0, ',', '.') ?> đ
                            </td>
                            <td>
                                <span style="background: #2b2b40; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                    <?php echo htmlspecialchars($item['categoryName']) ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?php if($item['quantity'] > 0): ?>
                                    <span style="color: var(--success); font-weight: bold;"><?php echo $item['quantity'] ?></span>
                                <?php else: ?>
                                    <span style="color: var(--danger); font-weight: bold;">Hết hàng</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?php echo ROOTLINK ?>/admin/products/edit/<?php echo $item['id'] ?>" 
                                   style="color: var(--primary); margin-right: 15px; font-size: 16px;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?php echo ROOTLINK ?>/admin/products/delete/<?php echo $item['id'] ?>" 
                                   onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')" 
                                   style="color: var(--danger); font-size: 16px;">
                                   <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-muted);">
                            <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                            Chưa có sản phẩm nào.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="productModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4 style="margin: 0; font-size: 18px;">Thêm sản phẩm mới</h4>
            <span class="close-modal" onclick="closeModal()" style="cursor: pointer; font-size: 24px; color: #aaa;">&times;</span>
        </div>

        <form action="<?php echo ROOTLINK ?>/admin/products/addProducts" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
            <div class="modal-body">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="color: var(--text-muted); margin-bottom: 5px; display: block;">Tên sản phẩm <span style="color: var(--danger)">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="Nhập tên sản phẩm...">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="color: var(--text-muted); margin-bottom: 5px; display: block;">Danh mục <span style="color: var(--danger)">*</span></label>
                    <select name="categoryId" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group" style="flex: 1;">
                        <label style="color: var(--text-muted); margin-bottom: 5px; display: block;">Giá bán (VNĐ) <span style="color: var(--danger)">*</span></label>
                        <input type="number" name="price" class="form-control" required placeholder="0">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label style="color: var(--text-muted); margin-bottom: 5px; display: block;">Số lượng kho</label>
                        <input type="number" name="quantity" class="form-control" value="100">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="color: var(--text-muted); margin-bottom: 5px; display: block;">Hình ảnh <span style="color: var(--danger)">*</span></label>
                    <input type="file" name="img" class="form-control" accept="image/*" required style="padding: 7px;">
                </div>

                <div class="form-group">
                    <label style="color: var(--text-muted); margin-bottom: 5px; display: block;">Mô tả chi tiết</label>
                    <textarea name="description" id="editor"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeModal()" style="padding: 8px 15px; border: 1px solid #3a3a50; background: transparent; color: #fff; border-radius: 4px; cursor: pointer; margin-right: 10px;">Hủy</button>
                <button type="submit" style="padding: 8px 20px; border: none; background: var(--primary); color: white; border-radius: 4px; cursor: pointer;">Lưu sản phẩm</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
    // --- 1. Xử lý Modal ---
    const modal = document.getElementById('productModal');

    function openModal() {
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }

    // --- 2. Khởi tạo CKEditor ---
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    // --- 3. CHỨC NĂNG TÌM KIẾM SẢN PHẨM ---
    function searchTable() {
        var input = document.getElementById("searchProduct");
        var filter = input.value.toLowerCase();
        
        var table = document.querySelector(".table-dark");
        var tbody = table.getElementsByTagName("tbody")[0];
        var rows = tbody.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            var tdName = rows[i].getElementsByTagName("td")[1];
            var tdPrice = rows[i].getElementsByTagName("td")[2];
            var tdCat = rows[i].getElementsByTagName("td")[3];

            if (tdName || tdPrice || tdCat) {
                var txtName = tdName.textContent || tdName.innerText;
                var txtPrice = tdPrice.textContent || tdPrice.innerText;
                var txtCat = tdCat.textContent || tdCat.innerText;
                var cleanPrice = txtPrice.replace(/[.,đ]/g, '');

                if (
                    txtName.toLowerCase().indexOf(filter) > -1 || 
                    txtCat.toLowerCase().indexOf(filter) > -1 ||
                    cleanPrice.indexOf(filter) > -1
                ) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }       
        }
    }
</script>