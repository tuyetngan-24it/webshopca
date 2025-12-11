<?php
// File: models/OrderModel.php

class OrderModel extends Model
{
    protected $table = 'orders';

    // =================================================================
    // PHẦN 1: ADMIN
    // =================================================================

    public function getAllOrders()
    {
        // SQL dùng LEFT JOIN để không bị mất đơn hàng nếu thiếu thông tin phụ
        $sql = "SELECT orders.*, 
                       users.username as username,
                       users.name as customer,
                       provinces.name as province,
                       wards.name as ward,
                       address.streetDetail as street
                FROM orders 
                LEFT JOIN users ON orders.userId = users.id
                LEFT JOIN address ON orders.addressId = address.id 
                LEFT JOIN provinces ON address.proviceId = provinces.id -- CHECK LẠI: là 'proviceId' hay 'provinceId'?
                LEFT JOIN wards ON address.wardId = wards.id
                ORDER BY orders.id DESC";

        $result = $this->db->query($sql);

        // --- ĐOẠN NÀY ĐỂ DEBUG (CHẠY XONG XÓA ĐI) ---
    
        // ---------------------------------------------

        return $result;
    }
    public function getOrderById($id)
    {
        $result = $this->getOne($id);
        return ($result && $result->num_rows > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function updateDeliveryStatus($id, $status)
    {
        // Set múi giờ VN
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Chuẩn bị data (đúng tên cột deliveryStatus trong hình)
        $data = [
            'deliveryStatus' => $status,
            'updated_at'     => date('Y-m-d H:i:s')
        ];

        // Gọi hàm update của Database
        return $this->db->update('orders', $data, "id = $id");
    }

    public function deleteOrder($id)
    {
        /**
         * QUAN TRỌNG: 
         * Nhìn hình ông gửi thì cột khóa ngoại tên là 'orderId' (chuẩn rồi).
         * Giờ chỉ cần sửa lại tên bảng cho đúng nữa thôi.
         */

        // Thay 'order_details' bằng tên bảng thật (VD: 'orderdetails', 'OrderDetail'...)
        $this->db->delete('orderdetails', "orderId = $id");
        // Nếu tên bảng là 'order_detail' thì sửa thành 'order_detail' nhé!

        // Xóa đơn hàng chính
        return $this->db->delete('orders', "id = $id");
    }

    // =================================================================
    // PHẦN 2: CLIENT
    // =================================================================

    public function insertOrder($data)
    {
        return $this->create($data);
    }

    public function insertOrderDetail($data)
    {
        return $this->db->insert('order_details', $data);
    }

    public function getAllOrderById($userId)
    {
        // Đúng tên cột userId
        $sql = "SELECT * FROM orders WHERE userId = $userId ORDER BY id DESC";
        return $this->db->query($sql);
    }
    public function updateStatus($id, $status)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $updated_at = date('Y-m-d H:i:s');

        // Ép kiểu ID về số nguyên cho an toàn (tránh SQL Injection cơ bản)
        $id = (int)$id;

        // Viết câu SQL cập nhật trực tiếp
        // Lưu ý: Cột 'status' phải đúng tên trong Database (nếu là payment_status thì sửa lại nhé)
        $sql = "UPDATE orders 
                SET status = '$status', updated_at = '$updated_at' 
                WHERE id = $id";

        // Gọi hàm query (giống hệt cách bạn làm ở hàm getAllOrders)
        return $this->db->query($sql);
    }
}
