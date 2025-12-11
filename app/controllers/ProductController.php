<?php
class ProductController extends Controller
{
    private $productModel;

    public function getProducPerPage($page = 1, $limit = 1)
    {
        $this->productModel = $this->loadModel('ProductModel');
        $result =   $this->productModel->getProductPerPage($page, $limit);
        // echo $this->productModel->getTotalPage($limit);
        echo $result;
    }

    public function getTotalPage($limit, $keyword='')
    {
        $this->productModel = $this->loadModel('ProductModel');
        echo $this->productModel->getTotalPage($limit, $keyword);
    }



    
    public function getProductPerPageById($keyword, $page=1,$limit =1) {
        $this->productModel = $this->loadModel('ProductModel'); 
        $result = $this->productModel->getProductLimitByCategories($keyword, $page, $limit); 
        echo $result; 
    }


    public function getProductNameByName($keyword, $page, $limit = 12) {
         $this->productModel = $this->loadModel('ProductModel'); 
        $result = $this->productModel->getProductByName($limit, $keyword);
        echo $result;  
    }



}
