<link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/contact.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="contact-wrapper">
    <div class="container">
        <div class="contact-grid">
            
            <div class="contact-info-box">
                <h2>Liên hệ </h2>
                <p>Bạn có câu hỏi về setup bể, kỹ thuật nuôi cá hay cần tư vấn sản phẩm? Đừng ngần ngại gửi tin nhắn cho MP Aquatric nhé!</p>
                
                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="info-text">
                        <h4>Địa chỉ</h4>
                        <span>470 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                    <div class="info-text">
                        <h4>Hotline</h4>
                        <span>0912 345 678</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-envelope"></i></div>
                    <div class="info-text">
                        <h4>Email</h4>
                        <span>contact@mpaquatric.com</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box"><i class="fa-solid fa-clock"></i></div>
                    <div class="info-text">
                        <h4>Giờ làm việc</h4>
                        <span>8:00 - 21:00 (Hàng ngày)</span>
                    </div>
                </div>
            </div>

            <div class="contact-form-box">
                <form action="<?php echo ROOTLINK ?>/contact/send" method="POST">
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn" required value="<?php echo isset($name) ? $name : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Email của bạn</label>
                        <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required value="<?php echo isset($email) ? $email : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" name="subject" class="form-control" placeholder="Bạn cần hỗ trợ vấn đề gì?" required>
                    </div>

                    <div class="form-group">
                        <label>Nội dung tin nhắn</label>
                        <textarea name="message" class="form-control" placeholder="Viết nội dung chi tiết..." required></textarea>
                    </div>

                    <button type="submit" class="btn-send"><i class="fa-solid fa-paper-plane"></i> Gửi Tin Nhắn</button>
                </form>
            </div>

        </div>
    </div>
</div>