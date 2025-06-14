-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2025 at 11:00 AM
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
-- Table structure for table `job_cards`
--

CREATE TABLE `job_cards` (
  `job_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `vehicles` varchar(255) DEFAULT NULL,
  `date_in` date NOT NULL,
  `date_out` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `service` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_cards`
--

INSERT INTO `job_cards` (`job_id`, `customer_name`, `vehicles`, `date_in`, `date_out`, `status`, `service`, `remarks`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'Toyota Camry - ABC 123', '2024-06-01', '2024-07-02', 'Completed', 'Oil Change', 'Customer requested synthetic oil. Filter also replaced.', 150.00, '2025-06-04 13:13:03', '2025-06-05 08:30:02'),
(2, 'Jane Smith', 'Honda Civic - XYZ 789', '2024-06-03', '2024-06-05', 'Completed', 'Brake Repair', 'Replaced front brake pads and rotors. Bled brake system.', 450.75, '2025-06-04 13:14:26', '2025-06-04 13:14:26'),
(3, 'Mike Brown', 'Ford Ranger - QWE 456', '2023-06-10', '2023-06-10', 'Completed', 'Tire Service', 'Rotated all four tires and balanced front two.', 80.00, '2025-06-03 13:14:38', '2025-06-05 08:47:42'),
(4, 'Sarah Lee', 'Mazda 3 - RTY 001', '2024-06-11', '2024-06-11', 'completed', 'Oil Change', 'Standard oil change.', 120.50, '2025-06-04 13:15:00', '2025-06-05 08:48:26'),
(5, 'David Wilson', 'Nissan Rogue - FGH 321', '2024-06-12', '2023-06-13', 'Completed', 'Engine Diagnostic', 'Customer reports rough idling. Check engine light is on.', 5.00, '2025-06-04 13:15:10', '2025-06-05 08:31:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_cards`
--
ALTER TABLE `job_cards`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_cards`
--
ALTER TABLE `job_cards`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
