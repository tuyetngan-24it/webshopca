<?php
class ProfileController extends Controller
{
    // 1. HIỂN THỊ TRANG PROFILE
    function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . ROOTLINK . "/login");
            exit;
        }
        $userId = $_SESSION['user']['id'];

        // --- SỬA LỖI: Gọi đúng tên 'UserModel' ---
        $userModel = $this->loadModel('UserModel');

        $freshUser = $userModel->getUserById($userId);
        if ($freshUser) {
            $data['user_info'] = $freshUser;
            $_SESSION['user']['username'] = $freshUser['username'];
        }

        // --- SỬA LỖI: Gọi đúng tên 'AddressModel' ---
        $addressModel = $this->loadModel('AddressModel');
        $data['content'] = 'components/Profile';
        $data['sub_content']['info'] = 'Profile';
        $data['sub_content']['name'] = $freshUser['name'];
        $data['sub_content']['numberPhone'] = $freshUser['numberPhone'];
        $data['sub_content']['username'] = $_SESSION['user']['username'];
        $data['sub_content']['role'] = $_SESSION['user']['role'];
        $data['sub_content']['my_addresses'] = $this->getAllAddress();
        $info = $this->loadModel('UserModel')->getInfo($_SESSION['user']['id']);
        $data['sub_content']['info'] = $info;
        $this->render('layouts/HomeLayout', $data);
    }


    // 2. UPDATE PROFILE
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];

            // --- SỬA LỖI: Gọi đúng tên 'UserModel' (Không phải UserloadModel) ---
            $userModel = $this->loadModel('UserModel');

            $updateData = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'numberPhone' => $_POST['phone']
            ];

            if (!empty($_POST['password'])) {
                $updateData['password'] = md5($_POST['password']);
            }

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $targetDir = "public/uploads/";
                if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

                $fileName = time() . '_' . basename($_FILES["avatar"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                    $updateData['avatar'] = $fileName;
                    $_SESSION['user']['avatar'] = $fileName;
                }
            }

            // Gọi hàm từ biến $userModel chuẩn
            $userModel->updateUser($userId, $updateData);
            header("Location: " . ROOTLINK . "/profile");
        }
    }

    // 3. THÊM ĐỊA CHỈ
    public function addAddress()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
            $addressModel = $this->loadModel('AddressModel');
            $streetDetail = $_POST['street_detail'];
            $provinceName = $_POST['province_name'];
            $wardName =  $_POST['ward_name'];
            $provinceId =  $addressModel->AddProvince($provinceName);
            $wardId =  $addressModel->addWard($wardName);

            // dữ liệu gửi đi
            $data = [
                'proviceId' => $provinceId,
                'wardId' => $wardId,
                'streetDetail' => $streetDetail,
                'userId' => $_SESSION['user']['id'],
                'create_at' => date('y:m:d')
            ];

            $result =  $addressModel->addAddress($data);
            if ($result) {
               $this->render('components/status/addsuccess'); 
                echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
            } else {
                echo "Thêm thất bại, vui lòng thử lại";
            }
        }
    }


    public function getAllAddress()
    {
        $addressModel = $this->loadModel('AddressModel');
        return $addressModel->getAllAdressById($_SESSION['user']['id']);
    }
    // 4. XÓA ĐỊA CHỈ
    public function deleteAddress()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $addressId = $_POST['id'];
                $addressModel = $this->loadModel('AddressModel');
                $result =  $addressModel->deleteAddress($addressId);
                if ($result) {
                     $this->render('components/status/deletesuccess'); 
                    echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                } else {
                      $this->render('components/status/failure'); 
                    echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
                }
            }
        }
    }
}
