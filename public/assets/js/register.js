const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");
const rootLink = 'http://localhost/dacs2';
// Ensure the elements exist before adding event listeners
registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});

// HÀM HIỆN LỖI
function showError(input, msg) {
  let err = input.nextElementSibling;
  if (!err || err.tagName !== "SMALL") {
    err = document.createElement("small");
    err.className = "error-message";
    err.style.color = "red";
    err.style.display = "block";
    err.style.marginTop = "4px";
    input.insertAdjacentElement("afterend", err);
  }

  err.textContent = msg;
  input.classList.add("input-error");

  input.classList.add("shake");
  setTimeout(() => input.classList.remove("shake"), 300);
}

// XÓA LỖI
function clearError(input) {
  const err = input.nextElementSibling;
  if (err && err.tagName === "SMALL") err.textContent = "";
  input.classList.remove("input-error");
}

// AJAX Gửi tới PHP
function ajaxCheck(field, value, callback) {
  fetch(`${rootLink}/signup`, {  //localhost/signnup -- sai  --->   http://localhost/dacs2/signup
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `field=${field}&value=${value}`,
  })
    .then((res) => res.json())
    .then((data) => callback(data));
}

// GET INPUTS
const username = document.querySelector('input[name="username"]');

const email = document.querySelector('.sign-up input[name="email"]');
const phone = document.querySelector('input[name="phone"]');
const password = document.querySelector('.sign-up input[name="password"]');

// BLUR EVENTS
username.addEventListener("blur", function () {
  ajaxCheck("username", this.value.trim(), (res) => {
 
    res.valid ? clearError(this) : showError(this, res.message);
  });
});

email.addEventListener("blur", function () {
  
  ajaxCheck("email", this.value.trim(), (res) => {

    res.valid ? clearError(this) : showError(this, res.message);
  });
});

phone.addEventListener("blur", function () {
     
  ajaxCheck("phone", this.value.trim(), (res) => {
    res.valid ? clearError(this) : showError(this, res.message);
  });
});

password.addEventListener("blur", function () {
  ajaxCheck("password", this.value.trim(), (res) => {
    res.valid ? clearError(this) : showError(this, res.message);
  });
});

// CHẶN SUBMIT VÀ GỬI AJAX
document.querySelector(".sign-up form").addEventListener("submit", function (e) {
    e.preventDefault(); // 1. Chặn load lại trang

    // 2. Check xem còn lỗi cũ chưa sửa không
    const errorInputs = document.querySelectorAll(".input-error");
    if (errorInputs.length > 0) {
        alert("Vui lòng sửa các lỗi màu đỏ trước khi đăng ký!");
        return;
    }

    // 3. Gom dữ liệu form
    const formElement = this;
    const formData = new FormData(formElement); 
    // Lưu ý: FormData sẽ lấy dữ liệu dựa trên name="" của thẻ input

    // 4. Gửi AJAX (Fetch)
    // Bạn cần trỏ đúng vào hàm xử lý đăng ký trong Controller, ví dụ: /signup/handleRegister
    fetch(`${rootLink}/handlesignup`, { 
        method: "POST",
        body: formData 
        // Khi dùng FormData, không cần set Content-Type, trình duyệt tự lo
    })
    .then(res => res.json()) // Mong đợi server trả về JSON
    .then(data => {
    

       // --- ĐOẠN SỬA ĐỔI BẮT ĐẦU TỪ ĐÂY ---
    if (data.status === "success") {
      // event.preventDefault();
        // Hiện Popup đẹp bằng SweetAlert
        alert("Đăng ký thành công");
        window.location.href = rootLink + '/'; 

    } else {
        // Xử lý lỗi thất bại
        Swal.fire({
            title: 'Đăng ký thất bại!',
            text: data.message,
            icon: 'error',
            confirmButtonText: 'Thử lại'
        });
        
        // Hiển thị lỗi đỏ dưới từng ô input (giữ nguyên logic cũ của bạn)
        if (data.errors) {
            for (const [key, msg] of Object.entries(data.errors)) {
                const input = formElement.querySelector(`input[name="${key}"]`);
                if (input) showError(input, msg);
            }
        }
    }
    })
    .catch(err => {
        console.error("Lỗi hệ thống:", err);
        alert("Có lỗi xảy ra, vui lòng thử lại sau.");
    });
}); 