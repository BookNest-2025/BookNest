-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2025 at 06:31 PM
-- Server version: 8.0.43-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booknest`
DROP DATABASE IF EXISTS `booknest`;
CREATE DATABASE `booknest`;
USE `booknest`;
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `a_id` int NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `telno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_id` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `rating` decimal(10,2) DEFAULT NULL,
  `quantity` int NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `s_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `b_id` int NOT NULL,
  `author_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_images`
--

CREATE TABLE `book_images` (
  `b_id` int NOT NULL,
  `image_url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_orders`
--

CREATE TABLE `book_orders` (
  `o_id` int NOT NULL,
  `b_id` int NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `c_id` int NOT NULL,
  `b_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `adress` varchar(150) DEFAULT NULL,
  `telno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `email`, `name`, `adress`, `telno`) VALUES
(1, 'sanira.adesha@gmail.com', NULL, NULL, NULL),
(3, 's123@gmail.com', NULL, NULL, NULL),
(4, 's1123@gmail.com', NULL, NULL, NULL),
(5, 's1213@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delevery_partners`
--

CREATE TABLE `delevery_partners` (
  `d_id` int NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `adress` varchar(150) DEFAULT NULL,
  `telno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delevery_partners`
--

INSERT INTO `delevery_partners` (`d_id`, `email`, `name`, `adress`, `telno`) VALUES
(1, 'saascac@gmail.com', NULL, NULL, NULL),
(2, 'sanira12@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int NOT NULL,
  `c_id` int NOT NULL,
  `state` varchar(20) NOT NULL,
  `o_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `s_id` int NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `adress` varchar(150) DEFAULT NULL,
  `telno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`s_id`, `email`, `name`, `adress`, `telno`) VALUES
(1, 'sanira.deneth2003@gmail.com', NULL, NULL, NULL),
(2, '12sascbh@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `category`) VALUES
('12sascbh@gmail.com', '$2y$10$P7AoqA6.5vcNah/qx9d9WOGZEUQozGkhomhTP1t7/by70X6n1Zeem', 'shops'),
('12sasscacbh@gmail.com', '$2y$10$dlf/xG7JZJrrbdH82puEPeW3dcUA.lsvEN7ZWT03vmPj77IkITbgy', 'delivery_partners'),
('s1123@gmail.com', '$2y$10$x6eNf/7.lD5c0kXZojp2POeRiRGg8.T2UbpzTQw8Bpfoo3q.95l/i', 'customers'),
('s1213@gmail.com', '$2y$10$n6xPKAfbWGiJxnw1vtR0xe9wHw9WQ8mUHKpb2PVdphNiNz/.86q.C', 'customers'),
('s123@gmail.com', '$2y$10$iY35E19u0YnTJEdDD2NihulTtGnD1euPTYvdqw95RJhfEP9to0nHu', 'customers'),
('saascac@gmail.com', '$2y$10$rby2Fh7daxrw/uQcWmQ3t.r65Hig0dcJipODwfKNKvpwqpUrjemzO', 'delevery_partners'),
('sanira.adesha@gmail.com', '$2y$12$UIG572jSY4R2sHmRHjVMxeSD.b.jorVeUfZozDqDQsBRado0W0fSO', 'customers'),
('sanira.deneth2003@gmail.com', '$2y$10$hIqJgoexguOX0JmQ9jfNyOHhSK.LOBhAkB/zNr2vyWRsh/EpVPk/S', 'shops'),
('sanira12@gmail.com', '$2y$10$Gp51Ldga6YJCM7qq5ZBnreK2juQq.yby.j.UUJeadiXPVW4xq6yBO', 'delevery_partners'),
('yadesha1kum2ara@gmail.com', '$2y$10$rMsdPIheMVcsn5UVk5rzgOauuDYB8axwSyNOHSEv9.t31oBrslpP2', 'delivery_partners'),
('yadesha1kumara@gmail.com', '$2y$10$e1AhT/vEFsbN82MaPp39huZUlfXxiEvA/gUCas.D0uaFQHdQUcNOq', 'delivery_partners'),
('yadeshakumara@gmail.com', '$2y$10$9QVf4o4oJI12YTtOYpAFE.Z8XSCmKbUof67OR35W0pJXmu3oW3TXC', 'delivery_partners');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `book_images`
--
ALTER TABLE `book_images`
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `book_orders`
--
ALTER TABLE `book_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `b_id` (`b_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `delevery_partners`
--
ALTER TABLE `delevery_partners`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delevery_partners`
--
ALTER TABLE `delevery_partners`
  MODIFY `d_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `s_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `shops` (`s_id`);

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`);

--
-- Constraints for table `book_images`
--
ALTER TABLE `book_images`
  ADD CONSTRAINT `book_images_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`);

--
-- Constraints for table `book_orders`
--
ALTER TABLE `book_orders`
  ADD CONSTRAINT `book_orders_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `customers` (`c_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `delevery_partners`
--
ALTER TABLE `delevery_partners`
  ADD CONSTRAINT `delevery_partners_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customers` (`c_id`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;