-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 07:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(6) UNSIGNED NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `product_names` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `customer_address`, `customer_phone`, `product_names`, `total_price`) VALUES
(229558, 'Soma', 'Sonagacha', '23324', 'Symphony Z60 4/64 gb', '9200.00'),
(252631, 'Ali', 'Comilla', '017139', 'Symphony Z60 4/64 gb', '18200.00'),
(584900, 'Suhma', 'dhaka', '3538', 'Symphony Z60 4/64 gb', '9200.00'),
(653114, 'Ali Bakar', 'Rajshahi', '015184', 'iPhone 14 pro max 8/256 gb', '50200.00'),
(667461, 'Ali', 'Cumilla', '902476', 'Symphony Z60 4/64 gb', '9100.00'),
(708012, 'Ali', 'Jashoe', '34253', 'Symphony Z60 4/64 gb, iPhone 14 pro max 8/256 gb', '68200.00'),
(722032, 'Ali Kodor', 'Dhaja', '243253467', 'Symphony Z60 4/64 gb', '18200.00'),
(759332, 'Uma Cha', 'Cumilla', '6790', 'Symphony Z60 4/64 gb', '18100.00'),
(789051, 'rwfw', 'fwf', '345', 'Symphony Z60 4/64 gb', '9200.00'),
(865835, 'wd', 'deq', '32242', 'Symphony Z60 4/64 gb', '9200.00'),
(900237, 'sas', 's', '567', 'Symphony Z60 4/64 gb', '18200.00'),
(939941, 'Ali Rahman', 'Cumilla', '357548', 'Symphony Z60 4/64 gb', '27200.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`, `image`) VALUES
(5, 'Symphony Z60 4/64 gb', 120, '9000.00', '../uploads/image-643e62ab72e6b.jpeg'),
(6, 'iPhone 14 pro max 8/256 gb', 20, '50000.00', '../uploads/image-643e62f6d7680.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `user_type` enum('admin','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `gender`, `date_of_birth`, `profile_picture`, `user_type`) VALUES
(1, 'Aditya Saha', 'amiaditya', '$2y$10$KE6XqayncBCnS2VLaX9D.uBooamHqKm7fUq/RjfHlwz7r318Wc7K6', 'Male', '2000-12-13', '../uploads/641d8a3bb23ef.jpg', 'admin'),
(2, 'Alul', 'amialul', '$2y$10$aJi1V9Y.XUX5TYCb7e0.DOA1KoGIFZ3tTA7lgGRd2PwRdkvjWiem6', 'Female', '2008-05-21', '../uploads/image-2.jpg', 'customer'),
(5, 'Soma Chow', 'amisoma', '$2y$10$4H/ipYMYWvAMdOSpTkbSy.WgBMNuADdXG/hSH6ZdVPUIr1c95MmfW', 'Male', '1990-12-12', '../uploads/642342a90d11f.jpg', 'admin'),
(6, 'Uma Cha', 'amiuma', '$2y$10$.NzgeIkIL2BwD25eQhGsYOGcZmh79lYZHE8f0EO33z6NK4wkp/9Wm', 'Female', '1999-02-13', '../uploads/643e6d23eebcd.jpg', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=939942;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
