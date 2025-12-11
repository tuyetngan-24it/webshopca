<?php
class AboutController extends Controller
{
  function index()
  {
    $data['content'] = 'components/About';  
     $data['sub_content']['headerPage'] = 'about';
    $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role']; 
    $this->render('layouts/MasterLayout', $data);
  }
}
