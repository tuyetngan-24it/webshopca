<?php 
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
$webRoot = 'https://'. $_SERVER['HTTP_HOST'];   // http://localhost/dacs2 --> value
}
else {
    $webRoot = 'http://'. $_SERVER['HTTP_HOST']; 
}
// xử lý rootpath
$serverPath = strtolower($_SERVER['DOCUMENT_ROOT']); 
$rootPath = strtolower(__DIR_ROOT__); 
$rootPath = str_replace('\\', '/', $rootPath);

$folder = str_replace($serverPath, '', $rootPath); 
// $folder = ltrim($folder, '/'); 
$webRoot=$webRoot.$folder; 
define("ROOTLINK", $webRoot); 