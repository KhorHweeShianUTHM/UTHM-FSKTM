-- Table structure for table `users`
CREATE TABLE `users` (
  `staff_id` INT(11) NOT NULL AUTO_INCREMENT,
  `staff_name` VARCHAR(100) DEFAULT NULL,
  `role` VARCHAR(100) DEFAULT NULL, 
  `email` VARCHAR(100) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `contact_number` VARCHAR(20) DEFAULT NULL,
  `date_enroll` DATE DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`staff_id`, `staff_name`, `role`, `email`, `password`, `contact_number`, `date_enroll`) VALUES
(4, 'haziqah', 'Manager', 'haziqahliyana71@gmail.com', '$2y$10$FDn4wc6awvc5OEerLwOy6uvx4RSi2z9gN0uiHOSoYpWueQq2kkbTe', '0123456789', '2024-06-01'),
(5, 'haziqah', 'Staff', 'di230103@student.uthm.edu.my', '$2y$10$I91IDDny0Y0ZfcjxX8CkH.Pk.T5LBikVsNSlWQUyWigCPj4/lpgfa', '0198765432', '2024-06-01');

-- Set AUTO_INCREMENT to next value
ALTER TABLE `users` AUTO_INCREMENT = 6;
