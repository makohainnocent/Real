-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2022 at 04:54 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
  `user_id` int(11) NOT NULL,
  `estate_name` varchar(25) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `location` varchar(25) NOT NULL,
  `details` varchar(50) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `user_id`, `estate_name`, `owner_id`, `location`, `details`, `added`) VALUES
(5, 1, 'Kyanja Estate', 2, 'kyanja', 'fgdfgdgd', '2022-08-05 09:59:09'),
(6, 1, 'Semawata Estate', 5, 'ntinda', 'tytrytryrt', '2022-08-05 11:46:47'),
(7, 1, 'kasese Estate', 8, 'kisasi', 'sample', '2022-08-05 14:02:17'),
(8, 1, 'kira estate', 7, 'kira', 'jkhjhjhvjhvh', '2022-07-16 16:12:30'),
(9, 1, 'Maganjo Estates', 7, 'maganjo', 'They look nice painted in white', '2022-07-16 16:12:30'),
(13, 1, 'kyambogo Estate', 2, 'bcvbcv', 'vcbxcvbcvb', '2022-08-05 14:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `names` varchar(25) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `nin` varchar(25) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `user_id`, `names`, `contact`, `nin`, `bank`, `added`) VALUES
(2, 1, 'jerry', '7056', '232f', '454645645', '2022-07-19 10:36:13'),
(5, 1, 'Amon', '39435348', 'nbtn4b56n4565', '2147483647', '2022-07-19 10:36:13'),
(7, 1, 'percy', '705', '232', '214748364', '2022-07-19 10:36:13'),
(8, 1, 'michael', '1111111', '232f', '6657876', '2022-07-21 14:33:27'),
(13, 1, 'percy thedon', '0765765', 'cmrrtrt0009', '34343343', '2022-07-21 14:23:36'),
(14, 2, 'MASTER DON', 'dfg', 'dfg', 'dfgdfgd', '2022-07-21 14:29:28'),
(15, 1, 'MASTER DON', 'percymichael0@gmail', '234234', '23432', '2022-07-26 07:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `house_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `estate_id` int(11) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `user_id`, `amount`, `balance`, `house_id`, `date`, `estate_id`, `payment_method`, `description`) VALUES
(31, NULL, 12000, NULL, 27, '2022-08-05', 5, 'Cash', 'dsafsdfsdfa'),
(32, NULL, 12000, NULL, 28, '2022-08-05', 5, 'Cash', 'dsafsdfsdfa'),
(33, NULL, 12000, NULL, 29, '2022-08-05', 5, 'Cash', 'dsafsdfsdfa'),
(34, NULL, 12000, NULL, 30, '2022-08-05', 5, 'Cash', 'dsafsdfsdfa'),
(35, NULL, 12000, NULL, 31, '2022-08-05', 5, 'Cash', 'dsafsdfsdfa');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unit_name` varchar(25) DEFAULT NULL,
  `estate_id` int(11) DEFAULT NULL,
  `monthly_rent` int(11) DEFAULT NULL,
  `tenant_id` bigint(100) DEFAULT NULL,
  `entrance_date` date DEFAULT NULL,
  `last_receipt_date` date DEFAULT NULL,
  `last_notified_date` date DEFAULT NULL,
  `vacancy` tinyint(1) NOT NULL DEFAULT 0,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `user_id`, `unit_name`, `estate_id`, `monthly_rent`, `tenant_id`, `entrance_date`, `last_receipt_date`, `last_notified_date`, `vacancy`, `balance`) VALUES
(27, NULL, 'room4', 5, 430000, 16, '2022-08-06', '2022-08-05', NULL, 1, NULL),
(28, NULL, 'room1', 5, 30000, 13, '2022-08-05', '2022-08-05', NULL, 1, NULL),
(29, 1, 'room2', 5, 340000, 14, '2022-08-05', '2022-08-05', NULL, 1, NULL),
(30, 1, 'room5', 5, 450000, 15, '2022-08-05', '2022-08-05', NULL, 1, NULL),
(31, 1, 'room3', 5, 123000, 17, '2022-08-05', '2022-08-05', NULL, 1, NULL),
(32, 1, 'fdsf', 6, 100000, NULL, NULL, NULL, NULL, 0, NULL),
(33, 1, 'kama1', 9, 200000, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `names` varchar(25) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `nin` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `user_id`, `names`, `contact`, `nin`) VALUES
(4, 1, 'Jane', '07056', '232f'),
(5, NULL, 'Danny', '07056', '1111'),
(7, NULL, 'amon', '07056', '4564564564'),
(8, NULL, 'Inno', '07056', '232f'),
(9, NULL, 'percy michael', '07056', '465676876978'),
(10, NULL, 'fdgd', 'fdgdgdg', 'gdfgd'),
(11, NULL, 'MASTER DON', 'dfgds', 'dfgdf'),
(13, 1, 'percy thedon', '2222', '34543'),
(14, 1, 'JOHN', '1111', '2233'),
(15, 1, 'TED', '12222', '1222'),
(16, 1, 'QWERT', '223', '33444'),
(17, 1, 'YOUN5', '345646', '67567');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `details` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_name`, `address`, `details`, `email`, `password`) VALUES
(1, 'Ntinda Properties', 'Ntinda,Kampala', 'We do this real good', 'percymichael0@gmail.com', 'percy06312'),
(2, 'Najera consult', 'Najera,Kampala', 'We do this real good', 'percy@dizayn.ug', 'pingu06312');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete` (`house_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `delete` FOREIGN KEY (`house_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
