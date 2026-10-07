  $(document).ready(function () {
    let keyword = "";
    const rootLink = "http://localhost/dacs2";

    const skeletonHTML = `
          <div class="product-card skeleton">
              <div class="product-thumb skeleton-box"></div>
              <div class="product-info">
                  <h3 class="skeleton-box"></h3>
                  <div class="price-box skeleton-box"></div>
              </div>
          </div>
      `;

    // 1. HÀM LOAD PRODUCTS (MẶC ĐỊNH)
    function loadProducts(page, limit = 12) {
      const $grid = $(".product-grid");
      const resultCount = $(".result-count");
      resultCount.empty();

      $grid.empty();
      for (let i = 0; i < 9; i++) {
        $grid.append(skeletonHTML);
      }

      $.ajax({
        url: `http://localhost/dacs2/products/get/${page}/${limit}`,
        type: "GET",
        dataType: "json",
        success: function (response) {
          
          setTimeout(function () {
            $grid.empty();

            if (response.length > 0) {
              const limitedData = response;
              resultCount.append(`Hiển thị <b>${response.length}</b> sản phẩm`);

              limitedData.forEach((item) => {
                // --- SỬA Ở ĐÂY: FORMAT GIÁ TIỀN ---
                let formattedPrice = new Intl.NumberFormat('vi-VN').format(item.price) + " VNĐ";

                let productHTML = `
                                  <div class="product-card">
                                      <div class="product-thumb">
                                          <img src="${item.img}" alt="Sản phẩm">
                                          <div class="card-actions">
                                            <form action="${rootLink}/cart/add" method="POST" style="display: inline;">
                                                <input type="hidden" name="id" value="${item.id}">
                                                  <button type="submit" class="action-btn">
                                                      <i class="fa-solid fa-cart-plus"></i>
                                                  </button>
                                              </form>
                                              <a href="${item.url}" class="action-btn"><i class="fa-regular fa-eye"></i></a>
                                          </div>
                                      </div>
                                      <div class="product-info">
                                          <h3>
                                              <a href="#" style="color: #fff;">
                                                  ${item.name.length > 20 ? item.name.substring(0, 20) + "..." : item.name}
                                              </a>
                                          </h3>
                                          <div class="price-box">
                                              <span class="current-price">${formattedPrice}</span>
                                          </div>
                                      </div>
                                  </div>
                              `;
                $grid.append(productHTML);
              });
            } else {
              let productHTML = '<p style="color:white; width:100%;">Chưa có sản phẩm nào</p>';
              $grid.append(productHTML);
            }
          });
        },
        error: function (err) {
          $grid.empty();
          $grid.html('<p style="color:white; text-align:center;">Lỗi tải dữ liệu!</p>');
        },
      });
    }

    window.loadProducts = loadProducts;
    loadProducts(1, 12);

    // 2. HÀM TÌM KIẾM THEO TỪ KHÓA
    function loadProductwithKeyword(keyword, page, limit = 12) {
      // Logic tương tự hàm dưới, bạn có thể áp dụng format giá giống hệt
      // ...
    }

    // 3. HÀM TÌM KIẾM THEO TÊN (Logic chính bạn đang dùng)
    function loadProductNamewithKeyword(keyword, page, limit = 12) {
      const $grid = $(".product-grid");
      const resultCount = $(".result-count");
      resultCount.empty();

      $grid.empty();
      for (let i = 0; i < 9; i++) {
        $grid.append(skeletonHTML);
      }

      keyword = encodeURIComponent(keyword);

      $.ajax({
        url: `http://localhost/dacs2/product/search/name/${keyword}/${limit}`,
        type: "GET",
        dataType: "json",
        success: function (response) {
          // console.log(response)
          setTimeout(function () {
            $grid.empty();

            if (response.length > 0) {
              const limitedData = response;
              resultCount.append(`Hiển thị <b>${response.length}</b> sản phẩm`);

              limitedData.forEach((item) => {
                // --- SỬA Ở ĐÂY: FORMAT GIÁ TIỀN ---
                let price = new Intl.NumberFormat('vi-VN').format(item.price) + " VNĐ";

                let productHTML = `
                                  <div class="product-card">
                                      <div class="product-thumb">
                                          <img src="${item.img}" alt="Sản phẩm">
                                          <div class="card-actions">
                                            <form action="${rootLink}/cart/add" method="POST" style="display: inline;">
                                                <input type="hidden" name="id" value="${item.id}">
                                                  <button type="submit" class="action-btn">
                                                      <i class="fa-solid fa-cart-plus"></i>
                                                  </button>
                                              </form>
                                              <a href="${item.url}" class="action-btn"><i class="fa-regular fa-eye"></i></a>
                                          </div>
                                      </div>
                                      <div class="product-info">
                                          <h3>
                                              <a href="#" style="color: #fff;">
                                                  ${item.name.length > 20 ? item.name.substring(0, 20) + "..." : item.name}
                                              </a>
                                          </h3>
                                          <div class="price-box">
                                              <span class="current-price">${price}</span>
                                          </div>
                                      </div>
                                  </div>
                              `;
                $grid.append(productHTML);
              });

              // renderPagination(1, 1, keyword); // Bỏ comment nếu bạn có hàm này
            } else {
              let productHTML = '<p style="color:white; width:100%;">Không tìm thấy sản phẩm nào</p>';
              $grid.append(productHTML);
            }
          });
        },
        error: function (err) {
          $grid.empty();
          $grid.html('<p style="color:white; text-align:center;">Lỗi tải dữ liệu!</p>');
        },
      });
      window.renderPagination(1, 1, 'cá'); 
    }

    window.loadProductwithKeyword = loadProductwithKeyword;
    window.loadProductNamewithKeyword = loadProductNamewithKeyword;

    $(document).on("click", ".action-btn", function () {
      console.log(this);
    });

    const categoriesLink = $(".category-link");

    categoriesLink.on("click", function (e) {
      e.preventDefault();
      categoriesLink.removeClass("active");
      $(this).addClass("active");
      let name = $(this).text().trim();

      if (name != "Tất cả sản phẩm") {
        // Lưu ý: Hàm này chưa được sửa format giá ở trên, bạn nhớ áp dụng tương tự nhé
        window.loadProductNamewithKeyword(name, 1, 40); 
      } else {
        window.loadProducts(1, 12);
      }
    });

    $(".search-form").on("submit", function (e) {
      e.preventDefault();
      let keyword = $(this).find('input[name="keyword"]').val().trim();

      if (keyword.length > 0) {
        $(".category-link").removeClass("active");
        console.log("Đang tìm kiếm:", keyword);
        window.loadProductNamewithKeyword(keyword, 1, 40);
      } else {
        window.loadProducts(1, 12);
      }
    });
  });

