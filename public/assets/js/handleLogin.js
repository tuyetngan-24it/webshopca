// === XỬ LÝ ĐĂNG NHẬP (LOGIN) ===
const loginForm = document.querySelector(".sign-in form");

if (loginForm) {
    loginForm.addEventListener("submit", function(e) {
        e.preventDefault(); // 1. Chặn load lại trang

        // 2. Gom dữ liệu (Email & Password)
        const formData = new FormData(this);

        // 3. Gửi Ajax tới Controller Login
        // Lưu ý: Route phải đúng với router ông định nghĩa (ví dụ: /login/handleLogin)
        fetch(`${rootLink}/handleLogin`, {
            method: "POST",
            body: formData
            // Không cần set Content-Type, để tự động nó mới nhận được
        })
        .then(res => res.json())
        .then(data => {
            console.log("Login response:", data); // Debug xem server trả gì

            if (data.status === 'success') {
                // alert("Đăng nhập thành công!"); // (Tùy chọn)
                
                // 4. Chuyển hướng
                // Nếu server có trả về link chuyển hướng (ví dụ admin hoặc home)
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.href = `${rootLink}/`; // Mặc định về trang chủ
                }
            } else {
                // 5. Hiện lỗi
                alert(data.message); // Hoặc hiển thị vào thẻ small đỏ tùy ông
            }
        })
        .catch(err => {
            console.error("Lỗi đăng nhập:", err);
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    });
}