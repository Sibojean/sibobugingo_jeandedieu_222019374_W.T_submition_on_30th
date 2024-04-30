-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 04:32 PM
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
-- Database: `online_banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_detail`
--

CREATE TABLE `account_detail` (
  `account_number` int(10) NOT NULL,
  `account_name` varchar(10) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `openning_balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_detail`
--

INSERT INTO `account_detail` (`account_number`, `account_name`, `account_type`, `openning_balance`) VALUES
(1600, 'saving', 'bk_s', 1000),
(16000123, 'block', 'sacco_b', 100000),
(120067854, 'deposit', 'Asset', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `branch_detail`
--

CREATE TABLE `branch_detail` (
  `branch_id` int(10) NOT NULL,
  `branch_name` varchar(10) NOT NULL,
  `branch_city` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_detail`
--

INSERT INTO `branch_detail` (`branch_id`, `branch_name`, `branch_city`) VALUES
(123, 'kcb', 'kgl city'),
(967, 'huye branc', 'huye city'),
(123456, 'Rubavu bra', 'Rugerero c');

-- --------------------------------------------------------

--
-- Table structure for table `card_detail`
--

CREATE TABLE `card_detail` (
  `card_number` int(10) NOT NULL,
  `card_type` varchar(10) NOT NULL,
  `expiry_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_detail`
--

INSERT INTO `card_detail` (`card_number`, `card_type`, `expiry_date`) VALUES
(9, 'credit car', '2024-04-13'),
(898087, 'debit card', '2024-04-05'),
(900000, 'green card', '2024-05-11'),
(33456778, 'visa card', '2024-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `customer_id` int(10) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `e_mail` varchar(15) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`customer_id`, `first_name`, `last_name`, `e_mail`, `phone`) VALUES
(1, 'sibo', '2', 'jeaana2022@gmai', '345267'),
(2, 'jean', '3', 's@gmail.com', '12345'),
(3, 'danny', '4', 'd@gmai.com', '00000007');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `transaction_id` int(10) NOT NULL,
  `transaction_number` varchar(10) NOT NULL,
  `transaction_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`transaction_id`, `transaction_number`, `transaction_date`) VALUES
(2, '12', '2024-04-06'),
(3, '100', '2024-05-11'),
(4, '1209', '2024-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(1, 'NSAB', 'Paul', 'abimana2022@gmail.com', 'paul', '$2y$10$2z5K1MtHz8fsLwp9o5R1pOz9RGH0bejGr0VDYM2AcohtTxf6pwqg.'),
(2, 'saidi', 'ndikumana', 'ana2022@gmail.com', 'sadi', '$2y$10$0dYHNHszjbHUrtDmjABuleYS0OPO2Fi17pmMjp4ySVLmEVMl8T9B.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD PRIMARY KEY (`account_number`);

--
-- Indexes for table `branch_detail`
--
ALTER TABLE `branch_detail`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `card_detail`
--
ALTER TABLE `card_detail`
  ADD PRIMARY KEY (`card_number`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
