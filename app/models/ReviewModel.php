<?php
// models/ReviewModel.php

class ReviewModel extends Model
{
    protected $table = 'reviews';

    // Lấy danh sách đánh giá của 1 sản phẩm
    public function getReviewsByProduct($productId)
    {
        $sql =  $sql = "SELECT r.*, u.name as user_name, u.username, u.avatar as avatar

                FROM reviews r

                JOIN users u ON r.user_id = u.id  

                WHERE r.product_id = $productId

                ORDER BY r.created_at DESC";
        // LƯU Ý: Ở dòng JOIN phía trên tôi đã sửa 'r.product_id' thành 'r.user_id' 
        // Vì nối bảng User phải dùng User ID, không dùng Product ID.

        return $this->query($sql);
    }

    // Kiểm tra xem user đã đánh giá sản phẩm trong đơn hàng này chưa
    public function checkReviewExist($userId, $productId, $orderId)
    {
        $sql = "SELECT id FROM reviews 
                WHERE user_id = $userId 
                AND product_id = $productId 
                AND orderid = $orderId";
        $result = $this->getByQuery($sql);
        return !empty($result);
    }

    // --- SỬA LỖI 'Unknown column userid' TẠI ĐÂY ---
    public function addReview($data)
    {
        // Kiểm tra và đổi tên key cho đúng với Database

        // 1. Sửa userid -> user_id
        if (isset($data['userid'])) {
            $data['user_id'] = $data['userid'];
            unset($data['userid']); // Xóa key sai đi
        }

        // 2. Sửa productid -> product_id
        if (isset($data['productid'])) {
            $data['product_id'] = $data['productid'];
            unset($data['productid']);
        }

        // 3. Đề phòng order_id bị sai -> orderid (Database của bạn là orderid viết liền)
        if (isset($data['order_id'])) {
            $data['orderid'] = $data['order_id'];
            unset($data['order_id']);
        }

        return $this->create($data);
    }

    // Tính điểm trung bình sao
    public function getAvgRating($productId)
    {
        $sql = "SELECT AVG(rating) as avg_rating, COUNT(id) as total_review 
                FROM reviews WHERE product_id = $productId";
        return $this->getFirstByQuery($sql);
    }

    public function getAllReviewByProductId($id)
    {
        $sql = "SELECT 
                reviews.*,
                products.name as products,
                users.name as users, users.avatar
                FROM `reviews`
                JOIN products ON reviews.product_id = products.id
                JOIN users ON reviews.user_id = users.id
                JOIN orders ON reviews.orderid = orders.id
                WHERE reviews.product_id = $id";

        $result =  $this->query($sql);
        return $result;
    }

    public function totalReviews($id)
    {
        $sql = "SELECT 
                COUNT(reviews.id) as totalreviews
                FROM `reviews`
                JOIN products ON reviews.product_id = products.id
                JOIN users ON reviews.user_id = users.id
                JOIN orders ON reviews.orderid = orders.id
                WHERE reviews.product_id = $id";

        $result = $this->query($sql);
        $result = $result->fetch_assoc();
        return $result['totalreviews'];
    }

    public function avgRating($id)
    {
        $sql = "SELECT 
                AVG(reviews.rating) as rating
                FROM `reviews`
                JOIN products ON reviews.product_id = products.id
                WHERE reviews.product_id = $id";

        $result = $this->query($sql);
        $result = $result->fetch_assoc();
        return $result['rating'];
    }
}
