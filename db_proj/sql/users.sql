-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 03:18 PM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `plate_number` varchar(50) NOT NULL,
  `service` text NOT NULL,
  `last_visit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `contact`, `vehicle`, `plate_number`, `service`, `last_visit`) VALUES
(1, 'Masidah Sinto', '0123456789', 'Perodua Myvi 1.5 SE', 'WXD 1234', 'Pemeriksaan Bateri', '2025-05-20'),
(2, 'Siti Aminah', '0139876543', 'Proton Saga FLX', 'ABC 5678', 'Servis Minyak Enjin', '2025-05-22'),
(3, 'Mohd Hafiz', '0147654321', 'Toyota Vios', 'DEF 9012', 'Penukaran Tayar', '2025-05-18'),
(4, 'Nurul Aisyah', '0111122334', 'Honda City', 'GHI 3456', 'Pemeriksaan Brek', '2025-05-23'),
(5, 'Zulkifli Ismail', '0166677885', 'Perodua Bezza', 'JKL 7890', 'Penyelenggaraan Berkala', '2025-05-19'),
(6, 'Aisyah Ramli', '0199988776', 'Honda Civic', 'MNO 3456', 'Servis Minyak Enjin', '2025-05-21'),
(7, 'Farid Zainal', '0171234567', 'Toyota Hilux', 'PQR 7890', 'Penukaran Tayar', '2025-05-15'),
(8, 'Lina Mariam', '0143344556', 'Perodua Axia', 'STU 1234', 'Pemeriksaan Brek', '2025-05-17'),
(9, 'Ahmad Shafiq', '0135566778', 'Proton Persona', 'VWX 5678', 'Pemeriksaan Bateri', '2025-05-16'),
(10, 'Norain Ismail', '0129988776', 'Mazda CX-5', 'YZA 9012', 'Penyelenggaraan Berkala', '2025-05-14'),
(11, 'Hasbullah Rahman', '0198877665', 'Nissan Almera', 'BCD 3456', 'Servis Minyak Enjin', '2025-05-13'),
(12, 'Suhaila Mazlan', '0187766554', 'Perodua Myvi', 'EFG 7890', 'Penukaran Tayar', '2025-05-12'),
(13, 'Azman Hashim', '0176655443', 'Honda Jazz', 'HIJ 1234', 'Pemeriksaan Brek', '2025-05-11'),
(14, 'Maya Syafiqah', '0165544332', 'Toyota Camry', 'KLM 5678', 'Pemeriksaan Bateri', '2025-05-10'),
(15, 'Razak Ahmad', '0154433221', 'Proton Exora', 'NOP 9012', 'Penyelenggaraan Berkala', '2025-05-09'),
(16, 'Sarah Liyana', '0143322110', 'Perodua Alza', 'QRS 3456', 'Servis Minyak Enjin', '2025-05-08'),
(17, 'Hakim Iskandar', '0132211009', 'Honda Accord', 'TUV 7890', 'Penukaran Tayar', '2025-05-07'),
(18, 'Nur Hazwani', '0121100998', 'Toyota Yaris', 'WXY 1234', 'Pemeriksaan Brek', '2025-05-06'),
(19, 'Imran Zulkifli', '0190099887', 'Perodua Myvi', 'ZAB 5678', 'Pemeriksaan Bateri', '2025-05-05'),
(20, 'Siti Norhaliza', '0189988776', 'Proton Wira', 'CDE 9012', 'Penyelenggaraan Berkala', '2025-05-04'),
(21, 'Ahmad Khairi', '0178877665', 'Honda CR-V', 'FGH 3456', 'Servis Minyak Enjin', '2025-05-03'),
(22, 'Fatin Amani', '0167766554', 'Toyota Avanza', 'IJK 7890', 'Penukaran Tayar', '2025-05-02'),
(23, 'Zainab Hamid', '0156655443', 'Perodua Myvi', 'LMN 1234', 'Pemeriksaan Brek', '2025-05-01'),
(24, 'Roslan Ghani', '0145544332', 'Proton Iriz', 'OPQ 5678', 'Pemeriksaan Bateri', '2025-04-30'),
(25, 'Sharifah Nadia', '0134433221', 'Honda BR-V', 'RST 9012', 'Penyelenggaraan Berkala', '2025-04-29'),
(26, 'Faizal Rahman', '0123322110', 'Toyota Fortuner', 'UVW 3456', 'Servis Minyak Enjin', '2025-04-28'),
(27, 'Hani Zulaikha', '0192211009', 'Perodua Myvi', 'XYZ 7890', 'Penukaran Tayar', '2025-04-27'),
(28, 'Rizal Ahmad', '0181100998', 'Proton Saga', 'ABC 1234', 'Pemeriksaan Brek', '2025-04-26'),
(29, 'Suhana Jamil', '0170099887', 'Honda City', 'DEF 5678', 'Pemeriksaan Bateri', '2025-04-25'),
(30, 'Hasnah Ismail', '0169988776', 'Toyota Vios', 'GHI 9012', 'Penyelenggaraan Berkala', '2025-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(4, 'haziqah', 'haziqahliyana71@gmail.com', '$2y$10$FDn4wc6awvc5OEerLwOy6uvx4RSi2z9gN0uiHOSoYpWueQq2kkbTe'),
(5, 'haziqah', 'di230103@student.uthm.edu.my', '$2y$10$I91IDDny0Y0ZfcjxX8CkH.Pk.T5LBikVsNSlWQUyWigCPj4/lpgfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
