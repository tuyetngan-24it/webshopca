<?php
require_once __DIR__ . '/../../models/DashboardModel.php';
require_once __DIR__ . '/AdminController.php';

class DashboardController extends AdminController // Nhớ kế thừa AdminController để check quyền admin
{
    private $dashboardModel;

    public function __construct()
    {
        parent::__construct(); // Gọi constructor cha để check login admin
        $this->dashboardModel = new DashboardModel();
    }

    public function index()
    {
        // Lấy năm từ GET, nếu không có thì lấy năm hiện tại
        $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

        // 1. Lấy dữ liệu biểu đồ (12 tháng)
        $monthlyData = $this->dashboardModel->getMonthlyRevenue($year);
        
        // Chuẩn bị dữ liệu cho ChartJS (Label tháng và Data doanh thu)
        // array_values để lấy mảng số index từ 0 cho JS dễ đọc
        $chartData = array_values($monthlyData); 

        // 2. Lấy các thống kê khác
        $totalRevenue = $this->dashboardModel->getTotalRevenueYear($year);
        $totalProducts = $this->dashboardModel->getTotalProductsSold($year);
        $bestSeller = $this->dashboardModel->getBestSellingProduct($year);

        // Đóng gói dữ liệu
        $data['content'] = 'components/admin/dashboard/revenue';
        $data['subcontent']['page'] = 'dashboard';
        
        $data['subcontent']['year'] = $year;
        $data['subcontent']['chartData'] = json_encode($chartData); // Chuyển sang JSON để JS đọc
        $data['subcontent']['totalRevenue'] = $totalRevenue;
        $data['subcontent']['totalProducts'] = $totalProducts;
        $data['subcontent']['bestSeller'] = $bestSeller;

        $this->render('layouts/AdminLayout', $data);
    }
}
?>