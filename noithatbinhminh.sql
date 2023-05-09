-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2023 lúc 02:43 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `noithatbinhminh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_account` varchar(20) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_account`, `admin_password`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_fullname` text NOT NULL,
  `customer_password` text NOT NULL,
  `customer_phone` text NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_email`, `customer_fullname`, `customer_password`, `customer_phone`, `customer_address`, `created_at`, `updated_at`) VALUES
(1, 'ductrinh@gmail.com', 'Trịnh Công Đức', '0cc175b9c0f1b6a831c399e269772661', '0966106570', 'An Vinh - Quỳnh Phụ - Thái Bình', '2023-02-12 08:42:21', '2023-05-06 10:52:18'),
(3, 'phongvjp@gmail.com', 'Trịnh Công Phong', '9f48495bb4b98ac37a1a72c7e6490c7a', '113', 'Anvinh-a', '2023-02-12 14:31:23', '2023-02-23 16:32:33'),
(4, 'hieubeo@gmail.com', 'Lê Quang Hiếu', 'a599842dee7f2631a2f6503a5f147215', '0123456789', 'Bắc Sơn', '2023-02-13 15:50:49', ''),
(5, '123@gmail.com', 'bop', '0cc175b9c0f1b6a831c399e269772661', '0966101554', 'Bình Dương', '2023-02-19 13:08:29', ''),
(7, 'a@gmail.com', 'Đức', '0cc175b9c0f1b6a831c399e269772661', '0966106570', 'Hà Nội', '2023-04-23 15:42:30', ''),
(8, 'b@gmail.com', 'Bê', '92eb5ffee6ae2fec3ad71c777531578f', '01293128939', 'Hải Phòng', '2023-04-23 15:51:57', ''),
(9, 'ducdocdaox237@gmail.com', 'Trịnh Công Đức', '3178914d6e429889da9de8df2a3b8928', '0966106570', 'An Vinh', '2023-05-02 18:07:00', '2023-05-06 12:20:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_order`
--

CREATE TABLE `detail_order` (
  `detail_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `detail_order`
--

INSERT INTO `detail_order` (`detail_order_id`, `product_id`, `order_quantity`, `order_id`) VALUES
(9, 105, 1, 60),
(10, 141, 1, 60),
(11, 108, 1, 60),
(12, 64, 1, 60),
(13, 159, 1, 61),
(14, 35, 1, 61),
(15, 148, 2, 62),
(16, 147, 1, 63),
(19, 47, 2, 65),
(20, 126, 1, 65),
(21, 151, 1, 66),
(22, 147, 3, 67),
(23, 60, 1, 67),
(24, 155, 1, 67),
(25, 112, 1, 67),
(26, 152, 1, 68),
(27, 76, 1, 68),
(28, 155, 1, 69);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(200) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `material`
--

INSERT INTO `material` (`material_id`, `material_name`, `created_at`, `updated_at`) VALUES
(2, 'Gỗ', '2023-01-31 04:10:53', '2023-01-31 04:27:54'),
(3, 'Nhựa ABS', '2023-01-31 10:25:35', ''),
(4, 'Kính cường lực', '2023-02-09 01:44:37', ''),
(5, 'Da', '2023-02-09 01:44:50', ''),
(6, 'Thép không gỉ', '2023-02-09 01:45:03', ''),
(11, 'Inoxx', '2023-05-02 16:19:37', '2023-05-02 16:21:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_p`
--

CREATE TABLE `order_p` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `receiver_name` varchar(200) NOT NULL,
  `receiver_phonenumber` text NOT NULL,
  `receiver_address` varchar(200) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order_p`
--

INSERT INTO `order_p` (`order_id`, `customer_id`, `receiver_name`, `receiver_phonenumber`, `receiver_address`, `order_status`, `created_at`, `updated_at`) VALUES
(60, 1, 'bop', 'bop', 'bop', 1, '2023-04-23 11:18:09', ''),
(61, 1, 'Bê', '342343214', 'Đà', 1, '2023-04-23 16:04:55', ''),
(62, 1, 'a', 'a', 'a', 4, '2023-04-23 16:25:19', ''),
(63, 7, 'aaaaa', '312321321', 'Ấndhfu8asf', 0, '2023-04-24 10:29:18', ''),
(65, 7, 'a', 'a', 'aaa', 1, '2023-04-24 10:43:59', ''),
(66, 7, 'aa', 'aaa', 'aa', 1, '2023-04-24 10:48:59', ''),
(67, 7, 'Bốp', '0123456789', 'Nhổn', 0, '2023-04-25 12:18:05', ''),
(68, 1, 'adsf', 'ádfasdfasg', 'agsasdgdsadg', 0, '2023-05-02 13:05:39', ''),
(69, 1, 'Trịnh Công Đức', '01235912942', 'An Vinh', 0, '2023-05-05 13:53:53', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_size` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `material_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_quantity`, `product_size`, `product_image`, `material_id`, `category_id`, `created_at`, `updated_at`) VALUES
(23, 'Sofa 3 chỗ Osaka mẫu 1 vải 288', '28800000', 'Sofa 3 chỗ từ bộa sưu tập Osaka mang nét hiện đại và thơ mộng của Nhật Bản, tạo nên một không gian sống độc đáo đầy sang trọng. Sản phẩm có phần chân bằng inox màu gold chắc chắn, phần nệm được bọc vải và có thể tháo rời được. Sofa 3 chỗ Osaka mẫu 1 vải 29 không chỉ mang đến thiết kế tinh tế, sang trọng mà còn cho người ngồi cảm giác thoải mái, dễ chịu.', 10, 'D2060 - R750 - C820/400 mm', 'sofa-osaka-3-cho-3101896-1.jpg', 2, 11, '2023-02-09 01:58:58', '2023-05-06 12:17:49'),
(24, 'Sofa 3 chỗ PENNY da cognac 509MB', '61860000', 'Sự đơn giản, tinh tế, sang trọng và không kém phần nổi bật của chiếc Sofa mang dòng máu bất diệt Scandinavian này với lần lượt các phiên bản màu từ tối tới sáng bật Pastel sẽ mang lại các sắc màu không thể lẫn vào đâu và đa dạng cho từng không gian sống nhà bạn. Thiết kế vuông vức, thanh mảnh nhẹ nhàng là sự pha trộn giữa vững chãi và nhẹ nhàng là tất cả những yếu tố thiết yếu hội tụ ở chiếc sofa này.', 1, 'D2400 - R880 - C850', '102437-sofa-penny-3-cho-dacognac-1.jpg', 5, 11, '2023-02-09 02:08:29', '2023-04-24 19:06:40'),
(25, 'Sofa Maxine 3 chỗ hiện đại da English Saddle', '143250000', 'Sofa Maxine 3 chỗ với điểm nhấn đặc biệt ở những hàng nút phá cách màu vàng đồng, lớp da bò màu cognac nổi bật. Sofa Maxine là 1 lựa chọn sáng giá cho không gian phòng khách sang trọng, tinh tế.', 4, 'D2160- R1010- C850 mm', 'sofa-maxine-3-cho-da-english-mau-nau-co-dien-87472-768x511.jpg', 5, 11, '2023-02-09 02:11:26', '2023-05-03 04:00:50'),
(26, 'Bàn bên Maxine', '12669999', 'Kết cấu mạnh mẽ mang cảm hứng công nghiệp cơ khí tạo cho sản phẩm bàn bên Maxine trở nên cá tính và lạ mặt. Bên cạnh đó, sản phẩm vẫn sử dụng chất liệu kim loại đồng, khung gỗ beech và vân gỗ mdf của bộ sưu tập Maxine. Sản phẩm là góp phận tạo nên sự kết nối với sofa trong phòng khách. Maxine – Nét nâu trầm sang trọng Maxine, mang thiết kế vượt thời gian, gửi gắm và gói gọn lại những nét đẹp của thiên nhiên và con người nhưng vẫn đầy tính ứng dụng cao trong suốt hành trình phiêu lưu của nhà thiế', 5, '590 - 700 mm', '1000-san-pham-nha-xinh_16-768x511.jpg', 2, 14, '2023-02-09 02:20:23', ''),
(27, 'Bàn nước Elegance màu đen', '23330000', 'Bàn nước Elegance với thiết kế đơn giản nhưng sang trọng và tinh tế. Nhờ kết cấu độc đáo nên có được trọng lượng nhẹ nhàng nhưng vô cùng chắc chắn. Phù hợp với các không gian nội thất hiện đại và đặc biệt là phong cách Scandinavian', 2, 'D1200 - R600 - C400 mm', '102413-ban-nuoc-elegnace-1m2-mau-den-2-768x495.jpg', 2, 14, '2023-02-09 02:29:42', ''),
(31, 'Bàn bên Maxine', '12669999', 'Kết cấu mạnh mẽ mang cảm hứng công nghiệp cơ khí tạo cho sản phẩm bàn bên Maxine trở nên cá tính và lạ mặt. Bên cạnh đó, sản phẩm vẫn sử dụng chất liệu kim loại đồng, khung gỗ beech và vân gỗ mdf của bộ sưu tập Maxine. Sản phẩm là góp phận tạo nên sự kết nối với sofa trong phòng khách. Maxine – Nét nâu trầm sang trọng Maxine, mang thiết kế vượt thời gian, gửi gắm và gói gọn lại những nét đẹp của thiên nhiên và con người nhưng vẫn đầy tính ứng dụng cao trong suốt hành trình phiêu lưu của nhà thiế', 4, '590 - 700 mm', '1000-san-pham-nha-xinh_16-768x511.jpg', 2, 14, '2023-02-09 02:44:11', ''),
(35, 'Sofa 3 chỗ PENNY da cognac 509MB', '61860000', 'Sự đơn giản, tinh tế, sang trọng và không kém phần nổi bật của chiếc Sofa mang dòng máu bất diệt Scandinavian này với lần lượt các phiên bản màu từ tối tới sáng bật Pastel sẽ mang lại các sắc màu không thể lẫn vào đâu và đa dạng cho từng không gian sống nhà bạn. Thiết kế vuông vức, thanh mảnh nhẹ nhàng là sự pha trộn giữa vững chãi và nhẹ nhàng là tất cả những yếu tố thiết yếu hội tụ ở chiếc sofa này.', 10, 'D2400 - R880 - C850', '102437-sofa-penny-3-cho-dacognac-1.jpg', 5, 11, '2023-02-09 02:44:39', '2023-05-03 04:00:43'),
(43, 'Tủ tivi Elegance màu nâu', '42670000', 'Tủ tivi Elegance màu nâu sang trọng', 9, 'D1745 - R420 - C430 mm', '102423-tu-tv-elegance-mau-tu-nhien-1-768x511.jpg', 2, 15, '2023-03-10 09:57:43', ''),
(47, 'Tủ Tivi Iris', '7776000', 'Tủ Tivi Iris vẻ đẹp bền vững từ gỗ sồi tự nhiên - MDF sơn xanh xám nhẹ nhàng có nguồn gốc bền vững, một loại vật liệu tự nhiên và tái tạo trở nên đẹp hơn theo từng năm. SP có thể kết hợp với các không gian phòng ngủ, phòng khách hoà cùng sản phẩm rumba hay iris.', 6, 'D1600-R450-C550 mm', '1000-tu-tv-iris-768x511.jpg', 2, 15, '2023-03-10 10:00:05', ''),
(52, 'Tủ tivi Universal P151/P9C/P201', '71952501', 'Tủ tivi Universal P151/P9C/P201 được làm từ gỗ Ash kết hợp MDF cao cấp sơn lacquer màu walnut trang nhã cùng với bề mặt tủ phủ lớp Ceramic P9C. Tủ tivi Universal P151/P9C/P201 có thiết kế sang trọng, thon gọn với nhiều ngăn tủ tiện dụng, kích thước vừa phải, có chiều cao phù hợp không gian vừa và lớn.', 3, 'D1810-R500-C490 mm', 'Tu-Ly-Universal-P151P9CP201-2-768x495.jpg', 2, 15, '2023-03-10 10:02:43', ''),
(60, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', '38930000', 'Bàn ăn Peak hiện đại mặt Ceramic vân mây kết hợp một thiết thông minh với một trải nghiệm hấp dẫn. Bằng cách sử dụng khung gỗ truyền thống và chuyển nó sang một cách diễn giải hiện đại hơn bằng kim loại, nó đã chứng tỏ có thể tạo ra một cấu trúc hỗ trợ vừa ổn định vừa cực kỳ chắc chắn.', 5, 'D2000-R000-C750mm', 'ban-an-peak-van-may-hien-dai-ceramic-768x511.jpg', 3, 16, '2023-03-10 10:06:21', ''),
(64, 'Bàn ăn Maxine 1m8', '8930000', 'Bàn ăn tròn Maxine tạo nét độc đáo bằng sự kết hợp giữa khung kim loại mạ đồng được thiết kế tinh xảo. Những chi tiết bo tròn đều được viền bằng kim loại đồng. Sự hài hòa trong việc phối màu nâu trầm và ánh kim tạo nên nét sang trọng và quyến rũ của không gian phòng ăn hiện đại.', 1, 'D1800-R900-C760 mm', '99100-ban-an-maxine-1m8-1-768x511.jpg', 2, 16, '2023-03-10 10:10:21', ''),
(70, 'Ghế ăn Rusty 80981K', '13000000', 'Ghế ăn Rusty 80981K bằng da sang trọng', 4, 'D550 - R540 - C790 mm', 'Ghe-An-Rusty-80981K-3105592-768x454.jpg', 5, 17, '2023-03-10 10:13:22', ''),
(76, 'Giường ngủ Miami 1m8 bọc vải Dolce 094', '18105000', 'Giường ngủ bọc vải Miami sử dụng gỗ Sồi trắng nhập khẩu từ Mỹ kết hợp MDF chống ẩm cao cấp tạo nên sự chắc chắn cho sản phẩm. Nhờ vào tone ấm của gỗ, giường Miami mang đến một sự hài hòa, đặc trưng của phong cách nội thất Bắc Âu.', 3, 'D2000- R1800- C1210 mm', 'giuong-miami-boc-vai-dolice-094-1-768x511.jpg', 2, 22, '2023-03-11 04:15:03', ''),
(87, 'Tủ áo Acrylic', '27965000', 'Tủ áo Acrylic thiết kế đẹp mắt', 7, 'D1600 - R600 - C2000 mm', 'Tu-ao-Acrylic-768x511.jpg', 3, 23, '2023-03-11 04:20:03', ''),
(94, 'Nệm Sen Việt 1m4', '7034400', 'Nệm lò xo túi Sen Việt được ra mắt từ năm 2017. Bằng tinh thần sáng tạo dân tộc, kết hợp cùng công nghệ sản xuất lò xo túi, Nệm Ưu Việt đã tạo ra dòng sản phẩm Sen Việt với những đường nét hoa sen Việt Nam được chấm phá trên mặt nệm với mong muốn truyền đi ý nghĩa đạo đức lớn lao, mang một giá trị thẩm mỹ vĩnh hằng của loài hoa đã thấm sâu vào tâm hồn dân tộc. Sản phẩm được những đối tác lớn ưa chuộng, tin dùng và phân phối rộng khắp trên cả nước.', 4, 'D2000 - R1400 - C250', 'nem-lo-xo-tui-senviet-1m4.jpg', 5, 24, '2023-03-11 04:22:54', ''),
(105, 'Bàn làm việc Maxine', '44149000', 'Một thiết kế bàn làm việc đẳng cấp cho không gian làm việc của bạn, Maxine sử dụng chất liệu da trên bề mặt, khung gỗ hoàn thiện mdf veneer nâu trầm sang trọng tạo cảm giác thư thái, nhẹ nhàng. Công năng của chiếc bàn được sắp tối ưu với các hộc kéo rộng. Maxine – Nét nâu trầm sang trọng Maxine, mang thiết kế vượt thời gian, gửi gắm và gói gọn lại những nét đẹp của thiên nhiên và con người nhưng vẫn đầy tính ứng dụng cao trong suốt hành trình phiêu lưu của nhà thiết kế người Pháp Dominique Moal.', 1, 'D1800-R750/1180-C750', '86828_1000-768x511.jpg', 2, 25, '2023-03-11 04:29:00', ''),
(108, 'Bàn làm việc Maxine', '44149000', 'Một thiết kế bàn làm việc đẳng cấp cho không gian làm việc của bạn, Maxine sử dụng chất liệu da trên bề mặt, khung gỗ hoàn thiện mdf veneer nâu trầm sang trọng tạo cảm giác thư thái, nhẹ nhàng. Công năng của chiếc bàn được sắp tối ưu với các hộc kéo rộng. Maxine – Nét nâu trầm sang trọng Maxine, mang thiết kế vượt thời gian, gửi gắm và gói gọn lại những nét đẹp của thiên nhiên và con người nhưng vẫn đầy tính ứng dụng cao trong suốt hành trình phiêu lưu của nhà thiết kế người Pháp Dominique Moal.', 3, 'D1800-R750/1180-C750', '86828_1000-768x511.jpg', 2, 25, '2023-03-11 04:29:08', ''),
(112, 'Ghế làm việc Labora high brown 80724K', '9520000', 'Ghế làm việc Labora high brown 80724K sang trọng', 4, 'D620 - R590 - C1290 mm', 'GHE-LAM-VIEC-LABORA-HIGH-BROWN-80724K-768x495.jpg', 5, 26, '2023-03-11 06:35:45', ''),
(119, 'Kệ Sách Artigo', '23488000', 'Thương hiệu Pháp Gautier.', 5, 'D850 - R380 - C1980mm', 'nha-xinh-ke-sach-cico.jpg', 2, 27, '2023-03-11 06:38:03', ''),
(126, 'Tủ Bếp Sunny', '33000000', 'Tủ Bếp Sunny thiết kế hiện đại', 4, 'D3220- R620- C2200 mm', 'tu-bep-768x511.jpg', 4, 18, '2023-03-11 07:35:59', ''),
(131, 'Bộ khung úp chén đĩa 3 tầng', '500000', 'Bộ khung úp chén đĩa 3 tầng', 5, 'D800-R300-C760 mm', 'bo_khung_up_chen_dia_3_tang_54402225_l.jpg', 6, 19, '2023-03-11 07:41:00', ''),
(141, 'Chậu hoa giả Ochid size M', '230000', 'Chậu hoa giả Ochid size M trông như thât', 5, 'D300-R200-C700 mm', 'chau-hoa-gia-ochid-93451j-768x511.jpg', 3, 28, '2023-03-11 07:43:43', ''),
(143, 'Gương bạc 68×158 880194I', '600000', 'Gương bạc 68×158 880194I phong cách hiện đại', 7, 'D1800-R900-C760 mm', 'GUONG-WALL-MIRROR-SILVER-68X158-880194I.jpg', 4, 29, '2023-03-11 07:46:01', ''),
(147, 'Chậu hoa giả Ochid size M', '230000', 'Chậu hoa giả Ochid size M trông như thât', 2, 'D300-R200-C700 mm', 'chau-hoa-gia-ochid-93451j-768x511.jpg', 3, 28, '2023-03-11 07:46:10', ''),
(148, 'Tranh Landscape 80×120 158913C', '4000000', 'Tranh Landscape 80×120 158913C sơn dầu nghệ thuật', 2, 'D1230 - R40 - C830 mm', 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 3, 33, '2023-03-11 07:53:11', ''),
(151, 'Tranh Landscape 80×120 158913C', '4000000', 'Tranh Landscape 80×120 158913C sơn dầu nghệ thuật', 3, 'D1230 - R40 - C830 mm', 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 3, 33, '2023-03-11 07:53:24', ''),
(152, 'Tranh Landscape 80×120 158913C', '4000000', 'Tranh Landscape 80×120 158913C sơn dầu nghệ thuật', 3, 'D1230 - R40 - C830 mm', 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 3, 33, '2023-03-11 07:53:26', ''),
(155, 'Tranh Landscape 80×120 158913C', '4000000', 'Tranh Landscape 80×120 158913C sơn dầu nghệ thuật', 0, 'D1230 - R40 - C830 mm', 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 3, 33, '2023-03-11 07:53:34', ''),
(159, 'Bàn ăn hiện đại', '8930000', 'Sofa 3 chỗ từ bộa sưu tập Osaka mang nét hiện đại và thơ mộng của Nhật Bản, tạo nên một không gian sống độc đáo đầy sang trọng. Sản phẩm có phần chân bằng inox màu gold chắc chắn, phần nệm được bọc vải và có thể tháo rời được. Sofa 3 chỗ Osaka mẫu 1 vải 29 không chỉ mang đến thiết kế tinh tế, sang trọng mà còn cho người ngồi cảm giác thoải mái, dễ chịu.', 1, 'D1800-R900-C760 mm', 'phong-an-shadow-kim-loai-go-6-768x512.jpg', 4, 16, '2023-04-17 03:59:21', '2023-05-03 04:17:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `room_id`, `created_at`, `updated_at`) VALUES
(11, 'Sofa', 2, '2023-01-31 03:31:47', '2023-04-24 19:06:22'),
(14, 'Bàn', 2, '2023-02-09 01:22:12', ''),
(15, 'Tủ tivi', 2, '2023-02-09 01:24:10', ''),
(16, 'Bàn ăn', 3, '2023-02-09 01:25:00', ''),
(17, 'Ghế ăn', 3, '2023-02-09 01:25:07', ''),
(18, 'Tủ bếp', 6, '2023-02-09 01:25:33', '2023-02-09 01:34:57'),
(19, 'Thiết bị bếp', 6, '2023-02-09 01:37:45', ''),
(22, 'Giường ngủ', 4, '2023-02-09 01:42:11', ''),
(23, 'Tủ quần áo', 4, '2023-02-09 01:42:20', ''),
(24, 'Nệm', 4, '2023-02-09 01:42:26', ''),
(25, 'Bàn làm việc', 5, '2023-02-09 01:42:55', ''),
(26, 'ghế làm việc', 5, '2023-02-09 01:43:04', ''),
(27, 'Kệ sách', 5, '2023-02-09 01:43:13', ''),
(28, 'Hoa và cây', 9, '2023-02-09 01:48:07', ''),
(29, 'Gương', 9, '2023-02-09 01:48:12', ''),
(33, 'Tranh', 9, '2023-03-11 06:59:20', ''),
(43, 'a', 5, '2023-05-02 16:21:10', '2023-05-02 16:21:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image_desc`
--

CREATE TABLE `product_image_desc` (
  `image_id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_image_desc`
--

INSERT INTO `product_image_desc` (`image_id`, `image_url`, `product_id`, `created_at`, `updated_at`) VALUES
(64, '102437-sofa-penny-3-cho-dacognac-1.jpg', 24, '2023-02-09 02:08:29', ''),
(65, '102437-sofa-penny-3-cho-dacognac-4-768x511.jpg', 24, '2023-02-09 02:08:29', ''),
(66, '102437-sofa-penny-3-cho-dacognac-5-768x511.jpg', 24, '2023-02-09 02:08:29', ''),
(67, '102437-sofa-penny-3-cho-dacognac-6-768x511.jpg', 24, '2023-02-09 02:08:29', ''),
(68, 'phong-khach-sofa-maxine-1-768x511.jpg', 25, '2023-02-09 02:11:26', ''),
(69, 'phong-khach-sofa-maxine-3.jpg', 25, '2023-02-09 02:11:26', ''),
(70, 'sofa-maxine-3-cho-da-english-mau-nau-co-dien-87472-768x511.jpg', 25, '2023-02-09 02:11:26', ''),
(71, '1000-san-pham-nha-xinh_16-2.jpg', 26, '2023-02-09 02:20:23', ''),
(72, '1000-san-pham-nha-xinh_16-768x511.jpg', 26, '2023-02-09 02:20:23', ''),
(73, 'phong-khach-maxine5-768x511.jpg', 26, '2023-02-09 02:20:23', ''),
(74, '102413-ban-nuoc-elegnace-1m2-mau-den-2-768x495.jpg', 27, '2023-02-09 02:29:42', ''),
(75, 'sofa-ban-nuoc-phong-khach-elegance5.jpg', 27, '2023-02-09 02:29:42', ''),
(82, '1000-san-pham-nha-xinh_16-2.jpg', 31, '2023-02-09 02:44:11', ''),
(83, '1000-san-pham-nha-xinh_16-768x511.jpg', 31, '2023-02-09 02:44:11', ''),
(84, 'phong-khach-maxine5-768x511.jpg', 31, '2023-02-09 02:44:11', ''),
(109, '102423-tu-tv-elegance-mau-tu-nhien-1-768x511.jpg', 43, '2023-03-10 09:57:43', ''),
(110, 'Elegance-768x495.jpg', 43, '2023-03-10 09:57:43', ''),
(111, 'Tu-tivi-Elegance-mau-nau-768x495.jpg', 43, '2023-03-10 09:57:43', ''),
(121, '500-tu-tv-iris-n.jpg', 47, '2023-03-10 10:00:05', ''),
(122, '1000-tu-tv-iris-768x511.jpg', 47, '2023-03-10 10:00:05', ''),
(131, 'Tu-Ly-Universal-P151P9CP201-1-1.jpg', 52, '2023-03-10 10:02:43', ''),
(132, 'Tu-Ly-Universal-P151P9CP201-2-768x495.jpg', 52, '2023-03-10 10:02:43', ''),
(149, 'ban-an-peak-hien-dai-van-may-ceramic-22.jpg', 60, '2023-03-10 10:06:21', ''),
(150, 'ban-an-peak-van-may-hien-dai-ceramic-2-768x511.jpg', 60, '2023-03-10 10:06:21', ''),
(151, 'ban-an-peak-van-may-hien-dai-ceramic-768x511.jpg', 60, '2023-03-10 10:06:21', ''),
(185, '99100-ban-an-maxine-1m8-1-768x511.jpg', 64, '2023-03-10 10:10:21', ''),
(186, '99100-ban-an-maxine-1m8-2-768x511.jpg', 64, '2023-03-10 10:10:21', ''),
(187, '99100-ban-an-maxine-1m8-3.jpg', 64, '2023-03-10 10:10:21', ''),
(188, 'ban-an-maxine-768x511.jpg', 64, '2023-03-10 10:10:21', ''),
(209, 'Ghe-An-Rusty-80981K-3105592-1.jpg', 70, '2023-03-10 10:13:22', ''),
(210, 'Ghe-An-Rusty-80981K-3105592-2.jpg', 70, '2023-03-10 10:13:22', ''),
(211, 'Ghe-An-Rusty-80981K-3105592-3-768x454.jpg', 70, '2023-03-10 10:13:22', ''),
(212, 'Ghe-An-Rusty-80981K-3105592-768x454.jpg', 70, '2023-03-10 10:13:22', ''),
(233, 'GIUONG-MIAMI-1M8-VAI-DOLCE-094-3106032-1-768x543.jpg', 76, '2023-03-11 04:15:03', ''),
(234, 'giuong-miami-boc-vai-dolice-094-1-768x511.jpg', 76, '2023-03-11 04:15:03', ''),
(255, 'Tu-ao-Acrylic-1-768x511.jpg', 87, '2023-03-11 04:20:03', ''),
(256, 'Tu-ao-Acrylic-2.jpg', 87, '2023-03-11 04:20:03', ''),
(257, 'Tu-ao-Acrylic-768x511.jpg', 87, '2023-03-11 04:20:03', ''),
(276, 'nem-lo-xo-tui-senviet-1m4.jpg', 94, '2023-03-11 04:22:54', ''),
(277, 'nem-sen-viet-768x511.jpg', 94, '2023-03-11 04:22:54', ''),
(278, 'sen-viet-768x511.jpg', 94, '2023-03-11 04:22:54', ''),
(315, '1000-san-pham-nha-xinh_11-1-768x511.jpg', 105, '2023-03-11 04:29:00', ''),
(316, '1000-san-pham-nha-xinh_11-2-768x511.jpg', 105, '2023-03-11 04:29:00', ''),
(317, '1000-san-pham-nha-xinh_11-3-768x511.jpg', 105, '2023-03-11 04:29:00', ''),
(318, '1000-san-pham-nha-xinh_11-4-768x511.jpg', 105, '2023-03-11 04:29:00', ''),
(319, '1000-san-pham-nha-xinh_11-5-768x511.jpg', 105, '2023-03-11 04:29:00', ''),
(320, '86828_1000-768x511.jpg', 105, '2023-03-11 04:29:00', ''),
(333, '1000-san-pham-nha-xinh_11-1-768x511.jpg', 108, '2023-03-11 04:29:08', ''),
(334, '1000-san-pham-nha-xinh_11-2-768x511.jpg', 108, '2023-03-11 04:29:08', ''),
(335, '1000-san-pham-nha-xinh_11-3-768x511.jpg', 108, '2023-03-11 04:29:08', ''),
(336, '1000-san-pham-nha-xinh_11-4-768x511.jpg', 108, '2023-03-11 04:29:08', ''),
(337, '1000-san-pham-nha-xinh_11-5-768x511.jpg', 108, '2023-03-11 04:29:08', ''),
(338, '86828_1000-768x511.jpg', 108, '2023-03-11 04:29:08', ''),
(351, 'GHE-LAM-VIEC-LABORA-HIGH-BROWN-80724K-1-768x495.jpg', 112, '2023-03-11 06:35:45', ''),
(352, 'GHE-LAM-VIEC-LABORA-HIGH-BROWN-80724K-5-768x495.jpg', 112, '2023-03-11 06:35:45', ''),
(353, 'GHE-LAM-VIEC-LABORA-HIGH-BROWN-80724K-768x495.jpg', 112, '2023-03-11 06:35:45', ''),
(370, 'nha-xinh-ke-sach-chio-hinh_lifestyle.jpg', 119, '2023-03-11 06:38:03', ''),
(371, 'nha-xinh-ke-sach-cico.jpg', 119, '2023-03-11 06:38:03', ''),
(388, 'bo_khung_up_chen_dia_3_tang_54402225_l.jpg', 131, '2023-03-11 07:41:00', ''),
(402, 'chau-hoa-gia-ochid-93451j-13-768x511.jpg', 141, '2023-03-11 07:43:43', ''),
(403, 'chau-hoa-gia-ochid-93451j-768x511.jpg', 141, '2023-03-11 07:43:43', ''),
(406, 'GUONG-WALL-MIRROR-SILVER-68X158-880194I.jpg', 143, '2023-03-11 07:46:01', ''),
(407, 'GUONG-WALL-MIRROR-SILVER-68X158-880194I-2-768x495.jpg', 143, '2023-03-11 07:46:01', ''),
(414, 'chau-hoa-gia-ochid-93451j-13-768x511.jpg', 147, '2023-03-11 07:46:10', ''),
(415, 'chau-hoa-gia-ochid-93451j-768x511.jpg', 147, '2023-03-11 07:46:10', ''),
(419, 'Elegance-mau-tu-nhien-2-768x511.jpg', 148, '2023-03-11 07:53:11', ''),
(420, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-1-768x511.jpg', 148, '2023-03-11 07:53:11', ''),
(421, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 148, '2023-03-11 07:53:11', ''),
(428, 'Elegance-mau-tu-nhien-2-768x511.jpg', 151, '2023-03-11 07:53:24', ''),
(429, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-1-768x511.jpg', 151, '2023-03-11 07:53:24', ''),
(430, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 151, '2023-03-11 07:53:24', ''),
(431, 'Elegance-mau-tu-nhien-2-768x511.jpg', 152, '2023-03-11 07:53:26', ''),
(432, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-1-768x511.jpg', 152, '2023-03-11 07:53:26', ''),
(433, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 152, '2023-03-11 07:53:26', ''),
(440, 'Elegance-mau-tu-nhien-2-768x511.jpg', 155, '2023-03-11 07:53:34', ''),
(441, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-1-768x511.jpg', 155, '2023-03-11 07:53:34', ''),
(442, 'TRANH-FRAME-LANDSCAPE-80X120-158913C-768x511.jpg', 155, '2023-03-11 07:53:34', ''),
(443, 'Phong-an-cabo-01-379x400.jpg', 23, '', '2023-04-11 16:06:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `created_at`, `updated_at`) VALUES
(2, 'Phòng Khách', '2023-01-31 05:02:14', '2023-01-31 10:12:32'),
(3, 'Phòng ăn', '2023-02-01 08:41:11', ''),
(4, 'Phòng ngủ', '2023-02-01 08:41:18', ''),
(5, 'Phòng làm việc', '2023-02-01 08:41:29', ''),
(6, 'Bếp', '2023-02-01 08:45:55', ''),
(9, 'Hàng trang trí', '2023-02-09 01:47:12', '2023-04-24 19:08:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`detail_order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Chỉ mục cho bảng `order_p`
--
ALTER TABLE `order_p`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `product_image_desc`
--
ALTER TABLE `product_image_desc`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `detail_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `order_p`
--
ALTER TABLE `order_p`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `product_image_desc`
--
ALTER TABLE `product_image_desc`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_p` (`order_id`),
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `order_p`
--
ALTER TABLE `order_p`
  ADD CONSTRAINT `order_p_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`);

--
-- Các ràng buộc cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Các ràng buộc cho bảng `product_image_desc`
--
ALTER TABLE `product_image_desc`
  ADD CONSTRAINT `product_image_desc_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
