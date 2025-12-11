<?php
class ReviewController extends Controller
{
  private $orderDetailModel;
  function __construct()
  {

    $userId = $_SESSION['user']['id'] ?? null;
    if ($userId == null) {
      redirect('login');
    }
  }

  function index($orderid)
  {


    $this->orderDetailModel = $this->loadModel('OrderDetailModel');
    $data['content'] = 'components/ReviewProduct';
    $data['sub_content']['info'] = 'Home';
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['orderItems'] = $this->orderDetailModel->getAllOrderDetail($orderid);
    $this->render('layouts/HomeLayout', $data);
  }

  function add($orderId, $productId)
  {
    $productModel = $this->loadModel('ProductModel');
    $productName = $productModel->getProductById($productId);
    $data['content'] = 'components/Reviews';
    $userId = $_SESSION['user']['id'];
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['order_id'] = $orderId;
    $data['sub_content']['productId'] = $productId;
    $data['sub_content']['productName'] = $productName['name'];
    $this->render('layouts/HomeLayout', $data);
  }

  function submit()
  {
    $reviewModel = $this->loadModel('ReviewModel');
    // // xử lý đường dẫn
    if (isset($_FILES['review_img']) && $_FILES['review_img']['error'] == 0) {
      $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'; // Thư mục lưu ảnh (nhớ tạo thư mục này trước)

      // Tạo tên file mới để tránh trùng lặp (thêm time() vào trước)
      $fileName = time() . '_' . basename($_FILES["review_img"]["name"]);
      $targetFile = $targetDir . $fileName;

      // Di chuyển file từ bộ nhớ tạm vào thư mục uploads
      if (move_uploaded_file($_FILES["review_img"]["tmp_name"], $targetFile)) {
        $imagePath = 'http://localhost/uploads/' . $fileName; // Lưu đường dẫn này vào DB
      } else {
        echo "Lỗi upload ảnh!";
        return;
        // Có thể return hoặc xử lý lỗi tại đây
      }
    }
    // echo "</pre>";

    $data = [
      'userid' => $_SESSION['user']['id'],
      'productid' => $_POST['product_id'],
      'orderid' => $_POST['order_id'],
      'rating' => $_POST['rating'],
      'comment' => $_POST['comment'],
      'image' => isset($imagePath) ? $imagePath : null,
      'created_at' => date('y:m:d')
    ];

    $result =  $reviewModel->addReview($data);

    if ($result) {
     $this->render('components/status/reviewsuccess'); 
     echo '<meta http-equiv="refresh" content="2;url=' . ROOTLINK . '">';
      return 0; 
    }
  }
}
