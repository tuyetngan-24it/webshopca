<?php

class Database
{
    private $conn;

    /**
     * Hàm khởi tạo: Giữ nguyên
     * Kết nối CSDL khi class được khởi tạo.
     */
    function __construct()
    {
        global $config;
        if (!empty($config['database'])) {
            $db_configs = array_filter($config['database']);
            if (!empty($db_configs)) {
                require_once('./core/Connection.php'); // load Connection class; 
                $this->conn = Connection::getConnected(); // gọi connection
            }
        }
    }

    /**
     * Hàm query: ĐÃ SỬA
     * Thêm báo lỗi mysqli_error để bạn biết CSDL bị lỗi gì.
     */
    public function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return $result;
        } else {
            // Hiển thị lỗi SQL để bạn gỡ rối (debug)
            return mysqli_errno($this->conn);
        }
    }

    /**
     * Hàm insert: VIẾT LẠI HOÀN TOÀN
     * - Dùng implode() thay vì logic rtrim() phức tạp.
     * - Dùng mysqli_real_escape_string() để chống SQL Injection.
     * - Tự động thêm dấu nháy đơn '' cho giá trị.
     */
    public function insert($table, $data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }

        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            // Tên cột an toàn (dùng dấu ` backtick)
            $fields[] = "`$key`";

            // Giá trị an toàn (làm sạch và bọc bằng ' ')
            $escaped_value = mysqli_real_escape_string($this->conn, $value);
            $values[] = "'$escaped_value'";
        }

        // Dùng implode để nối các phần tử mảng bằng dấu phẩy
        $fieldStr = implode(', ', $fields);
        $valueStr = implode(', ', $values);

        // Xây dựng câu SQL
        $sql = "INSERT INTO `$table` ($fieldStr) VALUES ($valueStr)";

        // Chạy query (dùng lại hàm query() của class)
        return $this->query($sql);
    }

    /**
     * Hàm update: VIẾT LẠI HOÀN TOÀN
     * - Sửa logic nối chuỗi (thiếu dấu ,)
     * - Chống SQL Injection.
     * - Sửa lỗi logic if/else của mệnh đề WHERE.
     */
    public function update($table, $data, $condition = '')
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }

        $updatePairs = [];
        foreach ($data as $key => $value) {
            // Giá trị an toàn
            $escaped_value = mysqli_real_escape_string($this->conn, $value);

            // Tạo cặp `key`='value'
            $updatePairs[] = "`$key`='$escaped_value'";
        }

        // Nối các cặp lại bằng dấu phẩy
        $updateStr = implode(', ', $updatePairs);

        // Xây dựng SQL
        // Logic if/else của bạn bị sai, đây là cách sửa:
        $sql = "UPDATE `$table` SET $updateStr";

        if (!empty($condition)) {
            // Thêm mệnh đề WHERE vào câu $sql
            $sql .= " WHERE $condition";
        } else {
            // Cảnh báo: Update mà không có WHERE sẽ cập nhật TOÀN BỘ BẢNG
            // Bạn có thể return false ở đây nếu muốn chặn
        }

        return $this->query($sql);
    }

    /**
     * Hàm delete: Giữ nguyên
     * Chỉ sửa lại để nó dùng hàm query() (để có báo lỗi)
     */
    public function delete($table, $condition = '')
    {
        // Phải có điều kiện mới cho xóa
        if (!empty($condition)) {
            $sql = "DELETE FROM `$table` WHERE $condition";
            return $this->query($sql);
        }

        // Trả về false nếu không có điều kiện
        return false;
    }


    public function escape($value)
    {
        // Dùng hàm có sẵn của mysqli
        return $this->conn->real_escape_string((string)$value);
    }

    public function getLastInsertId()
    {
        // Nó chỉ là một cách gọi khác của thuộc tính insert_id
        return $this->conn->insert_id;
    }
}
