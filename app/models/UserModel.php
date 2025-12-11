<?php
class UserModel extends Model
{
    protected $table = 'users';

    public function getInfo($idUser) {
        $sql = "SELECT avatar, email  FROM users WHERE id = $idUser"; 
        return $this->query($sql);
    }

    public function createUser($name, $email, $phone, $password)
    {
        $currentDate = date('Y-m-d');
        $password = md5($password);
        return $this->create([
            'username' => $name,
            'email' => $email,
            'numberPhone' => $phone,
            'password' => $password,
            'roleid' => '2',
            'create_at' => $currentDate
        ]);
    }




    public function isUsernameExist($username)
    {
        // 1. Escape dữ liệu cho an toàn (dùng hàm escape ông đã có)
        // Lưu ý: Nếu class Model cha chưa có escape thì dùng $this->db->escape
        $username = $this->db->escape($username);

        // 2. Viết query
        $sql = "SELECT id FROM users WHERE username = '$username'";

        // 3. Chạy query
        $result = $this->db->query($sql);

        // 4. Đếm số dòng trả về
        // Nếu > 0 tức là đã có người dùng rồi
        if ($result && mysqli_num_rows($result) > 0) {
            return true; // Đã tồn tại
        }

        return false; // Chưa tồn tại (Ngon)
    }


     public function isEmailExist($email)
    {
        // 1. Escape dữ liệu cho an toàn (dùng hàm escape ông đã có)
        // Lưu ý: Nếu class Model cha chưa có escape thì dùng $this->db->escape
        $username = $this->db->escape($email);

        // 2. Viết query
        $sql = "SELECT id FROM users WHERE email = '$email'";

        // 3. Chạy query
        $result = $this->db->query($sql);

        // 4. Đếm số dòng trả về
        // Nếu > 0 tức là đã có người dùng rồi
        if ($result && mysqli_num_rows($result) > 0) {
            return true; // Đã tồn tại
        }

        return false; // Chưa tồn tại (Ngon)
    }


    // =--------------Check Login------------
    public function checkLogin($email, $password)
    {
        // 1. Tìm user theo email
        $email = $this->db->escape($email);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = $this->db->query($sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // 2. Kiểm tra mật khẩu hash (Nếu lúc đăng ký ông dùng password_hash)
            if (md5($password) == $user['password']) {
                $user['role'] = $this->checkRole($user['roleid']);
                return $user; // Đúng pass -> Trả về thông tin user
            }
            // Lưu ý: Nếu lúc đăng ký ông KHÔNG mã hóa (lưu text thường) thì so sánh == thẳng luôn
            // if ($password == $user['password']) { return $user; }
        }

        return false; // Không tìm thấy hoặc sai pass
    }

    public function checkRole($UserId)
    {
        // lấy kết quả query từ $userId
        // 1. Sửa lại câu SQL cho đúng (ông bị dư dấu ngoặc vuông ']' ở cuối biến $UserId kìa)
        $sql = "SELECT roleid FROM users WHERE id = '$UserId'"; // Nhớ thêm dấu nháy đơn bao quanh ID nếu cần, và bỏ dấu ]


        // 2. Chạy query
        $result = $this->db->query($sql);
        $roleId = 2;
        // 3. Kiểm tra xem có dữ liệu không
        if ($result && mysqli_num_rows($result) > 0) {
            // 4. LẤY DỮ LIỆU RA (Fetch) - Bước quan trọng nhất
            $row = mysqli_fetch_assoc($result);
            // 5. Giờ mới echo được cái ruột bên trong
            $roleId =  $row['roleid'];
        }


        $sql = "SELECT name FROM roles WHERE id = $roleId";
        $result = $this->db->query($sql);
        $roleName = '';
        if ($result && mysqli_num_rows($result) > 0) {
            // 4. LẤY DỮ LIỆU RA (Fetch) - Bước quan trọng nhất
            $row = mysqli_fetch_assoc($result);
            // 5. Giờ mới echo được cái ruột bên trong
            $roleName =  $row['name'];
        }
        return $roleName;
    }
    public function updateUser($id, $data)
{
    // Tạo chuỗi SET cho câu lệnh SQL
    $setParts = [];
    foreach ($data as $column => $value) {
        // Escape dữ liệu để tránh lỗi SQL Injection
        $escapedValue = $this->db->escape($value);
        $setParts[] = "`$column` = '$escapedValue'";
    }

    // Luôn cập nhật thời gian updated_at
    $setParts[] = "`updated_at` = NOW()";

    $setString = implode(', ', $setParts);
    
    // Câu lệnh SQL: UPDATE users SET name='...', email='...' WHERE id = ...
    $sql = "UPDATE users SET $setString WHERE id = '$id'";
    
    return $this->db->query($sql);
}
public function getUserById($id)
{
    // Escape ID cho an toàn
    $id = $this->db->escape($id);
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $this->db->query($sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}
}
