<?php
class ProductDetailController extends Controller
{

    function __construct()
    {
        // Khúc này ông chặn không đăng nhập thì không xem được sản phẩm
        // (Tùy logic shop ông nha, thường thì khách vãng lai vẫn cho xem)
        $userId = $_SESSION['user']['id'] ?? null;
        if ($userId == null) {
            redirect('login');
        }
    }

    function index($id)
    {
        $reviewModel  = $this->loadModel('ReviewModel'); 
        // 1. Setup layout view
        $data['content'] = 'components/ProductDetail';

        // 2. Load Model Sản phẩm & Danh mục (Code cũ của ông)
        $result = $this->loadModel('ProductModel')->getProductById($id);
        $status = ($result['quantity'] > 0) ? "Còn hàng" : 'Hết hàng';
        $CatId = $result['categoryId'];
        $CatResult = $this->loadModel('CategoryModel')->getCategoryById($CatId);

        // --- BỔ SUNG KHÚC NÀY ĐỂ LẤY REVIEW ---
        $reviewModel = $this->loadModel('ReviewModel'); // Load model review
        $reviews = $reviewModel->getReviewsByProduct($id); // Lấy list comment
        $ratingStats = $reviewModel->getAvgRating($id);    // Lấy sao trung bình
        // --------------------------------------

        // 3. Đóng gói dữ liệu bắn sang View
        $data['sub_content']['product'] = $result;
        $data['sub_content']['category'] = $CatResult;
        $data['sub_content']['info'] = 'Home';
        $data['sub_content']['username'] = $_SESSION['user']['username'];
        $data['sub_content']['role'] = $_SESSION['user']['role'];
        $data['sub_content']['status'] = $status;
        $data['sub_content']['totalReview'] = 33; 
        // reviews
        $data['sub_content']['reviews'] = $reviewModel->getAllReviewByProductId($id); 
        $data['sub_content']['totalReview'] = $reviewModel->totalReviews($id); 
        $data['sub_content']['avgRating'] = $reviewModel->avgRating($id); 
        // // --- NÉM DỮ LIỆU REVIEW VÀO MẢNG sub_content ---
        // $data['sub_content']['reviews'] = $reviews;         // <--- Quan trọng
        // $data['sub_content']['ratingStats'] = $ratingStats; // <--- Quan trọng
        // -----------------------------------------------

        // 4. Render Layout
        $this->render('layouts/HomeLayout', $data);
    }
}