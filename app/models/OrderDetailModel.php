<?php
// Kế thừa từ Model
class OrderDetailModel extends Model
{
    // Khai báo bảng chính cho Model này là 'orders'
    protected $table = 'orderdetails';
    public function insertOrderDetail($data)
    {
        // Gọi hàm insert của class Database ($this->db)
        return  $this->db->insert($this->table,$data) ;
    }

   public function getAllOrderDetail($orderId) {
        // 1. Ép kiểu về số nguyên để bảo mật (tránh SQL Injection)
        $orderId = (int)$orderId;

        // 2. Viết câu SQL JOIN với bảng products
        // Giả sử: bảng orderdetails có cột 'productId' nối với bảng products cột 'id'
        $sql = "SELECT orderdetails.*, reviews.rating , products.name, products.img 
                FROM orderdetails 
                JOIN products ON orderdetails.productId = products.id 
                LEFT JOIN reviews ON orderdetails.orderId = reviews.orderid AND orderdetails.productId = reviews.product_id
                WHERE orderdetails.orderId = $orderId";

        // 3. Thực thi
        return $this->db->query($sql);
    }
}