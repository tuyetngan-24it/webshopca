# Tên Đồ Án Của Bạn (ví dụ: Website Bán Hàng DACS2)

[Viết một đoạn ngắn mô tả về dự án của bạn: Đây là dự án gì? Mục tiêu là gì? Đây là đồ án môn học nào? v.v.]

## 📖 Mục Lục

* [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
* [Cài đặt](#-cài-đặt)
* [Cấu hình](#-cấu-hình)
* [Hướng dẫn sử dụng](#-hướng-dẫn-sử-dụng)
* [Lưu ý kỹ thuật (Cách chèn file Public)](#-lưu-ý-kỹ-thuật)

## 🛠️ Công nghệ sử dụng

* **Ngôn ngữ:** PHP (mô hình MVC tự xây dựng)
* **Cơ sở dữ liệu:** MySQL (Quản lý qua phpMyAdmin)
* **Web Server:** Apache (Khuyên dùng XAMPP hoặc WAMP)
* **Giao diện (Frontend):** HTML, CSS, JavaScript [Ghi thêm nếu dùng Bootstrap, jQuery...]

---

## 🚀 Cài Đặt

Thực hiện các bước sau để chạy dự án trên máy cục bộ của bạn (localhost).

1.  **Clone Repository** (Nếu dùng Git):
    ```bash
    git clone [link-git-repository-cua-ban]
    ```
    (Nếu không dùng Git, chỉ cần **giải nén** file `.zip` hoặc `.rar` của dự án).

2.  **Di chuyển thư mục:**
    Copy thư mục dự án (ví dụ: `DACS2`) vào thư mục `htdocs` của XAMPP:
    `C:\xampp\htdocs\`

3.  **Cơ sở dữ liệu (Database):**
    * Mở XAMPP và khởi động Apache & MySQL.
    * Truy cập `http://localhost/phpmyadmin`.
    * Tạo một cơ sở dữ liệu mới (ví dụ: `db_dacs2`).
    * Chọn CSDL vừa tạo, nhấn vào tab **Import** (Nhập).
    * Chọn file `.sql` đi kèm trong dự án (ví dụ: `database/database.sql`) và nhấn **Go** (Thực hiện).

4.  **Chạy dự án:**
    Mở trình duyệt và truy cập: `http://localhost/[tên-thư-mục-dự-án]`
    *Ví dụ:* `http://localhost/DACS2`

---

## ⚙️ Cấu Hình

Dự án cần được cấu hình để kết nối đúng với database và xác định đúng đường dẫn gốc.

**Quan trọng:** Mở file cấu hình chính của dự án (thường là `core/config.php` hoặc `app/config.php` - *bạn hãy kiểm tra và điền đúng đường dẫn file*).

Tìm và chỉnh sửa các hằng số (constants) sau:

1.  **Cấu hình Database:**
    ```php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root'); // User mặc định của XAMPP
    define('DB_PASS', '');     // Password mặc định của XAMPP là rỗng
    define('DB_NAME', 'db_dacs2'); // Tên database bạn đã tạo ở Bước 3
    ```

2.  **Cấu hình Đường dẫn gốc (WEB_ROOT):**
    Đây là bước quan trọng để load file CSS, JS và điều hướng.
    ```php
    /* * Lấy protocol (http hoặc https)
    */
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $webRoot = 'https://'. $_SERVER['HTTP_HOST']; 
    } else {
        $webRoot = 'http://'. $_SERVER['HTTP_HOST']; 
    }

    /* * Lấy tên thư mục gốc của dự án
    * Ví dụ: /DACS2
    */
    $folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(str_replace('\\', '/', __DIR__)));

    /* * Hằng số đường dẫn web gốc
    * Kết quả sẽ là: http://localhost/DACS2
    */
    define('WEB_ROOT', $webRoot . $folder); 
    ```
    *(Lưu ý: Đoạn code trên là một cách tự động xác định `WEB_ROOT`. Nếu dự án của bạn định nghĩa `WEB_ROOT` thủ công, chỉ cần đảm bảo nó trỏ đúng, ví dụ: `define('WEB_ROOT', 'http://localhost/DACS2');`)*

---

## 🧑‍💻 Hướng Dẫn Sử Dụng

[Mô tả các chức năng chính của website, ví dụ:]

* **Trang Quản trị (Admin):**
    * Đường dẫn: `http://localhost/DACS2/admin/login` (hoặc `/admin`)
    * Tài khoản mẫu: `admin`
    * Mật khẩu mẫu: `123456`
    * Các chức năng: Quản lý Sản phẩm, Quản lý Danh mục, Quản lý Đơn hàng...

* **Trang Người dùng (Client):**
    * Truy cập trang chủ `http://localhost/DACS2`.
    * Các chức năng: Xem sản phẩm, Thêm vào giỏ hàng, Thanh toán...

---

## 💡 Lưu Ý Kỹ Thuật: Cách Chèn File Public (CSS, JS) Trong View

Đây là yêu cầu của bạn, và nó rất quan trọng trong mô hình MVC.

**Vấn đề:** Khi bạn chèn file CSS bằng đường dẫn tương đối (ví dụ: `public/css/style.css`), nó sẽ hoạt động ở trang chủ (`/`) nhưng sẽ **thất bại** ở các trang con (ví dụ: `/products/detail/1`) vì trình duyệt sẽ tìm file ở `products/detail/public/css...` (sai).

**Giải pháp:** Luôn luôn sử dụng đường dẫn **TUYỆT ĐỐI** bắt đầu từ gốc website, sử dụng hằng số `WEB_ROOT` mà bạn đã cấu hình ở trên.

**Cách làm:**

Trong file layout/view của bạn (ví dụ: `views/layouts/client_layout.php` hoặc `views/includes/header.php`):

**Cách làm SAI (dùng đường dẫn tương đối):**
```html
<link rel="stylesheet" href="public/css/style.css">
<script src="public/js/main.js"></script>
<img src="public/images/logo.png">

#Hướng dẫn sử dụng 

<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>/public/css/style.css">
<script src="<?php echo WEB_ROOT; ?>/public/js/main.js"></script>
<img src="<?php echo WEB_ROOT; ?>/public/images/logo.png">

<a href="<?php echo WEB_ROOT; ?>/products/list">Danh sách sản phẩm</a>


// Luồng chạy từ routes->controller->views->models->controller->views






****
   // 1. Kiểm tra Request Method và Đăng nhập
        // if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        //     header("Location: " . ROOTLINK . '/cart');
        //     exit();
        // }

        // // Kiểm tra đăng nhập (để chắc chắn có user_id)
        // if (empty($_SESSION['user']['id'])) {
        //      // Lưu lại link hiện tại để login xong quay lại (nếu cần)
        //      header("Location: " . ROOTLINK . '/auth/login');
        //      exit();
        // }

        // // 2. Kiểm tra giỏ hàng
        // $cart = $_SESSION['cart'] ?? [];
        // if (empty($cart)) {
        //     echo '<script>alert("Giỏ hàng trống!"); window.location.href="' . ROOTLINK . '/products";</script>';
        //     exit();
        // }

        // 3. Tính toán lại tổng tiền (Quan trọng: Tính ở server để tránh hack giá)
        // $totalMoney = 0;
        // foreach ($cart as $item) {
        //     $totalMoney += $item['price'] * $item['quantity'];
        // }

        // // 4. Chuẩn bị dữ liệu Order
        // $userId = $_SESSION['user']['id']; // Lấy từ session cho an toàn
        
        // $dataOrder = [
        //     'user_id' => $userId,
        //     'total_money' => $totalMoney,
        //     'create_at' => date('Y-m-d H:i:s'),
            
        // ];

        // // 5. Gọi Model để tạo Order
        // $orderModel = $this->loadModel('OrderModel');
        
        // // Hàm insertOrder gọi create() của Model cha -> Trả về ID vừa tạo
        // $orderId = $orderModel->insertOrder($dataOrder);
        // echo $orderId; 

        // if ($orderId) {
        //     // 6. Nếu tạo Order thành công -> Lưu chi tiết (Order Details)
        //     foreach ($cart as $productId => $item) {
        //         $dataDetail = [
        //             'order_id' => $orderId,
        //             'product_id' => $productId,
        //             'price' => $item['price'],
        //             'quantity' => $item['quantity'],
        //             'total' => $item['price'] * $item['quantity'] // Thành tiền từng món
        //         ];

        //         // Gọi hàm insertOrderDetail của OrderModel
        //         $orderModel->insertOrderDetail($dataDetail);
                
        //     }

        //     // 7. Xử lý sau khi lưu thành công
        //     // - Xóa giỏ hàng
        //     unset($_SESSION['cart']);

        //     // - Chuyển hướng sang trang thông báo thành công
        //     header("Location: " . ROOTLINK . '/order/success');
        //     exit();
