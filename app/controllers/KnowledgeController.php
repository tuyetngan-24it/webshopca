<?php
require_once __DIR__ . '/../models/BlogModel.php';

class KnowledgeController extends Controller
{ // Nhớ sửa tên class có chữ 'd' cho chuẩn
    private $blogModel;

    public function __construct()
    {
        $this->blogModel = $this->loadModel('BlogModel');
    }

    public function index()
    {
        // 1. Lấy dữ liệu
        $cats = $this->blogModel->getAllCategories();
        $blogs = $this->blogModel->getBlogs();

        // 2. Đóng gói dữ liệu
        $data = [];

        // QUAN TRỌNG: Phải nhét vào 'sub_content' để MasterLayout có cái mà dùng
        $data['sub_content'] = [
            'categories' => $cats,     // Cái này sẽ biến thành biến $categories ở view con
            'initial_blogs' => $blogs  // Cái này sẽ biến thành biến $initial_blogs ở view con
        ];

        // View con cần load
        $data['content'] = 'components/fishknowledge';
        $data['sub_content']['headerPage'] = 'knowledge';
        $data['sub_content']['username'] = $_SESSION['user']['username'];
        $data['sub_content']['role'] = $_SESSION['user']['role'];

        // 3. Render
        $this->render('layouts/HomeLayout', $data);
    }

    // Hàm search giữ nguyên như cũ
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $catId = $_GET['cat_id'] ?? 'all';

        // Gọi Model
        $blogs = $this->blogModel->getBlogs($keyword, $catId);
        $data['sub_content']['blog'] = $blogs;

        // Xử lý dữ liệu
        $data = [];
        foreach ($blogs as $row) {
            $imgUrl = !empty($row['image']) ? ROOTLINK . '/public/uploads/blogs/' . $row['image'] : 'https://via.placeholder.com/600';

            $data[] = [
                'title' => $row['title'],
                'description' => $row['description'],
                'cat_name' => $row['cat_name'] ?? 'Chưa phân loại', // Dùng ?? để tránh lỗi null
                'image_url' => $imgUrl,
                'date_format' => date('d/m', strtotime($row['created_at'])),
            ];
        }

        // --- QUAN TRỌNG NHẤT ---
        header('Content-Type: application/json');
        echo json_encode($data);
        exit; // <--- THÊM DÒNG NÀY (Bắt buộc để JSON sạch)
    }
    public function show($id)
    {

        // Lấy chi tiết bài viết từ Model
        $blog = $this->blogModel->getBlogById($id);

        if (!$blog) {
            // Xử lý nếu bài viết không tồn tại (ví dụ: chuyển hướng hoặc hiển thị lỗi)
            header("HTTP/1.0 404 Not Found");
            echo "Bài viết không tồn tại.";
            exit;
        }

        // Đóng gói dữ liệu
        $data = [];
        $data['sub_content'] = [
            'blog' => $blog
        ];

        // View con cần load
        $data['content'] = 'components/blogdetail';
        $data['sub_content']['username'] = $_SESSION['user']['username'];
        $data['sub_content']['role'] = $_SESSION['user']['role'];

        // Render
        $this->render('layouts/MasterLayout', $data);
    }
}
