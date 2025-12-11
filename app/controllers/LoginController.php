<?php
class LoginController extends Controller
{
  private $error;
  private $conn;
  private $userModel;
  function __construct()
  {
   
  }
  function index()
  {
     $userId = $_SESSION['user']['id'] ?? null;
    if ($userId != null) {
      redirect();
    }
    $data['content'] = 'components/Login';
    $data['sub_content']['info'] = 'Home';
    $data['sub_content']['login_error'] = $this->error;
    $this->render('layouts/LoginLayout', $data);
  }

  // === HÀM XỬ LÝ AJAX LOGIN ===
  public function handleLogin()
  {
    $this->userModel = $this->loadModel('UserModel');
    header("Content-Type: application/json");

    // 1. Lấy dữ liệu
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 2. Validate cơ bản
    if (empty($email) || empty($password)) {
      echo json_encode(['status' => 'error', 'message' => 'Vui lòng nhập đầy đủ email và mật khẩu.']);
      exit();
    }

    // 3. Gọi Model kiểm tra thông tin
    // Hàm checkLogin này ông tự viết trong UserModel nhé (Select * from users where email = ...)
    $user = $this->userModel->checkLogin($email, $password);

    if ($user) {
      // 4. Đăng nhập thành công -> Lưu Session
      $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'role' => $user['role'], // Quan trọng để phân quyền Admin/Client
        'email' => $user['email']
      ];



      // Check xem user là admin hay khách để chuyển hướng đúng chỗ
      $redirectUrl = ROOTLINK; // Mặc định về Home
      // if ($user['role'] == 'admin') {
      //   $redirectUrl = ROOTLINK . '/admin/dashboard';
      // }

      // if ($user['role'] == 'users') {
      //   $redirectUrl = ROOTLINK . '';
      // }

      echo json_encode([
        'status' => 'success',
        'message' => 'Đăng nhập thành công!',
        'redirect' => $redirectUrl // Gửi link này cho JS nó chuyển hướng
      ]);
    } else {
      // 5. Sai email hoặc pass
      echo json_encode([
        'status' => 'error',
        'message' => 'Email hoặc mật khẩu không chính xác.'
      ]);
    }
    exit();
  }


  public function logout() {
    // 1. Gọi session_start để PHP biết đang xử lý session nào
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. Xóa sạch dữ liệu trong mảng $_SESSION
    $_SESSION = array();

    // 3. GIẾT COOKIE PHPSESSID (Quan trọng nhất đoạn này)
    // Phải lấy đúng các tham số (path, domain) mà cookie được tạo ra thì mới xóa được
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        
        setcookie(
            session_name(),     // Tên cookie (thường là PHPSESSID)
            '',                 // Xóa value (để rỗng)
            time() - 42000,     // Thời gian: Lùi về quá khứ (để nó hết hạn ngay lập tức)
            $params["path"],    // Path cũ
            $params["domain"],  // Domain cũ
            $params["secure"],  // Secure flag cũ
            $params["httponly"] // HttpOnly flag cũ
        );
    }

    // 4. Hủy session trên server
    session_destroy();

    // 5. Đá về trang login
    header("Location: " . ROOTLINK . "/login");
    exit();
}
}
