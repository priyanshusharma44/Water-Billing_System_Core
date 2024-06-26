-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 12:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbill`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_charge`
--

CREATE TABLE `additional_charge` (
  `charge_id` int(11) NOT NULL,
  `charge_days` int(11) NOT NULL,
  `charge_percent` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_charge`
--

INSERT INTO `additional_charge` (`charge_id`, `charge_days`, `charge_percent`, `created_at`, `updated_at`) VALUES
(1, 30, 2.00, '2024-05-10 09:09:45', '2024-05-10 15:30:18'),
(2, 60, 3.00, '2024-05-10 09:09:45', '2024-05-10 15:30:46'),
(3, 90, 5.00, '2024-05-10 09:09:45', '2024-05-10 15:31:03'),
(4, 100, 6.00, '2024-05-10 09:09:45', '2024-05-10 15:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `phone_number`) VALUES
(1, 'admin1', 'Password@123', 'admin@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reading_id` int(11) NOT NULL,
  `tariff_id` int(11) NOT NULL,
  `charge_id` int(11) DEFAULT NULL,
  `units` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `user_id`, `reading_id`, `tariff_id`, `charge_id`, `units`, `total_amount`, `payment_status`, `due_date`) VALUES
(1, 1, 2, 2, 2, 200, 3807.00, 'paid', '2024-03-01'),
(2, 1, 3, 3, 4, 150, 9812.40, 'unpaid', '2024-01-01'),
(3, 1, 4, 1, 2, 100, 2544.80, 'unpaid', '2024-02-15'),
(4, 1, 5, 2, 2, 125, 4636.00, 'unpaid', '2024-06-10'),
(5, 1, 6, 1, 2, 75, 1878.80, 'unpaid', '2024-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complain_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complain_text` varchar(255) NOT NULL,
  `complain_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meter_reader`
--

CREATE TABLE `meter_reader` (
  `reader_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meter_reader`
--

INSERT INTO `meter_reader` (`reader_id`, `admin_id`, `username`, `password`, `email`, `phone_number`) VALUES
(1, 1, 'reader1', 'Password@123', 'reader@gmail.com', '9846985489');

-- --------------------------------------------------------

--
-- Table structure for table `meter_reading`
--

CREATE TABLE `meter_reading` (
  `reading_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `previous_reading_date` date NOT NULL,
  `previous_reading_value` decimal(10,2) NOT NULL,
  `current_reading_date` date NOT NULL,
  `current_reading_value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meter_reading`
--

INSERT INTO `meter_reading` (`reading_id`, `user_id`, `previous_reading_date`, `previous_reading_value`, `current_reading_date`, `current_reading_value`) VALUES
(1, 1, '2024-03-30', 0.00, '2024-04-30', 0.00),
(2, 1, '2024-04-30', 0.00, '2024-05-10', 200.00),
(3, 1, '2024-05-10', 200.00, '2024-05-10', 350.00),
(4, 1, '2024-05-10', 300.00, '2024-05-10', 400.00),
(5, 1, '2024-05-10', 400.00, '2024-05-10', 525.00),
(6, 1, '2024-05-10', 525.00, '2024-05-10', 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `tariff`
--

CREATE TABLE `tariff` (
  `tariff_id` int(11) NOT NULL,
  `tariff_name` varchar(255) NOT NULL,
  `minimum_usage` decimal(10,2) NOT NULL,
  `maximum_usage` decimal(10,2) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `base_fee` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tariff`
--

INSERT INTO `tariff` (`tariff_id`, `tariff_name`, `minimum_usage`, `maximum_usage`, `unit_price`, `base_fee`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 0.00, 100.00, 10.00, 20.00, '2024-05-10 09:09:45', '2024-05-10 09:09:45'),
(2, 'Standard', 101.00, 200.00, 15.00, 25.00, '2024-05-10 09:09:45', '2024-05-10 09:09:45'),
(3, 'Premium', 201.00, 300.00, 20.00, 30.00, '2024-05-10 09:09:45', '2024-05-10 09:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `contact_num` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `admin_id`, `username`, `password`, `email`, `address`, `otp`, `contact_num`) VALUES
(1, 1, 'Rocky', '123456789', 'aaa@gmail.com', 'ITAHARI', 6507, '9807059177');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_charge`
--
ALTER TABLE `additional_charge`
  ADD PRIMARY KEY (`charge_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_tariff_id` (`tariff_id`),
  ADD KEY `fk_reading_id` (`reading_id`),
  ADD KEY `fk_charge_id` (`charge_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `meter_reader`
--
ALTER TABLE `meter_reader`
  ADD PRIMARY KEY (`reader_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `meter_reading`
--
ALTER TABLE `meter_reading`
  ADD PRIMARY KEY (`reading_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `tariff`
--
ALTER TABLE `tariff`
  ADD PRIMARY KEY (`tariff_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_charge`
--
ALTER TABLE `additional_charge`
  MODIFY `charge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meter_reader`
--
ALTER TABLE `meter_reader`
  MODIFY `reader_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meter_reading`
--
ALTER TABLE `meter_reading`
  MODIFY `reading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tariff`
--
ALTER TABLE `tariff`
  MODIFY `tariff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_charge_id` FOREIGN KEY (`charge_id`) REFERENCES `additional_charge` (`charge_id`),
  ADD CONSTRAINT `fk_reading_bill` FOREIGN KEY (`reading_id`) REFERENCES `meter_reading` (`reading_id`),
  ADD CONSTRAINT `fk_tariff_bill` FOREIGN KEY (`tariff_id`) REFERENCES `tariff` (`tariff_id`),
  ADD CONSTRAINT `fk_user_bill` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `fk_user_complain` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `meter_reader`
--
ALTER TABLE `meter_reader`
  ADD CONSTRAINT `fk_admin_meter_reader` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `meter_reading`
--
ALTER TABLE `meter_reading`
  ADD CONSTRAINT `fk_user_meter_reading` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
