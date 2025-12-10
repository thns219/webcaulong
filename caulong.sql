-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 25, 2025 lúc 06:01 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `caulong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`) VALUES
(10, 5, 11, 1, '2025-05-20 08:06:29'),
(94, 11, 5, 1, '2025-05-28 08:06:57'),
(95, 11, 2, 2, '2025-05-28 08:06:57'),
(102, 13, 3, 2, '2025-05-28 10:26:57'),
(148, 15, 2, 1, '2025-06-06 08:00:44'),
(149, 15, 6, 1, '2025-06-06 08:00:44'),
(151, 16, 1, 1, '2025-06-06 08:03:23'),
(157, 20, 2, 1, '2025-06-25 15:10:10'),
(158, 20, 6, 2, '2025-06-25 15:10:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `don_hang_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `don_hang_id`, `product_id`, `so_luong`, `don_gia`) VALUES
(10, 10, 10, 1, 3800000.00),
(15, 13, 6, 6, 620000.00),
(16, 14, 1, 1, 1500000.00),
(17, 15, 2, 1, 400000.00),
(18, 16, 1, 1, 1500000.00),
(19, 17, 2, 1, 400000.00),
(20, 18, 2, 1, 400000.00),
(21, 19, 3, 1, 550000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `ngay_dat` timestamp NOT NULL DEFAULT current_timestamp(),
  `trang_thai` varchar(50) DEFAULT 'Chờ xử lý',
  `tong_tien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`id`, `user_id`, `username`, `sdt`, `dia_chi`, `ngay_dat`, `trang_thai`, `tong_tien`) VALUES
(10, 13, 'thien', '0321456789', 'phucat', '2025-05-28 07:21:50', 'Chờ xử lý', 3800000.00),
(13, 15, 'myhoi', '0999999999', '12345', '2025-05-29 02:40:27', 'Chờ xử lý', 3720000.00),
(14, 15, 'myhoi', '0999999999', '12345', '2025-06-02 08:46:49', 'Chờ xử lý', 1500000.00),
(15, 15, 'myhoi', '0999999999', '12345', '2025-06-04 18:57:27', 'Chờ xử lý', 400000.00),
(16, 18, 'myhoiii', '0328175565', '142 Tran Luong', '2025-06-06 08:14:34', 'Chờ xử lý', 1500000.00),
(17, 20, 'hung2', '01111111', '20 Phan Đình Phùng, P Bến Nghé, Quận 1, TP Hồ Chí Minh', '2025-06-06 16:53:14', 'Chờ xử lý', 400000.00),
(18, 20, 'hung2', '01111111', '20 Phan Đình Phùng, P Bến Nghé, Quận 1, TP Hồ Chí Minh', '2025-06-06 16:53:25', 'Chờ xử lý', 400000.00),
(19, 20, 'hung2', '01111111', '20 Phan Đình Phùng, P Bến Nghé, Quận 1, TP Hồ Chí Minh', '2025-06-10 16:28:43', 'Chờ xử lý', 550000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sao` int(1) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `ngay` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `sao`, `noi_dung`, `ngay`) VALUES
(1, 11, 4, 'Shop nhu c', '2025-05-23 17:42:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `url`, `author`, `published_date`, `content`, `summary`, `thumbnail`) VALUES
(1, 'Giải Vô Địch Cầu Lông Đồng Đội Quốc Gia 2025 TPHCM đoạt huy chương đồng', 'https://votcaulongshop.vn/giai-vo-dich-cau-long-dong-doi-quoc-gia-2025-tphcm-doat-huy-chuong-dong/', 'Erik Ten Hag', '2025-03-12', '<p>Huy chương đồng của Giải Vô Địch Cầu Lông Đồng Đội Hỗn Hợp Quốc Gia 2025 tại Điện Biên diễn ra từ ngày 21-26/4 rốt cuộc đã thuộc về TPHCM, sau chiến thắng tại trận tranh hạng 3 của Nhóm A trước Đồng Nai 3-0, nhẹ nhàng không kém so với chiến thắng chính đối thủ này 5-0 ở vòng bảng.</p>\r\n<img src= \"https://votcaulongshop.vn/wp-content/uploads/2025/04/giai-vo-dich-cau-long-dong-doi-quoc-gia-2025-tphcm-doat-huy-chuong-dong.jpg\" >\r\n<p>Lần này, tay vợt đơn nữ số 1 Việt Nam Nguyễn Thùy Linh tiếp tục vắng mặt trong thành phần Đồng Nai, nhưng TPHCM chào đón huyền thoại Nguyễn Tiến Minh xuất chiến. Nguyễn Tiến Minh không phụ sự kỳ vọng khi ấn định chiến thắng 3-0 cho đội nhà, sau thành công của đôi nam Phan Phúc Thịnh / Đặng Khắc Đăng Khánh và Lê Ngọc Vân ở đơn nữ. Do đó, các trận đôi nữ và đôi nam nữ không thi đấu.</p>\r\n<p>Ở Nhóm B, Đà Nẵng xếp thứ 3 sau chiến thắng chủ nhà Điện Biên 3-1. Nguyễn Thùy Dương níu kéo hy vọng lật bàn cho Điện Biên ở trận thứ 3 có nội dung đơn nữ, nhưng vậy là chưa đủ. Những chiến thắng của đôi nam nữ Nguyễn Phi Hùng / Nguyễn Thị Phương Hà, Đào Vĩnh Hưng ở đơn nam và đôi nam Nguyễn Phi Hùng / Đào Vĩnh Hưng đem về chiến thắng chung cuộc cho Đà Nẵng.</p>', 'Giải Vô Địch Cầu Lông Đồng Đội Quốc Gia 2025 TPHCM đoạt huy chương đồng', 'https://votcaulongshop.vn/wp-content/uploads/2025/04/giai-vo-dich-cau-long-dong-doi-quoc-gia-2025-tphcm-doat-huy-chuong-dong.jpg'),
(2, 'Top 4 Vợt Cầu Lông Yonex Tốt Nhất Năm 2025', 'https://votcaulongshop.vn/top-10-vot-yonex-tot-nhat-nam-2025/', 'Antony', '2025-03-11', '<p>Bài viết sau đây sẽ giới thiệu những cây vợt cầu lông Yonex nổi bật nhất năm 2025, phù hợp cho cả người chơi chuyên nghiệp lẫn bán chuyên.</p>\r\n\r\n    <div class=\"racket\">\r\n        <h2>TOP 1: Yonex Astrox 99 Pro</h2>\r\n        <img src=\"https://votcaulongshop.vn/wp-content/uploads/2025/04/top-10-vot-yonex-tot-nhat-nam-2025-1.jpg\">\r\n        <p>Vợt cầu lông Astrox 99 Pro nổi bật với thiết kế nặng đầu, trọng lượng 4U/3U cùng khung NAMD cao cấp, mang lại sự ổn định và uy lực tối đa cho những pha tấn công. Đây là lựa chọn lý tưởng cho người chơi ưa chuộng lối đánh mạnh mẽ, đặc biệt là dân văn phòng và sinh viên có lực cổ tay tốt. Nhờ công nghệ Rotational Generator System, người chơi có thể thực hiện các cú chuyển hướng mượt mà và kiểm soát cầu chính xác hơn. Theo khảo sát, có tới 85% người dùng đánh giá cao dòng vợt này vì khả năng đập cầu mạnh và cảm giác cầm nắm chắc tay.</p>\r\n    </div>\r\n\r\n    <div class=\"racket\">\r\n        <h2>TOP 2: Yonex Arcsaber 11 Pro</h2>\r\n        <img src=\"https://votcaulongshop.vn/wp-content/uploads/2025/04/vot-cau-long-yonex-arcsaber-11-pro.jpg\">\r\n        <p>Vợt cầu lông này nổi bật với trọng lượng 4U/3U, sử dụng khung cải tiến Enhanced Arcsaber cùng điểm cân bằng 300mm, mang đến sự ổn định và linh hoạt trong lối chơi. Đây là dòng vợt công thủ toàn diện, được 65% dân văn phòng yêu thích nhờ khả năng kiểm soát cầu tốt và độ chính xác cao trong từng cú đánh. Sản phẩm rất phù hợp với người chơi phong trào mong muốn cân bằng giữa tấn công và phòng thủ.</p>\r\n    </div>\r\n\r\n    <div class=\"racket\">\r\n        <h2>TOP 3: Vợt Yonex tốt nhất năm 2025: Yonex Nanoflare 001 Ability</h2>\r\n        <img src=\"https://votcaulongshop.vn/wp-content/uploads/2025/04/top-5-yonex-nanoflare-001-ability-768x959.jpg\">\r\n        <p>Vợt cầu lông này nổi bật với trọng lượng 5U (75-79g), thân dẻo và màu sắc bắt mắt, thu hút sự yêu thích ngay từ cái nhìn đầu tiên. Với mức giá khoảng 1.1 triệu đồng, sản phẩm được đánh giá rất phù hợp cho nữ giới và người chơi phong trào, đặc biệt trong lối đánh đôi đòi hỏi tốc độ. Theo khảo sát, có tới 60% người dùng chọn mẫu vợt này nhờ thiết kế nhẹ, hỗ trợ tấn công nhanh và dễ điều khiển.</p>\r\n    </div>\r\n\r\n    <div class=\"racket\">\r\n        <h2>TOP 4: Yonex Voltric Lite 25i</h2>\r\n        <img src=\"https://votcaulongshop.vn/wp-content/uploads/2025/04/voltric-25-ii.jpg\">\r\n        <p>Vợt cầu lông này nổi bật với trọng lượng 5U, thân dẻo và tích hợp công nghệ Tri-Voltage System, giúp hỗ trợ lực đánh tốt ngay cả trong phân khúc giá rẻ. Với mức giá chỉ khoảng 700 ngàn đồng, đây là lựa chọn cực kỳ phù hợp cho học sinh, sinh viên hoặc người mới chơi có ngân sách hạn chế. Vợt nhẹ, dễ vung nhưng vẫn đảm bảo sức mạnh cho các pha tấn công.</p>\r\n    </div>', 'Top 4 Vợt Cầu Lông Yonex Tốt Nhất Năm 2025', 'https://votcaulongshop.vn/wp-content/uploads/2025/04/top-10-vot-yonex-tot-nhat-2025.jpg'),
(3, 'Ra mắt BST giày Lining cùng đại sứ Issiac', 'https://lining.com.vn/blogs/news/ra-mat-bst-giay-li-ning-soft-cung-dai-su-isaac-khoi-bat-chat-rieng', 'Li-Ning Team', '2024-11-15', '<p>Li-Ning Soft - Sự kết hợp hoàn hảo giữa phong cách thời trang và công nghệ êm ái vượt trội. Hãy cùng Đại sứ thương hiệu Li-Ning - Nam ca sĩ Isaac \"nâng tầm\" phong cách và \"bùng nổ\" chất riêng với Li-Ning Soft!</p>\r\n<img src=\"//file.hstatic.net/1000312752/file/kv_900_x_900_c4a39a12957e4dbcb26764cec556acde_grande.png\">\r\n<ul><li>Cạ cứng cho mọi outfit với thiết kế trendy, đa màu sắc</li><li>Công nghệ “hạng A” giúp bảo vệ chân tối ưu, giúp bạn tận hưởng từng bước chân nhẹ êm như bay</li><li>Chất liệu cao cấp, êm ái, thoáng khí, mang lại cảm giác thoải mái tối ưu cho mọi hoạt động.</li></ul><p>Li-Ning Soft - “Must-have item” để bạn tự tin tỏa sáng với phong cách riêng!</p><p>Đặc biệt, Li-Ning còn có quà tặng hấp dẫn lên đến 677K khi mua 01 đôi giày SOFT. Còn chờ gì nữa mà không đến store Li-Ning gần nhất để “cheap-moment” với Đại sứ Isaac!</p>\r\n<p>#LiNing #LiNingVietnam #LiNingSOFT #SOFT</p>\r\n<img src=\"https://file.hstatic.net/1000312752/file/posm-softt__2__cc547b656494470fb2ee90650298e12d_grande.png\">\r\n<p>Website: <a href = \"https://lining.com.vn/\">https://lining.com.vn/</a></p>\r\n\r\n<p>Hệ thống cửa hàng: <a href = \"https://lining.com.vn/pages/he-thong-cua-hang-2\">https://lining.com.vn/pages/he-thong-cua-hang-2</a></p>', 'Li-Ning ra mắt BST giày Soft kết hợp công nghệ êm ái và phong cách thời trang hiện đại cùng đại sứ thương hiệu Isaac.', 'https://file.hstatic.net/1000312752/file/kv_900_x_900_c4a39a12957e4dbcb26764cec556acde_grande.png'),
(4, 'Thùy Linh thắng cựu số 1 thế giới ở giải Malaysia', 'https://vnexpress.net/thuy-linh-thang-cuu-so-1-the-gioi-o-giai-malaysia-4888731.html', 'Đức Đồng', '2025-05-21', '<p>MalaysiaTay vợt nữ số một Việt Nam Nguyễn Thuỳ Linh ra quân suôn sẻ ở giải Malaysia Masters, khi đánh bại Pusarla Venkata Sindhu (Ấn Độ) 2-1, trưa 21/5.</p>\r\n\r\n<p>Thùy Linh hiện đứng thứ 26 thế giới, kém Sindhu 10 bậc. Tay vợt Ấn Độ từng vô địch thế giới năm 2019, lên số một thế giới, giành HC bạc Olympic 2016 và HC đồng Olympic 2020. Nhưng ở lần chạm trán gần nhất hồi tháng 1 ở Indonesia Masters, Thùy Linh thắng 22-20, 21-12.</p>\r\n\r\n<p>Tái đấu hôm nay, Thùy Linh nhập cuộc đầy tự tin và liên tiếp dẫn trước, trước khi bị gỡ 6-6. Nhưng tay vợt người Phú Thọ không đánh mất thế trận mà bình tĩnh chắt chiu các pha cầu bền để ghi liền 6 điểm, dẫn lại 12-6. Khi tay vợt Việt Nam tăng tốc, tượng đài quần vợt Ấn Độ lại lúng túng, mắc nhiều lỗi đánh hỏng. Do đó, Thùy Linh dẫn 17-7 rồi thắng 21-11.</p>\r\n\r\n<img src =\"https://i1-thethao.vnecdn.net/2025/05/21/498972330-1011888404482455-398-8088-1789-1747803864.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=DWOkFRz2CkX5T24ic2fRwQ\">\r\n<p>Thùy Linh ăn mừng sau khi đánh bại Pusarla Venkata Sindhu (Ấn Độ) 2-1, trưa 21/5. Ảnh: Zyy</p>\r\n\r\n<p>Ở thế nguy hiểm, Sindhu vùng lên đầu set hai, liên tiếp ghi điểm. Cô dẫn 6-0 trước khi bị Thùy Linh rút ngắn còn 5-6. Nhưng với bản lĩnh của mình, Sindhu hóa giải các pha cầu khó của tay vợt Việt Nam, đồng thời điều cầu cuối sân chính xác đẩy lùi Thùy Linh ra sâu rồi dứt điểm trên lưới. Sindhu dẫn 14-12 rồi 19-12 trước khi thắng 21-14, đưa trận đấu vào set 3.</p>\r\n\r\n<p>Dù cả hai xuống sức, Thùy Linh tỏ ra quyết tâm cao hơn. Cô giữ ưu thế và thường ghi điểm sau các pha cầu giằng co. Đại diện Việt Nam dẫn 8-6 rồi 13-6 để tạo cách biệt an toàn. Sindhu nỗ lực đảo ngược tình thế, nhưng không kịp. Thùy Linh dẫn 19-14 rồi tiến tới điểm thắng 21-15 để vào vòng 2.</p>\r\n\r\n<p>Đối thủ tiếp theo của Thùy Linh là người thắng trong cặp đấu giữa Tidapron (Thái Lan, 80 thế giới) với Line (Đan Mạch, 35 thế giới).</p>\r\n\r\nMalaysia Masters 2025 thuộc hệ thống super 500 của Liên đoàn cầu lông thế giới, diễn ra tại Axiata Arena, Kuala Lumpur từ ngày 20 đến 25/5 với tổng giải thưởng là 475.000 USD. Ngoài Thùy Linh, Việt Nam còn có hai tay vợt nam là Lê Đức Phát, Nguyễn Hải Đăng tham dự. Trong đó, Hải Đăng đã đánh bại Đức Phát 2-0 ở vòng bảng để ghi tên vào vòng chính. Hải Đăng sẽ gặp Yushi Tanaka (Nhật Bản, số 23 thế giới) ở vòng tiếp theo.\r\n\r\nThùy Linh sinh ngày 20/11/1997 tại Phú Thọ. Cô thi đấu chuyên nghiệp năm 14 tuổi, và rồi mất thêm 4 năm để vô địch giải các tay vợt xuất sắc toàn quốc 2015. Từ 2018, Thùy Linh là tay vợt nữ số một Việt Nam, với 7 lần liên tiếp vô địch giải cầu lông cá nhân quốc gia. Cô còn ba lần liên tiếp vô địch Vietnam Open, từ 2022.\r\n\r\nThùy Linh cũng từng dự Olympic Tokyo 2020 và Paris 2024. Cô hiện xếp thứ 29 thế giới nội dung đơn nữ.\r\n\r\n', 'Tay vợt Việt Nam Nguyễn Thùy Linh thắng ngược đối thủ Đan Mạch - Line Christophersen 2-1 ở vòng hai giải Malaysia Masters 500 trưa 22/5.', 'https://i1-thethao.vnecdn.net/2025/05/22/499568967-1012669111071051-342-5238-4197-1747896723.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=_VJT7QyfIbZi2c6aXUIeYQ'),
(5, 'Top mẫu giày cầu lông 2025 đáng mua nhất hiện nay', 'https://mira.vn/top-mau-giay-cau-long-2025-dang-mua-nhat-hien-nay', 'Chuongw Phajm', '2025-05-25', '<p>Cầu lông là môn thể thao đòi hỏi sự di chuyển linh hoạt, phản xạ nhanh và sức bật tốt. Vì thế, việc chọn một đôi giày cầu lông chuyên dụng, phù hợp với bàn chân và lối chơi là điều vô cùng quan trọng. Giày tốt giúp bảo vệ cổ chân, hạn chế chấn thương, tăng độ bám sân và nâng cao hiệu suất thi đấu.</p>\r\n\r\n \r\n\r\n<p>Dưới đây là những mẫu giày cầu lông nổi bật nhất năm 2025, đang được giới vận động viên và người chơi phong trào ưa chuộng.</p>\r\n \r\n\r\n<h3>MIRA WARRIOR 2025 – Đôi giày của sự bền bỉ</h3>\r\n<img width = 600px src =\"https://mira.vn/upload/images/Screen%20Shot%202025-05-03%20at%2017_33_44.png\">\r\n\r\n<h4>Đặc điểm nổi bật:</h4>\r\n\r\n<ul>\r\n<li>Upper dày và chắc chắn, chống mài mòn.</li>\r\n<li>Đế EVA kết hợp đệm lót hấp thụ lực cực tốt.</li>\r\n<li>Heel counter cố định gót – chống lật cổ chân hiệu quả.</li>\r\n<li>Thiết kế mạnh mẽ, phù hợp với người có lối chơi thiên về sức mạnh.</li>\r\n</ul>\r\n<strong>Điểm mạnh:</strong> Giày rất bền, hỗ trợ cổ chân tốt, phù hợp cả luyện tập và thi đấu.\r\n\r\n \r\n\r\n<h3>Yonex Power Cushion 65Z3 2025 – Công nghệ giảm chấn hàng đầu</h3>\r\n<img width = 600px src =\"https://mira.vn/upload/images/Screen%20Shot%202025-05-03%20at%2017_34_22.png\">\r\n<h4>Đặc điểm nổi bật:</h4>\r\n<ul>\r\n<li>Power Cushion+ hấp thụ sốc, trả lại lực nhanh.</li>\r\n<li>Đế ngoài tròn – giúp xoay trở linh hoạt hơn.</li>\r\n<li>Form giày chuẩn thi đấu quốc tế, được nhiều VĐV sử dụng.</li>\r\n<li>Kiểu dáng thể thao, bắt mắt.</li>\r\n<strong>Điểm mạnh:</strong> Giảm chấn tốt, chơi lâu không đau chân, độ bám cực cao.\r\n\r\n\r\n<h3>MIRA LIGHTER – Đối thủ đáng gờm trong phân khúc giá rẻ</h3>\r\n<img width = 600px src = \"https://mira.vn/upload/images/Screen%20Shot%202025-05-03%20at%2017_33_53.png\">\r\n\r\n<h4>Đặc điểm nổi bật:</h4>\r\n\r\n<ul>\r\n<li>Thiết kế tối giản nhưng tinh tế.</li>\r\n<li>Upper bền, dễ vệ sinh – phù hợp học sinh, sinh viên.</li>\r\n<li>Đế cao su tổng hợp đàn hồi – chơi tốt trên cả sân gạch và sân thảm.</li>\r\n</ul>\r\n<strong>Điểm mạnh:</strong> Giá phải chăng, chất lượng vượt mong đợi trong phân khúc phổ thông.\r\n\r\n\r\n<h3>Tiêu chí chọn giày cầu lông năm 2025</h3>\r\n \r\n\r\n<p>Khi chọn mua giày cầu lông, bạn nên lưu ý:</p>\r\n\r\n<ul>\r\n<li>Form giày ôm chân: Tránh bị trượt bên trong khi di chuyển.</li>\r\n<li>Chống sốc – giảm chấn: Giúp chơi lâu mà không đau bàn chân hay đầu gối.</li>\r\n<li>Bám sân tốt: Nhất là khi chơi trên mặt sân gạch hoặc thảm cũ.</li>\r\n<li>Thoáng khí: Hạn chế mùi và đổ mồ hôi.</li>\r\n</ul>\r\n\r\n<p>Năm 2025, thị trường giày cầu lông có rất nhiều lựa chọn chất lượng, phù hợp mọi phong cách chơi – từ nhẹ, linh hoạt cho đến bền, hỗ trợ lực. Hãy chọn cho mình một đôi giày phù hợp với thể trạng, ngân sách và mục tiêu tập luyện để cải thiện hiệu suất thi đấu tốt nhất.</p>', 'Những mẫu giày cầu lông nổi bật nhất năm 2025 và tiêu chí chọn giày phù hợp', 'https://mira.vn/upload/images/Screen%20Shot%202025-05-03%20at%2017_33_44.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(100) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `Loại` int(11) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `Giamgia` int(11) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `luot_mua` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `ten_san_pham`, `soluong`, `Loại`, `mo_ta`, `gia`, `Giamgia`, `hinh_anh`, `luot_mua`) VALUES
(1, 'Áo cầu lông Yonex', 4, 1, 'Áo cầu lông Yonex thiết kế đế chống trượt, phù hợp với các vận động viên chuyên nghiệp.', 1500000.00, 0, 'ao.webp', 5),
(2, 'Áo cầu lông Li-Ning', 1, 1, 'Áo cầu lông Li-Ning thoáng khí, phù hợp cho các vận động viên', 600000.00, 400000, 'ao1.jpg', 8),
(3, 'Áo cầu lông Yonex 1', 3, 1, 'Áo cầu lông Yonex với chất liệu thoáng khí, giúp bạn vận động thoải mái.', 550000.00, 0, 'ao2.jpg', 5),
(4, 'Vợt cầu lông Victor 2', 14, 2, 'Áo cầu lông Victor siêu nhẹ, dễ dàng vận động, phù hợp cho các giải đấu.', 580000.00, 0, 'caulong.webp', 1),
(5, 'Giày cầu lông Adidas ', 15, 3, 'Áo cầu lông Adidas, thiết kế thời trang, chất liệu thấm hút mồ hôi tốt.', 590000.00, 0, 'giay.jpg', 5),
(6, 'Áo cầu lông Li-Ning 4', 4, 1, 'Áo cầu lông Li-Ning với thiết kế hiện đại, thoáng mát, sử dụng cho các môn thể thao.', 620000.00, 0, 'ao3.jpg', 6),
(8, 'Áo cầu lông Yonex 6', 9, 1, 'Áo cầu lông Yonex với công nghệ chống mồ hôi, mang lại sự thoải mái khi thi đấu.', 560000.00, 400000, 'ao4.jpg', 1),
(9, 'Áo cầu lông Victor 8', 7, 1, 'Áo cầu lông Victor phù hợp cho các trận đấu căng thẳng, với chất liệu thoáng khí.', 570000.00, 0, 'ao5.jpg', 3),
(10, 'Vợt cầu lông Victor Thruster K 12', 9, 2, 'Vợt cầu lông với sức mạnh vượt trội, phù hợp cho người chơi tấn công.', 3800000.00, 0, 'vot1.jpg', 6),
(11, 'Vợt cầu lông Lining Turbo X90', 15, 2, 'Vợt cầu lông bền bỉ, phù hợp cho người chơi phong trào.', 2500000.00, 0, 'vot2.jpg', 0),
(12, 'Vợt cầu lông Mizuno JPX 8.1', 14, 2, 'Vợt cầu lông nhẹ, linh hoạt, phù hợp cho người chơi kiểm soát.', 3200000.00, 0, 'vot3.jpg', 1),
(15, 'Giày cầu lông Yonex Power Cushion 65Z3', 10, 3, 'Giày cầu lông với công nghệ giảm chấn tiên tiến.', 2800000.00, 2490000, 'giay1.jpg', 0),
(16, 'Giày cầu lông Victor A960', 15, 3, 'Giày cầu lông bám sân tốt, hỗ trợ di chuyển linh hoạt.', 2600000.00, 0, 'giay2.jpg', 0),
(19, 'Vợt cầu lông Yonex Astrox 100ZZ', 15, 2, 'Vợt cầu lông cao cấp dành cho người chơi chuyên nghiệp.', 4500000.00, 0, 'vot4.jpg', 0),
(20, 'Giày Nike Air Max', 10, 3, 'Giày chạy bộ nhẹ, êm ái.', 2200000.00, 2100000, 'giay3.jpg', 0),
(21, 'Giày Adidas Ultraboost', 15, 3, 'Giày thể thao chuyên dụng cao cấp.', 2500000.00, 2100000, 'giay4.jpg', 0),
(22, 'Giày Puma Ignite', 12, 3, 'Thiết kế năng động, phù hợp mọi hoạt động.', 1800000.00, 1500000, 'giay5.jpg', 0),
(23, 'Giày Asics Gel Kayano', 15, 3, 'Giày hỗ trợ chạy đường dài.', 2700000.00, 2000000, 'giay6.jpg', 0),
(24, 'Giày Mizuno Wave Rider', 15, 3, 'Bền bỉ, ôm chân tốt.', 2300000.00, 0, 'giay7.jpg', 0),
(25, 'Giày New Balance 1080', 15, 3, 'Thoải mái, phong cách hiện đại.', 2400000.00, 2100000, 'giay8.jpg', 0),
(26, 'Áo Nike Dri-FIT', 10, 1, 'Áo thun thể thao thấm hút mồ hôi.', 550000.00, 450000, 'ao6.jpg', 0),
(27, 'Áo Adidas Training', 10, 1, 'Áo tập luyện chất lượng cao.', 600000.00, 400000, 'ao7.jpg', 0),
(28, 'Áo Under Armour HeatGear', 10, 1, 'Vải nhẹ, co giãn, thoáng khí.', 500000.00, 400000, 'nu.jpg', 0),
(29, 'Vợt Yonex Astrox 99', 15, 2, 'Vợt cầu lông cho người chơi chuyên nghiệp.', 3100000.00, 3000000, 'vot5.jpg', 0),
(30, 'Vợt Wilson Pro Staff', 15, 2, 'Vợt kiểm soát tốt.', 4500000.00, 4200000, 'vot6.jpg', 0),
(31, 'Vợt Lining Turbo X90', 0, 2, 'Cân bằng giữa sức mạnh và điều khiển.', 2900000.00, 2800000, 'vot7.jpg', 0),
(32, 'Vợt Babolat Pure Drive', 15, 2, 'Công nghệ tối ưu hóa độ xoáy.', 4200000.00, 4000000, 'vot8.jpg', 0),
(33, 'Băng quấn tay', 30, 4, 'Hỗ trợ cổ tay khi vận động.', 120000.00, 0, 'bangtay.jpg', 0),
(34, 'Túi đựng giày', 9, 4, 'Gọn nhẹ, chống nước.', 250000.00, 210000, 'tui.jpg', 1),
(35, 'Vớ thể thao Nike', 50, 4, 'Thoáng khí, co giãn.', 90000.00, 50000, 'vo.jpg', 0),
(36, 'Dây giày co giãn', 25, 4, 'Tiện lợi, dễ mang.', 60000.00, 0, 'day.jpg', 0),
(37, 'Mũ thể thao Adidas', 12, 4, 'Chống nắng, thoáng mát.', 200000.00, 150000, 'mu.jpg', 0),
(38, 'Bình nước 1L', 19, 4, 'Nhựa BPA free, an toàn.', 150000.00, 100000, 'binh.jpg', 1),
(39, 'Khăn tập gym', 18, 4, 'Mềm mại, thấm hút tốt.', 80000.00, 0, 'khan.jpg', 0),
(40, 'Bọc cán vợt Yonex', 40, 4, 'Chống trơn trượt.', 50000.00, 0, 'boc.jpg', 0),
(41, 'Balo thể thao', 15, 4, 'Đa năng, nhiều ngăn tiện dụng.', 350000.00, 320000, 'balo.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `sdt`, `dia_chi`, `role_id`) VALUES
(12, 'hung', '$2y$10$wFhXWGEU9/Qfx92e0N/loeWKVSr2X55VVQdSc.QfsQKJNmp9h7NCe', 'hung@gmail.com', '987654', 'gialai', 3),
(19, 'hung1', '$2y$10$MQ5N7yoPk6BJk2IwmYsFGu3RXKdlVhkxEHW2IozpR3.7dqVWMWfDu', 'hung123@gmail.com', '01111111', '20 Hồ Tùng Mậu, P Bến Nghé, Quận 1, TP Hồ Chí Minh', 1),
(20, 'hung2', '$2y$10$sp6XakOcT2pDbK8nARUeBubfUvsf6fRroLPx3qasWUCop5VN1x7ly', 'qhung@gmail.com', '01111111', '20 Phan Đình Phùng, P Bến Nghé, Quận 1, TP Hồ Chí Minh', 2),
(21, 'hung3', '$2y$10$ZJmGkLlEZ62kly6Kn7ETj.OhSV.SFUD.4ienMCWvYnqc1o.B9wIYS', 'qhung@gmail.com', '1233132', '20 Hồ Tùng Mậu, P Bến Nghé, Quận 1, TP Hồ Chí Minh', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hang_id` (`don_hang_id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_role` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
