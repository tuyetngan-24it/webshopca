<?php
import(__DIR__ . '\AdminController.php');
class CategoriesController extends AdminController
{
    private $categoriesModel;
    // tải trang admin
    public function index()
    {

        $data['content'] = "components/admin/categories/categories";
        $data['subcontent']['page'] = 'categories';
        $data['subcontent']['categories'] = $this->getAllCategories();
        $this->render('layouts/AdminLayout', $data);
    }

    // action thêm danh mục
    public function addCategories()
    {
        $this->categoriesModel = $this->loadModel('CategoryModel');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST)) {
                $name = $_POST['name'];
                $desc = $_POST['description'];
                $result =  $this->categoriesModel->createCategories($name, $desc);
                if ($result) {
                     $this->render('components/status/addsuccess');
                    echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                } else {
                }
            }
        }
    }
    // tải tất cả các danh mục
    public function getAllCategories()
    {
        $this->categoriesModel = $this->loadModel('CategoryModel');
        $result  =  $this->categoriesModel->getAllCategories();
        return $result;
    }



    public function edit($id)
    {

        $this->categoriesModel = $this->loadModel('CategoryModel');
        $data['content'] = "components/admin/categories/edit";
        $data['subcontent']['page'] = 'categories';
        $data['subcontent']['category'] = $this->categoriesModel->getCategoryById($id);
        $this->render('layouts/AdminLayout', $data);

        // handle update

    }

    public function update($id)
    {
        $this->categoriesModel = $this->loadModel('CategoryModel');
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST)) {
                $name = $_POST['name'];
                $desc = $_POST['description'];
                $data = [
                    'name' => $name,
                    'description' => $desc
                ];
                $result =  $this->categoriesModel->update($id, $data);
                if ($result) {
                     $this->render('components/status/editsuccess');
                    echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                }
            }
        }
    }


    public function delete($id)
    {
        $this->categoriesModel = $this->loadModel('CategoryModel');
        $result = $this->categoriesModel->delete($id);
        if ($result) {
            if ($result == 1451) {
                $this->render('components/status/warningcate');
                 echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                return;
            }
            $this->render('components/status/deletesuccess');
             echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
        } else {
            echo "Đã xảy ra lối";
        }
    }
}
