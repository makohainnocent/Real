-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2022 at 02:21 PM
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
(5, 1, 'Kyanja Estate', 5, 'kyanja', 'fgdfgdgd', '2022-07-16 16:12:30'),
(6, 1, 'Semawata Estate', 7, 'ntinda', 'tytrytryrt', '2022-07-16 16:12:30'),
(7, 1, 'kyanjanja-estate', 9, 'kisasi', 'sample', '2022-07-16 16:12:30'),
(8, 1, 'kira estate', 7, 'kira', 'jkhjhjhvjhvh', '2022-07-16 16:12:30'),
(9, 1, 'Maganjo Estates', 7, 'maganjo', 'They look nice painted in white', '2022-07-16 16:12:30'),
(13, 1, 'kyambogo', 2, 'bcvbcv', 'vcbxcvbcvb', '2022-07-19 08:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `names` varchar(25) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `nin` varchar(25) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `user_id`, `names`, `contact`, `nin`, `bank`, `added`) VALUES
(2, 1, 'jerry', 7056, '232f', 454645645, '2022-07-19 10:36:13'),
(5, 1, 'Amon', 39435348, 'nbtn4b56n4565', 2147483647, '2022-07-19 10:36:13'),
(7, 1, 'percy', 705, '232', 214748364, '2022-07-19 10:36:13'),
(8, 1, 'michael', 7056, '232f', 6657876, '2022-07-19 10:36:13'),
(9, 1, 'danny', 7056, '4543', 34234234, '2022-07-19 10:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
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

INSERT INTO `receipts` (`id`, `user_id`, `amount`, `house_id`, `date`, `estate_id`, `payment_method`, `description`) VALUES
(1, 1, 20000, 1, '2022-05-28', 0, 'Cash', 'dsjfsdkfls'),
(2, 1, 200000, 1, '2022-05-24', 0, 'Cash', 'sdfsfdfsddf'),
(3, 1, 430000, 1, '2022-05-22', 10, 'Bank', 'hes mad'),
(4, 1, 320000, 2, '2022-05-30', 10, 'Mobile Money', 'just'),
(5, 1, 2000, 1, '2022-05-29', 10, 'Bank', 'hes mad'),
(6, 1, 2000, 1, '2022-05-29', 10, 'Bank', 'hes mad'),
(7, NULL, 6000, 1, '2022-05-31', 10, 'Cash', 'just'),
(8, 1, 60000000, 9, '2022-06-05', 10, 'Cash', 'sample'),
(9, NULL, 400000, 1, '2022-06-23', 10, 'Cash', 'just'),
(10, 1, 400000, 1, '0000-00-00', 10, 'Cash', 'just'),
(11, 1, 400000, 1, '2022-06-09', 10, 'Cash', 'samplekkk'),
(12, NULL, 0, 3, '2022-06-08', 10, 'Cash', ''),
(13, NULL, 250000, 1, '2022-06-12', 10, 'Cash', 'Paid half for the month of june'),
(14, NULL, 150000, 1, '2022-07-10', 10, 'Mobile Money', 'pingu'),
(15, 1, 990000, 8, '2022-07-10', 10, 'Cash', ',kkkll');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(25) DEFAULT NULL,
  `estate_id` int(11) DEFAULT NULL,
  `monthly_rent` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `entrance_date` date DEFAULT NULL,
  `last_receipt_date` date DEFAULT NULL,
  `last_notified_date` date DEFAULT NULL,
  `vacancy` tinyint(1) NOT NULL DEFAULT 0,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `unit_name`, `estate_id`, `monthly_rent`, `tenant_id`, `entrance_date`, `last_receipt_date`, `last_notified_date`, `vacancy`, `balance`) VALUES
(2, 'Home', 6, 320000, 7, '2022-07-10', '2022-05-30', '2022-07-19', 1, -2560000),
(3, 'jkhjhjk', 7, 78676868, 8, NULL, '2022-06-08', '2022-07-18', 1, -472061208),
(4, 'hahaha', 7, 12334, 3, NULL, NULL, NULL, 1, 0),
(5, 'qeqweqweqe', 8, 800000, 5, NULL, NULL, NULL, 1, 0),
(6, 'ddd', 8, 2147483647, 3, '2022-05-24', NULL, NULL, 1, 0),
(7, 'pingu', 9, 1111242, 5, NULL, NULL, NULL, 0, 0),
(8, 'dradooo', 6, 330000, 7, '2022-06-09', '2022-07-10', NULL, 1, 990000),
(9, 'serfsdfs', 5, 2147483647, 9, '2022-06-09', '2022-06-05', '2022-07-10', 1, -2147483648),
(10, 'Room1 test', 5, 500000, 8, '2022-06-11', NULL, NULL, 1, 0),
(11, 'kawempe', 5, 2000, NULL, NULL, NULL, NULL, 0, NULL),
(12, 'were', 5, 55555, 7, '2022-07-16', NULL, NULL, 1, NULL),
(13, 'dfvcx', 5, 20000, NULL, NULL, NULL, NULL, 0, NULL),
(14, 'cvbcvb', 5, 545454, NULL, NULL, NULL, NULL, 0, NULL),
(15, 'fdfs', 6, 33333, 3, '2022-07-20', NULL, NULL, 1, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
