<?php
// Nhúng thủ công các file của PHPMailer (Nếu bạn không dùng Composer)
require_once __DIR__ . '/../../core/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../core/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../core/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller {

    public function index() {
     $data['content'] = 'components/Contact';

        $data12 = $this->loadModel('UserModel')->getInfo($_SESSION['user']['id']);
        while($row = mysqli_fetch_assoc($data12)){
            $data['sub_content']['email'] = $row['email'];
        }
        
        $data['sub_content']['email'] = $_SESSION['user']['email'] ?? '';
            $data['sub_content']['username'] = $_SESSION['user']['username'];
    $data['sub_content']['role'] = $_SESSION['user']['role'];
    $name = $this->loadModel('UserModel')->getUserById($_SESSION['user']['id'])?? '';
        $data['sub_content']['name'] =  $name['name'] ?? '';
        
        $this->render('layouts/HomeLayout', $data);
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // --- CẤU HÌNH GỬI MAIL ---
            $mail = new PHPMailer(true);
            
$mail->CharSet = 'UTF-8';

            try {
                // 1. Cài đặt Server
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                     // SMTP server của Gmail
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'supermoffcial@gmail.com';            // <--- ĐIỀN EMAIL CỦA BẠN (Email gửi đi)
                $mail->Password   = 'rohg gsew loyy prxx';                  // <--- ĐIỀN MẬT KHẨU ỨNG DỤNG (Xem hướng dẫn cuối bài)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Mã hóa SSL
                $mail->Port       = 465;                                    

                // 2. Người gửi & Người nhận
                // Gửi từ chính mail server của bạn (để tránh bị chặn)
                $mail->setFrom('supermoffcial@gmail.com', 'MP Aquatric System'); 
                
                // Gửi ĐẾN email của bạn (để bạn đọc)
                $mail->addAddress('supermoffcial@gmail.com');     

                // Khi bạn bấm Reply, nó sẽ trả lời vào mail của khách hàng
                $mail->addReplyTo($email, $name);

                // 3. Nội dung
                $mail->isHTML(true);                                  
                $mail->Subject = $subject;
                $mail->Body    = "
                    <h3>Bạn có liên hệ mới từ website MP Aquatric</h3>
                    <p><b>Khách hàng:</b> $name</p>
                    <p><b>Email:</b> $email</p>
                    <p><b>Tiêu đề:</b> $subject</p>
                    <hr>
                    <p><b>Nội dung tin nhắn:</b></p>
                    <p>$message</p>
                ";

                $mail->send();
                
                // Gửi thành công
                echo "<script>alert('Cảm ơn! Tin nhắn của bạn đã được gửi.'); window.location.href='" . ROOTLINK . "/contact';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Gửi lỗi: {$mail->ErrorInfo}'); window.history.back();</script>";
            }
        }
    }
}