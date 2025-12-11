    <?php
    class CustomerModel extends Model
    {
        protected $table = 'users';

        public function createCustomer($username, $name, $email, $phone, $password)
        {
            $currentDate = date('Y-m-d');
            return $this->create([
                'username'    => $username,
                'name'        => $name,
                'email'       => $email,
                'numberPhone' => $phone,
                'password'    => md5($password),
                'roleid'      => 2,
                'create_at'   => $currentDate
            ]);
        }
        public function getAllCustomers()
        {
            $sql = "SELECT * FROM users WHERE roleid = 2 ";
            return $this->db->query($sql);
        }

        public function getCustomerById($id)
        {
            $result = $this->getOne($id);
            if ($result && $result->num_rows > 0) {
                $result = mysqli_fetch_assoc($result);
            }
            return $result;
        }

    public function deleteCustomer($id)
        {
            // 0. AN TOÀN: Escape ID
            $escapedId = $this->db->escape($id);

            // --- NHÓM 1: XÓA CÁC BẢNG LIÊN QUAN TRỰC TIẾP ĐẾN USER ---

            // 1. Xóa Message (Tin nhắn) - Quan trọng!
            // Xóa tin nhắn user gửi HOẶC nhận
            // (Trong ảnh cột là: senderId, receiveId)
            // $sqlMessage = "DELETE FROM message WHERE senderId = '{$escapedId}' OR receiveId = '{$escapedId}'";
            // $this->db->query($sqlMessage);

            // 2. Xóa Reviews (Đánh giá)
            // (Trong ảnh cột là: user_id - có gạch dưới)
            $sqlReviews = "DELETE FROM reviews WHERE user_id = '{$escapedId}'";
            $this->db->query($sqlReviews);

            // 3. Xóa Address (Địa chỉ)
            // (Trong ảnh cột là: userId - viết liền)
            $sqlAddress = "DELETE FROM address WHERE userId = '{$escapedId}'";
            $this->db->query($sqlAddress);


            // --- NHÓM 2: XỬ LÝ CỤM ĐƠN HÀNG (PHỨC TẠP NHẤT) ---

            // 4. Xóa OrderDetails (Chi tiết đơn hàng) - Phải xóa cái này thì mới xóa được Orders
            // Logic: Tìm tất cả orderId thuộc về user này, rồi xóa trong bảng orderdetails
            // (Trong ảnh bảng orders cột là userId, bảng orderdetails cột là orderId)
            // $sqlDetails = "DELETE FROM orderdetails 
            //        WHERE orderId IN (SELECT id FROM orders WHERE userId = '{$escapedId}')";
            // $this->db->query($sqlDetails);

            // 5. Xóa Orders (Đơn hàng)
            // Giờ thằng con orderdetails chết rồi, thằng cha orders mới được chết
            // $sqlOrders = "DELETE FROM orders WHERE userId = '{$escapedId}'";
            // $this->db->query($sqlOrders);


            // --- NHÓM 3: XÓA TRÙM CUỐI ---

            // 6. Xóa User
            $this->table = 'users';
            // Đảm bảo set đúng primary key (thường là id)
            $this->primaryKey = 'id';
            return $this->delete($id);
        }
    }
