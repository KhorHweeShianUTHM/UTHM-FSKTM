-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 10:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `ahk_workshop`

-- --------------------------------------------------------

-- Table structure for table `inventory`

CREATE TABLE `inventory` (
  `inventory_id` INT(50) NOT NULL ,
  `inventory_name` VARCHAR(100) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `sku` VARCHAR(50) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `stock` INT(255) NOT NULL,
  `status` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `inventory`

INSERT INTO `inventory` (`inventory_id`, `inventory_name`, `category`, `sku`, `price`, `stock`, `status`) VALUES
(1, 'Air Filter', 'Engine Components', 'AF-002', 45.00, 30, 'Low Stock'),
(2, 'Brake Pad', 'Brakes', 'BP-009', 120.00, 75, 'In Stock'),
(3, 'Oil Filter', 'Engine Components', 'OF-014', 35.00, 10, 'Low Stock'),
(4, 'Wiper Blade', 'Accessories', 'WB-007', 25.00, 90, 'In Stock'),
(5, 'Spark Plug', 'Engine Components', 'SP-005', 18.00, 50, 'In Stock'),
(6, 'Radiator Coolant', 'Fluids', 'RC-012', 55.00, 25, 'Low Stock'),
(7, 'Timing Belt', 'Engine Components', 'TB-030', 150.00, 40, 'In Stock'),
(8, 'Headlight Bulb', 'Electrical', 'HB-021', 35.00, 60, 'In Stock'),
(9, 'Fuel Pump', 'Fuel System', 'FP-008', 320.00, 15, 'Low Stock'),
(10, 'Battery Terminal', 'Electrical', 'BT-014', 22.00, 100, 'In Stock'),
(11, 'Alternator', 'Electrical', 'ALT-011', 480.00, 10, 'Low Stock'),
(12, 'Starter Motor', 'Electrical', 'STM-012', 320.00, 20, 'In Stock'),
(13, 'Brake Disc', 'Brakes', 'BD-013', 150.00, 35, 'In Stock'),
(14, 'Brake Caliper', 'Brakes', 'BC-014', 210.00, 15, 'Low Stock'),
(15, 'Radiator Hose', 'Cooling System', 'RH-015', 65.00, 40, 'In Stock'),
(16, 'Drive Belt', 'Engine Components', 'DB-016', 85.00, 50, 'In Stock'),
(17, 'Oil Pump', 'Engine Components', 'OP-017', 180.00, 25, 'Low Stock'),
(18, 'Fuel Injector', 'Fuel System', 'FI-018', 220.00, 30, 'In Stock'),
(19, 'Exhaust Muffler', 'Exhaust System', 'EM-019', 350.00, 12, 'Low Stock'),
(20, 'Wheel Rim', 'Suspension', 'WR-020', 500.00, 8, 'Low Stock'),
(21, 'Shock Absorber', 'Suspension', 'SA-021', 250.00, 30, 'In Stock'),
(22, 'Steering Pump', 'Steering System', 'SP-022', 280.00, 18, 'Low Stock'),
(23, 'Horn', 'Electrical', 'HR-023', 45.00, 60, 'In Stock'),
(24, 'Tail Lamp', 'Electrical', 'TL-024', 85.00, 35, 'In Stock'),
(25, 'Battery Charger', 'Accessories', 'BC-025', 95.00, 20, 'Low Stock'),
(26, 'Windshield Washer Pump', 'Accessories', 'WWP-026', 75.00, 28, 'In Stock'),
(27, 'Car Cover', 'Accessories', 'CC-027', 120.00, 15, 'Low Stock'),
(28, 'Dashboard Camera', 'Electronics', 'DC-028', 220.00, 10, 'Low Stock'),
(29, 'GPS Navigation', 'Electronics', 'GPS-029', 300.00, 12, 'Low Stock'),
(30, 'Brake Fluid', 'Fluids', 'BF-030', 35.00, 50, 'In Stock'),
(31, 'Transmission Fluid', 'Fluids', 'TF-031', 65.00, 40, 'In Stock'),
(32, 'Head Gasket', 'Engine Components', 'HG-032', 270.00, 20, 'Low Stock'),
(33, 'Turbocharger', 'Engine Components', 'TC-033', 1200.00, 5, 'Low Stock');

-- Indexes for table `inventory`
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

-- AUTO_INCREMENT for table `inventory`
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;