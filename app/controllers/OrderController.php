<?php
class OrderController extends Controller
{
    private $orderModel;
    private $orderDetailModel;
    private $productModel; 
    public $data = [];

    // Cấu hình MoMo (Nên đưa vào file config riêng, nhưng để đây cho gọn demo)
    private $momoEndpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    private $partnerCode = 'MOMO';
    private $accessKey = 'F8BBA842ECF85'; // Key Test
    private $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz'; // Key Test

    public function index()
    {
        echo "<pre>";
        echo "Dữ liệu form gửi lên là: ";
        print_r($_POST);
        echo "</pre>";
        header("Location: " . ROOTLINK);
    }


    public function create()
    {
        // 1. Kiểm tra giỏ hàng
        if (empty($_SESSION['cart'])) {
            echo '<script>alert("Giỏ hàng trống!"); window.location.href="' . ROOTLINK . '/products";</script>';
            exit();
        }

        // 2. Tính tổng tiền
        $total = 0;
        $products = $_SESSION['cart'];
        foreach ($products as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Xử lý khi Submit Form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->orderModel = $this->loadModel('OrderModel');
            $this->orderDetailModel = $this->loadModel('OrderDetailModel');
            $this->productModel = $this->loadModel('ProductModel');

            // Lấy phương thức thanh toán từ Form (nhớ thêm input name='payment_method' vào view)
            $paymentMethod = $_POST['payment_method'] ?? 'momo'; // Mặc định là COD

            // Dữ liệu đơn hàng cha
            $data = [
                'userid' => $_SESSION['user']['id'],
                'addressid' => $_POST['address_id'] ?? '', // Lấy địa chỉ từ form
                'total' => $total,
                'status' => 'pending', // Mặc định là Chờ xử lý
                'created_at' => date('Y-m-d H:i:s') // Nên có cả giờ phút giây
            ];

            // TẠO ĐƠN HÀNG -> Lấy ID
            $orderId = $this->orderModel->insertOrder($data);
            

            if ($orderId) {
                // TẠO CHI TIẾT ĐƠN HÀNG
                foreach ($products as $item) {
                    $orderDetailData = [
                        'orderId' => $orderId,
                        'productId' => $item['id'],
                        'productName' => $item['name'],
                        'categoryId' => $item['categoryId'],
                        'price' => $item['price'],
                        'productQuantity' => $item['quantity'],
                        'created_at' => date('Y-m-d')
                    ];
                    $this->orderDetailModel->insertOrderDetail($orderDetailData);
                    $this->productModel->decreaseStock($item['quantity'], $item['id']);
                }

                // Xóa giỏ hàng sau khi lưu xong
                unset($_SESSION['cart']);

                // --- PHÂN LUỒNG THANH TOÁN ---
                if ($paymentMethod == 'momo') {
                    // Nếu là MoMo -> Gọi hàm xử lý thanh toán
                    $this->momo_payment($orderId, $total);
                } else {
                    // Nếu là COD -> Chuyển sang trang thông báo thành công luôn
                    header("Location: " . ROOTLINK . '/order/success');
                    exit();
                }
            } else {
                echo "Lỗi: Không thể tạo đơn hàng.";
            }
        }
    }
    // --- HÀM XỬ LÝ THANH TOÁN MOMO ---
    public function momo_payment($orderId, $totalMoney)
    {
        $requestId = time() . "";
        $requestType = "payWithMethod";
        $redirectUrl = ROOTLINK . '/order/momo_return'; // Link nhận kết quả
        $ipnUrl = ROOTLINK . '/order/momo_ipn';
        $orderInfo = "Thanh toán đơn hàng #" . $orderId;
        $amount = (string)$totalMoney;

        // orderId của MoMo phải duy nhất, nên nối thêm time() để tránh trùng nếu thanh toán lại
        $momoOrderId = $orderId . '_' . time();
        $extraData = "";

        // Tạo chữ ký (Signature)
        $rawHash = "accessKey=" . $this->accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $momoOrderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $this->partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'partnerName' => "Web Ban Hang",
            'storeId' => 'MomoTestStore',
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $momoOrderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        // Gửi request
        $result = $this->execPostRequest($this->momoEndpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Chuyển hướng sang MoMo
        if (isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            exit();
        } else {
            // In lỗi ra nếu có vấn đề
            echo "Lỗi MoMo: " . ($jsonResult['message'] ?? 'Unknown Error');
        }
    }

    // --- HÀM NHẬN KẾT QUẢ TỪ MOMO (Callback) ---
    public function momo_return()
    {
        // MoMo trả về kết quả qua GET
        if (isset($_GET['resultCode'])) {
            $resultCode = $_GET['resultCode'];
            $momoOrderId = $_GET['orderId']; // Dạng: 105_1732156...

            // Tách lấy ID đơn hàng gốc
            $parts = explode('_', $momoOrderId);
            $realOrderId = $parts[0];

            if ($resultCode == '0') {
                // THANH TOÁN THÀNH CÔNG
                $this->orderModel = $this->loadModel('OrderModel');

                // Cập nhật trạng thái đơn hàng: 'pending' -> 'paid' (hoặc 'success')
                // Ông cần viết hàm updateStatus trong OrderModel nhé
                $this->orderModel->updateStatus($realOrderId, 'paid');

                header("Location: " . ROOTLINK . '/order/success');
            } else {
                // THANH TOÁN THẤT BẠI
                echo "Thanh toán thất bại. Lỗi: " . ($_GET['message'] ?? '');
                echo "<br><a href='" . ROOTLINK . "'>Về trang chủ</a>";
            }
        }
    }

    // Hàm Helper gửi cURL
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        // --- THÊM 2 DÒNG NÀY ĐỂ FIX LỖI SSL LOCALHOST ---
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // ------------------------------------------------

        $result = curl_exec($ch);

        // --- THÊM ĐOẠN DEBUG NÀY ĐỂ SOI LỖI ---
        if ($result === false) {
            echo 'Curl error: ' . curl_error($ch);
            die();
        }
        // --------------------------------------

        curl_close($ch);
        return $result;
    }

    public function success()
    {
        // Load view báo thành công
       $this->render('components/status/ordersuccess'); 
       echo '<meta http-equiv="refresh" content="3;url=' . ROOTLINK . '">';

    }
}
