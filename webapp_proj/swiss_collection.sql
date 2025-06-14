-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 09:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swiss_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `email`, `password`, `is_admin`, `first_name`, `last_name`, `position`) VALUES
(31, 'tanguimei2812@gmail.com', '$2y$10$TO0o.wySImHs2KWSqF5DoO/LYq7l8XScKc.IR/JhGSfl1Nmq0gN22', 1, 'Tan', 'Gui Mei', 'Admin'),
(33, 'Jeniffer0606@gmail.com', '$2y$10$OWhE98MbXa7RKSRY/q2B9.PFiOJXszaoum0.cT44hRcI5vagi1l.e', 0, 'Jeniffer', '', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(7, 'Coffee (Hot)'),
(8, 'Coffee (Cold)'),
(9, 'Frappe'),
(11, 'Non-Coffee (Hot)'),
(13, 'Non-Coffee(Cold)');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `beverage_name` varchar(255) NOT NULL,
  `beverage_temp` varchar(255) NOT NULL,
  `sugar_level` varchar(255) NOT NULL,
  `addons` varchar(255) NOT NULL,
  `total_price` decimal(5,2) NOT NULL,
  `pay_status` int(11) NOT NULL,
  `order_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `beverage_name`, `beverage_temp`, `sugar_level`, `addons`, `total_price`, `pay_status`, `order_status`) VALUES
(4, 'americano', 'hot_coffee', 'less_sugar', 'cold_foam', 7.00, 1, 1),
(5, 'matcha', 'hot_coffee', 'less_sugar', '', 5.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `uploaded_date` date NOT NULL DEFAULT current_timestamp(),
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_image`, `category_id`, `uploaded_date`, `price`) VALUES
(22, 'Chocolate', 'Imagine rich, velvety cocoa meticulously blended with creamy, frothed milk, creating a masterpiece of indulgence. The aroma tantalizes, promising a delightful experience ahead.', './uploads/chocolate.jpg', 11, '2024-01-05', 7.5),
(24, 'Matcha', 'This exquisite blend combines finely ground Japanese green tea leaves with steamed milk, resulting in a beautifully verdant elixir. The earthy, grassy tones of matcha are complemented by a hint of natural sweetness, creating a delicate yet robust beverage.', './uploads/MatchaLatte.jpg', 11, '2024-01-05', 10.5),
(26, 'Americano', 'A classic coffee made by diluting espresso with hot water, delivering a bold and robust flavour profile similar to drip coffee but with a distinct espresso character.', './uploads/AmericanoCoffee.jpg', 7, '2024-01-05', 5),
(27, 'Americano', 'A classic coffee made by diluting espresso with hot water, delivering a bold and robust flavour profile similar to drip coffee but with a distinct espresso character.', './uploads/AmericanoCoffee.jpg', 8, '2024-01-05', 6),
(29, 'Mocha', 'Combining rich chocolate with espresso and steamed milk, the mocha presents a delightful harmony of flavours, where the chocolatey sweetness beautifully complements the robustness of coffee.', './uploads/Mocha.jpg', 7, '2024-01-05', 9),
(30, 'Mocha', 'Combining rich chocolate with espresso and steamed milk, the mocha presents a delightful harmony of flavours, where the chocolatey sweetness beautifully complements the robustness of coffee.', './uploads/Mocha.jpg', 8, '2024-01-05', 10),
(31, 'Cappucino', 'A classic Italian coffee made with equal parts of espresso, steamed milk, and milk foam. It boasts a strong espresso flavour with a creamy texture and a frothy top layer.', './uploads/Cappuccino.jpg', 7, '2024-01-05', 6),
(32, 'Cappucino', 'A classic Italian coffee made with equal parts of espresso, steamed milk, and milk foam. It boasts a strong espresso flavour with a creamy texture and a frothy top layer.', './uploads/Cappuccino.jpg', 8, '2024-01-05', 7),
(33, 'Caffee Latte', 'A smooth and creamy coffee made by mixing espresso with a larger amount of steamed milk, providing a milder coffee taste compared to cappuccino, with a velvety texture.', './uploads/CaffeLatte.jpg', 7, '2024-01-05', 8),
(34, 'Caffee Latte', 'A smooth and creamy coffee made by mixing espresso with a larger amount of steamed milk, providing a milder coffee taste compared to cappuccino, with a velvety texture.', './uploads/CaffeLatte.jpg', 8, '2024-01-05', 9),
(35, 'Hazelnut Latte', 'A delightful variation of the latte, infused with the nutty essence of hazelnut. This coffee combines espresso, steamed milk, and hazelnut syrup for a comforting and flavorful experience.', './uploads/Hazelnutlatte.jpg', 7, '2024-01-05', 9),
(36, 'Hazelnut Latte', 'A delightful variation of the latte, infused with the nutty essence of hazelnut. This coffee combines espresso, steamed milk, and hazelnut syrup for a comforting and flavorful experience.', './uploads/Hazelnutlatte.jpg', 8, '2024-01-05', 10),
(37, 'White Coffee Mocha', ' An exquisite blend of white chocolate and espresso, combined with steamed milk to create a luscious and creamy coffee with a sweet and rich flavour profile.', './uploads/whitecoffeemocha.jpg', 7, '2024-01-05', 9),
(38, 'White Coffee Mocha', ' An exquisite blend of white chocolate and espresso, combined with steamed milk to create a luscious and creamy coffee with a sweet and rich flavour profile.', './uploads/whitecoffeemocha.jpg', 8, '2024-01-05', 10),
(39, 'Strawberry Frappe', 'A strawberry frappe is a delightful concoction that blends the freshness of ripe strawberries with a frosty, creamy texture. Imagine a luscious mix of fresh or frozen strawberries, ice, milk or cream, and perhaps a touch of sweetener, all whipped together into a smooth, luxurious drink', './uploads/strawberry.jpg', 9, '2024-01-05', 12.5),
(40, 'Caramel Frappe', 'A heavenly concoction blending creamy textures with a delightful caramel infusion. Its sweetness dances on your taste buds, offering a ', './uploads/caramelfrappe.jpg', 9, '2024-01-05', 12.5),
(41, 'Caramel Macchiato Frappe', 'Combining the lusciousness of caramel with the boldness of espresso, this frappe delivers a symphony of flavours. The sweetness of caramel harmonises with the robust coffee notes, all wrapped in a creamy, chilled indulgence.', './uploads/caramelmacchiatofrappe.jpg', 9, '2024-01-05', 12.5),
(42, 'Mocha Frappe', 'Dive into the perfect fusion of chocolate and coffee—a velvety, energising delight that tantalises your senses. Its rich chocolatey essence b', './uploads/mochafrappe.jpg', 9, '2024-01-05', 12.5),
(43, 'Chocolate Frappe', 'Indulge in the sheer decadence of chocolate in every sip. This frappe boasts a creamy texture intertwined with the deep, luxurious taste of chocolate, offering pure bliss for chocolate enthusiasts.', './uploads/chocolatefrappe.jpg', 9, '2024-01-05', 10.5),
(44, 'Chocolate Chipn Frappe', 'A delectable twist on the classic chocolate frappe, featuring delightful morsels of chocolate chips dispersed within a creamy base, providing a flavorful surprise in every sip.', './uploads/chocolatechipfrappe.jpg', 9, '2024-01-05', 12.5),
(45, 'Halzenut Frappe', 'Experience the nutty elegance of hazelnut perfectly blended into a creamy symphony. Its smooth texture and distinct hazelnut flavour create a sophisticated and delightful drinking experience.', './uploads/Hazenutfrappe.jpg', 9, '2024-01-05', 12.5),
(46, 'Espresso Frappe', 'For those craving a robust caffeine kick, this frappe delivers. It encapsulates the bold essence of espresso in a chilled, creamy format, offering a refreshing jolt of energy.', './uploads/Espressofrappe.jpg', 9, '2024-01-05', 8),
(47, 'Matcha Frappe', 'Revel in the vibrant and earthy flavours of matcha green tea, harmonised with a creamy texture. Its refreshing taste and unique green hue make it a rejuvenating and captivating choice.', './uploads/matchafrappe.jpg', 9, '2024-01-05', 13.5),
(48, 'Vanilla Frappe', 'Embrace the classic allure of vanilla in a smooth, creamy drink. Its simple yet comforting taste makes it an all-time favourite for those seeking a familiar and delightful experience.', './uploads/vanillafrappe.jpg', 9, '2024-01-05', 12),
(49, 'White Chocolate Frappe', 'Indulge in the velvety smoothness of white chocolate in a chilled, creamy frappe. Its rich sweetness and luxurious taste create a divine indulgence for white chocolate enthusiasts.', './uploads/whitechocolatefrappe.jpg', 9, '2024-01-05', 12.5),
(51, 'Caramel Macchiato', 'An indulgent espresso-based drink layered with velvety milk and topped with a drizzle of caramel', './uploads/CaramelMacchiato.jpg', 7, '2024-01-05', 9),
(52, 'Caramel Macchiato', 'An indulgent espresso-based drink layered with velvety milk and topped with a drizzle of caramel', './uploads/CaramelMacchiato.jpg', 8, '2024-01-05', 10),
(53, 'Americano', 'Imagine rich, velvety cocoa meticulously blended with creamy, frothed milk, creating a masterpiece of indulgence. The aroma tantalizes, promising a delightful experience ahead.', './uploads/CaramelMacchiato.jpg', 11, '2024-01-05', 7.5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phonenum` varchar(10) NOT NULL,
  `registered_at` date NOT NULL DEFAULT current_timestamp(),
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phonenum`, `registered_at`, `isAdmin`, `address`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$j9OXXIYS0CG5AYuks62YMeDvuIpo2hZEN4CqfJfujt1yPMnoUq5C6', '9810283472', '2022-04-10', 1, 'newroad'),
(2, 'Queenie', 'Chan', 'shian08051@gmail.com', 'Khor@0805', '010671245', '2014-04-06', 0, 'No 109\r\nTaman Universiti\r\n81300\r\nJohor Bahru\r\nJohor\r\n\r\n'),
(3, 'Jakson', 'Ling', 'Jakson0808@gmail.com', '$2y$10$DJOdhZy1InHTKQO6whfyJexVTZCDTlmIYGCXQiPTv7l82AdC9bWHO', '0103452189', '2022-04-10', 0, 'No 88\r\nTaman Universiti\r\n81300\r\nJohor Bahru\r\nJohor'),
(4, 'Jeniffer', 'Wong', 'Jeni0405@yahoo.com', '$2y$10$DJOdhZy1InHTKQO6whfyJexVTZCDTlmIYGCXQiPTv7l82AdC9bWHO', '0185412390', '2022-04-10', 0, 'No 12\r\nTaman Universiti\r\n81300\r\nJohor Bahru\r\nJohor'),
(5, 'Lily', 'Tan', 'Lily0107@yahoo.com', '$2y$10$DJOdhZy1InHTKQO6whfyJexVTZCDTlmIYGCXQiPTv7l82AdC9bWHO', '0185412390', '2023-05-16', 0, 'No 56\r\nTaman Universiti\r\n81300\r\nJohor Bahru\r\nJohor'),
(6, 'Mary', 'Chong', 'Mary0812@yahoo.com', '$2y$10$DJOdhZy1InHTKQO6whfyJexVTZCDTlmIYGCXQiPTv7l82AdC9bWHO', '0192317840', '2023-06-22', 0, 'No 33\r\nTaman Universiti\r\n81300\r\nJohor Bahru\r\nJohor'),
(7, 'Tester', '1', 'shian08051@gmail.com', 'Khor@0805', '0164643995', '2024-01-07', 0, 'No 109Taman Universiti81300Johor BahruJohor'),
(8, 'Tester', '2', 'shian08051@gmail.com', 'Qwerty@123', '0164643995', '2024-01-07', 0, 'Perwira, Parit Paja, Johor.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`beverage_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
