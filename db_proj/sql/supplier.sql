-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 01:55 PM
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
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `contact_person`, `email`, `phone`, `category`, `created_at`, `updated_at`) VALUES
(15, 'ABC Supplies', 'John Doe', 'john.doe@abc.com', '0123456789', 'Electronics', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(16, 'Best Foods', 'Mary Jane', 'mary.jane@bestfoods.my', '0198765432', 'Food & Beverages', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(17, 'Tech Solutions', 'Alice Tan', 'alice.tan@techsolutions.com', '0112233445', 'IT Services', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(18, 'Green Farms', 'Peter Lim', 'peter.lim@greenfarms.my', '0171122334', 'Agriculture', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(19, 'OfficeMart', 'Siti Nur', 'siti.nur@officemart.com', '0109988776', 'Office Supplies', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(20, 'Speedy Logistics', 'David Lee', 'david.lee@speedylogistics.com', '0134455667', 'Logistics', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(21, 'CleanPro', 'Amir Hassan', 'amir.hassan@cleanpro.my', '0185566778', 'Cleaning Services', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(22, 'BuildRight', 'Raj Kumar', 'raj.kumar@buildright.com', '0143344556', 'Construction', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(23, 'Fashion Hub', 'Linda Wong', 'linda.wong@fashionhub.com', '0167788990', 'Apparel', '2025-05-30 11:34:22', '2025-05-30 11:34:22'),
(24, 'MediCare', 'Nurul Aisyah', 'nurul.aisyah@medicare.my', '0121122334', 'Healthcare', '2025-05-30 11:34:22', '2025-05-30 11:34:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
