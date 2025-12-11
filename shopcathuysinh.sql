-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307 :3307
-- Thời gian đã tạo: Th12 03, 2025 lúc 05:13 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopcathuysinh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` int(12) NOT NULL,
  `proviceId` int(12) NOT NULL,
  `wardId` int(11) NOT NULL,
  `streetDetail` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `content`, `image`, `category_id`, `created_at`) VALUES
(20, 'Cá Ông Tiên (Angelfish): Vẻ đẹp kiêu sa từ dòng sông Amazon', 'Thường bị nhầm là hiền lành vì dáng bơi khoan thai, nhưng Ông Tiên thực chất là những kẻ săn mồi đáng gờm. Hướng dẫn nuôi và ép đẻ dòng cá huyền thoại này.', '<p>Trước khi cá Dĩa trở nên phổ biến, <strong>Cá Ông Tiên (Pterophyllum Scalare)</strong> mới chính là vua của bể thủy sinh. Với dáng bơi lướt nhẹ như một chiếc lá khô và bộ vây dài thướt tha, chúng mang lại vẻ đẹp tĩnh lặng và sang trọng cho bất kỳ bể cá nào.</p>\r\n\r\n    <h2>1. Đặc điểm nhận dạng và Tập tính</h2>\r\n    <p>Cá Ông Tiên thuộc họ Cichlid (Cá Rô phi), nghĩa là chúng khá hung dữ và có tính lãnh thổ cao. \r\n    <br>Hình dáng của chúng dẹt mỏng theo chiều ngang (để lách qua các khe rễ cây) và vây lưng, vây bụng kéo dài theo chiều dọc. Vì vậy, bể nuôi Ông Tiên cần có <strong>chiều cao tối thiểu 50cm</strong> để cá không bị \"gù\" vây.</p>\r\n    <p><strong>Lưu ý quan trọng:</strong> Dù miệng trông nhỏm, nhưng Ông Tiên là loài săn mồi (Predator). Tuyệt đối không nuôi chung với các loại cá quá nhỏ như Cá Trâm, Tép màu... vì chúng sẽ trở thành bữa ăn nhẹ cho Ông Tiên chỉ trong một đêm.</p>\r\n\r\n    <h2>2. Các dòng Ông Tiên phổ biến</h2>\r\n    <ul>\r\n        <li><strong>Ông Tiên Ai Cập (Altum):</strong> \"Chén thánh\" của người chơi. Kích thước khổng lồ, sọc đen rõ nét, rất khó thuần dưỡng và giá cực đắt.</li>\r\n        <li><strong>Ông Tiên Koi:</strong> Đỉnh đầu màu cam đỏ, thân trắng lốm đốm đen, nhìn như cá Koi Nhật Bản.</li>\r\n        <li><strong>Ông Tiên Đen (Black Lace):</strong> Toàn thân đen tuyền ma mị, rất nổi bật trên nền cây xanh.</li>\r\n        <li><strong>Ông Tiên Platinum:</strong> Trắng toát toàn thân, vây ánh bạc lấp lánh.</li>\r\n    </ul>\r\n\r\n    <h2>3. Sinh sản và Chăm sóc cá con</h2>\r\n    <p>Khác với đa số loài cá đẻ trứng rồi bỏ đi, Ông Tiên là những ông bố bà mẹ tuyệt vời.</p>\r\n    <h3>Dấu hiệu sắp đẻ:</h3>\r\n    <p>Cặp cá trống mái sẽ tách đàn, hung dữ đuổi các con khác đi. Chúng sẽ chọn một bề mặt phẳng (như vách kính, lá cây to, hoặc giá thể gốm) và liên tục rỉa sạch nó. Cá mái đẻ trứng dính lên đó và cá trống bơi theo thụ tinh.</p>\r\n    <h3>Chăm sóc:</h3>\r\n    <p>Trong quá trình ấp trứng (2-3 ngày), cá bố mẹ sẽ liên tục quạt nước để cung cấp oxy cho trứng. Khi cá con nở, chúng sẽ bảo vệ đàn con cực gắt. <br>\r\n    <em>Mẹo:</em> Nếu muốn giữ số lượng cá con cao, bạn nên tách trứng ra ấp riêng và cho cá bột ăn Artemia ấp nở, vì trong môi trường bể cộng đồng, cá con rất dễ bị các loài khác ăn thịt.</p>', 'http://localhost/uploads/ca_ong_tien.jpg', 3, '2025-12-01 11:24:32'),
(25, 'Kỹ thuật Hardscape: Xử lý Lũa ra màu và bí kíp dán đá siêu dính', 'Làm sao để nước không bị vàng khi chơi lũa? Cách dùng keo 502 và giấy ăn để tạo nên những bộ bố cục thách thức trọng lực.', '<p>Trong bộ môn thủy sinh, \"Hardscape\" (phần cứng) bao gồm Lũa và Đá chính là bộ khung xương của cả bể. Cây có thể thay đổi, nhưng khung xương thì cố định. Vì vậy, setup hardscape chuẩn ngay từ đầu là cực kỳ quan trọng.</p>\r\n\r\n    <h2>1. Xử lý Lũa không bị ra màu (Tiết ra Tanin)</h2>\r\n    <p>Nỗi ám ảnh của người mới chơi là mua lũa về thả vào bể, vài ngày sau nước vàng khè như nước chè. Đó là nhựa cây và chất Tanin. Cách xử lý triệt để:<br>\r\n    - <strong>Luộc lũa:</strong> Biện pháp hiệu quả nhất. Luộc nước sôi trong 30-60 phút kèm nhiều muối hột. Muối giúp đẩy nhựa cây ra nhanh hơn và sát khuẩn nấm mốc.<br>\r\n    - <strong>Ngâm oxy già:</strong> Nếu lũa quá to không luộc được, hãy ngâm trong thùng xốp với dung dịch Oxy già công nghiệp pha loãng trong 3 ngày.</p>\r\n\r\n    <h2>2. Các loại Lũa phổ biến</h2>\r\n    <ul>\r\n        <li><strong>Lũa Linh Sam:</strong> Vân thớ cực đẹp, cứng, chìm ngay lập tức. Thường dùng ghép bonsai.</li>\r\n        <li><strong>Lũa Hải Sơn Quỳ:</strong> Gai góc, hầm hố, thích hợp cho bể phong cách Rừng rậm (Jungle).</li>\r\n        <li><strong>Lũa Đỗ Quyên:</strong> Màu vàng sáng, nhiều nhánh uốn lượn mềm mại. Lưu ý loại này nhẹ, cần ngâm lâu mới chìm.</li>\r\n    </ul>\r\n\r\n    <h2>3. Bí kíp dán đá: Keo 502 + Giấy vệ sinh/Bụi cưa</h2>\r\n    <p>Làm sao các Master có thể xếp những tảng đá cheo leo mà không đổ? Họ không dùng keo silicon (khô lâu) mà dùng kỹ thuật \"Khớp nối bê tông\":<br>\r\n    <strong>Bước 1:</strong> Kẹp một miếng giấy ăn nhỏ (hoặc rắc bột đá/mùn cưa) vào giữa điểm tiếp xúc của 2 tảng đá/lũa.<br>\r\n    <strong>Bước 2:</strong> Nhỏ keo 502 (loại lỏng) thấm đẫm miếng giấy đó.<br>\r\n    <strong>Kết quả:</strong> Phản ứng hóa học sinh nhiệt sẽ làm hỗn hợp đông cứng ngay lập tức như xi măng, mối nối cực kỳ chắc chắn, chịu lực tốt hơn cả đá thật.</p>', 'http://localhost/uploads/ky_thuat_lua_da.jpg', 1, '2025-12-01 11:27:05'),
(26, 'Giải mã thông số nước: pH, TDS, gH, kH là gì và tại sao cá chết?', 'Cá chết không rõ nguyên nhân? Có thể bạn đang nuôi cá ưa kiềm trong môi trường axit. Hiểu về hóa học nước để làm chủ cuộc chơi.', '<p>Nước trong vắt không có nghĩa là nước sạch. Có những \"sát thủ vô hình\" trong nước mà mắt thường không thấy được, nhưng lại quyết định sự sống còn của sinh vật. Đó là các chỉ số hóa học.</p>\r\n\r\n    <h2>1. Độ pH (Potential of Hydrogen) - Độ chua/kiềm</h2>\r\n    <p>Thang đo từ 0-14, với 7 là trung tính. <br>\r\n    - <strong>pH < 7 (Axit):</strong> Phù hợp cho đa số cá nhiệt đới (Neon, Dĩa, Ông Tiên) và Tép màu, Tép ong.<br>\r\n    - <strong>pH > 7 (Kiềm):</strong> Phù hợp cho cá Bảy màu (Guppy), Cá Molly, Cá Ali, Tép Sulawesi.<br>\r\n    <strong>Nguy hiểm:</strong> Sốc pH. Khi thả cá mới mua vào bể, nếu pH chênh lệch quá 1.0 đơn vị, cá sẽ bị sốc, tuột nhớt và chết ngay lập tức. Hãy hòa nước từ từ (Drip Acclimation).</p>\r\n\r\n    <h2>2. TDS (Total Dissolved Solids) - Tổng chất rắn hòa tan</h2>\r\n    <p>Hiểu đơn giản là độ \"dơ\" hoặc độ \"đặc\" của nước. TDS bao gồm khoáng chất, muối, kim loại nặng, phân cá tan rã...<br>\r\n    - <strong>Tép cảnh:</strong> Cần TDS chuẩn (ví dụ Tép Ong cần TDS ~100-120) để lột vỏ. TDS quá cao vỏ cứng không lột được -> Chết.<br>\r\n    - <strong>Cách giảm TDS:</strong> Duy nhất là thay nước hoặc dùng nước lọc RO.</p>\r\n\r\n    <h2>3. Độ cứng gH (General Hardness) và kH (Carbonate Hardness)</h2>\r\n    <ul>\r\n        <li><strong>gH:</strong> Đo lượng Canxi và Magie. Cây thủy sinh và ốc cần gH đủ cao để không bị rữa lá, mòn vỏ.</li>\r\n        <li><strong>kH:</strong> Đo độ đệm của nước. kH càng cao thì pH càng ổn định, khó bị tụt giảm đột ngột (pH Crash).</li>\r\n    </ul>\r\n\r\n    <h2>Lời khuyên</h2>\r\n    <p>Đừng quá ám ảnh với con số chính xác tuyệt đối. Sự <strong>ỔN ĐỊNH</strong> quan trọng hơn. Cá có thể thích nghi với pH 7.5 dù sách nói cần 6.5, miễn là con số 7.5 đó được duy trì ổn định, không trồi sụt thất thường.</p>', 'http://localhost/uploads/thong_so_nuoc.jpg', 2, '2025-12-01 11:27:05'),
(34, 'Kỹ Thuật Thay Nước Bể Cá Chuẩn Chuyên Gia: Bí Quyết Giúp Cá Khỏe, Nước Trong Vắt', 'Thay nước không chỉ đơn giản là đổ nước cũ đi và thêm nước mới. Làm sai cách có thể khiến cá bị sốc, chết vi sinh và bùng phát rêu hại. Cùng MP Aquatic tìm hiểu quy trình chuẩn nhé!', '<article class=\"blog-detail\">\r\n    <p>Thay nước không chỉ đơn giản là đổ nước cũ đi và thêm nước mới. Làm sai cách có thể khiến cá bị sốc, chết vi sinh và bùng phát rêu hại. Cùng <strong>MP Aquatic</strong> tìm hiểu quy trình chuẩn nhé!</p>\r\n\r\n    <h3>1. Tại sao cần thay nước định kỳ?</h3>\r\n    <p>Nhiều người mới chơi (Newbie) thường mắc sai lầm: <em>\"Thấy nước trong thì không cần thay\"</em>. Đây là quan niệm sai lầm chết người.</p>\r\n    <p>Trong quá trình nuôi, chất thải của cá và thức ăn thừa tạo ra <strong>Nitrate (NO3-)</strong>. Dù hệ vi sinh có tốt đến đâu thì Nitrate vẫn tích tụ dần. Khi nồng độ này quá cao, cá sẽ bị stress, bỏ ăn, giảm đề kháng và rêu hại bùng phát.</p>\r\n    <p><strong>Mục tiêu:</strong> Thay nước là để loại bỏ độc tố tích tụ và bổ sung khoáng chất mới cho cá/tép.</p>\r\n\r\n    <h3>2. Chuẩn bị dụng cụ \"hành nghề\"</h3>\r\n    <ul>\r\n        <li><strong>Cây hút cặn (Siphon):</strong> Dụng cụ bắt buộc để hút phân cá dưới nền.</li>\r\n        <li><strong>Xô/Chậu:</strong> Để chứa nước thải.</li>\r\n        <li><strong>Dung dịch khử Clo:</strong> Nếu bạn dùng nước máy trực tiếp.</li>\r\n        <li><strong>Khăn lau:</strong> Để thấm nước vương vãi.</li>\r\n        <li><strong>Dụng cụ cọ kính:</strong> Cạo rêu bám thành bể.</li>\r\n    </ul>\r\n\r\n    <h3>3. Quy trình thay nước 5 bước chuẩn chỉ</h3>\r\n    \r\n    <h4>Bước 1: Tắt các thiết bị điện</h4>\r\n    <p>An toàn là trên hết. Hãy rút phích cắm của lọc, đèn và đặc biệt là <strong>sưởi</strong>. Nếu sưởi đang nóng mà mực nước hạ xuống thấp hơn thân sưởi, nó có thể bị nổ hoặc hỏng hóc.</p>\r\n\r\n    <h4>Bước 2: Vệ sinh mặt kính và cắt tỉa cây</h4>\r\n    <p>Hãy cọ sạch rêu bám kính và tỉa cây <em>trước khi</em> hút nước. Bụi bẩn và lá cây cắt ra sẽ trôi lơ lửng và được hút ra ngoài ở bước sau.</p>\r\n\r\n    <h4>Bước 3: Hút nước cũ (Kỹ thuật Siphon)</h4>\r\n    <p><strong>Nguyên tắc vàng:</strong> Chỉ thay <strong>20% - 30%</strong> lượng nước trong bể mỗi lần. Tuyệt đối không thay 100% nước.</p>\r\n    <p><strong>Cách hút:</strong> Cắm đầu hút xuống lớp nền (sỏi/cát) để hút sạch phân cá và thức ăn thừa lắng đọng.</p>\r\n    <p><em>Lưu ý:</em> Tuyệt đối <strong>KHÔNG vớt cá ra ngoài</strong> khi thay nước để tránh làm cá hoảng sợ.</p>\r\n\r\n    <h4>Bước 4: Xử lý nước mới</h4>\r\n    <p>Đây là bước quan trọng nhất. Nước máy thường chứa <strong>Clo</strong> gây chết cá.</p>\r\n    <ul>\r\n        <li>Dùng dung dịch khử Clo chuyên dụng (như Seachem Prime).</li>\r\n        <li>Cố gắng để nhiệt độ nước mới xấp xỉ nước trong bể để tránh sốc nhiệt.</li>\r\n    </ul>\r\n\r\n    <h4>Bước 5: Vào nước</h4>\r\n    <p>Đổ nước thật nhẹ nhàng. Hãy lót một chiếc đĩa nhỏ hoặc dùng chính bàn tay của bạn để hứng dòng nước chảy xuống, tránh làm xối nền.</p>\r\n    <p>Sau khi nước đầy, châm thêm <strong>Vi sinh tươi</strong>, bật lại lọc và sưởi.</p>\r\n\r\n    <h3>4. Những sai lầm thường gặp</h3>\r\n    <ul>\r\n        <li>Thay 100% nước gây sốc môi trường.</li>\r\n        <li>Giặt bông lọc quá sạch bằng nước máy làm chết vi sinh.</li>\r\n        <li>Quên tắt sưởi khi thay nước.</li>\r\n    </ul>\r\n\r\n    <div class=\"blog-cta\" style=\"background: #1a1a1a; padding: 20px; border-radius: 10px; margin-top: 30px; border: 1px solid #333;\">\r\n        <h4 style=\"color: #f1c40f; margin-top: 0;\">Lời kết</h4>\r\n        <p style=\"margin-bottom: 0;\">Thay nước định kỳ hàng tuần là liều thuốc bổ rẻ tiền nhất cho bể cá. Ghé ngay <strong>MP Aquatic</strong> để sắm đầy đủ bộ dụng cụ vệ sinh bể cá chính hãng nhé!</p>\r\n    </div>\r\n</article>', 'http://localhost/uploads/1764572976_ky_thuat_thay_nuoc.jpg', 1, '2025-12-01 14:09:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(12) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(13, 'Cá cảnh', 'Các loại cá thủy sinh', '2025-11-22 17:00:00', NULL),
(14, 'Tép và Ốc', 'Tép cảnh và ốc dọn bể', '2025-11-22 17:00:00', NULL),
(15, 'Cây thủy sinh', 'Rêu, ráy, bucep, cắt cắm', '2025-11-30 03:09:08', NULL),
(16, 'Thiết bị bể cá', 'Đèn, lọc, sủi oxy, hẹn giờ', '2025-11-30 03:09:08', NULL),
(17, 'Vật tư & Trang trí', 'Phân nền, đá, lũa, thức ăn, vi sinh', '2025-11-30 03:09:08', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_blog`
--

CREATE TABLE `categories_blog` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_blog`
--

INSERT INTO `categories_blog` (`id`, `name`) VALUES
(1, 'Kỹ thuật Setup'),
(2, 'Chăm sóc bể'),
(3, 'Các loại cá & Tép');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `cotent` longtext NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiveId` int(11) NOT NULL,
  `isRead` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(12) NOT NULL,
  `orderId` int(12) NOT NULL,
  `productId` int(12) NOT NULL,
  `productName` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(10) DEFAULT NULL,
  `price` int(12) NOT NULL,
  `productQuantity` int(20) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(12) NOT NULL,
  `userId` int(11) NOT NULL,
  `addressid` int(12) NOT NULL,
  `total` int(13) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deliveryStatus` varchar(13) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(12) NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `categoryId` int(12) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `description`, `price`, `quantity`, `categoryId`, `created_at`, `updated_at`) VALUES
(1, 'Cá Neon Vua', 'http://localhost/uploads/neon_vua_01.jpg', '<p>Cá bơi theo đàn cực đẹp</p>', 15000, 27, 13, '2025-11-25 10:21:52', NULL),
(2, 'Cá Bảy Màu Rồng Đỏ', 'http://localhost/uploads/guppy_red_02.jpg', '<p>Dòng cá khỏe, dễ sinh sản</p>', 25000, 13, 13, '2025-11-25 10:21:52', NULL),
(3, 'Tép Yamato', 'http://localhost/uploads/yamato_03.jpg', '<p>Chuyên gia dọn rêu hại</p>', 35000, 44, 14, '2025-11-25 10:21:52', NULL),
(4, 'Ốc Nerita', 'http://localhost/uploads/nerita_04.jpg', '<p>Dọn bể kính sạch bong</p>', 10000, 111, 14, '2025-11-25 10:21:52', NULL),
(5, 'Cây Ráy Nana', 'http://localhost/uploads/nana_05.jpg', '<p>Cây thủy sinh tiền cảnh</p>', 45000, 30, 15, '2025-11-25 10:21:52', NULL),
(6, 'Đèn Chihiros WRGB', 'http://localhost/uploads/den_led_06.jpg', '<p>Đèn cao cấp cho bể 60cm</p>', 1200000, 9, 16, '2025-11-25 10:21:52', NULL),
(7, 'Lọc Thùng Atman', 'http://localhost/uploads/loc_atman_07.jpg', '<p>Lọc ngoại êm ái, hiệu quả</p>', 850000, 14, 16, '2025-11-25 10:21:52', NULL),
(8, 'Cá Sóc Đầu Đỏ', 'http://localhost/uploads/soc_dau_do_08.jpg', '<p>Bơi theo đàn rất chặt</p>', 12000, 200, 13, '2025-11-25 10:21:52', NULL),
(9, 'Tép RC (Red Cherry)', 'http://localhost/uploads/tep_rc_09.jpg', '<p>Tép màu đỏ nổi bật</p>', 5000, 499, 14, '2025-11-25 10:21:52', NULL),
(10, 'Cá Chuột Panda', 'http://localhost/uploads/chuot_panda_10.jpg', '<p>Dọn thức ăn thừa đáy bể</p>', 20000, 40, 13, '2025-11-25 10:21:52', NULL),
(11, 'Phân Nền Gex Xanh', 'http://localhost/uploads/gex_xanh_11.jpg', '<p>Phân nền chuyên tép</p>', 180000, 21, 17, '2025-11-25 10:21:52', NULL),
(12, 'Cá Betta Halfmoon', 'http://localhost/uploads/betta_hm_12.jpg', '<p>Vây đuôi xòe 180 độ</p>', 150000, 19, 13, '2025-11-25 10:21:52', NULL),
(13, 'Rêu Java Moss', 'http://localhost/uploads/java_moss_13.jpg', '<p>Rêu dễ trồng, không cần CO2</p>', 30000, 60, 15, '2025-11-25 10:21:52', NULL),
(14, 'Cá Trâm', 'http://localhost/uploads/ca_tram_14.jpg', '<p>Cá siêu nhỏ cho bể nano</p>', 8000, 300, 13, '2025-11-25 10:21:52', NULL),
(15, 'Máy Sủi Oxy 2 Vòi', 'http://localhost/uploads/sui_oxy_15.jpg', '<p>Siêu êm, tiết kiệm điện</p>', 65000, 45, 16, '2025-11-25 10:21:52', NULL),
(16, 'Vật Liệu Lọc Matrix', 'http://localhost/uploads/matrix_16.jpg', '<p>Đá lọc vi sinh cao cấp</p>', 380000, 30, 17, '2025-11-25 10:21:52', NULL),
(17, 'Cá Dĩa Xanh', 'http://localhost/uploads/ca_dia_17.jpg', '<p>Vua của các loài cá cảnh</p>', 450000, 10, 13, '2025-11-25 10:21:52', NULL),
(18, 'Tép Mũi Đỏ', 'http://localhost/uploads/tep_mui_do_18.jpg', '<p>Diệt rêu tóc hiệu quả</p>', 15000, 90, 14, '2025-11-25 10:21:52', NULL),
(19, 'Cây Bucep Ghost', 'http://localhost/uploads/bucep_19.jpg', '<p>Dòng Bucep lá nước đẹp</p>', 250000, 15, 15, '2025-11-25 10:21:52', NULL),
(20, 'Hẹn Giờ Cơ', 'http://localhost/uploads/timer_20.jpg', '<p>Hẹn giờ bật tắt đèn</p>', 80000, 50, 16, '2025-11-25 10:21:52', NULL),
(21, 'Cá Hồng Nhung', 'http://localhost/uploads/hong_nhung_21.jpg', '<p>Màu đỏ hồng đẹp mắt</p>', 10000, 138, 13, '2025-11-25 10:21:52', NULL),
(22, 'Lũa Linh Sam', 'http://localhost/uploads/lua_linh_sam_22.jpg', '<p>Lũa chìm, dáng bon sai</p>', 120000, 30, 17, '2025-11-25 10:21:52', NULL),
(23, 'Đá Da Voi', 'http://localhost/uploads/da_da_voi_23.jpg', '<p>Setup layout núi đá</p>', 35000, 100, 17, '2025-11-25 10:21:52', NULL),
(24, 'Thức Ăn Cá Cám Thái', 'http://localhost/uploads/cam_thai_24.jpg', '<p>Hạt nhỏ, thơm, lâu tan</p>', 25000, 200, 17, '2025-11-25 10:21:52', NULL),
(25, 'Vi Sinh Extra Bio', 'http://localhost/uploads/extra_bio_25.jpg', '<p>Làm trong nước nhanh chóng</p>', 90000, 60, 17, '2025-11-25 10:21:52', NULL),
(26, 'Cá Phượng Hoàng Lam', 'http://localhost/uploads/phuong_hoang_26.jpg', '<p>Màu sắc sặc sỡ</p>', 60000, 25, 14, '2025-11-25 10:21:52', NULL),
(27, 'Cây Trân Châu Ngọc Trai', 'http://localhost/uploads/tcnt_27.jpg', '<p>Thảm xanh mướt bể</p>', 50000, 40, 13, '2025-11-25 10:21:52', NULL),
(28, 'CO2 Lỏng Seachem', 'http://localhost/uploads/co2_seachem_28.jpg', '<p>Bổ sung Carbon cho cây</p>', 220000, 20, 14, '2025-11-25 10:21:52', NULL),
(29, 'Bình CO2 Nhôm 1L', 'http://localhost/uploads/binh_co2_29.jpg', '<p>An toàn, thẩm mỹ</p>', 650000, 10, 13, '2025-11-25 10:21:52', NULL),
(30, 'Cá Otto', 'http://localhost/uploads/ca_otto_30.jpg', '<p>Chăm chỉ lau kính, lá cây</p>', 40000, 55, 14, '2025-11-25 10:21:52', NULL),
(31, 'Sưởi Inox 100W', 'http://localhost/uploads/suoi_inox_31.jpg', '<p>Giữ ấm mùa đông</p>', 95000, 35, 13, '2025-11-25 10:21:52', NULL),
(32, 'Cát Nắng Vàng', 'http://localhost/uploads/cat_nang_32.jpg', '<p>Cát trải nền tự nhiên</p>', 15000, 100, 14, '2025-11-25 10:21:52', NULL),
(33, 'Cá Thần Tiên Ai Cập', 'http://localhost/uploads/than_tien_33.jpg', '<p>Dáng bơi khoan thai</p>', 80000, 15, 13, '2025-11-25 10:21:52', NULL),
(34, 'Tép Blue Dream', 'http://localhost/uploads/blue_dream_34.jpg', '<p>Màu xanh ngọc bích</p>', 25000, 70, 14, '2025-11-25 10:21:52', NULL),
(35, 'Cây Rong La Hán', 'http://localhost/uploads/rong_la_han_35.jpg', '<p>Cây cắt cắm mọc nhanh</p>', 10000, 80, 13, '2025-11-25 10:21:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE `provinces` (
  `id` int(12) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Thành phố Hà Nội'),
(2, 'Thành phố Đà Nẵng'),
(3, 'Tuyên Quang'),
(4, 'Lạng Sơn'),
(5, 'Phú Thọ'),
(6, 'Hưng Yên'),
(7, 'Ninh Bình');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(12) NOT NULL,
  `orderid` int(12) NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `comment` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-11-17 07:11:58', NULL),
(2, 'user', '2025-11-17 07:11:58', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `numberPhone` varchar(10) NOT NULL,
  `roleid` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `numberPhone`, `roleid`, `create_at`, `updated_at`, `avatar`) VALUES
(1, 'Hồ Đức Mạnh', 'manhnovar', 'supermoffcial@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0388730432', 1, '2025-11-19 17:00:00', '2025-12-03 01:10:53', '1764724253_betta_hm_12.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wards`
--

CREATE TABLE `wards` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `provicesId` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wards`
--

INSERT INTO `wards` (`id`, `name`, `provicesId`, `create_at`, `updated_at`) VALUES
(1, 'Phường Long Biên', 0, NULL, NULL),
(2, 'Xã Hòa Tiến', 0, NULL, NULL),
(3, 'Xã Thạnh Bình', 0, NULL, NULL),
(4, 'Xã Khâu Vai', 0, NULL, NULL),
(5, 'Xã Quý Hòa', 0, NULL, NULL),
(6, 'Xã Liên Sơn', 0, NULL, NULL),
(7, 'Xã Đức Phú', 0, NULL, NULL),
(8, 'Phường Ô Chợ Dừa', 0, NULL, NULL),
(9, 'Phường Yên Hòa', 0, NULL, NULL),
(10, 'Phường Cầu Giấy', 0, NULL, NULL),
(11, 'Xã Việt Yên', 0, NULL, NULL),
(12, 'Phường Liêm Tuyền', 0, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proviceId` (`proviceId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `wardId` (`wardId`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories_blog`
--
ALTER TABLE `categories_blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`orderid`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_username` (`username`),
  ADD KEY `Users_Roles` (`roleid`);

--
-- Chỉ mục cho bảng `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `categories_blog`
--
ALTER TABLE `categories_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `wards`
--
ALTER TABLE `wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`proviceId`) REFERENCES `provinces` (`id`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `address_ibfk_3` FOREIGN KEY (`wardId`) REFERENCES `wards` (`id`);

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Users_Roles` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
