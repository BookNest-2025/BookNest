-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2025 at 06:07 PM
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
-- Database: `booknest`
--
DROP DATABASE IF EXISTS `booknest`;

CREATE DATABASE `booknest`;
USE `booknest`;


-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rating` decimal(10,2) DEFAULT NULL,
  `no_of_books` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `author_name` varchar(30) DEFAULT NULL,
  `supplier_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `review_id` int(11) NOT NULL,
  `custemer_id` varchar(20) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` decimal(10,2) NOT NULL,
  `review` varchar(1000) DEFAULT NULL,
  `review_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `custemer_id` varchar(20) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` varchar(20) NOT NULL,
  `name` varchar(50) DEFAULT 'user',
  `email` varchar(50) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `telephone_number` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `adress`, `password`, `telephone_number`) VALUES
('akila', 'user', NULL, NULL, '$2y$10$KnadiJhDUYfdIGLL6UO/n.zMZ3DeVMcz0CtJ9JjR7nvGQlR03CS4y', NULL),
('alice', 'Alice Smith', 'alice@example.com', '123 Main St, Colombo', '$2y$10$pT56G3uDyM.YNMDfaMeGwu9dMKcskiKWjWTvavboYY3RGANfmUrxC', 771234567),
('Avishka', 'user', NULL, NULL, '$2y$10$TY5p.tk008kWqC57szR2.uAKNxd60gGgXpddke1UBK3dGgQm3ZKfC', NULL),
('bob', 'Bob Silva', 'bob@example.com', '456 Lake Rd, Kandy', '$2y$10$pT56G3uDyM.YNMDfaMeGwu9dMKcskiKWjWTvavboYY3RGANfmUrxC', 772345678),
('charlie', 'Charlie Perera', 'charlie@example.com', '789 River St, Galle', '$2y$10$pT56G3uDyM.YNMDfaMeGwu9dMKcskiKWjWTvavboYY3RGANfmUrxC', 773456789),
('sanira', 'user', '', NULL, '$2y$10$6OsM703fQCjBMZayMRz6w.G.6KGA10pZcRwO4k.ak1hjmtrmCpXb2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_reviews`
--

CREATE TABLE `site_reviews` (
  `review_id` int(11) NOT NULL,
  `custemer_id` varchar(20) NOT NULL,
  `rating` decimal(10,2) NOT NULL,
  `review` varchar(1000) DEFAULT NULL,
  `review_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `custemer_id` (`custemer_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `custemer_id` (`custemer_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `site_reviews`
--
ALTER TABLE `site_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `custemer_id` (`custemer_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_reviews`
--
ALTER TABLE `book_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_reviews`
--
ALTER TABLE `site_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD CONSTRAINT `book_reviews_ibfk_1` FOREIGN KEY (`custemer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `book_reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`custemer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `site_reviews`
--
ALTER TABLE `site_reviews`
  ADD CONSTRAINT `site_reviews_ibfk_1` FOREIGN KEY (`custemer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
