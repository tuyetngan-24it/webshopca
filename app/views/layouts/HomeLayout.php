<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MP AQUATRIC</title>
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Playfair+Display:wght@700&family=Poppins:wght@600&family=Roboto:wght@300&display=swap" rel="stylesheet">
        <!-- CSS -->
    <!-- <link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/headerHome.css" /> -->
    <link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/footer.css" />
    <link rel="stylesheet" href="<?php echo ROOTLINK?>/public/assets/css/HomePage.css">
</head>
<body>
    <?php $this -> render('partials/headerHome', $sub_content)  ?>
   
<?php

$this->render($content, $sub_content) ;?>

<?php // $this->render($view, $data) ?>

 <?php $this -> render('partials/footer', $sub_content)  ?>

<!-- ======================================================= -->
<!-- BẮT ĐẦU PHẦN CHAT BOT AI (Đã update hiệu ứng Gradient) -->
<!-- ======================================================= -->

<!-- 1. Nút mở Chat (Có hiệu ứng nhấp nháy) -->
<button id="chat-toggle-btn" class="ai-sync-glow" onclick="toggleChat()">
    <i class="fa-solid fa-robot"></i> &nbsp; Trợ lý AI
</button>

<!-- 2. Khung Chat -->
<div class="chat-container" id="chat-container">
    <!-- Header cũng dùng gradient cho đẹp -->
    <div class="chat-header ai-sync-glow">
        <span><i class="fa-solid fa-sparkles"></i> AquaShop AI Support</span>
        <button onclick="toggleChat()" class="close-btn"><i class="fa-solid fa-xmark"></i></button>
    </div>
    
    <div class="chat-messages" id="chat-messages">
        <div class="message bot-message">Chào bạn! mình là trợ lý của MPAQUATICS SHOP, bạn cần mình hỗ trợ gì không 🐠</div>
    </div>
    
    <div class="chat-input-area">
        <!-- Bọc input trong thẻ div này để làm viền gradient -->
        <div class="ai-input-wrapper ai-sync-glow">
            <input type="text" id="user-input" class="ai-input-field" placeholder="Nhập câu hỏi..." onkeypress="handleEnter(event)">
        </div>
        <button onclick="sendMessage()" class="send-btn"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<style>
    /* --- 1. ĐỊNH NGHĨA ANIMATION & MÀU SẮC --- */
    :root {
        --ai-gradient: linear-gradient(45deg, #ff00cc, #3333ff, #00ddff, #ff00cc);
    }

    @keyframes gradient-pulse-anim {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Class dùng chung cho hiệu ứng nhấp nháy đồng bộ */
    .ai-sync-glow {
        background: var(--ai-gradient);
        background-size: 300% 300%;
        animation: gradient-pulse-anim 4s ease infinite;
        color: white;
    }

    /* --- 2. NÚT TOGGLE CHAT --- */
    #chat-toggle-btn {
        position: fixed; bottom: 30px; right: 30px;
        border: none;
        padding: 15px 25px; border-radius: 50px;
        cursor: pointer; 
        box-shadow: 0 4px 15px rgba(51, 51, 255, 0.4);
        z-index: 9999; 
        font-weight: bold; font-size: 16px;
        transition: transform 0.3s;
        display: flex; align-items: center;
    }
    #chat-toggle-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(51, 51, 255, 0.6);
    }

    /* --- 3. KHUNG CHAT --- */
    .chat-container {
        display: none;
        position: fixed; bottom: 90px; right: 30px;
        width: 360px; height: 480px;
        background: white; border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        flex-direction: column; overflow: hidden;
        z-index: 9999;
        font-family: 'Roboto', sans-serif;
    }

    .chat-header {
        padding: 15px 20px;
        display: flex; justify-content: space-between; align-items: center;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .close-btn { background: none; border: none; color: white; cursor: pointer; font-size: 18px; }

    .chat-messages {
        flex: 1; padding: 20px; overflow-y: auto; background: #f8f9fa;
        display: flex; flex-direction: column; gap: 12px;
    }

    /* Message Styles */
    .message {
        padding: 10px 15px; border-radius: 12px; max-width: 80%; font-size: 14px; line-height: 1.4;
        word-wrap: break-word;
    }
    .bot-message { background: #e9ecef; align-self: flex-start; color: #333; border-bottom-left-radius: 2px; }
    .user-message { 
        background: linear-gradient(135deg, #3333ff, #00ddff); 
        align-self: flex-end; color: white; border-bottom-right-radius: 2px; 
    }

    /* --- 4. INPUT AREA & HIỆU ỨNG VIỀN --- */
    .chat-input-area {
        padding: 15px; 
        background: white;
        border-top: 1px solid #eee; 
        display: flex; gap: 10px; align-items: center;
    }

    /* Wrapper tạo viền gradient cho input */
    .ai-input-wrapper {
        flex: 1;
        padding: 2px; /* Độ dày viền */
        border-radius: 20px;
        display: flex;
    }

    .ai-input-field {
        width: 100%;
        border: none;
        border-radius: 18px; /* Nhỏ hơn wrapper xíu */
        padding: 10px 15px;
        outline: none;
        background: white; /* Nền trắng đè lên giữa gradient */
        font-size: 14px;
        color: #333;
    }

    .send-btn {
        background: none; border: none; 
        color: #3333ff; font-size: 20px; 
        cursor: pointer; transition: transform 0.2s;
        padding: 5px 10px;
    }
    .send-btn:hover { transform: scale(1.1); color: #ff00cc; }

</style>

<script>
    const ROOT_URL = '<?php echo ROOTLINK ?>';
    console.log("Root Link:", ROOT_URL); 

    function toggleChat() {
        const chatBox = document.getElementById('chat-container');
        // Thêm hiệu ứng fade in/out đơn giản
        if (chatBox.style.display === 'none' || chatBox.style.display === '') {
            chatBox.style.display = 'flex';
            document.getElementById('user-input').focus();
        } else {
            chatBox.style.display = 'none';
        }
    }

    function handleEnter(e) {
        if (e.key === 'Enter') sendMessage();
    }

    function sendMessage() {
        const input = document.getElementById('user-input');
        const message = input.value.trim();
        if (!message) return;

        // 1. Hiện tin nhắn user
        appendMessage(message, 'user-message');
        input.value = '';

        // 2. Hiện tin nhắn "Đang gõ..."
        const loadingId = 'loading-' + Date.now();
        // Tạo hiệu ứng 3 chấm đang gõ
        appendMessage('AI đang suy nghĩ... <i class="fa-solid fa-spinner fa-spin"></i>', 'bot-message', loadingId);

        // 3. Gửi AJAX lên PHP
        fetch(ROOT_URL + '/chat/ask', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Xóa loading, hiện câu trả lời thật
            const loadingMsg = document.getElementById(loadingId);
            if(loadingMsg) loadingMsg.remove();
            
            // Format tin nhắn bot (nếu trả về markdown thì cần xử lý thêm, ở đây tạm thời text)
            appendMessage(data.reply, 'bot-message');
        })
        .catch(error => {
            const loadingMsg = document.getElementById(loadingId);
            if(loadingMsg) loadingMsg.remove();
            appendMessage('Lỗi kết nối server! Vui lòng thử lại.', 'bot-message');
            console.error(error);
        });
    }

    function appendMessage(text, className, id = null) {
        const div = document.createElement('div');
        div.className = `message ${className}`;
        div.innerHTML = text; // Dùng innerHTML để hỗ trợ icon
        if (id) div.id = id;
        
        const container = document.getElementById('chat-messages');
        container.appendChild(div);
        container.scrollTop = container.scrollHeight; // Tự cuộn xuống cuối
    }
</script>

<!-- Kết thúc phần Chat AI -->
    <script src="http://localhost/DACS2/public/assets/js/headerHome.js"></script>
  </body>
<html></html>
