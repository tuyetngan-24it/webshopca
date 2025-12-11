<style>
    :root {
        --bg-body: #151521;       /* Nền chính tối thẫm */
        --bg-card: #1e1e2d;       /* Nền card/bảng sáng hơn tí */
        --text-main: #e1e1e1;     /* Chữ trắng đục */
        --text-muted: #92929f;    /* Chữ xám mờ */
        --border-color: #2b2b40;  /* Viền tối */
        --primary: #3699ff;       /* Màu xanh điểm nhấn */
        --danger: #f64e60;
        --warning: #ffa800;
    }

    body { color: var(--text-main); font-family: sans-serif; }
    
    /* Input/Card Style đồng bộ */
    .card { background: var(--bg-card); border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.2); padding: 25px; }
    
    .form-control { 
        background: #151521; 
        border: 1px solid var(--border-color); 
        color: #fff; 
        width: 100%; padding: 12px; border-radius: 6px; box-sizing: border-box; 
        transition: border-color 0.3s;
    }
    .form-control:focus { border-color: var(--primary); outline: none; }

    .btn-primary {
        background: var(--primary); color: white; border: none; 
        padding: 12px 25px; border-radius: 6px; cursor: pointer; font-weight: 500; 
        box-shadow: 0 4px 10px rgba(54, 153, 255, 0.3);
        transition: 0.3s;
    }
    .btn-primary:hover { filter: brightness(1.1); }

    .btn-back {
        background: transparent; border: 1px solid var(--border-color); color: var(--text-muted);
        padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block;
        transition: 0.3s;
    }
    .btn-back:hover { background: #2b2b40; color: #fff; }

    label { font-weight: 600; margin-bottom: 8px; display: block; color: var(--text-main); }
    .text-danger { color: var(--danger); }
</style>

<div class="wrapper" style="display: flex; width: 100%; background: var(--bg-body);">
    
    <div class="main-content" style="width: 100%; background: var(--bg-body); min-height: 100vh; transition: 0.3s;">
        
        <nav class="topbar" style="background: var(--bg-card); padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color);">
            <div class="mobile-toggle">
                <button id="sidebarToggle" style="background: none; border: none; color: #fff; font-size: 20px; cursor: pointer;">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="user-info">
                <span style="color: var(--text-main); font-weight: 600;">Chỉnh sửa Danh Mục</span>
            </div>
        </nav>

        <div class="container-fluid" style="padding: 30px;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <div>
                    <h3 style="margin: 0; color: #fff; font-size: 22px;">Cập nhật thông tin</h3>
                    <p style="margin: 5px 0 0; color: var(--text-muted); font-size: 14px;">Chỉnh sửa ID: #<?= isset($category['id']) ? $category['id'] : 'N/A' ?></p>
                </div>
                <a href="<?= ROOTLINK ?>/admin/categories" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </a>
            </div>

            <div class="card">
                <?php if (!empty($category)): ?>
                <form action="<?= ROOTLINK ?>/admin/categories/update/<?= $category['id'] ?>" method="POST">
                    
                    <div class="form-group" style="margin-bottom: 25px;">
                        <label>Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" 
                               value="<?= htmlspecialchars($category['name']) ?>" 
                               required placeholder="Nhập tên danh mục...">
                        <small style="color: var(--text-muted); display: block; margin-top: 5px;">Tên danh mục hiển thị trên menu trang chủ.</small>
                    </div>

                    <div class="form-group" style="margin-bottom: 30px;">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control" rows="6" 
                                  placeholder="Nhập mô tả chi tiết..."><?= htmlspecialchars($category['description']) ?></textarea>
                    </div>

                    <div style="border-top: 1px solid var(--border-color); padding-top: 20px; text-align: right;">
                        <a href="<?= ROOTLINK ?>/admin/categories" style="color: var(--text-muted); margin-right: 20px; text-decoration: none; font-size: 15px;">Hủy bỏ</a>
                        <button type="submit" class="btn-primary">
                            <i class="fa-solid fa-save"></i> Lưu thay đổi
                        </button>
                    </div>
                </form>
                <?php else: ?>
                    <div style="text-align: center; padding: 50px;">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 40px; color: var(--warning); margin-bottom: 15px;"></i>
                        <h3 style="color: #fff;">Không tìm thấy danh mục!</h3>
                        <p style="color: var(--text-muted);">Có vẻ như danh mục này không tồn tại hoặc đã bị xóa.</p>
                        <a href="<?= ROOTLINK ?>/admin/categories" class="btn-back" style="margin-top: 15px;">Quay lại danh sách</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar'); // Giả sử sidebar ở file layout chung
    if(sidebarToggle && sidebar) sidebarToggle.onclick = () => sidebar.classList.toggle('active');
</script>