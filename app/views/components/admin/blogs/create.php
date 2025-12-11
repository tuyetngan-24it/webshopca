<style>
    :root {
        --primary: #3699ff;
        --bg-body: #151521;
        --bg-card: #1e1e2d;
        --text-main: #ffffff;
        --text-muted: #b5b5c3;
        --border-color: #323248;
    }

    .content-wrapper { background-color: var(--bg-body); padding: 20px; min-height: 100vh; font-family: 'Poppins', sans-serif; }

    .card-custom {
        background: var(--bg-card);
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        padding: 30px;
    }

    /* Form Styles giống hệt modal khách hàng */
    .form-group { margin-bottom: 20px; }
    
    .form-label {
        display: block; 
        margin-bottom: 8px; 
        color: var(--text-muted); 
        font-weight: 500;
        font-size: 14px;
    }
    
    .form-control {
        background: #151521;
        border: 1px solid #3a3a50;
        color: #fff;
        width: 100%;
        padding: 12px 15px;
        border-radius: 6px;
        box-sizing: border-box;
        transition: 0.3s;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
    }

    textarea.form-control { min-height: 120px; resize: vertical; }

    /* File Input */
    input[type="file"] { padding: 10px; height: auto; }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(54, 153, 255, 0.3);
        transition: 0.3s;
    }
    .btn-submit:hover { background: #0073e9; transform: translateY(-2px); }

    .btn-cancel {
        background: transparent;
        border: 1px solid #3a3a50;
        color: var(--text-muted);
        padding: 12px 25px;
        border-radius: 6px;
        text-decoration: none;
        margin-left: 10px;
        transition: 0.3s;
        display: inline-block;
    }
    .btn-cancel:hover { border-color: var(--text-muted); color: #fff; }
</style>

<div class="content-wrapper">
    <div style="margin-bottom: 25px;">
        <h3 style="margin: 0; color: #fff; font-weight: 600;">Thêm bài viết mới</h3>
        <p style="color: var(--text-muted); margin-top: 5px; font-size: 14px;">Tạo bài viết chia sẻ kiến thức nuôi cá</p>
    </div>
    
    <div class="card-custom">
        <form action="<?php echo ROOTLINK; ?>/admin/blogs/store" method="POST" enctype="multipart/form-data">
            
            <div style="display: flex; gap: 20px;">
                <div style="flex: 2;">
                    <div class="form-group">
                        <label class="form-label">Tiêu đề bài viết <span style="color: #f64e60;">*</span></label>
                        <input type="text" class="form-control" name="title" required placeholder="Nhập tiêu đề...">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mô tả ngắn (Description)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Mô tả hiển thị bên ngoài card..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nội dung chi tiết (Content) <span style="color: #f64e60;">*</span></label>
                        <textarea name="content" class="form-control" rows="10" placeholder="Viết nội dung ở đây..."></textarea>
                    </div>
                </div>

                <div style="flex: 1;">
                    <div class="form-group">
                        <label class="form-label">Danh mục <span style="color: #f64e60;">*</span></label>
                        <select name="category_id" class="form-control">
                            <?php foreach($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Hình ảnh đại diện</label>
                        <input type="file" name="image" class="form-control">
                        <p style="color: var(--text-muted); font-size: 12px; margin-top: 5px;">
                            <i>Khuyên dùng ảnh kích thước 800x600px</i>
                        </p>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Lưu bài viết
                </button>
                <a href="<?php echo ROOTLINK; ?>/admin/blogs/index" class="btn-cancel">Hủy bỏ</a>
            </div>

        </form>
    </div>
</div>  