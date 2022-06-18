-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 09:04 PM
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
-- Database: `real`
--

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

CREATE TABLE `estates` (
  `id` int(11) NOT NULL,
  `estate_name` varchar(25) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `location` varchar(25) NOT NULL,
  `details` varchar(50) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `estate_name`, `owner_id`, `location`, `details`, `added`) VALUES
(5, 'Kyanja Estate', 5, 'kyanja', 'fgdfgdgd', '2022-05-19 00:09:13'),
(6, 'Semawata Estate', 7, 'ntinda', 'tytrytryrt', '2022-05-19 00:08:41'),
(7, 'kyanjanja-estate', 9, 'kisasi', 'sample', '2022-06-05 15:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `names` varchar(25) NOT NULL,
  `contact` int(11) NOT NULL,
  `nin` varchar(25) NOT NULL,
  `bank` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `names`, `contact`, `nin`, `bank`, `added`) VALUES
(2, 'jerry', 7056, '232f', 454645645, '2022-05-12 02:39:22'),
(5, 'Amon', 39435348, 'nbtn4b56n4565', 2147483647, '2022-05-12 02:40:34'),
(7, 'percy', 705, '232', 214748364, '2022-05-18 23:52:53'),
(8, 'michael', 7056, '232f', 6657876, '2022-05-18 23:53:27'),
(9, 'danny', 7056, '4543', 34234234, '2022-05-18 23:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `estate_id` int(11) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `amount`, `house_id`, `date`, `estate_id`, `payment_method`, `description`) VALUES
(1, 20000, 1, '2022-05-28', 0, 'Cash', 'dsjfsdkfls'),
(2, 200000, 1, '2022-05-24', 0, 'Cash', 'sdfsfdfsddf'),
(3, 430000, 1, '2022-05-22', 10, 'Bank', 'hes mad'),
(4, 320000, 2, '2022-05-30', 10, 'Mobile Money', 'just'),
(5, 2000, 1, '2022-05-29', 10, 'Bank', 'hes mad'),
(6, 2000, 1, '2022-05-29', 10, 'Bank', 'hes mad'),
(7, 6000, 1, '2022-05-31', 10, 'Cash', 'just'),
(8, 60000000, 9, '2022-06-05', 10, 'Cash', 'sample'),
(9, 400000, 1, '2022-06-23', 10, 'Cash', 'just'),
(10, 400000, 1, '0000-00-00', 10, 'Cash', 'just'),
(11, 400000, 1, '2022-06-09', 10, 'Cash', 'samplekkk'),
(12, 0, 3, '2022-06-08', 10, 'Cash', ''),
(13, 250000, 1, '2022-06-12', 10, 'Cash', 'Paid half for the month of june');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(25) NOT NULL,
  `estate_id` int(11) NOT NULL,
  `monthly_rent` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `entrance_date` date DEFAULT NULL,
  `last_receipt_date` date DEFAULT NULL,
  `last_notified_date` date DEFAULT NULL,
  `vacancy` tinyint(1) NOT NULL DEFAULT 0,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `unit_name`, `estate_id`, `monthly_rent`, `tenant_id`, `entrance_date`, `last_receipt_date`, `last_notified_date`, `vacancy`, `balance`) VALUES
(1, 'qqq', 10, 400000, 8, '2022-05-01', '2022-06-12', '2022-06-12', 1, -150000),
(2, 'Home', 10, 320000, 4, '2022-05-24', '2022-05-30', NULL, 1, 0),
(3, 'jkhjhjk', 10, 78676868, 8, NULL, '2022-06-08', NULL, 1, 0),
(4, 'hahaha', 10, 12334, 3, NULL, NULL, NULL, 1, 0),
(5, 'qeqweqweqe', 10, 800000, 5, NULL, NULL, NULL, 1, 0),
(6, 'ddd', 10, 2147483647, 3, '2022-05-24', NULL, NULL, 1, 0),
(7, 'pingu', 10, 1111242, 5, NULL, NULL, NULL, 1, 0),
(8, 'dradooo', 10, 330000, 7, '2022-06-09', NULL, NULL, 1, 0),
(9, 'serfsdfs', 10, 2147483647, 9, '2022-06-09', '2022-06-05', NULL, 1, 60000000),
(10, 'Room1 test', 10, 500000, 8, '2022-06-11', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `names` varchar(25) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `nin` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `names`, `contact`, `nin`) VALUES
(3, 'John', '07056', '232f'),
(4, 'Jane', '07056', '232f'),
(5, 'Danny', '07056', '1111'),
(7, 'amon', '07056', '4564564564'),
(8, 'Inno', '07056', '232f'),
(9, 'percy michael', '07056', '465676876978');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estates`
--
ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
