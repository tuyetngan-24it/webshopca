<?php
class BlogModel extends Model {
    protected $table = 'blogs';

    public function getBlogs($keyword = '', $categoryId = 'all') {
        // LEFT JOIN để lấy tên danh mục (c.name)
         $sql = "SELECT b.*, c.name as cat_name 
            FROM blogs b 
            LEFT JOIN categories_blog c ON b.category_id = c.id 
            WHERE 1=1"
            ;

        // 1. Tìm kiếm theo từ khóa (LIKE)
        if (!empty($keyword)) {
            $safeKeyword = $this->db->escape($keyword);
            $sql .= " AND (b.title LIKE '%$safeKeyword%' OR b.description LIKE '%$safeKeyword%')";
        }

        // 2. Lọc theo danh mục
        if (!empty($categoryId) && $categoryId != 'all') {
            $safeCat = $this->db->escape($categoryId);
            $sql .= " AND b.category_id = '$safeCat'";
        }

        $sql .= " ORDER BY b.created_at DESC";

        $result = $this->db->query($sql);
        
        // Trả về mảng dữ liệu luôn để Controller đỡ phải   while loop
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }
    public function getLatestBlogs() {
    $sql = "SELECT b.*, c.name as cat_name 
            FROM blogs b 
            LEFT JOIN categories_blog c ON b.category_id = c.id 
            WHERE 1=1
            ORDER BY b.created_at DESC  -- Thêm dòng này để lấy bài mới nhất
            LIMIT 3";
            
    return $this->getByQuery($sql);   // trả về 1 mảng dữ liệu
}

    public function getAllCategories() {
        $sql = "SELECT * FROM categories_blog";
        $result = $this->db->query($sql);
        $cats = [];
        if($result) {
            while($row = mysqli_fetch_assoc($result)){
                $cats[] = $row;
            }
        }
        return $cats;
    }
    public function createBlog($data) {
        // $data là mảng associative: ['title' => '...', 'description' => '...', ...]
        // Sử dụng hàm insert của framework hoặc viết SQL thuần
        
        $title = $this->db->escape($data['title']);
        $desc = $this->db->escape($data['description']);
        $content = $this->db->escape($data['content']);
        $image = $this->db->escape($data['image']);
        $cat_id = intval($data['category_id']);
        
        $sql = "INSERT INTO blogs (title, description, content, image, category_id, created_at) 
                VALUES ('$title', '$desc', '$content', '$image', $cat_id, NOW())";
        
        return $this->db->query($sql);
    }

    // 2. Xóa bài viết
    public function deleteBlog($id) {
        $id = intval($id);
        $sql = "DELETE FROM blogs WHERE id = $id";
        return $this->db->query($sql);
    }
    
    // 3. Lấy 1 bài viết để sửa
    public function getBlogById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM blogs WHERE id = $id";
        $result = $this->db->query($sql);
        return mysqli_fetch_assoc($result);
    }
}