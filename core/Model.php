<?php
// Giả sử file Database.php (ĐÃ CÓ HÀM escape() và getLastInsertId())
class Model
{
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->db = new Database();
    }
    
    // ... (hàm get($sql) và getOne($sql) đã sửa của bạn) ...

    /**
     * [CREATE] Thêm một bản ghi mới (An toàn)
     */

    public function create($data)
    {
        $columns = [];
        $values = [];

        foreach ($data as $key => $value) {
            $columns[] = "`{$key}`";
            // AN TOÀN: Escape mọi giá trị
            $values[] = "'" . $this->db->escape($value) . "'";
        }

        $columnString = implode(', ', $columns);
        $valueString = implode(', ', $values);

        $sql = "INSERT INTO {$this->table} ($columnString) VALUES ($valueString)";

        $result = $this->db->query($sql);
        if ($result) {
            // AN TOÀN: Dùng hàm đã viết
            return $this->db->getLastInsertId();
        }
        return false;
    }

    public function getAll()
    {
        $sql  = "SELECT * FROM $this->table";
        return $this->db->query($sql);
    }

    public function getOne($id)
    {
        $sql  = "SELECT * FROM $this->table WHERE id = $id";
        return $this->db->query($sql);
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }
    /**
     * [UPDATE] Cập nhật một bản ghi (An toàn)
     */
    public function update($id, $data)
    {
        $pairs = [];
        foreach ($data as $key => $value) {
            // AN TOÀN: Escape tên cột và giá trị
            $pairs[] = "`{$key}` = '" . $this->db->escape($value) . "'";
        }

        $pairString = implode(', ', $pairs);
        // AN TOÀN: Escape ID
        $escapedId = $this->db->escape($id);

        $sql = "UPDATE {$this->table} SET $pairString WHERE {$this->primaryKey} = '{$escapedId}'";

        return $this->db->query($sql);
    }

    /**
     * [DELETE] Xóa một bản ghi (An toàn)
     */
    public function delete($id)
    {
        // AN TOÀN: Escape ID
        $escapedId = $this->db->escape($id);

        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = '{$escapedId}'";
        return $this->db->query($sql);
    }


    public function getDataPerPage($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM $this->table LIMIT $limit OFFSET $offset";
        return $this->db->query($sql);
    }

    public function getDataByCategoryName($categoryName, $page, $limit)
    {
        $offset = ($page - 1) * $limit;

        // 1. Clean dữ liệu string (Quan trọng khi dùng MySQLi)
        // Giả sử $this->db là đối tượng mysqli connection
        $categoryName = $this->db->escape($categoryName);

        // 2. JOIN bảng products với categories
        // Giả sử bảng danh mục tên là 'categories' và khóa ngoại là 'category_id'
        $sql = "SELECT $this->table.* FROM $this->table 
            JOIN categories ON $this->table.categoryId = categories.id
            WHERE categories.name LIKE '%$categoryName%' 
            LIMIT $limit OFFSET $offset";

        return $this->db->query($sql);
    }



    public function getByQuery($sql)
    {
        // Gọi hàm query của class cha
        $result = $this->query($sql);

        $data = [];
        // Kiểm tra nếu query thành công và trả về object (SELECT)
        if ($result && $result instanceof mysqli_result) {
            // Lặp để lấy dữ liệu
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * 3. Hàm getFirstByQuery: Lấy 1 dòng duy nhất (Dùng cho mysqli)
     */
    public function getFirstByQuery($sql)
    {
        $result = $this->query($sql);

        if ($result && $result instanceof mysqli_result) {
            // Lấy 1 dòng đầu tiên
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    /**
     * 4. Hàm escape: Để model con gọi cho tiện (Wrapper)
     */
    public function escapeString($str)
    {
        return $this->db->escape($str);
    }
}
