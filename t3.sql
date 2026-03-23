-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 06:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `bnum` varchar(50) NOT NULL,
  `tname` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `fname`, `lname`, `bnum`, `tname`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', '2023-02-11 07:48:46', '2023-12-29 16:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `boxlog`
--

CREATE TABLE `boxlog` (
  `id` int(11) NOT NULL,
  `date` datetime(2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `prize_name` varchar(255) NOT NULL,
  `uid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boxlog`
--

INSERT INTO `boxlog` (`id`, `date`, `username`, `category`, `price`, `prize_name`, `uid`) VALUES
(1, '2025-10-20 03:30:29.00', 'ceoxdnvc', 'example1', 11, 'dwadwadwD', '1'),
(2, '2025-10-20 03:37:39.00', 'ceoxdnvc', 'example2', 22, 'sdasdasdad', '1'),
(3, '2025-10-20 04:10:21.00', 'ceoxdnvc', 'example2', 22, 'asd', '1'),
(4, '2025-10-21 05:25:20.00', 'Owner', 'example1', 10, 'ชำระสินค้า (ราคาหลังส่วนลด)', '1'),
(5, '2025-10-21 05:39:10.00', 'Owner', 'example1', 11, 'dwadwadwD', '1'),
(6, '2025-10-21 05:41:55.00', 'Owner', 'example2', 20, 'asd', '1'),
(7, '2025-10-21 05:44:37.00', 'Owner', 'example2', 22, 'as', '1');

-- --------------------------------------------------------

--
-- Table structure for table `box_product`
--

CREATE TABLE `box_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `img` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `link_download` varchar(255) NOT NULL,
  `percent` int(3) NOT NULL DEFAULT 100,
  `salt_prize` varchar(255) NOT NULL DEFAULT 'ไม่ได้รับรางวัล',
  `c_type` varchar(255) NOT NULL,
  `badge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `box_product`
--

INSERT INTO `box_product` (`id`, `name`, `price`, `des`, `img`, `type`, `link_download`, `percent`, `salt_prize`, `c_type`, `badge`) VALUES
(1, 'example1', 11, 'example1', 'https://mockups-design-com.b-cdn.net/wp-content/uploads/2018/02/Software_Box_Mockup_1_BG.jpg', 2, 'https://www.youtube.com/watch?v=tec1', 100, 'ไม่ได้รับรางวัล', 'example1', 1),
(2, 'example2', 22, 'example2', 'https://placehold.co/512', 1, '', 100, 'ไม่ได้รับรางวัล', 'example2', 2),
(3, 'example3', 33, 'example3', 'https://cdn.discordapp.com/attachments/1178032838189260901/1178227379093651466/83_20231126135426.png?ex=657560c1&is=6562ebc1&hm=ddeadee70b33168d4371dc9af50278f8b0c61f37eefc01fbcc45f1c0dbd55119&', 1, '', 100, 'ไม่ได้รับรางวัล', 'example3', 0),
(4, 'example4', 44, 'example4', 'https://cdn.discordapp.com/attachments/1178032838189260901/1178227379093651466/83_20231126135426.png?ex=657560c1&is=6562ebc1&hm=ddeadee70b33168d4371dc9af50278f8b0c61f37eefc01fbcc45f1c0dbd55119&', 2, '', 100, 'ไม่ได้รับรางวัล', 'example4', 0),
(5, 'example5', 55, 'example5', 'https://cdn.discordapp.com/attachments/1178032838189260901/1178227379093651466/83_20231126135426.png?ex=657560c1&is=6562ebc1&hm=ddeadee70b33168d4371dc9af50278f8b0c61f37eefc01fbcc45f1c0dbd55119&', 1, '', 100, 'ไม่ได้รับรางวัล', 'example4', 0),
(6, 'ตัวอย่าง', 5, 'dudud', 'https://img2.pic.in.th/pic/New-Project-360-E95FB42.gif', 0, '', 100, 'ไม่ได้รับรางวัล', 'example1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `box_stock`
--

CREATE TABLE `box_stock` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` int(3) NOT NULL,
  `p_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `box_stock`
--

INSERT INTO `box_stock` (`id`, `username`, `password`, `p_id`) VALUES
(3, 'dwadwadwD', 0, '1'),
(4, 'dwadwadwD', 0, '1'),
(5, 'dwadwadwD', 0, '1'),
(6, 'dwadwadwD', 0, '1'),
(11, 'da', 0, '2'),
(12, 'das', 0, '2'),
(13, 'dsa', 0, '2'),
(14, 'd', 0, '2'),
(15, 'asd', 0, '2');

-- --------------------------------------------------------

--
-- Table structure for table `byshop`
--

CREATE TABLE `byshop` (
  `status` varchar(255) NOT NULL,
  `apikey` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `byshop`
--

INSERT INTO `byshop` (`status`, `apikey`, `cost`) VALUES
('on', 'keyapibyshop', '15');

-- --------------------------------------------------------

--
-- Table structure for table `captcha_setting`
--

CREATE TABLE `captcha_setting` (
  `id` int(11) NOT NULL,
  `enable_turnstile` tinyint(1) DEFAULT 1,
  `enable_recaptcha` tinyint(1) DEFAULT 0,
  `enable_hcaptcha` tinyint(1) DEFAULT 0,
  `turnstile_key` varchar(255) DEFAULT NULL,
  `recaptcha_key` varchar(255) DEFAULT NULL,
  `hcaptcha_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `captcha_setting`
--

INSERT INTO `captcha_setting` (`id`, `enable_turnstile`, `enable_recaptcha`, `enable_hcaptcha`, `turnstile_key`, `recaptcha_key`, `hcaptcha_key`) VALUES
(1, 1, 0, 0, '0x4AAAAAAB8JKbbw4RtN4Jcj', 'YOUR_RECAPTCHA_KEY', 'YOUR_HCAPTCHA_KEY');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `link`) VALUES
(1, 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `des`, `img`) VALUES
(1, 'example1', 'example1', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375'),
(2, 'example2', 'example2', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375'),
(3, 'example3', 'example3', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375'),
(4, 'example4', 'example4', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `img`, `link`, `name`, `des`) VALUES
(1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtfbcYeYgf0wQJ-LSPm3CPbyB7T1p0f5bnaA&s', 'https://facebook.com/zeusx.xyz', 'Facebook', '');

-- --------------------------------------------------------

--
-- Table structure for table `crecom`
--

CREATE TABLE `crecom` (
  `recom_1` int(11) NOT NULL DEFAULT 0,
  `recom_2` int(11) NOT NULL DEFAULT 0,
  `recom_3` int(11) NOT NULL DEFAULT 0,
  `recom_4` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crecom`
--

INSERT INTO `crecom` (`recom_1`, `recom_2`, `recom_3`, `recom_4`) VALUES
(1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `discount_value` float NOT NULL DEFAULT 0,
  `max_uses` int(11) NOT NULL DEFAULT 0,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `products` text DEFAULT NULL COMMENT 'เก็บ ID ของสินค้าที่ใช้ได้ เช่น 1,2,3',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `code`, `discount_type`, `discount_value`, `max_uses`, `used_count`, `status`, `products`, `created_at`) VALUES
(10, 'WELCOME', 'fixed', 1, 1, 1, 'active', '1', '2025-10-20 22:13:02'),
(12, '10', 'percent', 10, 1, 1, 'active', '2', '2025-10-20 22:41:05'),
(13, 'WELCOME1', 'percent', 20, 0, 0, 'active', '1', '2025-10-21 18:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `howto`
--

CREATE TABLE `howto` (
  `status` int(11) NOT NULL,
  `link` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `howto`
--

INSERT INTO `howto` (`status`, `link`) VALUES
(0, 'G56JZUTHV_0');

-- --------------------------------------------------------

--
-- Table structure for table `kbank_trans`
--

CREATE TABLE `kbank_trans` (
  `id` int(11) NOT NULL,
  `qr` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `sender` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kbank_trans`
--

INSERT INTO `kbank_trans` (`id`, `qr`, `ref`, `sender`, `created_at`, `updated_at`) VALUES
(3, '0041000600000101030040220013075180347BTF021645102TH9104A4B7', '013075180347BTF02164', 'YOv Cof', '2023-12-09 16:17:31', '2023-12-09 09:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `loading`
--

CREATE TABLE `loading` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loading`
--

INSERT INTO `loading` (`id`, `type`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `particle`
--

CREATE TABLE `particle` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `particle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `particle`
--

INSERT INTO `particle` (`id`, `status`, `particle`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT 'ผู้ใช้ทั่วไป',
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `rating` decimal(2,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `product_id`, `username`, `comment`, `created_at`, `rating`) VALUES
(3, 1, 'Owner', 'สินค้านี้ดี', '2025-10-22 00:12:40', 5.0);

-- --------------------------------------------------------

--
-- Table structure for table `recom`
--

CREATE TABLE `recom` (
  `recom_1` int(11) NOT NULL DEFAULT 0,
  `recom_2` int(11) NOT NULL DEFAULT 0,
  `recom_3` int(11) NOT NULL DEFAULT 0,
  `recom_4` int(11) NOT NULL DEFAULT 0,
  `recom_5` int(11) NOT NULL DEFAULT 0,
  `recom_6` int(11) NOT NULL DEFAULT 0,
  `recom_7` int(11) NOT NULL DEFAULT 0,
  `recom_8` int(11) NOT NULL DEFAULT 0,
  `recom_9` int(11) NOT NULL DEFAULT 0,
  `recom_10` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recom`
--

INSERT INTO `recom` (`recom_1`, `recom_2`, `recom_3`, `recom_4`, `recom_5`, `recom_6`, `recom_7`, `recom_8`, `recom_9`, `recom_10`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `max_count` int(11) NOT NULL,
  `prize` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem_his`
--

CREATE TABLE `redeem_his` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` datetime(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_cate`
--

CREATE TABLE `service_cate` (
  `s_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `img` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_cate`
--

INSERT INTO `service_cate` (`s_id`, `name`, `des`, `type`, `img`) VALUES
(1, 'example1', 'example1', 1, 'https://cdn.discordapp.com/attachments/1178032838189260901/1178225138370625637/82_20231126134526.png?ex=65755eab&is=6562e9ab&hm=78b6da730beba327f9b41b9ed51c4c0470b7dae78b05d04ffce8caed09475e39&'),
(2, 'example2', 'example2', 1, 'https://cdn.discordapp.com/attachments/1178032838189260901/1178225138370625637/82_20231126134526.png?ex=65755eab&is=6562e9ab&hm=78b6da730beba327f9b41b9ed51c4c0470b7dae78b05d04ffce8caed09475e39&');

-- --------------------------------------------------------

--
-- Table structure for table `service_order`
--

CREATE TABLE `service_order` (
  `id` int(11) NOT NULL,
  `cosid` varchar(255) NOT NULL,
  `prod` varchar(255) NOT NULL,
  `user` mediumtext NOT NULL,
  `pass` mediumtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `del` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_prod`
--

CREATE TABLE `service_prod` (
  `id` int(11) NOT NULL,
  `cate` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `img` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_prod`
--

INSERT INTO `service_prod` (`id`, `cate`, `name`, `des`, `price`, `img`) VALUES
(1, 'example1', 'example1', 'example1', 12, 'https://cdn.discordapp.com/attachments/1178032838189260901/1178227379093651466/83_20231126135426.png?ex=657560c1&is=6562ebc1&hm=ddeadee70b33168d4371dc9af50278f8b0c61f37eefc01fbcc45f1c0dbd55119&'),
(2, 'example2', 'example2', 'example2', 23, 'https://cdn.discordapp.com/attachments/1178032838189260901/1178227379093651466/83_20231126135426.png?ex=657560c1&is=6562ebc1&hm=ddeadee70b33168d4371dc9af50278f8b0c61f37eefc01fbcc45f1c0dbd55119&');

-- --------------------------------------------------------

--
-- Table structure for table `service_setting`
--

CREATE TABLE `service_setting` (
  `status` varchar(255) NOT NULL,
  `mes` varchar(255) NOT NULL,
  `img` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_setting`
--

INSERT INTO `service_setting` (`status`, `mes`, `img`) VALUES
('on', 'บริการไอดีพาส', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `wallet` varchar(255) NOT NULL,
  `fee` enum('on','off') NOT NULL DEFAULT 'off',
  `bg2` varchar(255) NOT NULL,
  `bg3` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ann` varchar(255) NOT NULL,
  `main_color` varchar(255) NOT NULL,
  `sec_color` varchar(255) NOT NULL,
  `font_color` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `contact2` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `date` datetime(2) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `webhook_dc` varchar(255) NOT NULL,
  `widget_discord` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`wallet`, `fee`, `bg2`, `bg3`, `name`, `ann`, `main_color`, `sec_color`, `font_color`, `contact`, `contact2`, `des`, `date`, `ip`, `logo`, `webhook_dc`, `widget_discord`, `discord`, `facebook`) VALUES
('0909900090', 'off', 'https://img5.pic.in.th/file/secure-sv1/26_7ED5EF0.png', 'undefined', 'Xdnvc Cloud', 'Xdnvc Cloud บริการปล่อยเช่าเว็บราคาถูกเริ่มต้น 50/เดือน', '#b939fe', '#f9cb66', '#242424', '', '', 'Xdnvc Cloud บริการปล่อยเช่าเว็บไซต์ราคาถูกเริ่มต้น 50/เดือน', '2022-12-25 12:30:39.00', '::1', 'https://media.discordapp.net/attachments/1094846072444157994/1106529358463651890/logoxdnvNEW1.png', '#', 'undefined', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `static`
--

CREATE TABLE `static` (
  `s_count` int(11) NOT NULL DEFAULT 2575,
  `b_count` int(11) NOT NULL DEFAULT 3525,
  `m_count` int(11) NOT NULL DEFAULT 5468,
  `c_count` int(11) NOT NULL DEFAULT 5599,
  `last_change` datetime(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `static`
--

INSERT INTO `static` (`s_count`, `b_count`, `m_count`, `c_count`, `last_change`) VALUES
(0, 0, 0, 0, '2023-01-04 19:06:16.00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_wheel`
--

CREATE TABLE `stock_wheel` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `p_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_wheel`
--

INSERT INTO `stock_wheel` (`id`, `username`, `p_id`) VALUES
(1, 'dsadasDadadaf', '1'),
(2, 'dsadasDadadaf', '1'),
(3, 'dsadasDadadaf', '1'),
(4, 'dsadasDadadaf', '1'),
(5, 'dsadasDadadaf', '1'),
(6, 'dsadasDadadaf', '1'),
(7, 'dsadasDadadaf', '1'),
(8, 'dsadasDadadaf', '1'),
(9, 'dsadasDadadaf', '1'),
(10, 'dsadasDadadaf', '1'),
(11, 'dsadasDadadaf', '1'),
(12, 'dsadasDadadaf', '1'),
(13, 'dsadasDadadaf', '1'),
(14, 'dsadasDadadaf', '1'),
(15, 'dsadasDadadaf', '1'),
(16, 'dsadasDadadaf', '1'),
(17, 'dsadasDadadaf', '1'),
(18, 'dsadasDadadaf', '1'),
(19, 'dsadasDadadaf', '1'),
(20, 'dsadasDadadaf', '1'),
(21, 'dsadasDadadaf', '1'),
(22, 'dsadasDadadaf', '1'),
(23, 'dsadasDadadaf', '1'),
(24, 'dsadasDadadaf', '1'),
(25, 'dsadasDadadaf', '1'),
(26, 'dsadasDadadaf', '1'),
(27, 'dsadasDadadaf', '1'),
(28, 'dsadasDadadaf', '1'),
(29, 'dsadasDadadaf', '1'),
(30, 'dsadasDadadaf', '1'),
(31, 'dsadasDadadaf', '2'),
(32, 'dsadasDadadaf', '2'),
(33, 'dsadasDadadaf', '2'),
(34, 'dsadasDadadaf', '2'),
(35, 'dsadasDadadaf', '2'),
(36, 'dsadasDadadaf', '2'),
(37, 'dsadasDadadaf', '2'),
(38, 'dsadasDadadaf', '2'),
(39, 'dsadasDadadaf', '2'),
(40, 'dsadasDadadaf', '2'),
(41, 'dsadasDadadaf', '2'),
(42, 'dsadasDadadaf', '2'),
(43, 'dsadasDadadaf', '2'),
(44, 'dsadasDadadaf', '2'),
(45, 'dsadasDadadaf', '2'),
(46, 'dsadasDadadaf', '2'),
(47, 'dsadasDadadaf', '2'),
(48, 'dsadasDadadaf', '2'),
(49, 'dsadasDadadaf', '2'),
(50, 'dsadasDadadaf', '2'),
(51, 'dsadasDadadaf', '2'),
(52, 'dsadasDadadaf', '2'),
(53, 'dsadasDadadaf', '2'),
(54, 'dsadasDadadaf', '2'),
(55, 'dsadasDadadaf', '2'),
(56, 'dsadasDadadaf', '2'),
(57, 'dsadasDadadaf', '2'),
(58, 'dsadasDadadaf', '2'),
(59, 'dsadasDadadaf', '2'),
(60, 'dsadasDadadaf', '2'),
(64, 'dsadasDadadaf', '3'),
(65, 'dsadasDadadaf', '3'),
(66, 'dsadasDadadaf', '3'),
(67, 'dsadasDadadaf', '3'),
(68, 'dsadasDadadaf', '3'),
(69, 'dsadasDadadaf', '3'),
(70, 'dsadasDadadaf', '3'),
(71, 'dsadasDadadaf', '3'),
(72, 'dsadasDadadaf', '3'),
(73, 'dsadasDadadaf', '3'),
(74, 'dsadasDadadaf', '3'),
(75, 'dsadasDadadaf', '3'),
(76, 'dsadasDadadaf', '3'),
(77, 'dsadasDadadaf', '3'),
(78, 'dsadasDadadaf', '3'),
(79, 'dsadasDadadaf', '3'),
(80, 'dsadasDadadaf', '3'),
(81, 'dsadasDadadaf', '3'),
(82, 'dsadasDadadaf', '3'),
(83, 'dsadasDadadaf', '3'),
(84, 'dsadasDadadaf', '3'),
(85, 'dsadasDadadaf', '3'),
(86, 'dsadasDadadaf', '3'),
(87, 'dsadasDadadaf', '3'),
(88, 'dsadasDadadaf', '3'),
(89, 'dsadasDadadaf', '3'),
(90, 'dsadasDadadaf', '3'),
(91, 'dsadasDadadaf', '4'),
(92, 'dsadasDadadaf', '4'),
(93, 'dsadasDadadaf', '4'),
(94, 'dsadasDadadaf', '4'),
(95, 'dsadasDadadaf', '4'),
(96, 'dsadasDadadaf', '4'),
(97, 'dsadasDadadaf', '4'),
(98, 'dsadasDadadaf', '4'),
(99, 'dsadasDadadaf', '4'),
(100, 'dsadasDadadaf', '4'),
(101, 'dsadasDadadaf', '4'),
(102, 'dsadasDadadaf', '4'),
(103, 'dsadasDadadaf', '4'),
(104, 'dsadasDadadaf', '4'),
(105, 'dsadasDadadaf', '4'),
(106, 'dsadasDadadaf', '4'),
(107, 'dsadasDadadaf', '4'),
(108, 'dsadasDadadaf', '4'),
(109, 'dsadasDadadaf', '4'),
(110, 'dsadasDadadaf', '4'),
(111, 'dsadasDadadaf', '4'),
(112, 'dsadasDadadaf', '4'),
(113, 'dsadasDadadaf', '4'),
(114, 'dsadasDadadaf', '4'),
(115, 'dsadasDadadaf', '4'),
(116, 'dsadasDadadaf', '4'),
(117, 'dsadasDadadaf', '4'),
(118, 'dsadasDadadaf', '4'),
(119, 'dsadasDadadaf', '4'),
(120, 'dsadasDadadaf', '4');

-- --------------------------------------------------------

--
-- Table structure for table `theme_setting`
--

CREATE TABLE `theme_setting` (
  `icon` varchar(255) NOT NULL,
  `ui` varchar(255) NOT NULL,
  `uic` varchar(255) NOT NULL,
  `anim` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theme_setting`
--

INSERT INTO `theme_setting` (`icon`, `ui`, `uic`, `anim`, `theme`) VALUES
('classic', 'light', '#000000', 'fu', 'custom');

-- --------------------------------------------------------

--
-- Table structure for table `topup_his`
--

CREATE TABLE `topup_his` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `amount` int(20) NOT NULL,
  `date` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topup_his`
--

INSERT INTO `topup_his` (`id`, `link`, `amount`, `date`, `uid`, `uname`) VALUES
(7, 'สลิปบัญชีชื่อ : ด.ช. มูฮัมหมัด จ', 50, '2023-12-12 17:34:13', 5, 'f');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'https://cdn-icons-png.flaticon.com/128/4322/4322991.png',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `point` float NOT NULL,
  `total` float NOT NULL,
  `pin` varchar(6) NOT NULL,
  `rank` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `username`, `password`, `date`, `point`, `total`, `pin`, `rank`) VALUES
(1, 'https://i.pinimg.com/236x/0c/11/82/0c1182d5b237ea83402f66b08d1a18af.jpg', 'Owner', '9aaf7f9513a25892268f5b486abdf20d', '2025-10-20', 932.2, 0, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wheel`
--

CREATE TABLE `wheel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `mode` enum('wheel','csgo') DEFAULT 'wheel',
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wheel`
--

INSERT INTO `wheel` (`id`, `name`, `price`, `mode`, `img`) VALUES
(3, 'spin 1', 1, 'csgo', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375'),
(4, 'spinx', 5, 'wheel', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375');

-- --------------------------------------------------------

--
-- Table structure for table `wheellog`
--

CREATE TABLE `wheellog` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `prize_name` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wheellog`
--

INSERT INTO `wheellog` (`id`, `date`, `username`, `category`, `price`, `prize_name`, `uid`) VALUES
(1, '2025-10-25 05:14:46', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(2, '2025-10-25 05:14:47', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(3, '2025-10-25 05:15:45', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wheel_item`
--

CREATE TABLE `wheel_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `percent` int(3) NOT NULL DEFAULT 100,
  `w_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wheel_item`
--

INSERT INTO `wheel_item` (`id`, `name`, `img`, `percent`, `w_id`) VALUES
(1, '1', 'https://media.discordapp.net/attachments/1094846072444157994/1106529358463651890/logoxdnvNEW1.png', 50, 3),
(2, '2', 'https://media.discordapp.net/attachments/1094846072444157994/1106529358463651890/logoxdnvNEW1.png', 50, 3),
(3, '5 บาท', 'https://img.xdnv.store/upload/image/aLd1702566412BKFhd.png', 50, 4),
(4, '10 บาท', 'https://img.xdnv.store/upload/image/aLd1702566412BKFhd.png', 50, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boxlog`
--
ALTER TABLE `boxlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `box_product`
--
ALTER TABLE `box_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `box_stock`
--
ALTER TABLE `box_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha_setting`
--
ALTER TABLE `captcha_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_unique` (`code`);

--
-- Indexes for table `howto`
--
ALTER TABLE `howto`
  ADD UNIQUE KEY `1` (`status`,`link`) USING HASH;

--
-- Indexes for table `kbank_trans`
--
ALTER TABLE `kbank_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loading`
--
ALTER TABLE `loading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `particle`
--
ALTER TABLE `particle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`,`particle`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem_his`
--
ALTER TABLE `redeem_his`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_cate`
--
ALTER TABLE `service_cate`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `service_order`
--
ALTER TABLE `service_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_prod`
--
ALTER TABLE `service_prod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_wheel`
--
ALTER TABLE `stock_wheel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topup_his`
--
ALTER TABLE `topup_his`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheel`
--
ALTER TABLE `wheel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheellog`
--
ALTER TABLE `wheellog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheel_item`
--
ALTER TABLE `wheel_item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `boxlog`
--
ALTER TABLE `boxlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `box_product`
--
ALTER TABLE `box_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `box_stock`
--
ALTER TABLE `box_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `captcha_setting`
--
ALTER TABLE `captcha_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kbank_trans`
--
ALTER TABLE `kbank_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loading`
--
ALTER TABLE `loading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `particle`
--
ALTER TABLE `particle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `redeem_his`
--
ALTER TABLE `redeem_his`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_cate`
--
ALTER TABLE `service_cate`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_order`
--
ALTER TABLE `service_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_prod`
--
ALTER TABLE `service_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_wheel`
--
ALTER TABLE `stock_wheel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `topup_his`
--
ALTER TABLE `topup_his`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wheel`
--
ALTER TABLE `wheel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wheellog`
--
ALTER TABLE `wheellog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wheel_item`
--
ALTER TABLE `wheel_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
