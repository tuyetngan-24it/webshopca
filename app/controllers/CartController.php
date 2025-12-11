<?php
class CartController extends Controller
{
  function __construct()
  {
    // Kiểm tra đăng nhập
    $userId = $_SESSION['user']['id'] ?? null;
    if ($userId == null) {
      redirect('login');
    }
  }

  // Hiển thị giỏ hàng
  function index()
  {
    $data['content'] = 'components/Cart';
    $data['sub_content']['info'] = 'Home';
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['shoppingCart'] = $_SESSION['cart'] ?? [];
    $addresses = [];
    if (isset($_SESSION['user'])) {
      $userId = $_SESSION['user']['id'];
      $addressModel = $this->loadModel('AddressModel');
      // Hàm này chính là hàm bạn dùng JOIN 3 bảng hôm qua để lấy tên Tỉnh/Phường
      $addresses = $addressModel->getAllAdressById($userId);
    }

    $data['sub_content']['my_addresses'] = $addresses; // Truyền biến này sang View

    $this->render('layouts/HomeLayout', $data);
  }

  // Thêm vào giỏ hàng
  function add()
  {
    $id = 0;
    $quantity = 1; 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        
      }

      if (!empty($_POST['quantity'])){
        $quantity = $_POST['quantity']; 
      }
      if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
      }

      // LOGIC: Kiểm tra tồn tại
      if (isset($_SESSION['cart'][$id])) {
        // Nếu đã có -> Tăng số lượng
        $_SESSION['cart'][$id]['quantity'] += 1;
      } else {
        // Nếu chưa có -> Lấy từ DB
        $result = $this->loadModel('ProductModel')->getProductById($id);

        if ($result) {
          $item = [
            'id' => $result['id'],
            'name' => $result['name'],
            'img' => $result['img'],
            'price' => $result['price'],
            'quantity' => isset($_POST['quantity']) ? $quantity : 1,
            'categoryId' => $result['categoryId']
          ];
          $_SESSION['cart'][$id] = $item;
        }
      }
      // Chuyển hướng nhanh gọn
      header('Location: ' . ROOTLINK . '/cart');;

      // exit;
    }
  }

  // Xóa sản phẩm
  public function remove()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'] ?? null;
      if ($id && isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
      }
      header('Location: ' . ROOTLINK . '/cart');
      exit;
    }
  }


  // // [MỚI] Hàm tính tổng tiền (Private)
  private function calculateTotalMoney($cartItems)
  {
    $total = 0;
    if (empty($cartItems)) return 0;

    foreach ($cartItems as $item) {
      $price = isset($item['price']) ? (float)$item['price'] : 0;
      $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
      $total += $price * $quantity;
    }
    return $total;
  }



  // CartController.php

  // Hàm nhận tham số trực tiếp từ URL
  // Ví dụ URL: /cart/update/101/5  => $productId = 101, $qty = 5
  public function update($productId = 1, $quantity = 1)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $productId = (int)$productId;
      $quantity = (int)$quantity;
      header('Content-Type: application/json');
      if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;

        $totalMoney = $this->calculateTotalMoney($_SESSION['cart']);

        echo json_encode([
          'status' => 'success',
          'total_money_formatted' => number_format($totalMoney, 0, ',', '.') . 'đ'
        ]);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
      }
      // echo json_encode(['success' => 'thành công']);
    }
    // 1. Ép kiểu cho chắc ăn (tránh hacker chèn SQL Injection vào URL)
    // // 2. Logic cập nhật Session (y chang cũ
  }
}
