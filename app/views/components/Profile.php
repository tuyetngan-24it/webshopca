<?php
// Lấy dữ liệu user
$user = isset($data['user_info']) ? $data['user_info'] : (isset($_SESSION['user']) ? $_SESSION['user'] : []);
$username   = isset($user['username']) ? $user['username'] : '';
$email      = isset($user['email']) ? $user['email'] : '';
$avatarFile = isset($user['avatar']) ? $user['avatar'] : '';
$avatarPath = !empty($avatarFile) ? ROOTLINK . '/public/uploads/' . $avatarFile : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=200';
?>



<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOTLINK ?>/public/assets/css/homePage.css">

<div class="profile-wrapper">
    <div class="container">
        <div class="profile-grid">

            <?php foreach ($info as $info): ?>  
                <aside class="user-sidebar">
                    <div class="avatar-box" onclick="openModal('editProfileModal')">
                        <img src="<?php echo ROOTLINK . '/public/uploads/' .  $info['avatar']; ?>" alt="Avatar" style="object-fit: cover;">
                        <div class="avatar-overlay"><i class="fa-solid fa-camera"></i></div>
                    </div>

                    <h3 class="user-name"><?php echo $name ?></h3>
                    <div class="user-username">@<?php echo $username; ?></div>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <div class="info-value"><i class="fa-solid fa-envelope"></i> <?php echo $info['email']; ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Số điện thoại</span>
                            <div class="info-value"><i class="fa-solid fa-phone"></i> <?php echo $numberPhone; ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Mật khẩu</span>
                            <div class="info-value"><i class="fa-solid fa-lock"></i> ••••••••••</div>
                        </div>
                    </div>
                    <button class="btn-edit-profile" onclick="openModal('editProfileModal')">
                        <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa hồ sơ
                    </button>
                </aside>
          

            <main class="address-panel">
                <div class="panel-header">
                    <div class="panel-title">Địa chỉ nhận hàng</div>
                    <button class="btn-add-addr" onclick="openModal('addressModal')">
                        <i class="fa-solid fa-plus"></i> Thêm địa chỉ mới
                    </button>
                </div>

                <div class="address-list">
                    <?php if (isset($data['my_addresses']) && mysqli_num_rows($data['my_addresses']) > 0): ?>
                        <?php foreach ($data['my_addresses'] as $addr): ?>
                            <div class="address-item">
                                <div class="addr-info">
                                    <h4>
                                        <?php echo $addr['receiverName']; ?>
                                    </h4>
                                    <div class="addr-phone"><i class="fa-solid fa-phone-flip"></i> <?php echo $addr['phone']; ?></div>
                                    <div class="addr-text">
                                        <?php echo $addr['street']; ?>,
                                        <?php echo isset($addr['ward']) ? $addr['ward'] : ''; ?>,
                                        <?php echo isset($addr['province']) ? $addr['province'] : ''; ?>
                                    </div>
                                </div>
                                <div class="addr-actions">
                                    <form action="<?php echo ROOTLINK ?>/profile/deleteAddress" method="post">
                                        <input type="text" name="id" id="" value="<?php echo $addr['addressid']; ?>" hidden>
                                        <button type="submit"
                                            class="btn-delete"
                                            onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')"
                                            title="Xóa địa chỉ">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>


                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="padding: 20px; color: #666;">Chưa có địa chỉ nào.</p>
                    <?php endif; ?>
                </div>
            </main>

        </div>
    </div>
</div>

<div id="addressModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Thêm địa chỉ mới</h3>
            <span class="close-modal" onclick="closeModal('addressModal')">&times;</span>
        </div>
        <form action="<?php echo ROOTLINK ?>/profile/addAddress" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label>Họ tên người nhận</label>
                    <input type="text" class="form-control" name="receiver_name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $numberPhone; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Tỉnh/Thành phố</label>
                    <select class="form-control provinces" name="province_id" onchange="" required>
                        <option value="">-- Chọn Tỉnh/Thành --</option>
                    </select>
                    <input type="hidden" name="province_name" id="province_name_hidden">
                </div>
            </div>

            <div class="form-group">
                <label>Phường/Xã</label>
                <select class="form-control wards" name="ward_id" id="wardSelect" required>
                    <option value="">-- Vui lòng chọn Tỉnh trước --</option>
                </select>
                <input type="hidden" name="ward_name" id="ward_name_hidden">
            </div>

            <div class="form-group">
                <label>Địa chỉ cụ thể</label>
                <input type="text" class="form-control" name="street_detail" placeholder="Số nhà, tên đường..." required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('addressModal')">Hủy bỏ</button>
                <button type="submit" class="btn-save">Lưu địa chỉ</button>
            </div>
        </form>
    </div>
</div>

<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Chỉnh sửa hồ sơ</h3>
            <span class="close-modal" onclick="closeModal('editProfileModal')">&times;</span>
        </div>
        <form action="<?php echo ROOTLINK ?>/profile/update" method="POST" enctype="multipart/form-data">
            <div class="avatar-upload-area">
                <div class="preview-box">
                    <img id="avatarPreview" src="<?php echo $avatarPath; ?>" style="object-fit: cover;">
                </div>
                <label for="avatarInput" class="btn-upload-img"><i class="fa-solid fa-camera"></i> Chọn ảnh mới</label>
                <input type="file" id="avatarInput" name="avatar" hidden accept="image/*" onchange="previewImage(this)">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" value="<?php echo $username; ?>" disabled style="opacity: 0.6;">
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $info['email']; ?>">
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $numberPhone; ?>">
            </div>
            <div class="form-group">
                <label>Đổi mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('editProfileModal')">Hủy bỏ</button>
                <button type="submit" class="btn-save">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
  <?php endforeach ?>
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) event.target.classList.remove('show');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // AJAX Load Phường/Xã
    function loadWards(provinceId) {
        var wardSelect = document.getElementById('wardSelect');
        wardSelect.innerHTML = '<option value="">Đang tải...</option>';
        if (!provinceId) {
            wardSelect.innerHTML = '<option value="">-- Vui lòng chọn Tỉnh trước --</option>';
            return;
        }
        fetch('<?php echo ROOTLINK ?>/profile/getWards?province_id=' + provinceId)
            .then(response => response.json())
            .then(data => {
                wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                data.forEach(item => {
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.name;
                    wardSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Lỗi:', error);
                wardSelect.innerHTML = '<option value="">Lỗi tải dữ liệu</option>';
            });
    }
</script>
<script src="<?php echo ROOTLINK ?> /public/assets/js/Jquery/jquery-3.6.0.min.js"></script>
<script src="<?php echo ROOTLINK  ?>/public/assets/js/addressAPI.js"></script>