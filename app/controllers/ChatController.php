<?php
class ChatController extends Controller
{

    // Thay API Key của bạn vào đây
    private $apiKey = 'AIzaSyBc1JmpRs2Ft3CIHXADogbAzJS4-ow5ixY';  // chìa khóa 

    // ChatController.php

    public function ask()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // ... (Đoạn lấy input user y chang bài trước) ...
            $input = json_decode(file_get_contents('php://input'), true);
            $userMessage = $input['message'] ?? '';

            // 1. GỌI MODEL LẤY DỮ LIỆU SẢN PHẨM
            $productModel = $this->loadModel('ProductModel');
            $shopData = $productModel->getProductsForAI();

            // 2. TẠO CÂU SYSTEM PROMPT (Kèm dữ liệu)
            // Đây là phần quan trọng nhất!
            $systemInstruction = "
            Câu chào quan trọng nhất, hãy chào mình là trợ lý vui tính của mpaquatics nhé
       Bạn đóng vai trò là trợ lý MPAQUATIC
        
        === DANH SÁCH SẢN PHẨM ===
        $shopData
        ===========================
        
        Quy tắc trả lời:
        1. Chỉ tư vấn các sản phẩm có trong danh sách trên.
        2. Nếu khách hỏi món không có, hãy xin lỗi và bảo shop chưa nhập.
        3. Báo giá chính xác theo danh sách.
        4. Trả lời ngắn gọn, thân thiện, dùng icon cá/nước cho sinh động.
        5. có thể giỡn với khách, khách kiu cười thì chọc cười khách, MPAQUATIC không khô khan đâu, được thì tỏ tình luôn, kk,
        Luôn đùa với khách, nếu khách có hỏi câu tiếng anh mình biết thì mình trả lời, kh biết thì nói là xin lỗi, mình không thể phục vụ bạn ngoài việc chọn sản phẩm thủy sinh
        ";

            // ... (Đoạn Config API Gemini y chang bài trước) ...
           // Sửa dòng $url thành:
           //"https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-lite-latest:generateContent?key=
           //"https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-lite-latest:generateContent?key="
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-lite-latest:generateContent?key=" . $this->apiKey;

            $data = [
                "contents" => [
                    [
                        "parts" => [
                            // Ghép Instruction + Câu hỏi user
                            ["text" => $systemInstruction . "\n\nKhách hỏi: " . $userMessage]
                        ]
                    ]
                ]
            ];

            // ... (Đoạn CURL gửi đi và nhận về y chang bài trước) ...
            // ...
            // Gửi Request bằng cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo json_encode(['reply' => 'Lỗi kết nối đến Google AI.']);
            } else {
                $decoded = json_decode($response, true);

                // Lấy câu trả lời (Cấu trúc trả về của Gemini hơi sâu)
                if (isset($decoded['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiReply = $decoded['candidates'][0]['content']['parts'][0]['text'];
                    echo json_encode(['reply' => $aiReply]);
                } else {
                    // Trường hợp bị chặn hoặc lỗi
                    // Thay vì báo "AI đang ngủ", hãy in luôn cái cục dữ liệu Google trả về để xem lỗi gì
                    $googleError = json_encode($decoded, JSON_UNESCAPED_UNICODE);
                    echo json_encode(['reply' => "Google báo lỗi nè: " . $googleError]);
                }
            }
            curl_close($ch);
        }
    }
}
