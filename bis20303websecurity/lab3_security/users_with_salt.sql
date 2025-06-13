-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 03:55 PM
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
-- Database: `lab3_security`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_with_salt`
--

CREATE TABLE `users_with_salt` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `password_hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_with_salt`
--

INSERT INTO `users_with_salt` (`id`, `username`, `salt`, `password_hash`) VALUES
(1, 'khor', 'd587bd173cc95b8485a568d414934e65', 'c3e294ca87d348fa9a3cbea99b639fb9b822f635702b1a034eaf3cf729aeb246'),
(2, 'ong', '71cc1226a354e95d4cc625580b7f70f2', 'c9d0d469f374909e2a5ffb73edaed577c181506f97f8bd18356b958bc4fe8e17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_with_salt`
--
ALTER TABLE `users_with_salt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_with_salt`
--
ALTER TABLE `users_with_salt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
