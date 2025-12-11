<?php 
class Connection {
  
       // khởi tạo thuộc tính instance 
       //mục đích để trả instant nếu chưa kết nối
       //kết nối 1 lần thì lần sau sẽ không kết nối nữa, mà dùng luôn
       // design partten  singleton 
    private static $instance = null; 
    private $conn = null; 

    private function __construct()
    {
       try {
        global $config; 
        $db_configs = $config['database']; 
        $host = $db_configs['host']; 
        $username = $db_configs['username']; 
        $password = null; 
        $database = $db_configs['database']; 
        $port = $db_configs['port'];    
        $this->conn = mysqli_connect($host, $username, $password, $database, $port); 
        if ($this->conn) {
         
        }
        else {
            throw new Exception("Lỗi kết nối"); 
        }
       }
       catch(Exception $e) {
        echo $e->getMessage(); 
       }
    }
  
    public static function getInstance() {
            if (self::$instance == null) {
                self::$instance = new Connection(); 
            }
            return self::$instance; 
    }

    public static function getConnected() {
        $instance = Connection::getInstance(); 
        return $instance->getConn();  
    }

    public function getConn() {
        return $this->conn;
    }
   public function closeConnection() {
        if ($this->conn != null) {
            mysqli_close($this->conn);
            $this->conn = null; // Đặt lại biến kết nối về null sau khi đóng
            // Tùy chọn: đặt lại instance về null để cho phép tạo kết nối mới sau khi đóng
            // self::$instance = null; 
        }
    }
}
