<?php 
class CategoryModel extends Model{
      protected $table = 'categories';
     public function createCategories($name, $description) {
        $currentDate = date('Y-m-d');
        return $this->create([
            'name'=>$name,
            'description'=>$description,
            'created_at'=>$currentDate
        ]); 
     }

     public function getAllCategories() {
       return  $this->getAll(); 
     }

     public function getCategoryById($id) {
      $result  =  $this->getOne($id); 
      if($result&&$result->num_rows >0) {
        $result = mysqli_fetch_assoc($result); 
      }
      return $result; 
     }


    public function getCategoriesLimit($limit) {
     return $this->getDataPerPage(1, $limit);
    }

    public function delete($id) {
      $sql = 'DELETE FROM categories WHERE id = '.$id.' ';
      $result = $this->query($sql); 
      return $result; 
    }
     
}