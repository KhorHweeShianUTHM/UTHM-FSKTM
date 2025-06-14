-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 09:50 PM
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
-- Table structure for table `ahk_users`
--

CREATE TABLE `ahk_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ahk_users`
--

INSERT INTO `ahk_users` (`user_id`, `full_name`, `email`, `password`, `role`) VALUES
(11, 'Ahmad Faizal', 'ahmadfaizal@gmail.com', '$2y$10$RUQroAJeA6tHaqad8WwafeyfiXUtHD7WXF0DkV.jXd6mgcOqJOzkC', 'staff'),
(13, 'Peeta Mellark', 'pettamellark@gmail.com', '$2y$10$/Ib/NjFTkfgbpkGdwSlSKOklaZcz6/gKr8YE3H/OtNsnRqKRoAGHa', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahk_users`
--
ALTER TABLE `ahk_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ahk_users`
--
ALTER TABLE `ahk_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
