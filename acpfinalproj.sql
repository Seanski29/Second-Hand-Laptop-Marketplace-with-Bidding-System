-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 09:24 AM
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
-- Database: `acpfinalproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids_won`
--

CREATE TABLE `bids_won` (
  `bid_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bid_amount` decimal(10,2) DEFAULT NULL,
  `bid_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_bid`
--

CREATE TABLE `pending_bid` (
  `bid_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `high_bid_amount` decimal(10,2) NOT NULL,
  `bid_deadline` datetime DEFAULT NULL,
  `bid_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `starting_price` decimal(10,2) NOT NULL,
  `highest_bid` decimal(10,2) NOT NULL,
  `bid_deadline` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `highest_bidder_id` int(11) DEFAULT NULL,
  `status` enum('active','sold','expired') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_image`, `starting_price`, `highest_bid`, `bid_deadline`, `user_id`, `highest_bidder_id`, `status`) VALUES
(59, 'Acer Aspire 3 A315', 'This is my personal laptop. Here is my specs\r\nIntel® Core™ i3-1115G4\r\n8GB DDR4 Memory\r\n512GB NVMe SSD \r\n15.6&quot; Full HD 1920 x 1080\r\nIntel® UHD Graphics for 11th Gen Intel® Processors\r\nFree Office 2021 for Home and Student', '6753fee95d302_ACER ASPIRE 3 A315.jpg', 430.00, 450.00, '2024-12-10 18:52:00', 1, NULL, 'active'),
(60, 'HP ELITEBOOK 840G4', 'School laptop, inyo na\r\nHP EliteBook 820 G4 | 256GB SSD | 8GB Ram Core i5 7th Gen 256GB SSD 8GB RAM Keyboard Light 13 inches Silver Color USED PC', '6753ffa640939_HP ELITEBOOK 840 G1.jpg', 120.00, 130.00, '2024-12-09 05:56:00', 2, NULL, 'active'),
(61, 'ACER CHROME BOOK 511', 'Kayna daddy ito\r\n\r\nHindi ko po alam ang specs, please buy it off of me', '6754002db34cc_ACER CHROMEBOOK 511.jpg', 80.00, 81.00, '2024-12-11 15:58:00', 3, NULL, 'active'),
(62, 'Lenovo ThinkPad X270', 'One of my FAVORITE LAPTOPS but Kinda buggy\r\n\r\ni5\r\n250ssd\r\n1366x 980 display\r\n2 Batteries', '675400681e2c7_Thinkpad X270.png', 140.00, 150.00, '2024-12-19 15:59:00', 1, NULL, 'active'),
(63, 'Dell LATITUDE 7650', 'Copy paste from Google ang specs kasi wala me alam hehe ;)\r\n\r\nProcessor\r\nIntel® Core™ Ultra 5 135U, vPRO (12MB cache, 12 cores, 14 threads, up to 4.4 GHz Max Turbo)\r\n\r\nOperating System\r\nWindows 11 Pro, English, Brazilian Portuguese, French, Spanish\r\n\r\nGraphics Card\r\nIntegrated Intel® graphics, Core™ Ultra 5 135U vPRO Processor, 16GB LPDDR5x Memory\r\n\r\nDisplay\r\nLaptop 16.0&quot; FHD+ (1920x1200) IPS, AG No-Touch, 250 nits, FHD IR Cam, WLAN, Aluminum\r\n\r\nMemory \r\n16 GB: LPDDR5x, 6400 MT/s (onboard)\r\n\r\nStorage\r\n256 GB, M.2 2230, TLC PCIe Gen 4 NVMe, SSD', '675400fabcd21_DELL LATITUDE 7650.jpg', 100.00, 110.00, '2024-12-18 16:01:00', 2, NULL, 'active'),
(64, 'Asus Touchscreen', 'Issue: Nasa Image\r\nBatter and Keyboard sitll owkring, But not screen\r\nPlease take it off my hands Thank you', '67540155027b8_image_2024-12-07_160300000.png', 30.00, 31.00, '2024-12-09 16:03:00', 3, NULL, 'active'),
(65, 'MSI Thin 15', 'Laptop ng Brother ko. Need to sell to pay off College tuition!\r\ni7\r\nrtx 460', '6754020309ebf_image_2024-12-07_160514839.png', 900.00, 923.00, '2024-12-16 16:06:00', 25, NULL, 'active'),
(66, 'Razer Blade Pro 2014', 'Intel Core i7-4700HQ Quad Core Processor with Hyper Threading 2.4GHz / 3.4GHz (Base / Turbo) + NVIDIA GeForce GTX 765M (2 GB GDDR5 VRAM, Optimus Technology)\r\n8 GB (2 x 4 GB DDR3L-1600MHz)\r\nWindows 8 64-bit\r\n128 GB SSD (mSATA), 256 GB SSD (mSATA), 512 GB SSD (mSATA)', '6754027d49975_image_2024-12-07_160735655.png', 100.00, 110.00, '2024-12-14 16:08:00', 25, NULL, 'active'),
(67, 'Asus ROG Zepherus', 'LAPTOP LAPTOP!!! NOT STOLEN\r\n\r\nDEFINETLY NOT STOLEN!!!!\r\n\r\nPLEASE BUY 9K PHP ONLYY!', '675402f1735ea_image_2024-12-07_161023803.png', 155.00, 170.00, '2024-12-31 16:10:00', 2, NULL, 'active'),
(68, 'Asus VIVOBOOK 14 (defective)', 'Defective\r\nNot working LCD\r\nEverything is fine', '675403594e429_image_2024-12-07_161141056.png', 25.00, 30.00, '2025-01-11 16:12:00', 1, NULL, 'active'),
(69, 'Gigabyte p2352V', 'The new models are the P2532N and the P2532V and they both feature nearly identical specs, except for the display, as the P2532N uses a Full HD resolution (1920x1080) . thats why Im selling this, this is not my style', '6754041c8d4ab_image_2024-12-07_161420448.png', 89.00, 95.00, '2024-12-18 16:15:00', 3, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `address`) VALUES
(1, 'Sean Martin Del Rosario', 'seanmdelrosario@gmail.com', '$2y$10$9l/0AW5uWOlVIjFeL1daluYZd3Fcd.cufWhpKrT5cgwYd1wk2j5iq', '004 Pilahan East, Sabang, Lipa City, Batangas'),
(2, 'Miguel Romero', 'miguel_romero@myyahoo.com', '$2y$10$z4JensBVV6K8dacj0qYfD.1oxECQQRYEPUv9TKxjuglluGwDVt0zi', '069 Pinagtungan, Lipa City, Batangas'),
(3, 'Ced', 'andorced@gmail.com', '$2y$10$G33y4FlsPwM0JxP88KbkIOOltIatkBm0uk3vOl3DgtVJ0EbgaKFZm', '0880, Purok 4, Brgy. Santa Rosa, Alaminos Laguna'),
(25, 'Cheska Anne G. De Castro', 'cheskasean2917@gmail.com', '$2y$10$P1loZFtOCHsZ.zQE9teFvOBPdi5bOMdUDZiQK9toYNwB3ibOkIdjW', 'B. Morada Street Barangay Uno, Lipa City, Batangas'),
(26, 'The Highest Bidder Tester', 'bidder@gmail.com', '$2y$10$DdWI276Qu/52uK/9ozqSXuOjT8rZbU3oUHwAJVPE9OyE3EDDH3dyu', 'unknown');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids_won`
--
ALTER TABLE `bids_won`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pending_bid`
--
ALTER TABLE `pending_bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `highest_bidder_id` (`highest_bidder_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids_won`
--
ALTER TABLE `bids_won`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pending_bid`
--
ALTER TABLE `pending_bid`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids_won`
--
ALTER TABLE `bids_won`
  ADD CONSTRAINT `bids_won_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `bids_won_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pending_bid`
--
ALTER TABLE `pending_bid`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_bid_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `pending_bid_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`highest_bidder_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
