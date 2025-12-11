<?php
// Đường dẫn gọi Model

require_once __DIR__ . '/../../models/BlogModel.php'; 
import(__DIR__ . '\AdminController.php');
// SỬA LỖI 1: Đổi 'extends AdminController' thành 'extends Controller' 
// (Trừ khi bạn có file AdminController.php và đã require nó ở trên)
class AdminBlogController extends AdminController {
    private $blogModel;

    public function __construct() {
        parent::__construct();  // Load Model
        $this->blogModel = $this->loadModel('BlogModel');
    }

    public function index() {
        // SỬA LỖI 2: Đóng gói dữ liệu vào 'subcontent' để AdminLayout hiểu
        // Thay vì $data['blogs'], phải là $data['subcontent']['blogs']
        $data['subcontent'] = [
            'blogs' => $this->blogModel->getBlogs()
        ];
        
        // Khai báo view con
        $data['content'] = 'components/admin/blogs/index'; 
        
        // Active Sidebar
        $data['subcontent']['page'] = 'blogs'; 

        // Render Layout cha
        $this->render('layouts/AdminLayout', $data);
    }

    public function create() {
        // SỬA LỖI 2: Tương tự hàm index, gói vào subcontent
        $data['subcontent'] = [
            'categories' => $this->blogModel->getAllCategories()
        ];
        
        $data['content'] = 'components/admin/blogs/create';
        $data['page'] = 'blogs';
        $this->render('layouts/AdminLayout', $data);
        
    }

   public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $content = $_POST['content'];
            $cat_id = $_POST['category_id'];
            
            $image = ''; // Mặc định rỗng nếu không up ảnh

            // Xử lý upload ảnh
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                
                // 1. ĐỊNH NGHĨA ĐƯỜNG DẪN

                // Đường dẫn vật lý trên ổ cứng (Để PHP di chuyển file vào đây)
                // Ví dụ: C:/xampp/htdocs/uploads/
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'; 

                // Đường dẫn URL (Để lưu vào Database và hiển thị trên web)
                // Ví dụ: http://localhost/uploads/
                $urlBase = "http://localhost/uploads/";

                // Tạo tên file ngẫu nhiên để không bị trùng
                $fileName = time() . '_' . basename($_FILES["image"]["name"]);

                // Đường dẫn file đích trên ổ cứng
                $targetFilePath = $uploadDir . $fileName;
                
                // Kiểm tra thư mục vật lý tồn tại chưa, chưa thì tạo
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // 2. THỰC HIỆN UPLOAD
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    // Thành công -> Gán đường dẫn URL đầy đủ vào biến $image
                    // Kết quả sẽ là: http://localhost/uploads/1700123_tenanh.jpg
                    $image = $urlBase . $fileName; 
                }
            }

            // 3. LƯU VÀO DATABASE
            $data = [
                'title' => $title,
                'description' => $desc,
                'content' => $content,
                'image' => $image, // Lúc này $image đã là đường dẫn http://...
                'category_id' => $cat_id
            ];

            if ($this->blogModel->createBlog($data)) {
                // Chuyển hướng về trang danh sách
                $this->render('components/status/addsuccess');
                 echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                exit();
            } else {
                echo "Lỗi thêm mới!";
            }
        }
    }
    public function delete($id) {
        $this->blogModel->deleteBlog($id);
        $this->render('components/status/deletesuccess');
        echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit();
    }
}