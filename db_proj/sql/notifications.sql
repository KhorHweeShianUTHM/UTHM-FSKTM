-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 03:07 PM
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
-- Database: `ahk_workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_status` tinyint(1) DEFAULT 0 COMMENT '0=unread, 1=read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `timestamp`, `read_status`) VALUES
(20, 'System Update Scheduled', 'A system update is scheduled for Sunday at 2 AM. Expect brief downtime.', '2025-05-27 07:54:31', 1),
(21, 'New Job Card Created', 'Job card #JC002 for Honda Accord has been created.', '2025-05-27 07:54:31', 1),
(22, 'Low Inventory Alert', 'Brake pads are below 5 units. Please reorder.', '2025-05-27 07:54:31', 1),
(23, 'Payment Received', 'Payment of $320.00 received for invoice #INV0035.', '2025-05-27 07:54:31', 1),
(24, 'System Update Scheduled', 'Maintenance will occur Saturday at 1 AM. Expect downtime.', '2025-05-27 07:54:31', 1),
(25, 'New Job Card Created', 'Job card #JC003 for Ford Ranger has been created.', '2025-05-27 07:54:31', 1),
(26, 'Low Inventory Alert', 'Air filters stock below threshold. Reorder now.', '2025-05-27 07:54:31', 1),
(27, 'Payment Received', 'Payment of $275.00 received for invoice #INV0036.', '2025-05-27 07:54:31', 1),
(28, 'System Update Scheduled', 'System optimization scheduled Monday at midnight.', '2025-05-27 07:54:31', 1),
(29, 'New Job Card Created', 'Job card #JC004 for Mazda CX-5 has been created.', '2025-05-27 07:54:31', 1),
(30, 'Low Inventory Alert', 'Coolant is running low. Replenish inventory.', '2025-05-27 07:54:31', 1),
(31, 'Payment Received', 'Payment of $180.00 received for invoice #INV0037.', '2025-05-27 07:54:31', 1),
(32, 'System Update Scheduled', 'Database patch scheduled Friday night.', '2025-05-27 07:54:31', 1),
(33, 'New Job Card Created', 'Job card #JC005 for Hyundai Sonata has been created.', '2025-05-27 07:54:31', 1),
(34, 'Low Inventory Alert', 'Transmission fluid below safety levels.', '2025-05-27 07:54:31', 1),
(35, 'Payment Received', 'Payment of $200.00 received for invoice #INV0038.', '2025-05-27 07:54:31', 1),
(36, 'System Update Scheduled', 'Security update this weekend.', '2025-05-27 07:54:31', 1),
(37, 'New Job Card Created', 'Job card #JC096 for Tesla Model Y has been created.', '2025-05-27 07:54:31', 1),
(38, 'Low Inventory Alert', 'Steering fluid low. Restock required.', '2025-05-27 07:54:31', 1),
(39, 'Payment Received', 'Payment of $480.00 received for invoice #INV0123.', '2025-05-27 07:54:31', 1),
(40, 'System Update Scheduled', 'Performance tuning on Tuesday at 3 AM.', '2025-05-27 07:54:31', 1),
(58, 'admin123 added a new customer', 'Customer record for no has been created. Contact: 0123456789, Vehicle: Proton Saga FLX, Plate: 012345677, Service: Servis Minyak Enjin, Last Visit: 2025-05-29.', '2025-05-27 12:59:59', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
