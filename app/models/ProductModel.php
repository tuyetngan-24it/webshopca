<?php
class ProductModel extends Model
{

    protected $table = 'products';


    // hàm tạo products; 
    public function createProduct($name, $categoryId, $price, $quantity, $imgPath, $description)
    {
        $currentDate = date('Y-m-d');
        $data = [
            'name' => $name,
            'categoryId' => $categoryId, // Lưu ý tên cột trong DB của bạn
            'price' => $price,
            'quantity' => $quantity,
            'img' => $imgPath,        // Lưu đường dẫn ảnh (string)
            'description' => $description,
            'created_at' => $currentDate
        ];
        return $this->create($data);
    }

    //
    public function getAllProducts()
    {
        $result = $this->query('SELECT p.*, c.name as categoryName 
            FROM products p 
            JOIN categories c ON p.categoryId = c.id
            ORDER BY p.id DESC');
        return $result;
    }

    public function getProductById($id)
    {
        $result =  $this->getOne($id);
        if ($result && $result->num_rows > 0) {
            $result = mysqli_fetch_assoc($result);
        }
        return $result;
    }

    public function getProductPerPage($page, $limit)
    {
        $data = [];
        $result = $this->getDataPerPage($page, $limit);

        if ($result && $result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                // 1. Tính toán Slug trước
                $slugName = toSlug($rows['name']);
                $fullSlug = $slugName . '-' . $rows['id'];

                // 2. Nhét Slug (và đường dẫn) vào trong dòng dữ liệu ($rows)
                $rows['slug'] = $fullSlug;
                // Nên thêm cái này để tiện dùng trong JS
                $rows['url'] = "" . $fullSlug . ".html";

                // 3. Cuối cùng mới đẩy dòng dữ liệu hoàn chỉnh vào mảng tổng
                $data[] = $rows;
            }
        }

        // Lưu ý: Nếu Controller của bạn cần mảng để foreach thì đừng json_encode ở đây.
        // Nếu chỉ dùng cho AJAX thì OK.
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getProductLimit($limit)
    {
        return $this->getDataPerPage(1, 1);
    }


    public function getProductLimitByCategories($keyword, $page, $limit)
    {
        $result =  $this->getDataByCategoryName($keyword, $page, $limit);
        $data = [];
        $result = $this->getDataPerPage($page, $limit);

        if ($result && $result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                // 3. Cuối cùng mới đẩy dòng dữ liệu hoàn chỉnh vào mảng tổng
                $data[] = $rows;
            }
        }

        // Lưu ý: Nếu Controller của bạn cần mảng để foreach thì đừng json_encode ở đây.
        // Nếu chỉ dùng cho AJAX thì OK.
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getTotalPage($limit, $keyword = "")
    {
        if ($keyword != "") {
            $sql_count = "SELECT COUNT(*) as total FROM products WHERE $keyword = $keyword";
        } else {
              $sql_count = "SELECT COUNT(*) as total FROM products ";
            $result = $this->query($sql_count);
            $row = mysqli_fetch_assoc($result);
            $totalRows  = $row['total'];
            $totalPages = ceil($totalRows / (int)$limit);
            return json_encode($totalPages, JSON_UNESCAPED_UNICODE);
        }
    }




    // Lưu ý thứ tự tham số: $quantity trước, $productId sau (như bạn gọi ở Controller)
    public function decreaseStock($quantity, $productId)
    {
        // Chỉ trừ KHI VÀ CHỈ KHI số lượng trong kho ĐỦ LỚN (>= số lượng mua)
        $sql = "UPDATE products 
            SET quantity = quantity - $quantity 
            WHERE id = $productId AND quantity >= $quantity";

        // Thực thi
        $result = $this->query($sql);

        // Kiểm tra xem có dòng nào được update không?
        // Nếu affected_rows = 0 nghĩa là kho không đủ hàng -> Update thất bại
    }

    // ProductModel.php
    public function getProductsForAI()
    {
        // Chỉ lấy tên và giá, mô tả ngắn
        $sql = "SELECT name, price, quantity FROM products";
        $result = $this->db->query($sql); // Giả sử bạn dùng thư viện DB như các bài trước

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $status = ($row['quantity'] > 0) ? "Còn hàng" : "Hết hàng";
            $price = number_format($row['price'], 0, ',', '.') . 'đ';
            // Tạo chuỗi dạng: "- Cá Rồng (5.000.000đ) - Tình trạng: Còn hàng"
            $data[] = "- {$row['name']} (Giá: {$price}) - {$status}";
        }

        // Nối lại thành 1 đoạn văn bản dài
        return implode("\n", $data);
    }


    public function findById($id)
    {
        // 1. Bảo mật: Escape ID tránh SQL Injection
        $id = $this->db->escape($id);

        // 2. Viết câu SQL
        // Lấy sản phẩm + Tên danh mục (JOIN bảng categories)
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p
                LEFT JOIN categories c ON p.categoryId = c.id
                WHERE p.id = $id";

        // 3. Gọi hàm lấy 1 dòng (đã viết trong BaseModel)
        return $this->getFirstByQuery($sql);
    }


    public function getProductByName($limit, $name)
    {
        $sql  = "SELECT * FROM `products` WHERE name LIKE '%$name%' limit $limit";
        $result = $this->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return  json_encode($data);
    }


    // 1. Lấy sản phẩm MỚI NHẤT (Sắp xếp theo ID giảm dần)
    public function getNewProducts($limit)
    {
        // Viết SQL nối chuỗi theo style của bạn
        $sql = "SELECT * FROM `products` ORDER BY id DESC LIMIT $limit";

        // Gọi hàm query có sẵn
        $result = $this->query($sql);


        // LƯU Ý: Trả về $data (Mảng) để Controller còn ném ra View được.
        // Nếu bạn return json_encode($data) thì ở View sẽ KHÔNG foreach được nhé!
        return $result;
    }

    // 2. Lấy sản phẩm HOT NHẤT (Sắp xếp theo lượt mua 'sold' giảm dần)
    public function getHotProducts($limit)
    {
        // Giả sử bảng products của bạn có cột 'sold' (số lượng đã bán)
        // Nếu chưa có thì nhớ vào Database thêm cột 'sold' kiểu INT nhé
        $sql = "SELECT p.*, SUM(od.productQuantity) as total
                FROM products p
                JOIN orderdetails od ON p.id = od.productId
                GROUP BY p.id
                ORDER BY total DESC LIMIT $limit";

        $result = $this->query($sql);



        return $result;
    }
}
