<?php
require_once __DIR__ . '/AdminController.php';

class OrdersController extends AdminController
{
    private $orderModel;

    public function index() {
        $this->orderModel = $this->loadModel('OrderModel');
        $data['content'] = "components/admin/orders/orders";
        $data['subcontent']['page'] = 'orders';
        $data['subcontent']['orders'] = $this->orderModel->getAllOrders();
        $this->render('layouts/AdminLayout', $data);
    }

    // 
   public function updateStatus() {
    $this->orderModel = $this->loadModel('OrderModel');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // --- XÓA MẤY CÁI DÒNG DEBUG (echo, print_r, die) ĐI NHÉ ---
        
        $id = $_POST['order_id'];
        $status = $_POST['deliveryStatus'];

        // Kiểm tra xem ID có rỗng không cho chắc
        if (empty($id)) {
            echo '<script>alert("Lỗi: Không lấy được ID đơn hàng!"); window.history.back();</script>';
            return;
        }

        $result = $this->orderModel->updateDeliveryStatus($id, $status);

        if ($result) {
            echo '<script>alert("Cập nhật thành công!"); window.location.href="' . ROOTLINK . '/admin/orders";</script>';
        } else {
            echo '<script>alert("Lỗi cập nhật SQL!"); window.history.back();</script>';
        }
    }

}

    public function delete($id) {
        $this->orderModel = $this->loadModel('OrderModel');
        
        $result = $this->orderModel->deleteOrder($id);

        if ($result) {
            $this->render('/components/status/deletesuccess'); 
        } else {
            echo '<script>alert("Xóa thất bại! Vui lòng kiểm tra lại bảng order_details."); window.history.back();</script>';
        }
    }
}
?>