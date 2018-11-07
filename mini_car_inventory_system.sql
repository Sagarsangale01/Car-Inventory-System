-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2018 at 02:40 PM
-- Server version: 5.6.41-84.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samaranb_mini_car_inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_model`
--

CREATE TABLE `car_model` (
  `model_pk` int(8) NOT NULL,
  `manufacturer_fk` int(5) NOT NULL,
  `model_name` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL,
  `fuel` varchar(10) NOT NULL,
  `manufacturer_year` varchar(20) NOT NULL,
  `registration_year` int(5) NOT NULL,
  `note` text NOT NULL,
  `car_picture1` varchar(100) NOT NULL,
  `car_picture2` varchar(100) NOT NULL,
  `carcount` int(5) NOT NULL,
  `created_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`model_pk`, `manufacturer_fk`, `model_name`, `color`, `fuel`, `manufacturer_year`, `registration_year`, `note`, `car_picture1`, `car_picture2`, `carcount`, `created_date`, `status`) VALUES
(1, 1, 'Swift', 'white', 'Petrol', '2017', 2018, 'Swift         ', 'Maruti-Suzuki-New-Swift-Left-Front-Three-Quarter-88877.jpg', 'Maruti-Suzuki-New-Swift-Rear-view-88878.jpg', 2, '2018-11-06', '1'),
(2, 1, 'Vitara Brezza', 'Gray', 'Diesel', '2018', 2018, ' \n                     ', 'Maruti-Suzuki-Vitara-Brezza-Exterior-100226.jpg', 'Maruti-Suzuki-Vitara-Brezza-Right-Front-Three-Quarter-118639.jpg', 2, '2018-11-06', '1'),
(3, 2, 'Santro', 'Blue', 'CNG', '2017', 2018, ' \n                     ', 'Hyundai-Santro-Right-Front-Three-Quarter-138738.jpg', 'Hyundai-Santro-Right-Rear-Three-Quarter-138739.jpg', 1, '2018-11-06', '1'),
(4, 3, 'Marazzo', 'Mariner Ma', 'Diesel', '2018', 2018, '<p>Mahindra Marazzo price starts at ? 9.99 Lakhs and goes upto ? 13.9 Lakhs. Diesel Marazzo price starts at ? 9.99 Lakhs.</p>\n', 'Mahindra-Marazzo-Exterior-136955.jpg', 'Mahindra-Marazzo-Exterior-134818.jpg', 1, '2018-11-06', '1'),
(5, 5, 'Harrier', 'Orange', 'Diesel', '2018', 2018, ' \n                     ', 'harrier_front_view.jpg', 'harrier_back_view.jpg', 1, '2018-11-06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_pk` int(8) NOT NULL,
  `manufacturer_name` varchar(20) NOT NULL,
  `created_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_pk`, `manufacturer_name`, `created_date`, `status`) VALUES
(1, 'Maruti Suzuki', '2018-11-06', '1'),
(2, 'Hyundai', '2018-11-06', '1'),
(3, 'Mahindra', '2018-11-06', '1'),
(4, 'Toyota', '2018-11-06', '1'),
(5, 'TATA', '2018-11-06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_pk` int(8) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `token` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_pk`, `user_name`, `user_id`, `password`, `status`, `token`) VALUES
(1, 'Admin', 'Admin', 'd41d8cd98f00b204e9800998ecf8427e', '1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`model_pk`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturer_pk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `model_pk` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_pk` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_pk` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
