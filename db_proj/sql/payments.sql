-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 06:23 PM
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
-- Database: `ahk_payments`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `fullname`, `method`, `status`, `amount`, `datetime`, `updated_at`) VALUES
(1, 'Ahmad Faizal', 'Cash', 'Paid', 300.00, '2025-06-10 14:38:18', '2025-06-11 00:07:24'),
(2, 'Peeta Mellark', 'Online Banking', 'Paid', 120.00, '2025-06-10 14:39:37', NULL),
(3, 'Katniss Everdeen', 'e-Wallet Boost', 'Paid', 570.00, '2025-06-10 14:40:20', '2025-06-11 00:06:57'),
(4, 'Haymitch Abernathy', 'e-Wallet Boost', 'Paid', 300.00, '2025-06-10 15:14:05', '2025-06-11 00:07:07'),
(5, 'Lenore Dove', 'e-Wallet TNG', 'Pending', 700.00, '2025-06-10 15:16:00', NULL),
(6, 'Finnick Ordair', 'e-Wallet GrabPay', 'Paid', 724.00, '2025-06-10 15:17:35', NULL),
(7, 'Annie Cresta', 'e-Wallet GrabPay', 'Paid', 570.50, '2025-06-10 15:32:16', NULL),
(8, 'Effie Trinket', 'Cash', 'Paid', 972.50, '2025-06-10 16:15:56', '2025-06-11 00:16:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
