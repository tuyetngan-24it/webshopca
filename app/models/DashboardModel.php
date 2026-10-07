<?php
class DashboardModel extends Model
{
    // Không cần khai báo $table vì mình sẽ viết SQL join trực tiếp

    /**
     * 1. Lấy doanh thu từng tháng (Biểu đồ)
     */
    public function getMonthlyRevenue($year)   // hàm getMonthlyRevenue: trả về doanh thu theo Tháng
    {
        // Kiểm tra trạng thái 'delivered' (Giao thành công)
        $sql = "SELECT MONTH(created_at) as month, SUM(total) as revenue 
                FROM orders 
                WHERE deliveryStatus = 'delivered' 
                AND YEAR(created_at) = '$year' 
                GROUP BY MONTH(created_at)";
        
        $result = $this->db->query($sql);
        
        // Tạo mảng 12 tháng mặc định = 0
        $data = array_fill(1, 12, 0);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[(int)$row['month']] = (float)$row['revenue'];
            }
        }
        return $data; 
    }

    /**
     * 2. Tổng doanh thu cả năm
     */
    public function getTotalRevenueYear($year)
    {
        $sql = "SELECT SUM(total) as total 
                FROM orders 
                WHERE deliveryStatus = 'delivered'   -- NGHĨA CỦA DÒNG NÀY: VỚI ĐIỀU KIỆN TRẠNG THÁI GIAO HÀNG LÀ ĐÃ GIAO --
                AND YEAR(created_at) = '$year'"; // nghĩa: và năm tạo là năm hiện tại
        
        $result = $this->db->query($sql);  // truy vấn trả về kết quả
        $row = $result->fetch_assoc(); 
        return $row['total'] ?? 0;
    }

    /**
     * 3. Tổng số lượng sản phẩm đã bán
     * Lưu ý: Bảng 'orderdetails', cột 'productQuantity'
     */
    public function getTotalProductsSold($year)
    {
        $sql = "SELECT SUM(od.productQuantity) as total_qty 
                FROM orderdetails od
                JOIN orders o ON od.orderId = o.id     -- Join dùng để nối 2 bảng với nhau --
                WHERE o.deliveryStatus = 'delivered' 
                AND YEAR(o.created_at) = '$year'";

        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_qty'] ?? 0;
    }

    /**
     * 4. Sản phẩm bán chạy nhất
     * Lưu ý: Bảng 'orderdetails', cột 'productName', 'productQuantity'
     */
    public function getBestSellingProduct($year)
    {
        $sql = "SELECT od.productName as name, SUM(od.productQuantity) as total_sold
                FROM orderdetails od
                JOIN orders o ON od.orderId = o.id   
                WHERE o.deliveryStatus = 'delivered' 
                AND YEAR(o.created_at) = '$year'   
                GROUP BY od.productId, od.productName   -- nhóm theo 1 điều kiên --
                ORDER BY total_sold DESC  -- sắp xếp theo 1 điều kiện ( desc: cao nhất) -- 
                LIMIT 1"; // giới hạn 1 bảng ghi

        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}
?>