-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 06:34 PM
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
-- Database: `borrow`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_records`
--

CREATE TABLE `address_records` (
  `record_id` int(11) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `uid` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_records`
--

INSERT INTO `address_records` (`record_id`, `address_line1`, `address_line2`, `city`, `province`, `postal_code`, `uid`) VALUES
(1000, '242', 'ปลายนา', 'ศรีประจันต์', 'สุพรรณบุรี', '00000', 104),
(1001, '27', 'สามโก้', 'สามโก้', 'อ่างทอง', '14160', 105),
(1002, '346/3', 'ปลายนา', 'ศรีประจันต์', 'สุพรรณบุรี', '00000', 106),
(1003, '38', 'ราษฏรพัฒนา', 'สามโก้', 'อ่างทอง', '00000', 107),
(1004, '76/1', 'สาวร้องไห้', 'วิเศษชัยชาญ', 'อ่างทอง', '00000', 108),
(1005, '10', 'สี่ร้อย', 'วิเศษชัยชาญ', 'อ่างทอง', '00000', 109),
(1006, '74/15', 'ประตูชัย', 'พระนครศรีอยุธยา', 'พระนครศรีอยุธยา', '00000', 110),
(1007, '3', 'บางเจ้าฉ่า', 'โพธิ์ทอง', 'อ่างทอง', '00000', 112),
(1008, '122/1', 'ถ้ำกระต่ายทอง', 'พรานกระต่าย', 'กำแพงเพชร', '00000', 113),
(1009, '3', 'โพธิ์ม่วงพันธ์', 'สามโก้', 'อ่างทอง', '14160', 114),
(1010, '149/3', 'อบทม', 'สามโก้', 'อ่างทอง', '14160', 115),
(1011, '276', 'สามโก้', 'สามโก้', 'อ่างทอง', '14160', 116),
(1012, '245/1', 'โพธิ์ม่วงพันธ์', 'สามโก้', 'อ่างทอง', '14160', 117),
(1013, '109/3', 'หนองผักนาก', 'สามชุก', 'สุพรรรบุรี', '00000', 118),
(1014, '64', 'ห้วยแห้ง', 'บ้านไร่', 'อุทัยธานี', '00000', 119),
(1015, '9', 'สามโก้', 'สามโก้', 'อ่างทอง', '14160', 120),
(1016, '22/2', 'ไผ่ขวาง', 'เมืองสุพรรณ', 'สุพรรณบุรี', '00000', 121),
(1017, '56/5', 'บ้านลี่', 'บางปะหัน', 'พระนครศรีอยุธยา', '13160', 122),
(1018, '58/3', 'อบทม', 'สามโก้', 'อ่างทอง', '14160', 123),
(1019, '10', 'ลำตะเคียน', 'ผักไห่', 'พระนครศรีอยุธยา', '00000', 124),
(1020, '25', 'สามโก้', 'สามโก้', 'อ่างทอง', '14160', 125),
(1021, '22', 'มงคลธรรมนิมิต', 'สามโก้', 'อ่างทอง', '00000', 126),
(1022, '53/26', 'บางปรอก', 'เมืองปทุมธานี', 'ปทุมธานี', '00000', 127),
(1023, '63', 'โคกตะเคียน', 'กาบเชิง', 'สุรินทร์', '00000', 128),
(1024, '143', 'อบทม', 'สามโก้', 'อ่างทอง', '14160', 129),
(1025, '246', 'ปลายนา', 'ศรีประจันต์', 'สุพรรณบุรี', '00000', 130),
(1026, '37/1', 'ลาดชิด', 'ผักไห่', 'พระนครศรีอยุธยา', '00000', 131),
(1029, '184', 'ราษฏรพัฒนา', 'สามโก้', 'อ่างทอง', '14160', 134),
(1030, '22/1', 'บางบัวทอง', 'บางบัวทอง', 'นนทบุรี', '00000', 135),
(1031, '2/57', 'สำโรงเหนือ', 'เมืองสมุทรปราการ', 'สมุทรปราการ', '00000', 136),
(1032, '62', 'คลองน้ำไหล', 'คลองลาน', 'กำแพงเพชร', '00000', 137),
(1033, '56/1', 'หน้าโคก', 'ผักไห่', 'พระนครศรีอยุธยา', '00000', 138),
(1034, '79', 'หน้าโคก', 'ผักไห่', 'พระนครศรีอยุธยา', '00000', 139),
(1035, '244/2', 'อบทม', 'สามโก้', 'อ่างทอง', '14160', 140),
(1036, '173/5', 'ไผ่ขวาง', 'เมืองสุพรรณ', 'สุพรรณบุรี', '00000', 141),
(1038, '114/1', 'มดแดง', 'ศรีประจันต์', 'สุพรรณบุรี', '00000', 143);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adid`, `username`, `password`, `role`) VALUES
(2, 'admina', '15995100', 'admin'),
(3, 'admin', '$2y$10$tdN2kOSr/zxF2f0ZiwHOmeNnaDQswcoJyXXwB6Lf1LOoYtrCYNJX.', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `inid` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `uid` int(11) NOT NULL,
  `purchase_mount` date NOT NULL,
  `instatus` varchar(255) NOT NULL,
  `mountstatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`inid`, `product_name`, `price`, `purchase_date`, `uid`, `purchase_mount`, `instatus`, `mountstatus`) VALUES
(100005, 'รองเท้า Fiflop', 420, '2024-01-07', 104, '0000-00-00', '', ''),
(100006, 'รองเท้า อภิชาต', 170, '2024-01-07', 111, '0000-00-00', '', ''),
(100007, 'รองเท้า Fiflop', 370, '2024-01-14', 119, '0000-00-00', '', ''),
(100009, 'รองเท้า อภิชาต', 170, '2024-01-14', 121, '0000-00-00', '', ''),
(100010, 'รองเท้า Fiflop', 250, '2023-12-17', 128, '0000-00-00', '', ''),
(100011, 'เสื้อ', 120, '2023-12-17', 130, '0000-00-00', '', ''),
(100012, 'แก๊สโซลีน', 255, '2023-12-17', 131, '0000-00-00', '', ''),
(100023, 'รองเท้าSHU', 289, '2024-01-14', 134, '0000-00-00', '', ''),
(100024, 'รองเท้า', 195, '2024-01-07', 135, '0000-00-00', '', ''),
(100025, 'รองเท้า', 1350, '0000-00-00', 135, '2024-01-30', '', ''),
(100026, 'กระเป๋าเจลลี่บันนี่', 1390, '0000-00-00', 140, '2024-01-30', '', ''),
(100027, 'กางเกงแก๊สโซลีน', 1200, '0000-00-00', 140, '2024-01-30', '', ''),
(100028, 'รองเท้าSHU', 1190, '0000-00-00', 141, '2024-01-30', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `recover`
--

CREATE TABLE `recover` (
  `recid` int(11) NOT NULL,
  `loan_amount` int(11) NOT NULL,
  `interest_rate` int(11) NOT NULL,
  `recovery_date` date NOT NULL,
  `uid` int(11) NOT NULL,
  `stna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recover`
--

INSERT INTO `recover` (`recid`, `loan_amount`, `interest_rate`, `recovery_date`, `uid`, `stna`) VALUES
(10007, 2000, 400, '2024-01-30', 106, ''),
(10008, 1000, 200, '2024-02-02', 107, ''),
(10009, 2000, 400, '2024-01-30', 108, ''),
(10011, 4000, 800, '2024-01-31', 109, ''),
(10012, 1000, 200, '2024-01-31', 110, ''),
(10013, 1000, 200, '2024-02-03', 112, ''),
(10015, 1500, 300, '2024-01-30', 113, ''),
(10016, 500, 100, '2024-01-30', 114, ''),
(10017, 1000, 200, '2024-01-30', 115, ''),
(10018, 1000, 200, '2024-01-30', 116, ''),
(10019, 2000, 400, '2024-01-23', 117, 'pass'),
(10020, 1000, 200, '2024-01-30', 118, ''),
(10022, 1000, 200, '2024-01-30', 120, ''),
(10024, 1000, 200, '2024-01-30', 122, ''),
(10025, 2000, 400, '2024-01-23', 123, 'pass'),
(10026, 1000, 200, '2024-01-23', 124, 'pass'),
(10027, 500, 100, '2024-01-23', 125, 'pass'),
(10028, 4000, 800, '2024-01-31', 126, ''),
(10031, 2000, 400, '2024-01-27', 129, ''),
(10033, 500, 100, '2024-02-01', 131, ''),
(10047, 2000, 400, '2024-01-23', 135, ''),
(10048, 1000, 200, '2024-01-23', 136, ''),
(10049, 500, 100, '2024-02-03', 137, ''),
(10050, 2000, 400, '2024-01-29', 138, ''),
(10051, 1000, 200, '2024-01-30', 139, ''),
(10057, 1500, 300, '2024-01-30', 105, ''),
(10058, 1000, 200, '2024-01-28', 127, ''),
(10061, 1000, 200, '2024-01-29', 124, ''),
(10062, 500, 100, '2024-01-29', 143, ''),
(10064, 1000, 200, '2024-01-31', 117, 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `facename` varchar(255) NOT NULL,
  `cardid` varchar(255) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `lname`, `facename`, `cardid`, `pid`, `status`) VALUES
(104, 'ณัฐญา ', 'ชิดปราง', 'ณัฐญา ชิดปราง', '1-7205-01166-02-7		', 'MP01', 'fail'),
(105, 'คณิศรณ์', 'กลิ่นลำดวน', 'Kanison Klinlumduan', '1-1599-00375-40-5', 'MP02', 'pass'),
(106, 'วนาริน', 'สุขต่าย', 'Wanarin Way', '1-1996-00019-44-0', 'MP03', 'pass'),
(107, 'ณัฏฐนิชา', 'หวานฉ่ำ', 'นะ นะ', '1-1599-00408-81-8', 'MP04', 'pass'),
(108, 'ณัฐเดือน ', 'ชุ่มติ่ง', 'Nat Nat', '1-7399-00464-20-8', 'MP05', 'pass'),
(109, 'นพรดา', 'ทองกัญชร', 'Kamon Netd', '1-1002-00903-93-1', 'MP06', 'pass'),
(110, 'ปณิตา', 'รังกระโทก', 'Panita Rungkathok', '1-1499-00672-64-7', 'MP07', 'pass'),
(111, 'จิรภา', 'บุญขยาย', 'นุ่น จ๋า', '1-1499-00746-18-7', 'MP08', 'fail'),
(112, 'บุณยาพร', 'เดชบำรุง', 'หนึ่ง ซี่', '1-1599-00240-08-9', 'MP09', 'pass'),
(113, 'น้ำทิพย์ ', 'ข่ายทอง		', 'โดโซะ ซากุระ', '1-6206-00009-14-1', 'MP10', 'pass'),
(114, 'สุทธิลักษณ์', 'พงษ์ไพร', 'ปราง\'งง เยิ้ม\'มม', '1-1407-00056-36-7', 'MP11', 'pass'),
(115, 'อมรรัตน์', 'จุลเกตุ', 'Amornrat Junraket', '1-1506-00121-41-8', 'MP12', 'pass'),
(116, 'วราลี', 'พุทธิเดช', 'Varalee Phutthidet', '1-1506-00090-15-6		', 'MP13', 'pass'),
(117, 'รสสุคนธ์', 'คงแก้วมณี', 'รสสุคนธ์ คงแก้วมณี', '1-6003-00055-69-2		', 'MP14', 'wait'),
(118, 'ทิพวัลย์', 'สว่างศรี', 'Thipphawan Sawangsri', '1-7208-00132-75-2', 'MP15', 'pass'),
(119, 'ชลาลักษณ์ ', 'ภูนา', 'Chalalak Puna', '1-1042-00449-74-6		', 'MP16', 'fail'),
(120, 'ฐิติพร ', 'โพธิ์ศรีนาค', 'ชื่อ\'อ้อน', '1-1599-00477-21-6', 'MP17', 'pass'),
(121, 'จิราพัชร ', 'ชาวสกุล', 'Ploy Jirapat', '1-7299-00532-74-2		', 'MP18', 'fail'),
(122, 'วิไลวรรณ', 'วาดวิจิตต์', 'วิไลวรรณ วาดวิจิตต์', '1-1599-00191-06-1', 'MP19', 'pass'),
(123, 'วัชรมน', 'เฉกแสงทอง', 'Biw Watcharamon', '1-7299-00634-08-1', 'MP20', 'wait'),
(124, 'นภัทรประภา', 'เล็กคำ', 'นภัทรประภา\'าา', '1-1599-00495-65-6', 'MP21', 'pass'),
(125, 'อาภัสระ', 'บุบผาศรี', 'Aor Arpatsara', '1-1599-00411-97-5', 'MP22', 'wait'),
(126, 'พัชมณฑ์', 'คำนวนสกุณี', 'Phatchamon Comnonsakunee', '1-1599-00445-27-6', 'MP23', 'pass'),
(127, 'กมลวรรณ', 'กัลยานี', 'Kamonwan Kanlayani', '1-16790-00031-34-9', 'MP24', 'pass'),
(128, 'พุทธชาติ', 'ยอดเสาดี', 'กี กี้', '1-4507-00254-19-1', 'MP25', 'fail'),
(129, 'จันทร์เกษม', 'บุญประเสริฐ', 'Jankaseam Boonprasert', '1-1590-00000-83-9', 'MP26', 'pass'),
(130, 'ศิริวรรณ', 'เกาะแก้ว', 'Siriwan KaoKaew', '1-1599-00458-70-0', 'MP27', 'fail'),
(131, 'กนกทิพย์', 'อิ่มอารมณ์', 'Aome Vios		', '1-1015-00541-56-4		', 'MP28', 'two'),
(134, 'วาสนา', 'ชินพร', 'Drêam Lookthai', '1-1506-01166-70-9', 'MP29', 'fail'),
(135, 'ณัฐธิดา', 'มะสูงเนิน', 'Nut Cha', '1-1299-00141-26-9', 'MP30', 'two'),
(136, 'นัฐกชนันท์', 'สุริยวงษ์', 'ซ้อ\' น้ำตาล จัดว่าเด็ด', '1-1014-00827-99-7', 'MP31', 'pass'),
(137, 'น้ำส้ม', 'วงษ์ธรรม', 'ไม่ค้น พบ', '1-1406-00193-11-7', 'MP32', 'pass'),
(138, 'เครือทอง', 'น้อยพันธุ์', 'บ้ะ โบว์', '1-1599-00173-86-1', 'MP33', 'pass'),
(139, 'กัญญารัตน์', 'รักพันธ์', 'ต้า ซี๊ด.', '1-1483-00026-45-8', 'MP34', 'pass'),
(140, 'น้ำฝน', 'พิมพ์อักษร', 'Namfon Pimakson', '1-1590-00000-95-2', 'MP35', 'fail'),
(141, 'ณัฐสุดา ', 'สุริพล', 'พลอย พลอยจี๊ดจ๊าด', '1-1604-00059-67-1', 'MP36', 'fail'),
(143, 'ภคพร', 'แย้มนวม', 'กัส \'จ๋า', '1-1197-01138-48-9', 'MP37', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(500) NOT NULL,
  `image_data` longblob NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_records`
--
ALTER TABLE `address_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `fkuid1` (`uid`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`inid`),
  ADD KEY `fkuid3` (`uid`);

--
-- Indexes for table `recover`
--
ALTER TABLE `recover`
  ADD PRIMARY KEY (`recid`),
  ADD KEY `fkuid2` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fkuidim` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_records`
--
ALTER TABLE `address_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1039;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `inid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100036;

--
-- AUTO_INCREMENT for table `recover`
--
ALTER TABLE `recover`
  MODIFY `recid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10065;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_records`
--
ALTER TABLE `address_records`
  ADD CONSTRAINT `fkuid1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `installment`
--
ALTER TABLE `installment`
  ADD CONSTRAINT `fkuid3` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `recover`
--
ALTER TABLE `recover`
  ADD CONSTRAINT `fkuid2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `fkuidim` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
