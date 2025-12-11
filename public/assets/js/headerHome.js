// Toggle menu cho mobile
function toggleMenu() {
  const menu = document.querySelector(".navbar-menu");
  menu.classList.toggle("active");
}

// Toggle dropdown user (nếu có)
function toggleDropdown() {
  const dropdown = document.getElementById("dropdownMenu");
  dropdown.classList.toggle("show");
}
// Đổi màu navbar khi cuộn
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

function toggleUserMenu() {
  document.getElementById("userMenuPopup").classList.toggle("show");
}

// Logic: Bấm ra ngoài vùng menu thì tự đóng lại cho gọn
window.onclick = function (event) {
  if (!event.target.closest(".user-toggle")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};
// Đóng dropdown khi click ngoài
document.addEventListener("click", function (event) {
  const dropdown = document.getElementById("dropdownMenu");
  const userInfo = document.querySelector(".user-info");
  if (
    dropdown &&
    userInfo &&
    !userInfo.contains(event.target) &&
    !dropdown.contains(event.target)
  ) {
    dropdown.classList.remove("show");
  }
});
