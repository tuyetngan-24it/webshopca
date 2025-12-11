<?php
class HomeController extends Controller
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
    $blogModel = $this->loadModel('BlogModel'); // nạp model từ hàm loadmodel 
    $blogs = $blogModel->getLatestBlogs(); // trả về dữ liệu blogs
    $data['content'] = 'components/Home';
    $data['sub_content']['headerPage'] = 'home';
    $data['sub_content']['info'] = 'Home';
    $data['sub_content']['blogs'] = $blogs;
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['categories'] = $this->loadModel('CategoryModel')->getCategoriesLimit(3);
    $data['sub_content']['products'] = $this->loadModel('ProductModel')->getNewProducts(8);
    $data['sub_content']['hotproducts'] = $this->loadModel('ProductModel')->getHotProducts(8);
    $this->render('layouts/HomeLayout', $data);
  }
}
