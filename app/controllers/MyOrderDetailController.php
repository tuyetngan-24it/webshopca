<?php
class MyOrderDetailController extends Controller
{
  private $orderDetailModel;
  function __construct()
  {

    $userId = $_SESSION['user']['id'] ?? null;
    if ($userId == null) {
      redirect('login');
    }
  }

  function index($orderid)
  {


    $this->orderDetailModel = $this->loadModel('OrderDetailModel');
    $data['content'] = 'components/MyOrderDetail';
    $data['sub_content']['info'] = 'Home';
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['orderItems'] = $this->orderDetailModel->getAllOrderDetail($orderid);
    $this->render('layouts/HomeLayout', $data);
  }
}
