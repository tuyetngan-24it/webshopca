<video autoplay muted loop id="video-background">
    <source src="http://localhost/DACS2/public/assets/video/videologin.mp4" type="video/mp4" />
    Trình duyệt của bạn không hỗ trợ video.
</video>


<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="handlesignup" method="post">
            <h1>Đăng ký tài khoản</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fab fa-github"></i></a>
                <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>hoặc sử dụng email để đăng ký</span>

            <input type="text" name="username" placeholder="Tên đăng nhập" required />
            <input type="email" name="email" placeholder="Địa chỉ Email" required />
            <input type="tel" name="phone" placeholder="Số điện thoại liên hệ" required />
            <input type="password" name="password" placeholder="Mật khẩu bảo mật" required />
            <button type="submit"  class="register" name="register">Đăng Ký Ngay</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="dang-nhap" method="post">
            <h1>Đăng nhập</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fab fa-github"></i></a>
                <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>hoặc đăng nhập bằng tài khoản</span>

            <input type="email" name="email" placeholder="Nhập Email" required />
            <input type="password" name="password" placeholder="Nhập Mật khẩu" required />

            <a href="#" class="forgot-password">Bạn quên mật khẩu?</a>
            <button  type="submit" name="login">Đăng Nhập</button>
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Rất vui được gặp lại!</h1>
                <p>Để tiếp tục kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn.</p>
                <button class="hidden" id="login">Đăng Nhập</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Xin chào bạn mới!</h1>
                <p>Nhập thông tin cá nhân và bắt đầu hành trình khám phá những tính năng tuyệt vời cùng chúng tôi.</p>
                <button class="hidden" id="register">Đăng Ký Mới</button>
            </div>
        </div>
    </div>
</div>