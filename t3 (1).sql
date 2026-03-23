-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 06:30 PM
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
(1, 'ณัฐพงศ์', 'แซ่หลู่', '1563167986', 'ธนาคารกสิกร', '2023-02-11 07:48:46', '2025-12-04 19:45:25');

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
(7, '2025-10-21 05:44:37.00', 'Owner', 'example2', 22, 'as', '1'),
(8, '2025-11-19 03:22:26.00', 'Owner', 'example1', 9, 'dwadwadwD', '1');

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
(1, 'example1', 11, 'example1', 'https://mockups-design-com.b-cdn.net/wp-content/uploads/2018/02/Software_Box_Mockup_1_BG.jpg', 2, 'https://www.youtube.com/watch?v=tec1', 100, 'ไม่ได้รับรางวัล', 'example1', 2),
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
(13, 'WELCOME1', 'percent', 20, 0, 1, 'active', '1', '2025-10-21 18:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `helpbtn`
--

CREATE TABLE `helpbtn` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `helpbtn`
--

INSERT INTO `helpbtn` (`id`, `img`, `link`, `status`) VALUES
(1, 'https://placehold.co/1000x500?text=1000x500', 'localhost/home', '1'),
(2, 'https://placehold.co/1000x500?text=1000x500', 'localhost/shop', '1'),
(3, 'https://placehold.co/1000x500?text=1000x500', '/home', '1'),
(4, 'https://placehold.co/1000x500?text=1000x500', '/home', '1');

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
-- Table structure for table `otp_codes`
--

CREATE TABLE `otp_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp_code` int(11) NOT NULL,
  `type` text NOT NULL,
  `expire_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_codes`
--

INSERT INTO `otp_codes` (`id`, `user_id`, `email`, `otp_code`, `type`, `expire_at`) VALUES
(3, 1, 'zenx.ixu@gmail.com', 993690, 'verify_email', '2025-11-19');

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
(1, 1, 3);

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
(3, 1, 'Owner', 'สินค้านี้ดี', '2025-10-22 00:12:40', 1.0);

-- --------------------------------------------------------

--
-- Table structure for table `product_multi`
--

CREATE TABLE `product_multi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `base_image` varchar(255) DEFAULT NULL,
  `enable_form` tinyint(1) NOT NULL DEFAULT 0,
  `form_fields` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_multi`
--

INSERT INTO `product_multi` (`id`, `name`, `description`, `base_image`, `enable_form`, `form_fields`, `status`, `created_at`) VALUES
(1, 'ฟหก', '', '', 0, '', 0, '2025-11-21 04:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_multi_orders`
--

CREATE TABLE `product_multi_orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1,
  `price_total` int(11) NOT NULL,
  `customer_json` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_multi_variant`
--

CREATE TABLE `product_multi_variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
('0909900090', 'off', 'https://img5.pic.in.th/file/secure-sv1/26_7ED5EF0.png', 'undefined', 'Xdnvc Cloud', 'Xdnvc Cloud บริการปล่อยเช่าเว็บราคาถูกเริ่มต้น 50/เดือน', '#b939fe', '#f9cb66', '#000000', '', '', 'Xdnvc Cloud บริการปล่อยเช่าเว็บไซต์ราคาถูกเริ่มต้น 50/เดือน', '2022-12-25 12:30:39.00', '::1', 'https://media.discordapp.net/attachments/1094846072444157994/1106529358463651890/logoxdnvNEW1.png', '#', 'undefined', '#', '#');

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
(57, 'dsadasDadadaf', '2'),
(58, 'dsadasDadadaf', '2'),
(59, 'dsadasDadadaf', '2'),
(60, 'dsadasDadadaf', '2'),
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
(120, 'dsadasDadadaf', '4'),
(123, 'ด', '1'),
(124, 'ด', '1'),
(125, 'ด', '1'),
(126, 'ด', '1'),
(127, 'ด', '1'),
(128, 'ด', '1'),
(129, 'ด', '1'),
(130, 'ด', '1'),
(131, 'ด', '1'),
(132, 'ด', '1'),
(133, 'ด', '1'),
(134, 'ด', '1'),
(135, 'ด', '1'),
(136, 'ด', '1'),
(137, 'ด', '1'),
(138, 'ด', '1'),
(139, 'ด', '1'),
(140, 'ด', '1'),
(141, 'ด', '1'),
(142, 'ด', '1'),
(143, 'ด', '1'),
(144, 'ด', '1'),
(145, 'ด', '1'),
(146, 'ด', '1'),
(147, 'ด', '1'),
(148, 'ด', '1'),
(149, 'ด', '1'),
(150, 'ด', '1'),
(151, 'ด', '1'),
(152, 'ด', '1'),
(153, 'ด', '1'),
(154, 'ด', '1'),
(155, 'ด', '1'),
(156, 'ด', '1'),
(157, 'ด', '1'),
(158, 'ด', '1'),
(159, 'ด', '1'),
(160, 'ด', '1'),
(161, 'ด', '1'),
(162, 'ด', '1'),
(163, 'ด', '1'),
(164, 'ด', '1'),
(165, 'ด', '1'),
(166, 'ด', '1'),
(167, 'ด', '1'),
(168, 'ด', '1'),
(169, 'ด', '1'),
(170, 'ด', '1'),
(171, 'ด', '1'),
(172, 'ด', '1'),
(173, 'ด', '1'),
(174, 'ด', '1'),
(175, 'ด', '1'),
(176, 'ด', '1'),
(177, 'ด', '1'),
(178, 'ด', '1'),
(179, 'ด', '1'),
(180, 'ด', '1'),
(181, 'ด', '1'),
(182, 'ด', '1'),
(183, 'ด', '1'),
(184, 'ด', '1'),
(185, 'ด', '1'),
(186, 'ด', '1'),
(187, 'ด', '1'),
(188, 'ด', '1'),
(189, 'ด', '1'),
(190, 'ด', '1'),
(191, 'ด', '1'),
(192, 'ด', '1'),
(193, 'ด', '1'),
(194, 'ด', '1'),
(195, 'ด', '1'),
(196, 'ด', '1'),
(197, 'ด', '1'),
(198, 'ด', '1'),
(199, 'ด', '1'),
(200, 'ด', '1'),
(201, 'ด', '1'),
(202, 'ด', '1'),
(203, 'ด', '1'),
(204, 'ด', '1'),
(205, 'ด', '1'),
(206, 'ด', '1'),
(207, 'ด', '1'),
(208, 'ด', '1'),
(209, 'ด', '1'),
(210, 'ด', '1'),
(211, 'ด', '1'),
(212, 'ด', '1'),
(213, 'ด', '1'),
(214, 'ด', '1'),
(215, 'ด', '1'),
(216, 'ด', '1'),
(217, 'ด', '1'),
(218, 'ด', '1'),
(219, 'ด', '1'),
(220, 'ด', '1'),
(221, 'ด', '1'),
(222, 'ด', '1'),
(223, 'ด', '1'),
(224, 'ด', '1'),
(225, 'ด', '1'),
(226, 'ด', '1'),
(227, 'ด', '1'),
(228, 'ด', '1'),
(229, 'ด', '1'),
(230, 'ด', '1'),
(231, 'ด', '1'),
(232, 'ด', '1'),
(233, 'ด', '1'),
(234, 'ด', '1'),
(235, 'ด', '1'),
(236, 'ด', '1'),
(237, 'ด', '1'),
(238, 'ด', '1'),
(239, 'ด', '1'),
(240, 'ด', '1'),
(241, 'ด', '1'),
(242, 'ด', '1'),
(243, 'ด', '1'),
(244, 'ด', '1'),
(245, 'ด', '1'),
(246, 'ด', '1'),
(247, 'ด', '1'),
(248, 'ด', '1'),
(249, 'ด', '1'),
(250, 'ด', '1'),
(251, 'ด', '1'),
(252, 'ด', '1'),
(253, 'ด', '1'),
(254, 'ด', '1'),
(255, 'ด', '1'),
(256, 'ด', '1'),
(257, 'ด', '1'),
(258, 'ด', '1'),
(259, 'ด', '1'),
(260, 'ด', '1'),
(261, 'ด', '1'),
(262, 'ด', '1'),
(263, 'ด', '1'),
(264, 'ด', '1'),
(265, 'ด', '1'),
(266, 'ด', '1'),
(267, 'ด', '1'),
(268, 'ด', '1'),
(269, 'ด', '1'),
(270, 'ด', '1'),
(271, 'ด', '1'),
(272, 'ด', '1'),
(273, 'ด', '1'),
(274, 'ด', '1'),
(275, 'ด', '1'),
(276, 'ด', '1'),
(277, 'ด', '1'),
(278, 'ด', '1'),
(279, 'ด', '1'),
(280, 'ด', '1'),
(281, 'ด', '1'),
(282, 'ด', '1'),
(283, 'ด', '1'),
(284, 'ด', '1'),
(285, 'ด', '1'),
(286, 'ด', '1'),
(287, 'ด', '1'),
(288, 'ด', '1'),
(289, 'ด', '1'),
(290, 'ด', '1'),
(291, 'ด', '1'),
(292, 'ด', '1'),
(293, 'ด', '1'),
(294, 'ด', '1'),
(295, 'ด', '1'),
(296, 'ด', '1'),
(297, 'ด', '1'),
(298, 'ด', '1'),
(299, 'ด', '1'),
(300, 'ด', '1'),
(301, 'ด', '2'),
(302, 'ด', '2'),
(303, 'ด', '2'),
(304, 'ดดดด', '2'),
(305, 'ด', '2'),
(306, 'ด', '2'),
(307, 'ด', '2'),
(308, 'ด', '2'),
(309, 'ด', '2'),
(310, 'ด', '2'),
(311, 'ด', '2'),
(312, 'ด', '2'),
(313, 'ด', '2'),
(314, 'ด', '2'),
(315, 'ด', '2'),
(316, 'ด', '2'),
(317, 'ด', '2'),
(318, 'ด', '2'),
(319, 'ด', '2'),
(320, 'ด', '2'),
(321, 'ด', '2'),
(322, 'ด', '2'),
(323, 'ด', '2'),
(324, 'ด', '2'),
(325, 'ด', '2'),
(326, 'ด', '2'),
(327, 'ด', '2'),
(328, 'ด', '2'),
(329, 'ด', '2'),
(330, 'ด', '2'),
(331, 'ด', '2'),
(332, 'ด', '2'),
(333, 'ด', '2'),
(334, 'ด', '2'),
(335, 'ด', '2'),
(336, 'ด', '2'),
(337, 'ด', '2'),
(338, 'ด', '2'),
(339, 'ด', '2'),
(340, 'ด', '2'),
(341, 'ด', '2'),
(342, 'ด', '2'),
(343, 'ด', '2'),
(344, 'ด', '2'),
(345, 'ด', '2'),
(346, 'ด', '2'),
(347, 'ด', '2'),
(348, 'ด', '2'),
(349, 'ด', '2'),
(350, 'ด', '2'),
(351, 'ด', '2'),
(352, 'ด', '2'),
(353, 'ด', '2'),
(354, 'ด', '2'),
(355, 'ด', '2'),
(356, 'ด', '2'),
(357, 'ด', '2'),
(358, 'ด', '2'),
(359, 'ด', '2'),
(360, 'ด', '2'),
(361, 'ด', '2'),
(362, 'ด', '2'),
(363, 'ด', '2'),
(364, 'ด', '2'),
(365, 'ด', '2'),
(366, 'ด', '2'),
(367, 'ด', '2'),
(368, 'ด', '2'),
(369, 'ด', '2'),
(370, 'ด', '2'),
(371, 'ด', '2'),
(372, 'ด', '2'),
(373, 'ด', '2'),
(374, 'ด', '2'),
(375, 'ด', '2'),
(376, 'ด', '2'),
(377, 'ด', '2'),
(378, 'ด', '2'),
(379, 'ด', '2'),
(380, 'ด', '2'),
(381, 'ด', '2'),
(382, 'ด', '2'),
(383, 'ด', '2'),
(384, 'ด', '2'),
(385, 'ด', '2'),
(386, 'ด', '2'),
(387, 'ด', '2');

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
  `rank` int(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `username`, `password`, `date`, `point`, `total`, `pin`, `rank`, `email`) VALUES
(1, 'https://i.pinimg.com/236x/0c/11/82/0c1182d5b237ea83402f66b08d1a18af.jpg', 'Owner', '9aaf7f9513a25892268f5b486abdf20d', '2025-10-20', 755.4, 0, '0', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `wheel`
--

CREATE TABLE `wheel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `mode` enum('wheel','csgo','box','crane') DEFAULT 'wheel',
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wheel`
--

INSERT INTO `wheel` (`id`, `name`, `price`, `mode`, `img`) VALUES
(3, 'spin 1', 1, 'crane', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375'),
(4, 'spinx', 5, 'box', 'https://media.discordapp.net/attachments/1178225356499603486/1178225396043493486/p1.png?ex=65755ee8&is=6562e9e8&hm=01646f86d75e073e2fd77ba68b0c1244abbd2ebc12dade23cb8dafcb9a0b9bbe&=&format=webp&width=1800&height=375');

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
(3, '2025-10-25 05:15:45', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(4, '2025-11-21 02:23:48', 'Owner', '10 บาท', 5, 'dsadasDadadaf', 1),
(5, '2025-11-21 02:45:02', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(6, '2025-11-21 03:09:28', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(7, '2025-11-21 03:09:40', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(8, '2025-11-21 03:09:57', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(9, '2025-11-21 03:13:25', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(10, '2025-11-21 03:13:46', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(11, '2025-11-21 03:20:13', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(12, '2025-11-21 03:20:49', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(13, '2025-11-21 03:23:03', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(14, '2025-11-21 03:23:36', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(15, '2025-11-21 03:24:00', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(16, '2025-11-21 03:24:45', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(17, '2025-11-21 03:25:26', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(18, '2025-11-21 03:29:21', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(19, '2025-11-21 03:29:45', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(20, '2025-11-21 03:29:53', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(21, '2025-11-21 03:30:19', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(22, '2025-11-21 03:30:41', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(23, '2025-11-21 03:31:01', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(24, '2025-11-21 03:31:19', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(25, '2025-11-21 03:31:45', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(26, '2025-11-21 03:32:05', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(27, '2025-11-21 03:32:25', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(28, '2025-11-21 03:35:45', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(29, '2025-11-21 03:35:57', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(30, '2025-11-21 03:38:59', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(31, '2025-11-21 03:39:45', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(32, '2025-11-21 03:40:00', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(33, '2025-11-21 03:42:45', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(34, '2025-11-21 03:42:59', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(35, '2025-11-21 03:43:10', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(36, '2025-11-21 03:50:48', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(37, '2025-11-21 03:51:02', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(38, '2025-11-21 04:09:55', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(39, '2025-11-21 06:16:49', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(40, '2025-11-22 22:45:30', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(41, '2025-11-22 22:54:39', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(42, '2025-11-22 22:55:47', 'Owner', '10 บาท', 5, 'dsadasDadadaf', 1),
(43, '2025-11-22 23:05:28', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(44, '2025-11-22 23:10:11', 'Owner', '10 บาท', 5, 'dsadasDadadaf', 1),
(45, '2025-11-22 23:10:40', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(46, '2025-11-22 23:11:43', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(47, '2025-11-22 23:13:09', 'Owner', '10 บาท', 5, 'dsadasDadadaf', 1),
(48, '2025-11-22 23:13:31', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(49, '2025-11-22 23:15:19', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(50, '2025-11-22 23:16:11', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(51, '2025-11-22 23:16:28', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(52, '2025-11-22 23:21:19', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(53, '2025-11-22 23:21:51', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(54, '2025-11-22 23:22:27', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(55, '2025-11-22 23:22:42', 'Owner', '10 บาท', 5, 'dsadasDadadaf', 1),
(56, '2025-11-23 00:01:39', 'Owner', '5 บาท', 5, 'dsadasDadadaf', 1),
(57, '2025-11-23 00:01:48', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(58, '2025-11-23 00:02:00', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(59, '2025-11-25 08:42:36', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(60, '2025-12-03 21:24:30', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(61, '2025-12-03 21:26:15', 'Owner', '10 บาท', 5, 'dsadasDadadaf', 1),
(62, '2025-12-15 07:23:56', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(63, '2025-12-15 07:24:08', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(64, '2025-12-15 07:24:52', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(65, '2025-12-15 07:35:07', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(66, '2025-12-15 07:41:52', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(67, '2025-12-15 07:42:05', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(68, '2025-12-15 07:51:09', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(69, '2025-12-15 07:56:32', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(70, '2025-12-15 08:01:51', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(71, '2025-12-15 08:15:13', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(72, '2025-12-15 08:18:01', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(73, '2025-12-15 08:21:20', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(74, '2025-12-15 08:23:55', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(75, '2025-12-15 08:24:26', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(76, '2025-12-15 08:24:52', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(77, '2025-12-15 08:25:24', 'Owner', '1', 1, 'dsadasDadadaf', 1),
(78, '2025-12-15 08:28:08', 'Owner', '1', 1, 'ด', 1),
(79, '2025-12-15 08:28:39', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(80, '2025-12-15 08:29:09', 'Owner', '1', 1, 'ด', 1),
(81, '2025-12-15 19:10:19', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(82, '2025-12-15 19:11:38', 'Owner', '2', 1, 'dsadasDadadaf', 1),
(83, '2025-12-15 20:54:56', 'Owner', '2', 1, 'dsadasDadadaf', 1);

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
(1, '1', 'https://placehold.co/512?text=1', 50, 3),
(2, '2', 'https://placehold.co/512?text=2', 50, 3),
(3, '5 บาท', 'https://placehold.co/512?text=5', 50, 4),
(4, '10 บาท', 'https://placehold.co/512?text=10', 50, 4);

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
-- Indexes for table `helpbtn`
--
ALTER TABLE `helpbtn`
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `otp_codes`
--
ALTER TABLE `otp_codes`
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
-- Indexes for table `product_multi`
--
ALTER TABLE `product_multi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_multi_orders`
--
ALTER TABLE `product_multi_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_multi_variant`
--
ALTER TABLE `product_multi_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `helpbtn`
--
ALTER TABLE `helpbtn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `otp_codes`
--
ALTER TABLE `otp_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `product_multi`
--
ALTER TABLE `product_multi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_multi_orders`
--
ALTER TABLE `product_multi_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_multi_variant`
--
ALTER TABLE `product_multi_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `wheel_item`
--
ALTER TABLE `wheel_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_multi_variant`
--
ALTER TABLE `product_multi_variant`
  ADD CONSTRAINT `product_multi_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_multi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
