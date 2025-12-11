<?php
class RegisterController extends Controller
{
    // private $error; // Kh chưa dùng thì comment lại cho đỡ warning
    private $userModel;
    function index()
    {
        $data['content'] = 'components/Login';
        $data['sub_content']['register_error'] =  $_SESSION['signup-error'] ?? '';
        $this->render('layouts/LoginLayout', $data);
        unset($_SESSION['errors_register']);
    }


    public function handleRegister()
    {
        $this->userModel =  $this->loadModel('UserModel');
        // Đặt header lên đầu để đảm bảo luôn trả về JSON
        header("Content-Type: application/json");

        // 1. Lấy dữ liệu và làm sạch
        $field = $_POST['field'] ?? '';
        $value = trim($_POST['value'] ?? '');

        // 2. Cấu trúc phản hồi mặc định (Mặc định là đúng)
        $response = [
            "valid" => true,
            "message" => ""
        ];

        // 3. Xử lý Switch Case
        switch ($field) {
            case 'username':
                if (empty($value)) {
                    $response = ["valid" => false, "message" => "Vui lòng nhập tên đăng nhập."];
                } elseif (strlen($value) < 3) {
                    $response = ["valid" => false, "message" => "Tên đăng nhập phải từ 3 ký tự trở lên."];
                } elseif ($this->userModel->isUsernameExist($value)) {
                    // Nếu Model trả về TRUE -> Báo lỗi
                    $response = ["valid" => false, "message" => "Tên đăng nhập này đã có người dùng."];
                }
                break;

            case 'email':
                if (empty($value)) {
                    $response = ["valid" => false, "message" => "Vui lòng nhập Email."];
                } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $response = ["valid" => false, "message" => "Email không đúng định dạng."];
                }
                elseif($this->userModel->isEmailExist($value)){
                     $response = ["valid" => false, "message" => "Email đã được sử dụng"];
                }
                break;

            case 'phone':
                if (empty($value)) {
                    $response = ["valid" => false, "message" => "Vui lòng nhập số điện thoại."];
                } elseif (!preg_match('/^0[0-9]{9}$/', $value)) {
                    $response = ["valid" => false, "message" => "SĐT phải gồm 10 số và bắt đầu bằng 0."];
                }
                break;

            case 'password':
                if (empty($value)) {
                    $response = ["valid" => false, "message" => "Vui lòng nhập mật khẩu."];
                } elseif (strlen($value) < 6) {
                    $response = ["valid" => false, "message" => "Mật khẩu phải ít nhất 6 ký tự."];
                }
                break;
        }





        // 4. Trả về JSON
        // NẾU ĐÚNG: $response vẫn là ["valid" => true, "message" => ""]
        // NẾU SAI: $response là ["valid" => false, "message" => "Lỗi..."]

        // Tuyệt đối KHÔNG ĐƯỢC gán lại $response = ['status' => 'success'] đè lên mảng cũ
        // Nếu muốn thêm status thì gán thêm vào:
        if ($response['valid']) {
            $response['status'] = 'success';
        }




        echo json_encode($response);
        exit(); // Dùng exit để ngắt luồng, đảm bảo không có HTML thừa
    }



    public function createUser()
    {
        header("Content-Type: application/json");
        // 1. Lấy dữ liệu từ form gửi lên
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // 2. VALIDATE LẠI (Backend phải check kỹ, lỡ tụi nó dùng Postman bắn thẳng vào thì sao?)
        $errors = [];

        // Check Username
        if (empty($username) || strlen($username) < 3) {
            $errors['username'] = "Tên đăng nhập không hợp lệ";
        }
        // Check Email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        }
        // Check Phone
        if (empty($phone) || !preg_match('/^0[0-9]{9}$/', $phone)) {
            $errors['phone'] = "Số điện thoại không hợp lệ";
        }
        // Check Password
        if (empty($password) || strlen($password) < 6) {
            $errors['password'] = "Mật khẩu quá ngắn";
        }

        // Check trùng trong DB (Nên làm)
        // if ($this->userModel->checkUsername($username)) $errors['username'] = "Tên đã tồn tại";

        // 3. Nếu có lỗi -> Trả về lỗi ngay
        if (!empty($errors)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $errors // Trả cái này về để JS hiển thị đỏ lòm từng ô
            ]);
            exit();
        }


        // 4. Nếu ngon lành -> Gọi Model lưu
        // Gọi hàm createUser bên dưới (nhớ sửa lại hàm đó tí)
        $this->userModel =  $this->loadModel('UserModel');
        $newUserId = $this->userModel->createUser($username, $email, $phone, $password);

        if ($newUserId) {
            // Lưu session login luôn cho xịn
            $_SESSION['user'] = [
                'id' => $newUserId,
                'username' => $username,
                'roleid' => '2',
                'role'=>'user'
            ];

            echo json_encode(['status' => 'success', 'message' => 'Đăng ký thành công!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Đăng ký thất bại']);
        }
        exit();
    }
}
