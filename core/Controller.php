<?php
class Controller
{

    private $model;

    public function __construct()  // contructor -->  Hàm luôn chạy khi mà đối tượng được gọi
    {
        // 1. Kiểm tra xem đã đăng nhập chưa
        $isLoggedIn = !empty($_SESSION['user']);

        // 2. Lấy đường dẫn hiện tại (URI)
        // Ví dụ: /shop/auth/signup hoặc /shop/products/detail
        $currentUrl = $_SERVER['REQUEST_URI'];

        // 3. DANH SÁCH NGOẠI LỆ (Whitelist)
        // Những từ khóa mà nếu xuất hiện trong URL thì cho phép người chưa đăng nhập vào
        // Bắt buộc phải có: 'signup' (theo yêu cầu), 'login' (để còn đăng nhập), 'auth' (để xử lý form post)
        $allowedKeywords = ['signup', 'login', 'register', 'auth'];  // được truy cập khi chưa đăng nhập

        // 4. LOGIC CHẶN CỬA
        // Nếu CHƯA đăng nhập
        if (!$isLoggedIn) {

            // Kiểm tra xem URL hiện tại có chứa từ khóa cho phép không
            $isAllowed = false;
            foreach ($allowedKeywords as $key) {
                // Nếu tìm thấy từ khóa (vd: 'signup') trong URL
                if (strpos($currentUrl, $key) !== false) {
                    $isAllowed = true;
                    break;
                }
            }

            // Nếu không nằm trong danh sách cho phép -> ĐÁ VỀ LOGIN
            if (!$isAllowed) {
                // Lưu ý: Thay _WEB_ROOT bằng biến đường dẫn gốc của bạn (ví dụ: http://localhost/DACS2)
                $root = (defined('_WEB_ROOT')) ? ROOTLINK : '/DACS2';

                header("Location: " . $root . '/login');
                exit();
            }
        }
    }
    public function loadModel($model)  // nạp model
    {
        if (file_exists(__DIR_ROOT__ . '/app/models/' . ($model) . '.php')) {
            require_once(__DIR_ROOT__ . '/app/models/' . ($model) . '.php');
            if (class_exists($model)) {
                $model = new $model();
                return $model;  // trả về đối tượng model 
            }
        }
        return false;
    }

    public function render($view, $data = []) // trả về view tương ứng
    {
        extract($data); // ->> //  giải mảng sử dụng như là 1 biến trong view mới //  $data['subcontent'] => $subcontent trong view mới
        if (file_exists(__DIR_ROOT__ . '/app/views/' . ($view) . '.php')) {
            require_once(__DIR_ROOT__ . '/app/views/' . ($view) . '.php');
        } else {
            echo "View không tồn tại";
        }
    }
}


// view 1 -> view 2 --> view3