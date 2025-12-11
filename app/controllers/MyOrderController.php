<?php
class MyOrderController extends Controller
{
  function __construct()
  {

    $userId = $_SESSION['user']['id'] ?? null;
    if ($userId == null) {
      redirect('login');
    }
  }

  function index()
  {
    $orderModel = $this->loadModel('OrderModel');
    $id =   $_SESSION['user']['id'];
   $AllOrders =  $orderModel->getAllOrderById($id);
    $data['content'] = 'components/MyOrder';//view
    $data['sub_content']['info'] = 'MyOrder';
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['orders'] = $AllOrders; 
    $this->render('layouts/HomeLayout', $data);
    
  }


  function add() {}
}
