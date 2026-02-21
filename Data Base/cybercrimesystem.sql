-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 07:53 AM
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
-- Database: `cybercrimesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case`
--

CREATE TABLE `tbl_case` (
  `case_id` int(6) NOT NULL,
  `login_id` int(6) NOT NULL,
  `station_id` int(6) NOT NULL,
  `category` varchar(50) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `description` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case`
--

INSERT INTO `tbl_case` (`case_id`, `login_id`, `station_id`, `category`, `date`, `time`, `description`) VALUES
(51, 40, 28, 'x56wfnOpLEH58q/i5M4vgQiZnqDcL6MT6N3gLQ/6RLs=', 'QLRobNGw1VcIWdPaUM2Cbg==', 'pZrcFb9sdft7/P4GTha/3Q==', 'Ihkx&Jklktyk&Yyzks&oy&jkyomtkj&zu&nkrv&otjo|oj{gry&xkvuxz&ihkx&ixosky&w{oiqr&gtj&klloioktzr4Xkvuxzy&gxk&joxkizkj&zu&znk&tkgxkyz&vuroik&yzgzouty2&kty{xotm&vxusvz&gizout4&[ykxy&igt&zxgiq&znk&yzgz{y&ul&znkox&igyky&otxkgr3zosk2&vxu|ojotm&zxgtyvgxkti&gtj&vkgik&ul&sotj4&U{x&mugr&oy&zu&vxu|ojk&g&yki{xk&gtj&yzxkgsrotkj&vxuikyy&lux&ngtjrotmihkx&ixosk&otiojktzy2&iuttkizotm&iozo?kty&joxkizr&}ozn&rg}&ktluxiksktz&gmktioky&jkjoigzkj&zu&iushgzotm&utrotk&znxkgzy4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_casestatus`
--

CREATE TABLE `tbl_casestatus` (
  `slno` int(11) NOT NULL,
  `case_id` int(6) NOT NULL,
  `station_id` int(6) NOT NULL,
  `filing_date` varchar(100) NOT NULL,
  `current_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_casestatus`
--

INSERT INTO `tbl_casestatus` (`slno`, `case_id`, `station_id`, `filing_date`, `current_status`) VALUES
(23, 51, 28, '2024-10-11 23:53:34', 'NYbwpauRE/SKK5QrIwmc2A==');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(6) NOT NULL,
  `state_id` int(6) NOT NULL,
  `district_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `state_id`, `district_name`) VALUES
(24, 20, 'pomsg8v0uNJhsuq82Q6QSA=='),
(25, 24, 'xa1Qn9mdsnIQSEB+QwGlmQ=='),
(26, 24, '+667zXqVr0jhqORuxINNNA=='),
(27, 24, 'aKFh64c0uGxVnQ2778kzGA==');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(6) NOT NULL,
  `usertype_id` int(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `usertype_id`, `username`, `password`) VALUES
(20, 3, 'i5spfK2bsgnCtT1L74T25w==', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d'),
(39, 2, '5BVnISQk5nLmMRZpD0Tmow==', '84a516841ba77a5b4648de2cd0dfcb30ea46dbb4'),
(40, 3, 'rtrfdny1x5XlmUfBa6tH7Q==', '0d950b17080ee9846b572b451a7c9a40d687c01c'),
(41, 2, 'bpZNqIAxegJeyq6+Ljx8Yg==', 'd0aaab75800fa4e51005a7fd3181a9caf64bdbb1'),
(42, 2, 'xqgoCr+5blQt6oleqG+VUw==', 'b220ee2eb110e04999d6aaa434a9d965cd98a2e3'),
(43, 2, 'oSukC9fVO5HaZ3FSpRwHyA==', 'cef9ae7b75fc545c174d262138b017424b1308c1'),
(44, 1, 'pA8VZ6qih9OHIKB3i+hEuw==', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_policestation`
--

CREATE TABLE `tbl_policestation` (
  `station_id` int(6) NOT NULL,
  `login_id` int(6) NOT NULL,
  `district_id` int(6) NOT NULL,
  `state_id` int(6) NOT NULL,
  `station_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_policestation`
--

INSERT INTO `tbl_policestation` (`station_id`, `login_id`, `district_id`, `state_id`, `station_name`) VALUES
(27, 39, 24, 20, 'VrY2SMMUzLzpiDHEzG9V4g=='),
(28, 41, 25, 24, 'Qd0qqVN1jqdbF/lHj6HTxg=='),
(29, 42, 25, 24, 'AUVgiooFyY0Wkdkek0/Emw=='),
(30, 43, 25, 24, '4Lq/dPpsxVJoRu4u4lHMyA==');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

CREATE TABLE `tbl_register` (
  `register_id` int(6) NOT NULL,
  `login_id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`register_id`, `login_id`, `name`, `dob`, `email`, `mobile`, `address`) VALUES
(20, 20, 'rtrfdny1x5XlmUfBa6tH7Q==', 'D1uDOUMA+OnMcHvw+DHf3w==', '0jtF2BOGc522w1cMcSXfQ48K4wID4cP78WEn83YAxMU=', 'OBC45aeSU0CQygeWlIuZnw==', 'tnM1pCvDI94PrcNKW14zIA=='),
(21, 40, 'eG5S+5pM2qxt1meVwOUHVi4qZqf6wAkgPIQWT7oZ0so=', 'CgeMRmfsp/J4H6tIHsYvRg==', 'bb0st8In68IB8kSXwCGmgQ==', 'ZuN58iIbDDgr0vlN0d6+OQ==', 'hcManGa3UYw6lLOPsMk0PCNblOARz0ENwsbwXLbDNk4YFXIAdnvCH1MXdYbpCuY3zSwNES8DGuioR7nQO32mhjfQwI9MtwBXKpOTSjT4SgQ=');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(6) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`) VALUES
(20, '3DAXUDvH0rqJmuui8wUDfw=='),
(24, 'W9/AlzzcloRWT1lSL3JdNg=='),
(25, 'CjDeruDB21Qwhkbt8TCisg==');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_statusupdates`
--

CREATE TABLE `tbl_statusupdates` (
  `slno` int(6) NOT NULL,
  `case_id` int(6) NOT NULL,
  `status` varchar(255) NOT NULL,
  `timestamp` varchar(100) NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_statusupdates`
--

INSERT INTO `tbl_statusupdates` (`slno`, `case_id`, `status`, `timestamp`, `view`) VALUES
(78, 51, 'FFE7yiziwAasf5EzEUATtw==', '2024-10-11 23:53:34', 1),
(79, 51, 'XJS+vTrtGoZi1YF3ldmcf1tD7IiV2lQDJmP42+ynawo=', '2024-10-11 23:55:59', 1),
(80, 51, 'L+BjWVdlW6Lkcj3pgrvfpnoAEnHgzQdSDLHn36sOrKc=', '2024-10-12 00:56:43', 1),
(81, 51, 't4eZY/njCV37nAGy87/13i8ztguYHIm92MfaDQ2NQ/U=', '2024-10-12 00:57:11', 1),
(82, 51, 'j4w73+IU5qHe8EHJlw60JP+2iIV/jq88iVsl+A7ET/E=', '2024-10-22 10:09:03', 1),
(83, 51, 'NYbwpauRE/SKK5QrIwmc2A==', '2024-11-11 10:49:32', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_case`
--
ALTER TABLE `tbl_case`
  ADD PRIMARY KEY (`case_id`);

--
-- Indexes for table `tbl_casestatus`
--
ALTER TABLE `tbl_casestatus`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_policestation`
--
ALTER TABLE `tbl_policestation`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `tbl_register`
--
ALTER TABLE `tbl_register`
  ADD PRIMARY KEY (`register_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_statusupdates`
--
ALTER TABLE `tbl_statusupdates`
  ADD PRIMARY KEY (`slno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_case`
--
ALTER TABLE `tbl_case`
  MODIFY `case_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_casestatus`
--
ALTER TABLE `tbl_casestatus`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_policestation`
--
ALTER TABLE `tbl_policestation`
  MODIFY `station_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_register`
--
ALTER TABLE `tbl_register`
  MODIFY `register_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_statusupdates`
--
ALTER TABLE `tbl_statusupdates`
  MODIFY `slno` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
