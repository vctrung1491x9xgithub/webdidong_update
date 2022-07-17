-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 11:41 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

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
('', 'vu', 'levu', '123', '2021-05-29 10:21:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan_san_pham`
--

CREATE TABLE `binh_luan_san_pham` (
  `id_binh_luan` int(11) NOT NULL,
  `id_san_pham` int(255) NOT NULL,
  `ma_kh` varchar(255) NOT NULL,
  `noi_dung_binh_luan` text NOT NULL,
  `thoi_gian_binh_luan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `binh_luan_san_pham`
--

INSERT INTO `binh_luan_san_pham` (`id_binh_luan`, `id_san_pham`, `ma_kh`, `noi_dung_binh_luan`, `thoi_gian_binh_luan`) VALUES
(1, 32, 'KH1aa', 'Tôi mua sp đã qua sử dụng (còn bảo hành10 tháng), nhưng máy rất tệ cụ thể: 1 camera quá xấu 2 màn hình cảm ứng chậm 3 lướt web thường cũng giật lag rất khó chịu. ', '2021-04-27 20:35:08'),
(8, 34, 'KH1aa', 'tot', '2021-05-06 10:44:56'),
(9, 122, 'KH7c1', 'tot\r\n', '2021-05-11 17:05:00');

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
(309, 170, 32, 1, 24000000, '2021-04-10 18:26:05'),
(310, 171, 36, 1, 8490000, '2021-04-10 18:27:22'),
(313, 174, 32, 3, 72000000, '2021-04-10 20:17:50'),
(314, 174, 33, 2, 15980000, '2021-04-10 20:17:50'),
(326, 184, 32, 1, 24000000, '2021-05-13 11:05:10'),
(327, 185, 38, 1, 17000000, '2021-05-13 11:05:17'),
(328, 186, 36, 1, 8490000, '2021-05-13 11:05:45'),
(329, 187, 32, 3, 72000000, '2021-05-13 11:28:02');

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
(71, 55, 32),
(72, 55, 33),
(73, 55, 34),
(74, 55, 36),
(75, 55, 38);

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc_mat_hang`
--

CREATE TABLE `danh_muc_mat_hang` (
  `id_mat_hang` varchar(255) NOT NULL,
  `ten_mat_hang` varchar(255) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `link_danh_muc` varchar(255) NOT NULL,
  `stt` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `danh_muc_mat_hang`
--

INSERT INTO `danh_muc_mat_hang` (`id_mat_hang`, `ten_mat_hang`, `icon`, `link_danh_muc`, `stt`) VALUES
('LAPTOP', 'Laptop', 'laptop_mac', 'view_all_product.php?all_laptop', 3),
('PC', 'PC', 'desktop_windows', 'view_all_product.php?all_pc', 4),
('PHONE', 'Điện thoại', 'smartphone', 'view_all_product.php?all_phone', 1),
('PHUKIEN', 'Phụ kiện', 'headset', 'view_all_product.php?all_phukien', 5),
('SOUND', 'Âm thanh', 'speaker_group', 'view_all_product.php?all_sound', 7),
('TABLET', 'Tablet', 'tablet', 'view_all_product.php?all_tablet', 2),
('WATCH', 'Đồng hồ', 'watch', 'view_all_product.php?all_watch', 6);

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
('VIN', 'VINPHAT'),
('VIO', 'Vivo'),
('XAM', 'Xiaomi');

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
(170, 'KH1aa', '24000000', '', '2021-04-10 18:26:05', 'Đang chờ'),
(171, 'KH1aa', '8490000', '', '2021-04-10 18:27:22', 'Đang chờ'),
(174, 'KH1aa', '87980000', 'giao hàng lúc 11h trưa các ngày trong tuần', '2021-04-10 20:17:50', 'Xác nhận'),
(184, 'KH7c1', '24000000', '', '2021-05-13 11:05:10', 'Xác nhận'),
(185, 'KH7c1', '17000000', '', '2021-05-13 11:05:17', 'Xác nhận'),
(186, 'KH7c1', '8490000', '', '2021-05-13 11:05:45', 'Đang chờ'),
(187, 'KH7c1', '72000000', '', '2021-05-13 11:28:02', 'Xác nhận');

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

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`id_gio_hang`, `san_pham_so_luong`, `id_san_pham`, `ma_kh`) VALUES
(78, 2, 120, 'KH1aa');

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
(33, '/uploads/05-04-2021/samsung-galaxy-tab-a-101-t515-2019-gold-400x400.jpg', 32),
(35, '/uploads/06-05-2021/iphone12(1).jpg', 120),
(37, '/uploads/10-05-2021/pcmota(1).jpg', 122),
(38, '/uploads/10-05-2021/Loa.png', 123),
(39, '/uploads/10-05-2021/dongho(1).jpg', 124),
(40, '/uploads/10-05-2021/dongho1(1).jpg', 125),
(41, '/uploads/10-05-2021/donghovip(1).jpg', 126),
(43, '/uploads/13-05-2021/donghothethao(1).jpg', 127),
(44, '/uploads/13-05-2021/dong-ho-the-thao-chong-nuoc.jpg', 127);

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
('KH1aa', 'Le', 'Vu', '0987654321', 'levu@gmail.com', 'tien giang', 0, '2021-04-10 18:18:39'),
('KH29e', 'van', 'vu', '1234567890', 'fpt.vu13544@gmail.com', 'tien giang', 0, '2021-05-13 10:35:36'),
('KH7b7', 'le van', 'vu', '0335670084', '', 'tien giang', 0, '2021-05-06 17:06:05'),
('KH7c1', 'vu', 'anh', '0123456789', 'fpt.vu13544@gmail.com', 'tien giang', 0, '2021-05-11 17:03:45'),
('KHaed', 'Phạm Hữu', 'Tiền', '0147822399', 'fpt.vu13544@gmail.com', 'tien giang', 0, '2021-04-27 22:40:00'),
('KHfec', 'le', 'van vu', '0335670084', 'fpt.vu13544@gmail.com', 'tien giang', 0, '2021-05-06 17:16:55');

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
  `gia_ban` float NOT NULL,
  `giam_gia` float NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `pay` int(11) NOT NULL,
  `ngay_cap_nhat` datetime NOT NULL,
  `id_mat_hang` varchar(255) NOT NULL,
  `id_thuong_hieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `gia_ban`, `giam_gia`, `hinh_anh`, `noi_dung`, `pay`, `ngay_cap_nhat`, `id_mat_hang`, `id_thuong_hieu`) VALUES
(32, 'IPhone 11 Red 128gb', 24000000, 500000, '/uploads/27-06-2020/iphone-11-(10).jpg', 'Tặng tiền cước 500.000đ (đã trừ vào giá)', 2500, '2020-06-27 00:00:00', 'PHONE', 'APP'),
(33, 'Sam Sung Galaxy A30s', 7990000, 50000, '/uploads/27-06-2020/samsung-galaxy-a30s-(14).jpg', 'Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)', 1200, '2020-06-27 00:00:00', 'PHONE', 'SSE'),
(34, 'Oppo A31 2020 128GB Đen', 7790000, 50000, '/uploads/27-06-2020/oppo-a31-2020-128gb-den-600x600-1-400x400.jpg', 'Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)', 0, '2020-06-27 00:00:00', 'PHONE', 'OPP'),
(36, 'Huawei MediaPad M5 Lite Gray', 8490000, 0, '/uploads/27-06-2020/huawei-mediapad-m5-lite-gray-400x400(1).jpg', 'Tặng tiền cước 400.000đ (áp dụng đặt và nhận hàng từ 16 - 30/6) (đã trừ vào giá)', 0, '2020-06-27 00:00:00', 'PHONE', 'HUA'),
(38, 'Asus vivo X409FA i3', 17000000, 500000, '/uploads/29-06-2020/asus-vivobook-x409fa-i3-ek468t-221618-1-600x600(1).jpg', 'Mua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 0, '2020-06-29 07:40:46', 'LAPTOP', 'ASU'),
(39, 'Laptop Asus VivoBook X441MA N5000/4GB/1TB/Win10', 7190000, 310000, '/uploads/29-06-2020/asus-x441ma-ga024t-600x600(1).jpg', 'Mua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ', 1100, '2020-06-29 10:54:00', 'LAPTOP', 'ASU'),
(44, 'USB Wifi 150Mbps Totolink N150USM Trắng', 140000, 0, '/uploads/01-07-2020/usb-wifi-150-mbps-totolink-n150usm-trang-1-1-600x600(1).jpg', '', 0, '2020-07-01 15:02:06', 'PHUKIEN', 'CN'),
(45, 'USB 3.1 32 GB Apacer AH357', 210000, 90000, '/uploads/01-07-2020/usb-31-32gb-apacer-ah357-av-600x600.jpg', 'Giảm 90.000đ (đã trừ vào giá)', 0, '2020-07-01 15:28:05', 'PHUKIEN', 'CN'),
(46, 'Ốp lưng Galaxy S20 Ultra Nhựa dẻo Slim TPU JM Đen', 35000, 35000, '/uploads/01-07-2020/op-lung-galaxy-s20-ultra-nhua-deo-slim-tpu-jm-den-1-1-600x600(1).jpg', '', 0, '2020-07-01 15:38:50', 'PHUKIEN', 'CN'),
(47, 'Pin sạc dự phòng Polymer 10.000 mAh Type C eSaver PJ JP106S', 455000, 195000, '/uploads/01-07-2020/polymer-10000-mah-type-c-esaver-pj-jp106s-avatar-1-600x600.jpg', 'Giảm 195,000đ (đã trừ vào giá)', 0, '2020-07-01 15:56:11', 'PHUKIEN', 'CN'),
(50, 'Cáp Micro 2 m Xmobile LTMP-2006 Xanh Navy', 60000, 40000, '/uploads/01-07-2020/cap-micro-2m-xmobile-ltmp-2006-xanh-navy-1-fix1-600x600.jpg', 'Giảm 40,000đ (đã trừ vào giá)', 0, '2020-07-01 15:59:49', 'PHUKIEN', 'CN'),
(51, 'Chuột không dây Zadez M356', 135000, 15000, '/uploads/01-07-2020/chuot-khong-day-zadez-m356-den-ava-600x600.jpg', 'Giảm 15,000đ (đã trừ vào giá)', 0, '2020-07-01 16:02:26', 'PHUKIEN', 'CN'),
(52, 'Máy tính bảng iPad 10.2 inch Wifi 32GB (2019)', 9490000, 500000, '/uploads/01-07-2020/ipad-10-2-inch-wifi-32gb-2019-gold-400x460(1).png', 'Giảm ngay 500.000đ (đã trừ vào giá) \r\nMua kèm Microsoft 365 Personal ưu đãi giảm 600.000đ\r\n', 1113, '2020-07-01 19:48:19', 'TABLET', 'APP'),
(54, 'Máy tính bảng iPad Pro 12.9 inch Wifi 128GB (2020)', 27490000, 500000, '/uploads/01-07-2020/ipad-pro-12-9-inch-wifi-128gb-2020-xam-400x460-1-400x460.png', 'Giảm ngay 500.000đ (đã trừ vào giá)', 1890, '2020-07-01 19:56:12', 'TABLET', 'APP'),
(106, 'ddasda', 13, 12, '/uploads/02-04-2021/asus-vivobook-x409fa-i3-ek468t-221618-1-600x600.jpg', '', 0, '2021-04-02 08:14:00', 'LAPTOP', 'SSE'),
(107, 'sdaasd', 212, 123, '/uploads/02-04-2021/new-alienware-15-2019-01.png', '', 0, '2021-04-02 08:23:58', 'LAPTOP', 'ASU'),
(115, 'ddasdac', 212, 123, '/uploads/02-04-2021/xiaomi-redmi-note-9s-(2).jpg', '', 0, '2021-04-02 09:14:53', 'PHUKIEN', 'CN'),
(120, 'iphone 12 ', 25000000, 100, '/uploads/06-05-2021/iphone12.jpg', 'tốt', 0, '2021-05-06 11:26:23', 'PHONE', 'APP'),
(122, 'Pc Gaming', 50000000, 5000, '/uploads/10-05-2021/pc-1(1).png', 'RAM 100G', 0, '2021-05-10 16:15:04', 'PC', 'ASU'),
(123, 'Loa Bluetooth 8.0', 1000000, 200, '/uploads/10-05-2021/loa1.jpg', 'Loa nghe bao phê\r\nĐể xa tầm tay trẻ em', 0, '2021-05-10 16:22:44', 'SOUND', 'CN'),
(124, 'Đồng hồ xinh', 100000000, 500000, '/uploads/10-05-2021/dongho.jpg', 'đồng hồ đẹp', 0, '2021-05-10 17:16:04', 'WATCH', 'APP'),
(125, 'Đồng hồ apple ', 25000000, 500000, '/uploads/10-05-2021/dongho1.jpg', 'DEP', 0, '2021-05-10 17:52:46', 'WATCH', 'APP'),
(126, 'Đồng hồ thụy sĩ', 25000000, 100, '/uploads/10-05-2021/donghovip.jpg', 'đồng hồ vip', 0, '2021-05-10 18:00:24', 'WATCH', 'CN'),
(127, 'Đồng hồ thể thao', 1000000, 300000, '/uploads/13-05-2021/donghothethao.jpg', 'Đồng hồ chống nước, xài vẫn vô nước nhe anh em', 0, '2021-05-13 09:50:58', 'WATCH', 'VIN');

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
(55, 'San pham hot hot hot thang 5', '2021-05-10 16:53:00', 'enable');

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
(28, 'user1', '202cb962ac59075b964b07152d234b70', 'KH1aa', '2021-04-10 18:18:39'),
(30, 'user3', '202cb962ac59075b964b07152d234b70', 'KHaed', '2021-04-27 22:40:00'),
(32, 'user5', '202cb962ac59075b964b07152d234b70', 'KHfec', '2021-05-06 17:16:55'),
(33, 'vuanh', '202cb962ac59075b964b07152d234b70', 'KH7c1', '2021-05-11 17:03:45'),
(34, 'vanvu', '202cb962ac59075b964b07152d234b70', 'KH29e', '2021-05-13 10:35:36');

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
(24, 'CPU', 'Apple A13 Bionic 6 nhân', 32),
(26, 'HĐH', 'WINDOWNS 10', 122),
(27, 'HĐH', 'IOS', 125),
(28, 'HĐH', 'IOS', 126);

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
  ADD KEY `fk_ma_kh_blsp` (`ma_kh`),
  ADD KEY `fk_id_san_pham_blsp` (`id_san_pham`);

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
  MODIFY `id_binh_luan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id_chi_tiet` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `chi_tiet_slider`
--
ALTER TABLE `chi_tiet_slider`
  MODIFY `id_chi_tiet_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id_don_hang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  MODIFY `id_anh_mo_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `phien_ban_san_pham`
--
ALTER TABLE `phien_ban_san_pham`
  MODIFY `id_phien_ban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `ma_tk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `thong_so_san_pham`
--
ALTER TABLE `thong_so_san_pham`
  MODIFY `id_thong_so` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan_san_pham`
--
ALTER TABLE `binh_luan_san_pham`
  ADD CONSTRAINT `fk_id_san_pham_blsp` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ma_kh_blsp` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`);

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `fk_iddonhang` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id_don_hang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idsanpham` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`);

--
-- Constraints for table `chi_tiet_slider`
--
ALTER TABLE `chi_tiet_slider`
  ADD CONSTRAINT `fk_id_san_pham_ct_slider` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_slide_der_ct_slider` FOREIGN KEY (`id_slider`) REFERENCES `slider` (`id_slider`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `pk_id_san_pham_gio_hang` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pk_ma_kh_gio_hang` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD CONSTRAINT `fk_id_san_pham_hinh_anh` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phien_ban_san_pham`
--
ALTER TABLE `phien_ban_san_pham`
  ADD CONSTRAINT `fk_id_san_pham_phien_ban` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `thong_so_san_pham`
--
ALTER TABLE `thong_so_san_pham`
  ADD CONSTRAINT `fk_id_san_pham_chi_tiet` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
