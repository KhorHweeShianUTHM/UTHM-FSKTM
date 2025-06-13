-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 05:04 PM
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
-- Database: `kangaroocare`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `card_number` varchar(19) DEFAULT NULL,
  `card_name` varchar(100) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `cw` varchar(4) DEFAULT NULL,
  `selected_package` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `card_type`, `card_number`, `card_name`, `expiry_date`, `cw`, `selected_package`, `total_price`, `user_id`) VALUES
(1, '', '', '', '0000-00-00', '', 'Basic', 500.00, 123),
(2, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(3, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(4, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(5, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(6, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(7, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(8, '', '', '', '0000-00-00', '', 'Premium', 800.00, 123),
(9, 'visa', '1234556778901111', '2', '0000-00-00', '22', 'Basic', 500.00, 123),
(10, 'mastercard', '1234567891234567', 'Gavin', '0000-00-00', '122', 'Premium', 800.00, 123),
(11, 'mastercard', '1234567891234567', 'Gavin', '0000-00-00', '122', 'Premium', 800.00, 123),
(12, 'mastercard', '1234567891234567', 'Gavin', '2025-12-01', '122', 'Premium', 800.00, 123),
(13, 'visa', '1234567856890123', 'tan', '2025-06-01', '123', 'Basic', 500.00, 123),
(14, 'mastercard', '1234567891234567', 'q', '2025-11-01', '123', 'Basic', 500.00, 123),
(15, 'mastercard', '1234567891234567', 'd', '2025-11-01', '123', 'Premium', 800.00, 123),
(16, 'mastercard', '1234567891234567', 'dg', '2025-11-01', '123', 'Premium', 800.00, 123),
(17, 'visa', '1234567891234567', 'Handsome', '2025-11-01', '123', 'Basic', 500.00, 123),
(18, 'mastercard', '1234567891234567', 'John', '2025-12-01', '123', 'Basic', 500.00, 123),
(19, 'mastercard', '1234567891234567', 'John', '2025-11-01', '123', 'Basic', 500.00, 123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
