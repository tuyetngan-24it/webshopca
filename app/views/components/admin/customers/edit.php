<div class="content-header">
    <h1>Chỉnh sửa Khách hàng</h1>
</div>

<div class="container-fluid" style="padding: 20px;">
    <div class="card" style="background: var(--bg-card); padding: 20px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.2);">
        
        <form action="<?= ROOTLINK ?>/admin/customers/update/<?= $customer['id'] ?>" method="POST">
            
            <div class="row">
                <div class="col-md-6" style="width: 48%; display: inline-block; vertical-align: top; margin-right: 2%;">
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="color: var(--text-muted); display: block; margin-bottom: 8px;">Username <span style="color: var(--danger)">*</span></label>
                        <input type="text" name="username" class="form-control" 
                               value="<?= htmlspecialchars($customer['username']) ?>" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="color: var(--text-muted); display: block; margin-bottom: 8px;">Họ và tên <span style="color: var(--danger)">*</span></label>
                        <input type="text" name="name" class="form-control" 
                               value="<?= htmlspecialchars($customer['name']) ?>" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="color: var(--text-muted); display: block; margin-bottom: 8px;">Email <span style="color: var(--danger)">*</span></label>
                        <input type="email" name="email" class="form-control" 
                               value="<?= htmlspecialchars($customer['email']) ?>" required>
                    </div>
                </div>

                <div class="col-md-6" style="width: 48%; display: inline-block; vertical-align: top;">
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="color: var(--text-muted); display: block; margin-bottom: 8px;">Số điện thoại</label>
                        <input type="text" name="numberPhone" class="form-control" 
                               value="<?= htmlspecialchars($customer['numberPhone']) ?>">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="color: var(--text-muted); display: block; margin-bottom: 8px;">Đổi mật khẩu</label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="Để trống nếu không muốn đổi">
                        <small style="color: #666; font-style: italic;">Nhập vào đây nếu muốn reset mật khẩu cho khách.</small>
                    </div>
                </div>
            </div>

            <div style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 20px; text-align: right;">
                <a href="<?= ROOTLINK ?>/admin/customers" style="padding: 10px 20px; color: var(--text-muted); text-decoration: none; margin-right: 10px;">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 10px 25px; border-radius: 6px; cursor: pointer; font-weight: 600;">
                    <i class="fa-solid fa-save"></i> Lưu cập nhật
                </button>
            </div>

        </form>
    </div>
</div>