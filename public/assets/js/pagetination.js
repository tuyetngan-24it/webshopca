// --- CẤU HÌNH ---
let visiblePage = 3;
let totalPage;
let page = 1;
function scrollToTop() {}

// Tải tổng số trang
$.ajax({
  url: `http://localhost/dacs2/products/totalPage/12`, // API giả lập
  type: "GET",
  dataType: "json",
  success: function (response) {
    totalPage = response;
    console.log(totalPage);
  },
});
// --- HÀM RENDER ---
function renderPagination(startPage, currentPage, $keyword = "") {
  scrollToTop();
  // Logic: Nếu dải trang vượt quá tổng số thì kéo lùi lại
  if (startPage + visiblePage - 1 > totalPage) {
    startPage = totalPage - visiblePage + 1;
  }
  if (startPage < 1) startPage = 1;

  let html = "";
  for (let i = 0; i < visiblePage; i++) {
    let pageNum = startPage + i;

    if (pageNum > totalPage) break;

    let activeClass = pageNum === currentPage ? "active" : "";

    // Thêm class 'page-num' để phân biệt với nút prev/next
    html += `<a href="#" class="page-link page-num ${activeClass}" data-page="${pageNum}">${pageNum}</a>`;
  }

  if ($keyword != "") {
    $(".pagination").html("Chỉ lọc tối đa 12 sản phẩm thôi nhé");
  } else {
    $(".pagination").html(
      `
        <a href="#" class="prev-btn"><i class="fa-solid fa-arrow-left"></i></a>
        ${html}
        <a href="#" class="next-btn"><i class="fa-solid fa-arrow-right"></i></a>
        `
    );
  }
  // Vẽ lại HTML (Thêm class prev-btn và next-btn vào thẻ A)
}

// --- SỰ KIỆN CLICK SỐ TRANG (Chỉ bắt class .page-num) ---
$(document).on("click", ".pagination .page-num", function (e) {
  e.preventDefault();
  let pageData = $(this).attr("data-page");

  if (pageData) {
    page = parseInt(pageData);
    renderPagination(page, page);
    window.loadProducts(page); // Gọi API
  }
});

// --- SỰ KIỆN CLICK PREV (Bắt vào thẻ A .prev-btn) ---
$(document).on("click", ".pagination .prev-btn", function (e) {
  e.preventDefault();
  if (page > 1) {
    // Chỉ lùi khi lớn hơn 1
    page--;
    renderPagination(page, page);
    window.loadProducts(page);
  }
});

// --- SỰ KIỆN CLICK NEXT (Bắt vào thẻ A .next-btn) ---
$(document).on("click", ".pagination .next-btn", function (e) {
  e.preventDefault();
  if (page < totalPage) {
    // Chỉ tiến khi nhỏ hơn tổng
    page++;
    renderPagination(page, page);
    window.loadProducts(page);
  }
});

// --- CHẠY LẦN ĐẦU TIÊN ---
renderPagination(1, 1);
