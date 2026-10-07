<?php
class AdminController extends Controller
{
  private $userModel; 
  // tải trang admin
  function __construct()  
  {
    $this->userModel = $this->loadModel('UserModel'); 
    // 2. Check đăng nhập cơ bản
    if (!isset($_SESSION['user'])) {

      header('Location: '.ROOTLINK.'/login ');
      exit();
    }
    $userId = $_SESSION['user']['id'];
    $freshUser = $this->userModel->checkRole($userId);
    $_SESSION['user']['role'] = $freshUser;
    if ($_SESSION['user']['role'] != 'admin') {
      $this->render('/components/status/notpermission');
      exit();
    }
  }
}
