<?php
import(__DIR__ . '\AdminController.php');
class ProductsController extends AdminController
{
     private $productModel; 
    // tải trang admin
    public function index()
    {

       
        $CategoriesModel = $this->loadModel('CategoryModel');
        $data['content'] = "components/admin/products/products";
        $data['subcontent']['categories'] = $CategoriesModel->getAllCategories();
        $data['subcontent']['page'] = 'products';
        $data['subcontent']['products'] = $this->getAllProducts();
        // foreach($data['subcontent']['products'] as $item){
        //     print_r($item);
        // }
        $this->render('layouts/AdminLayout', $data);
    }

    public function addProducts()
    {

        $productModel = $this->loadModel('ProductModel');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST)) {
                $name = $_POST['name'];
                $categoryId = $_POST['categoryId'];
                $price    = $_POST['price'];
                $quantity = $_POST['quantity'];
                $description = $_POST['description'];
                $imagePath = '';

                // xử lý đường dẫn
                if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'; // Thư mục lưu ảnh (nhớ tạo thư mục này trước)

                    // Tạo tên file mới để tránh trùng lặp (thêm time() vào trước)
                    $fileName = time() . '_' . basename($_FILES["img"]["name"]);
                    $targetFile = $targetDir . $fileName;

                    // Di chuyển file từ bộ nhớ tạm vào thư mục uploads
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
                        $imagePath = 'http://localhost/uploads/'. $fileName; // Lưu đường dẫn này vào DB
                    } else {
                        echo "Lỗi upload ảnh!";
                        return;
                        // Có thể return hoặc xử lý lỗi tại đây
                    }
                }

                $result = $productModel->createProduct($name, $categoryId, $price, $quantity, $imagePath, $description);
                if ($result) {
                    $this->render('components/status/addsuccess');
                    echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                } else {
                    echo "Thất bại";
                }
            }
        }
    }

    public function getAllProducts()
    {
        $productModel = $this->loadModel('ProductModel');
        $result = $productModel->getAllProducts();
        return $result;
    }

    public function edit($id)
    {
        $CategoriesModel = $this->loadModel('CategoryModel');
        $productModel = $this->loadModel('ProductModel');
        $data['content'] = "components/admin/products/edit";
        $data['subcontent']['product'] = $productModel->getProductById($id);
        $data['subcontent']['categories'] = $CategoriesModel->getAllCategories();
        $data['subcontent']['page'] = 'products';
        $this->render('layouts/AdminLayout', $data);
    }



    public function update($id)
    {
        $productModel = $this->loadModel('ProductModel');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST)) {
                $oldImg = $_POST['old_img'];
                $name = $_POST['name'];
                $categoryId = $_POST['categoryId'];
                $price    = $_POST['price'];
                $quantity = $_POST['quantity'];
                $description = $_POST['description'];
                $imgPath =   $oldImg;

                // xử lý đường dẫn
                if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'; // Thư mục lưu ảnh (nhớ tạo thư mục này trước)

                    // Tạo tên file mới để tránh trùng lặp (thêm time() vào trước)
                    $fileName = time() . '_' . basename($_FILES["img"]["name"]);
                    $targetFile = $targetDir . $fileName;

                    // Di chuyển file từ bộ nhớ tạm vào thư mục uploads
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
                        $imgPath = $targetFile; // Lưu đường dẫn này vào DB
                    }
                }

                $currentDate = date('Y-m-d');
                $data = [
                    'name' => $name,
                    'img' => $imgPath,
                    'description' => $description,
                    'price' => $price,
                    'quantity' => $quantity,
                    'categoryId' => $categoryId,
                    'updated_at' => $currentDate

                ];
                $result =  $productModel->update($id, $data);
                if ($result) {
                   $this->render('components/status/editsuccess');
                    echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                }
            }
        }
    }

    public function delete($id)
    {
        $this->productModel = $this->loadModel('ProductModel');
      $result =   $this->productModel->delete($id);
      echo $result; 
      exit(); 
       $this->render('components/status/deletesuccess');
        echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
    }
}
