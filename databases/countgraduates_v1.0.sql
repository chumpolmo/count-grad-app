-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 09:20 AM
-- Server version: 8.0.40
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `countgraduates`
--

-- --------------------------------------------------------

--
-- Table structure for table `cga_ceremony_seq`
--

CREATE TABLE `cga_ceremony_seq` (
  `ces_id` int NOT NULL,
  `ces_order` int DEFAULT NULL,
  `ces_title` varchar(200) DEFAULT NULL,
  `ces_numOfCert` int DEFAULT NULL,
  `ces_status` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cga_ceremony_seq`
--

INSERT INTO `cga_ceremony_seq` (`ces_id`, `ces_order`, `ces_title`, `ces_numOfCert`, `ces_status`) VALUES
(1, 1, 'บัณฑิตเริ่มเดินเข้าหอประชุม', 0, 10),
(2, 2, 'นายยกสภากล่าวรายงาน', 0, 10),
(3, 3, 'อธิการบดีกล่าวรายงานเบิกบัณฑิตกิตติมศักดิ์', 0, 10),
(4, 4, 'เริ่มรับพระราชทานปริญญาบัตร', 0, 10),
(5, 5, 'บัณฑิตกิตติมศักดิ์', 5, 10),
(6, 6, 'คณบดีคณะศิลปกรรมฯ เบิกบัณฑิต', 0, 10),
(7, 7, 'อาจารย์คนที่ 1', 45, 10),
(8, 8, 'อาจารย์คนที่ 2', 53, 10),
(9, 9, 'คณบดีคณะวิทย์ฯเบิกบัณฑิต', 0, 10),
(10, 10, 'อาจารย์คนที่ 1', 22, 10),
(11, 11, 'อาจารย์คนที่ 2', 68, 10),
(12, 12, 'คณบดีคณะวิศวกรรมเบิกบัณฑิต', 0, 10),
(13, 13, 'อาจารย์คนที่ 1', 60, 10),
(14, 14, 'อาจารย์คนที่ 2', 170, 10),
(15, 15, 'อาจารย์คนที่ 3', 140, 10),
(16, 16, 'อาจารย์คนที่ 4', 121, 10),
(17, 17, 'พักเบรค', 0, 10),
(18, 18, 'คณบดีคณะบริหารฯเบิกบัณฑิต', 0, 10),
(19, 19, 'อาจารย์คนที่ 1', 71, 10),
(20, 20, 'อาจารย์คนที่ 2', 135, 10),
(21, 21, 'อาจารย์คนที่ 3', 135, 10),
(22, 22, 'อาจารย์คนที่ 4', 130, 10),
(23, 23, 'อาจารย์คนที่ 5', 86, 10),
(24, 24, 'อาจารย์คนที่ 6', 93, 10),
(25, 25, 'เบิกบัณฑิตรับเหรียญ', 0, 10),
(26, 26, 'บัณฑิตรับเหรียญ', 0, 10),
(27, 27, 'บัณฑิตกล่าวปฏิญาณตน', 0, 10),
(28, 28, 'ให้โอวาส', 0, 10),
(29, 29, 'ลาพระและออกจากหอประชุม', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cga_practice_record`
--

CREATE TABLE `cga_practice_record` (
  `prr_id` int NOT NULL,
  `ces_id` int DEFAULT NULL,
  `prt_id` int DEFAULT NULL,
  `prr_time_start` time DEFAULT NULL,
  `prr_time_end` time DEFAULT NULL,
  `prr_time_total` double DEFAULT NULL,
  `prr_speed_per_min` double DEFAULT NULL,
  `prr_result` tinyint DEFAULT NULL,
  `prr_counting` int DEFAULT NULL,
  `prr_note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cga_practice_record`
--

INSERT INTO `cga_practice_record` (`prr_id`, `ces_id`, `prt_id`, `prr_time_start`, `prr_time_end`, `prr_time_total`, `prr_speed_per_min`, `prr_result`, `prr_counting`, `prr_note`) VALUES
(1509, 1, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1510, 2, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1511, 3, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1512, 4, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1513, 5, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1514, 6, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1515, 7, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1516, 8, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1517, 9, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1518, 10, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1519, 11, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1520, 12, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1521, 13, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1522, 14, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1523, 15, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1524, 16, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1525, 17, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1526, 18, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1527, 19, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1528, 20, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1529, 21, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1530, 22, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1531, 23, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1532, 24, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1533, 25, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1534, 26, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1535, 27, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1536, 28, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1537, 29, 56, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1683, 1, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1684, 2, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1685, 3, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1686, 4, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1687, 5, 62, '11:05:41', '11:05:53', 12, 30, 20, 6, ''),
(1688, 6, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1689, 7, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1690, 8, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1691, 9, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1692, 10, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1693, 11, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1694, 12, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1695, 13, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1696, 14, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1697, 15, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1698, 16, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1699, 17, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1700, 18, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1701, 19, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1702, 20, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1703, 21, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1704, 22, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1705, 23, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1706, 24, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1707, 25, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1708, 26, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1709, 27, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1710, 28, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1711, 29, 62, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1741, 1, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1742, 2, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1743, 3, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1744, 4, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1745, 5, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1746, 6, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1747, 7, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1748, 8, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1749, 9, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1750, 10, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1751, 11, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1752, 12, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1753, 13, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1754, 14, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1755, 15, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1756, 16, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1757, 17, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1758, 18, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1759, 19, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1760, 20, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1761, 21, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1762, 22, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1763, 23, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1764, 24, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1765, 25, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1766, 26, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1767, 27, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1768, 28, 64, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(1769, 29, 64, '11:37:42', '11:37:48', 0, 0, 0, 0, ''),
(2002, 1, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2003, 2, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2004, 3, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2005, 4, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2006, 5, 73, '13:55:47', '13:56:01', 14, 25.71, 20, 6, ''),
(2007, 6, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2008, 7, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2009, 8, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2010, 9, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2011, 10, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2012, 11, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2013, 12, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2014, 13, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2015, 14, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2016, 15, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2017, 16, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2018, 17, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2019, 18, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2020, 19, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2021, 20, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2022, 21, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2023, 22, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2024, 23, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2025, 24, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2026, 25, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2027, 26, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2028, 27, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2029, 28, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2030, 29, 73, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2031, 1, 74, '11:17:39', '11:17:58', 0, 0, 0, 15, ''),
(2032, 2, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2033, 3, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2034, 4, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2035, 5, 74, '11:18:07', '11:18:28', 21, 42.86, 20, 15, ''),
(2036, 6, 74, '11:19:31', '11:19:37', 0, 0, 0, 0, ''),
(2037, 7, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2038, 8, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2039, 9, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2040, 10, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2041, 11, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2042, 12, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2043, 13, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2044, 14, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2045, 15, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2046, 16, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2047, 17, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2048, 18, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2049, 19, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2050, 20, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2051, 21, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2052, 22, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2053, 23, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2054, 24, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2055, 25, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2056, 26, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2057, 27, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2058, 28, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, ''),
(2059, 29, 74, '00:00:00', '00:00:00', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `cga_practice_time`
--

CREATE TABLE `cga_practice_time` (
  `prt_id` int NOT NULL,
  `prt_date` date DEFAULT NULL,
  `prt_time` tinyint DEFAULT NULL,
  `prt_status` tinyint DEFAULT NULL,
  `prt_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cga_practice_time`
--

INSERT INTO `cga_practice_time` (`prt_id`, `prt_date`, `prt_time`, `prt_status`, `prt_added`) VALUES
(56, '2024-11-05', 3, 10, NULL),
(62, '2024-11-06', 1, 20, NULL),
(64, '2024-11-06', 2, 20, '2024-11-06 05:37:31'),
(73, '2024-11-06', 3, 20, '2024-11-06 01:54:56'),
(74, '2024-11-24', 1, 20, '2024-11-11 11:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `cga_settings`
--

CREATE TABLE `cga_settings` (
  `set_id` int NOT NULL,
  `set_name` varchar(100) DEFAULT NULL,
  `set_value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cga_settings`
--

INSERT INTO `cga_settings` (`set_id`, `set_name`, `set_value`) VALUES
(1, 'numOfStud', '28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cga_ceremony_seq`
--
ALTER TABLE `cga_ceremony_seq`
  ADD PRIMARY KEY (`ces_id`);

--
-- Indexes for table `cga_practice_record`
--
ALTER TABLE `cga_practice_record`
  ADD PRIMARY KEY (`prr_id`);

--
-- Indexes for table `cga_practice_time`
--
ALTER TABLE `cga_practice_time`
  ADD PRIMARY KEY (`prt_id`);

--
-- Indexes for table `cga_settings`
--
ALTER TABLE `cga_settings`
  ADD PRIMARY KEY (`set_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cga_ceremony_seq`
--
ALTER TABLE `cga_ceremony_seq`
  MODIFY `ces_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cga_practice_record`
--
ALTER TABLE `cga_practice_record`
  MODIFY `prr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2060;

--
-- AUTO_INCREMENT for table `cga_practice_time`
--
ALTER TABLE `cga_practice_time`
  MODIFY `prt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
