-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 04:20 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_webdidong`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `AdminAvatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `full_name`, `password`, `date_of_birth`, `AdminAvatar`) VALUES
('ID_AD01', 'admin', 'Võ Trung', '202cb962ac59075b964b07152d234b70', '1999-09-14 10:55:00', '/uploads/22-05-2020/iphone-11-(10).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan_san_pham`
--

CREATE TABLE `binh_luan_san_pham` (
  `id_binh_luan` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `ma_kh` varchar(255) NOT NULL,
  `noi_dung_binh_luan` text NOT NULL,
  `thoi_gian_binh_luan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id_chi_tiet` int(255) NOT NULL,
  `id_don_hang` int(255) NOT NULL,
  `id_san_pham` int(255) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `tong_tien` float NOT NULL,
  `thoi_gian_dat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id_chi_tiet`, `id_don_hang`, `id_san_pham`, `so_luong`, `tong_tien`, `thoi_gian_dat`) VALUES
(98, 131, 33, 1, 7990000, '2020-07-04 15:44:12'),
(99, 132, 52, 1, 9490000, '2020-07-04 15:58:57'),
(100, 133, 33, 3, 7990000, '2020-07-04 19:31:52'),
(101, 134, 52, 1, 9490000, '2020-07-04 19:50:05'),
(102, 135, 32, 1, 24000000, '2020-07-06 12:11:24'),
(103, 135, 54, 2, 27490000, '2020-07-06 12:11:24'),
(315, 175, 32, 4, 96000000, '2022-07-17 08:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_slider`
--

CREATE TABLE `chi_tiet_slider` (
  `id_chi_tiet_slider` int(11) NOT NULL,
  `id_slider` int(11) NOT NULL,
  `id_san_pham` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chi_tiet_slider`
--

INSERT INTO `chi_tiet_slider` (`id_chi_tiet_slider`, `id_slider`, `id_san_pham`) VALUES
(52, 47, 33),
(53, 48, 32),
(54, 48, 33),
(55, 48, 34),
(56, 48, 36),
(57, 48, 38);

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc_mat_hang`
--

CREATE TABLE `danh_muc_mat_hang` (
  `id_mat_hang` varchar(255) NOT NULL,
  `ten_mat_hang` varchar(255) NOT NULL,
  `link_danh_muc` varchar(255) NOT NULL,
  `icon` text NOT NULL,
  `stt` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `danh_muc_mat_hang`
--

INSERT INTO `danh_muc_mat_hang` (`id_mat_hang`, `ten_mat_hang`, `link_danh_muc`, `icon`, `stt`) VALUES
('LAPTOP', 'Laptop', 'view_all_product.php?all_laptop', 'laptop', 1),
('PHONE', 'Điện thoại', 'view_all_product.php?all_phone', 'phone_iphone', 3),
('PHUKIEN', 'Phụ kiện', 'view_all_product.php?all_accessory', 'headset', 2),
('TABLET', 'Máy tính bản', 'view_all_product.php?all_tablet', 'tablet', 4);

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc_thuong_hieu`
--

CREATE TABLE `danh_muc_thuong_hieu` (
  `id_thuong_hieu` varchar(255) NOT NULL,
  `ten_thuong_hieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `danh_muc_thuong_hieu`
--

INSERT INTO `danh_muc_thuong_hieu` (`id_thuong_hieu`, `ten_thuong_hieu`) VALUES
('APP', 'Apple'),
('ASU', 'Asus'),
('CN', 'Trung Quốc'),
('DEL', 'Dell'),
('HP', 'HP'),
('HUA', 'Huawei'),
('LNV', 'Lenovo'),
('NKA', 'Nokia'),
('OPP', 'Oppo'),
('REM', 'Realme'),
('SSE', 'Samsung'),
('VIO', 'Vivo');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id_don_hang` int(255) NOT NULL,
  `ma_kh` varchar(255) NOT NULL,
  `tong_tien` varchar(255) NOT NULL,
  `ghi_chu` text NOT NULL,
  `thoi_gian_dat` datetime NOT NULL,
  `trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id_don_hang`, `ma_kh`, `tong_tien`, `ghi_chu`, `thoi_gian_dat`, `trang_thai`) VALUES
(131, 'KH50c', '7990000', '', '2020-07-04 15:44:12', 'Xác nhận'),
(132, 'KH995', '9490000', '', '2020-07-04 15:58:57', 'Xác nhận'),
(133, 'KH50c', '23970000', '', '2020-07-04 19:31:51', 'Đang chờ'),
(134, 'KH995', '9490000', '', '2020-07-04 19:50:05', 'Đang chờ'),
(135, 'KHde7', '78980000', '', '2020-07-06 12:11:24', 'Đang chờ'),
(175, 'KH279', '96000000', 'aa', '2022-07-17 08:50:23', 'Đang chờ');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_gio_hang` int(11) NOT NULL,
  `san_pham_so_luong` int(11) NOT NULL,
  `id_san_pham` int(255) NOT NULL,
  `ma_kh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_pham`
--

CREATE TABLE `hinh_anh_san_pham` (
  `id_anh_mo_ta` int(11) NOT NULL,
  `link_anh_mo_ta` varchar(255) NOT NULL,
  `id_san_pham` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hinh_anh_san_pham`
--

INSERT INTO `hinh_anh_san_pham` (`id_anh_mo_ta`, `link_anh_mo_ta`, `id_san_pham`) VALUES
(31, '/uploads/05-04-2021/samsung-galaxy-tab-a8-plus-p205-black-400x400.jpg', 32),
(32, '/uploads/05-04-2021/samsung-galaxy-tab-a8-plus-p205-black-400x460.png', 32),
(33, '/uploads/05-04-2021/samsung-galaxy-tab-a-101-t515-2019-gold-400x400.jpg', 32);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_kh` varchar(255) NOT NULL,
  `ho_lot` varchar(255) NOT NULL,
  `ten_kh` varchar(255) NOT NULL,
  `sdt_kh` varchar(255) NOT NULL,
  `email_kh` varchar(255) NOT NULL,
  `dia_chi_kh` varchar(255) NOT NULL,
  `diem_kh` int(11) DEFAULT NULL,
  `ngay_cap_nhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`ma_kh`, `ho_lot`, `ten_kh`, `sdt_kh`, `email_kh`, `dia_chi_kh`, `diem_kh`, `ngay_cap_nhat`) VALUES
('KH041', 'Nguyễn Văn', 'A', '0774787677', 'user2@gmail.com', 'Vĩnh Long', 0, '2021-04-11 06:43:55'),
('KH1aa', 'Võ', 'Trung', '0123456789', 'votrung@gmail.com', 'Vĩnh Long', 0, '2021-04-10 18:18:39'),
('KH279', 'Vo', 'Trung', '0774787675', 'vctrung1491x9x@gmail.com', 'vinh long', 0, '2022-07-17 08:48:01'),
('KH389', 'Quách', 'Tĩnh', '0123654724', 'quachtinh@gmail.com', 'Shanghai China', 0, '2020-07-06 12:55:39'),
('KH50c', 'Võ Chí', 'Trung', '0774787675', '17004211@student.vlute.edu.vn', 'Song Phú Tam Bình Vĩnh Long', 1000, '2020-07-03 15:46:34'),
('KH52a', 'Tô Tài', 'Năng', '01452365214', 'nangtotai@gmail.com', 'Mang Thít Vĩnh Long', 300, '0000-00-00 00:00:00'),
('KH56c', 'Nguyễn Thị', 'Lan', '7747897422', 'lannguyen@gmail.com', 'Sóc sờ bay Sóc Trăng', 0, '2020-06-10 00:00:00'),
('KH5b2', 'Trần Thị', 'Cởi', '01478523698', 'coitra345@gmail.com', 'Tam Bình Vĩnh Long', 0, '0000-00-00 00:00:00'),
('KH86f', 'Thị ', 'Lam', '0125463987', 'lamthi123@gmail.com', 'Nha Trang Khánh Hoà', 0, '2020-06-30 07:24:09'),
('KH995', 'Lê Thị', 'Na', '1236547894', 'nale123@yahoo.com', 'Cây Bàng Trà Ôn', 7500, '2020-07-04 19:48:25'),
('KHa0b', 'Nguyễn Thị', 'Bé Hai', '0774789654', 'haibe@gmail.com', 'Hà Tiên', 0, '2020-06-10 00:00:00'),
('KHad7', 'Tô Tài', ' Trung', '1452365214', 'trungcodon@gmail.com', 'Cái Bè Tiền Giang', 0, '0000-00-00 00:00:00'),
('KHde7', 'Trần Văn', 'Dần', '1236547894', 'tradanartist@gmail.com', 'Califonia Beyond In The World', 5000, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `phien_ban_san_pham`
--

CREATE TABLE `phien_ban_san_pham` (
  `id_phien_ban` int(11) NOT NULL,
  `ten_phien_ban` varchar(255) NOT NULL,
  `phien_ban_gia_ban` float NOT NULL,
  `id_san_pham` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` int(255) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `id_mat_hang` varchar(255) NOT NULL,
  `gia_ban` float NOT NULL,
  `giam_gia` float NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `id_thuong_hieu` varchar(255) NOT NULL,
  `pay` int(11) NOT NULL,
  `ngay_cap_nhat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `id_mat_hang`, `gia_ban`, `giam_gia`, `hinh_anh`, `noi_dung`, `id_thuong_hieu`, `pay`, `ngay_cap_nhat`) VALUES
(32, 'IPhone 11 Red 128gb', 'PHONE', 24000000, 500000, '/uploads/27-06-2020/iphone-11-(10).jpg', 'Tặng tiền cước 500.000đ (đã trừ vào giá)', 'APP', 2500, '2020-06-27 00:00:00'),
(33, 'Sam Sung Galaxy A30s', 'PHONE', 7990000, 50000, '/uploads/27-06-2020/samsung-galaxy-a30s-(14).jpg', 'Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)', 'SSE', 1200, '2020-06-27 00:00:00'),
(34, 'Oppo A31 2020 128GB Đen', 'PHONE', 7790000, 50000, '/uploads/27-06-2020/oppo-a31-2020-128gb-den-600x600-1-400x400.jpg', 'Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)', 'OPP', 0, '2020-06-27 00:00:00'),
(36, 'Huawei MediaPad M5 Lite Gray', 'PHONE', 8490000, 510000, '/uploads/27-06-2020/huawei-mediapad-m5-lite-gray-400x400(1).jpg', 'Tặng tiền cước 400.000đ (áp dụng đặt và nhận hàng từ 16 - 30/6) (đã trừ vào giá)', 'HUA', 0, '2020-06-27 00:00:00'),
(38, 'Asus vivo X409FA i3', 'LAPTOP', 17000000, 500000, '/uploads/29-06-2020/asus-vivobook-x409fa-i3-ek468t-221618-1-600x600(1).jpg', 'Mua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 'ASU', 0, '2020-06-29 07:40:46'),
(39, 'Laptop Asus VivoBook X441MA N5000/4GB/1TB/Win10', 'LAPTOP', 7190000, 310000, '/uploads/29-06-2020/asus-x441ma-ga024t-600x600(1).jpg', 'Mua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 'ASU', 1100, '2020-06-29 10:54:00'),
(40, 'Nokia 53 Đen', 'PHONE', 5190000, 310000, '/uploads/29-06-2020/nokia-53-den-400x460-400x460.png', 'Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác) ', 'NKA', 0, '2020-06-29 10:56:09'),
(41, 'Điện thoại Samsung Galaxy S10 Lite', 'PHONE', 13490000, 500000, '/uploads/04-07-2020/samsung-galaxy-s10-lite-blue-chi-tiet-400x460.png', 'Tặng suất mua đồng hồ Samsung Active 2 giảm đến 3.000.000đ (Đồng hồ mua kèm không áp dụng KM khác).\r\n', 'SSE', 1000, '2020-06-29 10:58:09'),
(44, 'USB Wifi 150Mbps Totolink N150USM Trắng', 'PHUKIEN', 140000, 0, '/uploads/01-07-2020/usb-wifi-150-mbps-totolink-n150usm-trang-1-1-600x600(1).jpg', '', 'CN', 0, '2020-07-01 15:02:06'),
(45, 'USB 3.1 32 GB Apacer AH357', 'PHUKIEN', 210000, 90000, '/uploads/01-07-2020/usb-31-32gb-apacer-ah357-av-600x600.jpg', 'Giảm 90.000đ (đã trừ vào giá)', 'CN', 0, '2020-07-01 15:28:05'),
(46, 'Ốp lưng Galaxy S20 Ultra Nhựa dẻo Slim TPU JM Đen', 'PHUKIEN', 35000, 35000, '/uploads/01-07-2020/op-lung-galaxy-s20-ultra-nhua-deo-slim-tpu-jm-den-1-1-600x600(1).jpg', '', 'CN', 0, '2020-07-01 15:38:50'),
(47, 'Pin sạc dự phòng Polymer 10.000 mAh Type C eSaver PJ JP106S', 'PHUKIEN', 455000, 195000, '/uploads/01-07-2020/polymer-10000-mah-type-c-esaver-pj-jp106s-avatar-1-600x600.jpg', 'Giảm 195,000đ (đã trừ vào giá)', 'CN', 0, '2020-07-01 15:56:11'),
(50, 'Cáp Micro 2 m Xmobile LTMP-2006 Xanh Navy', 'PHUKIEN', 60000, 40000, '/uploads/01-07-2020/cap-micro-2m-xmobile-ltmp-2006-xanh-navy-1-fix1-600x600.jpg', 'Giảm 40,000đ (đã trừ vào giá)', 'CN', 0, '2020-07-01 15:59:49'),
(51, 'Chuột không dây Zadez M356', 'PHUKIEN', 135000, 15000, '/uploads/01-07-2020/chuot-khong-day-zadez-m356-den-ava-600x600.jpg', 'Giảm 15,000đ (đã trừ vào giá)', 'CN', 0, '2020-07-01 16:02:26'),
(52, 'Máy tính bảng iPad 10.2 inch Wifi 32GB (2019)', 'TABLET', 9490000, 500000, '/uploads/01-07-2020/ipad-10-2-inch-wifi-32gb-2019-gold-400x460(1).png', 'Giảm ngay 500.000đ (đã trừ vào giá) \r\nMua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ\r\n', 'APP', 1113, '2020-07-01 19:48:19'),
(53, 'Máy tính bảng Samsung Galaxy Tab with S Pen (P205)', 'TABLET', 6990000, 510000, '/uploads/01-07-2020/samsung-galaxy-tab-a8-plus-p205-black-400x460.png', 'Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)', 'SSE', 0, '2020-07-01 19:54:17'),
(54, 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 'TABLET', 27490000, 500000, '/uploads/01-07-2020/ipad-pro-12-9-inch-wifi-128gb-2020-xam-400x460-1-400x460.png', 'Giảm ngay 500.000đ (đã trừ vào giá)', 'APP', 1890, '2020-07-01 19:56:12'),
(55, 'Máy tính bảng Huawei Mediapad T5 10.1 inch (3GB/32GB)', 'TABLET', 4990000, 510000, '/uploads/01-07-2020/huawei-mediapad-m5-lite-gray-400x400.jpg', 'Mua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 'HUA', 0, '2020-07-01 19:57:39'),
(56, 'Máy tính bảng Samsung Galaxy Tab S6', 'TABLET', 18490000, 510000, '/uploads/04-07-2020/samsung-galaxy-tab-s6-400x400.jpg', 'Phiếu mua hàng Samsung 2.1 triệu (áp dụng đặt và nhận hàng từ 1 - 19/7)\r\n', 'SSE', 1002, '2020-07-01 19:59:17'),
(57, 'Máy tính bảng Lenovo Tab E10 TB-X104L Đen', 'TABLET', 3690000, 300000, '/uploads/01-07-2020/lenovo-tab-e10-tb-x104l-den-1-400x400(1).jpg', 'Giảm ngay 300.000đ (đã trừ vào giá)\r\n', 'LNV', 0, '2020-07-01 20:03:40'),
(58, 'Laptop HP 15s fq0004TU N5000/4GB/512GB/Win10 (1A0D5PA)', 'LAPTOP', 8890000, 110000, '/uploads/04-07-2020/hp-15s-fq0004tu-n5000-1a0d5pa-224010-1-600x600.jpg', 'Túi chống sốc Laptop 15.6 inch eValu\r\nMua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 'HP', 0, '2020-07-04 07:33:06'),
(59, 'Laptop Lenovo IdeaPad Slim 3 14IIL05 i7 1065G7/8GB/512GB/Win10 (81WD0040VN)', 'LAPTOP', 18090000, 700000, '/uploads/04-07-2020/lenovo-ideapad-3-14iil05-i7-81wd0040vn-222638-1-600x600.jpg', 'Giảm ngay 700.000đ (đã trừ vào giá) *\r\nBalo Laptop Lenovo\r\nMua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 'LNV', 0, '2020-07-04 07:55:26'),
(60, 'Alienware M15 R1 Laptop Gaming Core i7 9750H 16GB SSD 512GB + 512GB 15.6 inch FHD GeForce RTX™ 2070 Windows 10', 'LAPTOP', 44900000, 510000, '/uploads/04-07-2020/new-alienware-15-2019-01(1).png', 'Chuột Logitech , Balo The Northfacre cao cấp. Cài đặt phần mềm. Vệ sinh máy định kỳ trong suốt thời gian sử dụng.\r\n', 'DEL', 0, '2020-07-04 08:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `ten_slider` varchar(255) NOT NULL,
  `ngay_them_slider` datetime NOT NULL,
  `trang_thai_slider` varchar(10) NOT NULL DEFAULT 'disable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `ten_slider`, `ngay_them_slider`, `trang_thai_slider`) VALUES
(47, 'slide texxt 7', '2021-03-29 22:50:18', 'disable'),
(48, 'slide texxt 2', '2021-03-29 23:04:50', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `ma_tk` int(255) NOT NULL,
  `tk_nguoi_dung` varchar(255) NOT NULL,
  `mk_nguoi_dung` varchar(255) NOT NULL,
  `ma_kh` varchar(255) NOT NULL,
  `ngay_tao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`ma_tk`, `tk_nguoi_dung`, `mk_nguoi_dung`, `ma_kh`, `ngay_tao`) VALUES
(4, 'user1', '202cb962ac59075b964b07152d234b70', 'KH50c', '0000-00-00 00:00:00'),
(5, 'naxinhgai124', '81dc9bdb52d04dc20036dbd8313ed055', 'KH995', '0000-00-00 00:00:00'),
(6, 'trandan3', '202cb962ac59075b964b07152d234b70', 'KHde7', '0000-00-00 00:00:00'),
(7, 'trancoi345', '202cb962ac59075b964b07152d234b70', 'KH5b2', '0000-00-00 00:00:00'),
(8, 'totainang567', '202cb962ac59075b964b07152d234b70', 'KH52a', '0000-00-00 00:00:00'),
(9, 'trungtailanh789', '202cb962ac59075b964b07152d234b70', 'KHad7', '0000-00-00 00:00:00'),
(10, 'haibe124', '202cb962ac59075b964b07152d234b70', 'KHa0b', '0000-00-00 00:00:00'),
(11, 'user2', '202cb962ac59075b964b07152d234b70', 'KH56c', '0000-00-00 00:00:00'),
(25, 'lam_thi123', '202cb962ac59075b964b07152d234b70', 'KH86f', '0000-00-00 00:00:00'),
(27, 'quachtinh123', '202cb962ac59075b964b07152d234b70', 'KH389', '2020-07-06 12:55:39'),
(28, 'user1', '202cb962ac59075b964b07152d234b70', 'KH1aa', '2021-04-10 18:18:39'),
(29, 'user2', '202cb962ac59075b964b07152d234b70', 'KH041', '2021-04-11 06:43:55'),
(30, 'abc', '202cb962ac59075b964b07152d234b70', 'KH279', '2022-07-17 08:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `thong_so_san_pham`
--

CREATE TABLE `thong_so_san_pham` (
  `id_thong_so` int(11) NOT NULL,
  `ten_thong_so` varchar(255) NOT NULL,
  `mo_ta_thong_so` varchar(255) NOT NULL,
  `id_san_pham` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thong_so_san_pham`
--

INSERT INTO `thong_so_san_pham` (`id_thong_so`, `ten_thong_so`, `mo_ta_thong_so`, `id_san_pham`) VALUES
(20, 'HDH', 'IOS 12', 32),
(21, ' Màn hình', 'IPS LCD, 6.1', 32),
(22, 'Camera sau', 'Chính 12 MP & Phụ 12 MP', 32),
(23, 'Camera trước', '12MP', 32),
(24, 'CPU', 'Apple A13 Bionic 6 nhân', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binh_luan_san_pham`
--
ALTER TABLE `binh_luan_san_pham`
  ADD PRIMARY KEY (`id_binh_luan`),
  ADD KEY `fk_makh` (`ma_kh`),
  ADD KEY `fk_sp` (`id_san_pham`);

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id_chi_tiet`),
  ADD KEY `fk_idsanpham` (`id_san_pham`),
  ADD KEY `fk_iddonhang` (`id_don_hang`);

--
-- Indexes for table `chi_tiet_slider`
--
ALTER TABLE `chi_tiet_slider`
  ADD PRIMARY KEY (`id_chi_tiet_slider`),
  ADD KEY `fk_id_san_pham_ct_slider` (`id_san_pham`),
  ADD KEY `fk_id_slide_der_ct_slider` (`id_slider`);

--
-- Indexes for table `danh_muc_mat_hang`
--
ALTER TABLE `danh_muc_mat_hang`
  ADD PRIMARY KEY (`id_mat_hang`);

--
-- Indexes for table `danh_muc_thuong_hieu`
--
ALTER TABLE `danh_muc_thuong_hieu`
  ADD PRIMARY KEY (`id_thuong_hieu`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id_don_hang`),
  ADD KEY `makh` (`ma_kh`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_gio_hang`),
  ADD KEY `pk_id_san_pham_gio_hang` (`id_san_pham`),
  ADD KEY `pk_ma_kh_gio_hang` (`ma_kh`);

--
-- Indexes for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD PRIMARY KEY (`id_anh_mo_ta`),
  ADD KEY `fk_id_san_pham_hinh_anh` (`id_san_pham`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_kh`);

--
-- Indexes for table `phien_ban_san_pham`
--
ALTER TABLE `phien_ban_san_pham`
  ADD PRIMARY KEY (`id_phien_ban`),
  ADD KEY `fk_id_san_pham_phien_ban` (`id_san_pham`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_san_pham`),
  ADD KEY `id_mat_hang` (`id_mat_hang`),
  ADD KEY `id_thuong_hieu` (`id_thuong_hieu`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`ma_tk`),
  ADD KEY `taikhoan_ibfk_1` (`ma_kh`);

--
-- Indexes for table `thong_so_san_pham`
--
ALTER TABLE `thong_so_san_pham`
  ADD PRIMARY KEY (`id_thong_so`),
  ADD KEY `fk_id_san_pham_chi_tiet` (`id_san_pham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luan_san_pham`
--
ALTER TABLE `binh_luan_san_pham`
  MODIFY `id_binh_luan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id_chi_tiet` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `chi_tiet_slider`
--
ALTER TABLE `chi_tiet_slider`
  MODIFY `id_chi_tiet_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id_don_hang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `ma_tk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan_san_pham`
--
ALTER TABLE `binh_luan_san_pham`
  ADD CONSTRAINT `fk_makh` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `fk_iddonhang` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id_don_hang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idsanpham` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_mat_hang`) REFERENCES `danh_muc_mat_hang` (`id_mat_hang`),
  ADD CONSTRAINT `san_pham_ibfk_2` FOREIGN KEY (`id_thuong_hieu`) REFERENCES `danh_muc_thuong_hieu` (`id_thuong_hieu`);

--
-- Constraints for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD CONSTRAINT `tai_khoan_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
