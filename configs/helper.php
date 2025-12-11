<?php
// kiểm tra user đã login hay chưa, nếu chưa thì điều hướng về trang login



function redirect($path = '')
{
    header('Location: ' . ROOTLINK . '/' . $path);
    exit();
}


function import($path) {
if(file_exists($path)){
   require_once $path; 
}
}


function toSlug($str) {
    if (!$str) return '';
    $str = trim(mb_strtolower($str));
    
    // Đổi ký tự có dấu thành không dấu
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    
    // Xóa ký tự đặc biệt
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    // Thay khoảng trắng bằng dấu gạch ngang
    $str = preg_replace('/([\s]+)/', '-', $str);
    
    return $str;
}
