<?php
class CategoriesController extends Controller
{

  function index()
  {
    $categories = $this->loadModel('CategoryModel');   // 
    $data['content'] = 'components/Categories';
    $data['sub_content']['info'] = 'Home';
     $data['sub_content']['headerPage'] = 'product';
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $data['sub_content']['categories'] = $categories->getAllCategories(); 
    $this->render('layouts/HomeLayout', $data);
  }
}
