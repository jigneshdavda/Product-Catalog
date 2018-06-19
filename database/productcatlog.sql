-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2018 at 08:40 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productcatlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_phone` varchar(12) NOT NULL,
  `company_address_line_1` text NOT NULL,
  `company_address_line_2` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `company_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`company_id`, `company_name`, `company_email`, `company_phone`, `company_address_line_1`, `company_address_line_2`, `country`, `company_registration_date`, `company_password`) VALUES
(1, 'Jignesh Private Limited', 'jigneshd108@gmail.com', '9619337636', '201, Alag Bella', 'B.P. Cross Road, Lane no. 2, Mulund west', 'India', '2018-06-09 18:39:04', 'jiggu@321'),
(2, 'Arvind Davda', 'darvind108@gmail.com', '9869407386', 'neelkant nagar mulund west mumbai 80', 'neelkant nagar mulund west mumbai 80', 'India', '2018-06-18 10:55:44', 'arvind123');

-- --------------------------------------------------------

--
-- Table structure for table `product_box_type`
--

CREATE TABLE `product_box_type` (
  `product_box_type_id` int(11) NOT NULL,
  `product_box_type_name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_box_type`
--

INSERT INTO `product_box_type` (`product_box_type_id`, `product_box_type_name`, `company_id`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `product_brand_id` int(11) NOT NULL,
  `product_brand_name` varchar(255) NOT NULL,
  `product_brand_category_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`product_brand_id`, `product_brand_name`, `product_brand_category_id`, `company_id`) VALUES
(1, 'Apple', 2, 1),
(2, 'Google', 2, 1),
(3, 'Motorolla', 2, 1),
(4, 'OnePlus', 2, 1),
(5, 'LG', 2, 1),
(6, 'HTC', 2, 1),
(7, 'Xiaomi', 2, 1),
(8, 'Oppo', 2, 1),
(9, 'Dell', 1, 1),
(10, 'Acer', 1, 1),
(11, 'Asus', 1, 1),
(12, 'Sony', 1, 1),
(13, 'Samsung', 1, 1),
(14, 'Apple', 1, 1),
(15, 'Apple', 3, 1),
(16, 'Samsung', 3, 1),
(17, 'Micromax', 3, 1),
(18, 'iBall', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_brand_warranty`
--

CREATE TABLE `product_brand_warranty` (
  `product_brand_warranty_id` int(11) NOT NULL,
  `product_brand_warranty_type` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brand_warranty`
--

INSERT INTO `product_brand_warranty` (`product_brand_warranty_id`, `product_brand_warranty_type`, `company_id`) VALUES
(1, 'Yes', 1),
(2, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `product_category_name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`, `company_id`) VALUES
(1, 'Laptop', 1),
(2, 'Mobile Phones', 1),
(3, 'Tablet', 1),
(4, 'Accessories', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_condition`
--

CREATE TABLE `product_condition` (
  `product_condition_id` int(11) NOT NULL,
  `product_condition_name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_condition`
--

INSERT INTO `product_condition` (`product_condition_id`, `product_condition_name`, `company_id`) VALUES
(1, 'Like New', 1),
(2, 'Excellent', 1),
(3, 'Brand New - Open Box', 1),
(4, 'Fair', 1),
(5, 'Brand New - Sealed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `product_details_id` int(11) NOT NULL,
  `product_details_category` int(11) NOT NULL,
  `product_details_brand` int(11) NOT NULL,
  `product_details_model_name` varchar(255) NOT NULL,
  `product_details_model_color` varchar(255) NOT NULL,
  `product_details_condition` int(11) NOT NULL,
  `product_details_box_type` int(11) NOT NULL,
  `product_details_brand_warranty` int(11) NOT NULL,
  `product_details_warranty_expiry` varchar(255) NOT NULL,
  `product_details_model_comments` longtext NOT NULL,
  `product_details_model_quantity` int(11) NOT NULL,
  `product_details_mfg_price` varchar(255) NOT NULL,
  `product_details_company_price` varchar(255) NOT NULL,
  `product_details_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_details_id`, `product_details_category`, `product_details_brand`, `product_details_model_name`, `product_details_model_color`, `product_details_condition`, `product_details_box_type`, `product_details_brand_warranty`, `product_details_warranty_expiry`, `product_details_model_comments`, `product_details_model_quantity`, `product_details_mfg_price`, `product_details_company_price`, `product_details_date`, `company_id`) VALUES
(1, 2, 2, 'Google Pixel 2 XL 128GB', 'Just Black', 1, 1, 1, 'Dec 2019', '4 GB RAM | 128 GB ROM |\r\n6 inch QHD+ Display\r\n12.2MP Rear Camera | 8MP Front Camera\r\n3520 mAh Battery\r\nQualcomm Snapdragon 835 64-bit Octa Core Processor', 3, '70,499', '50,499', '2018-06-09 19:04:03', 1),
(2, 2, 7, 'Redmi Note 5 Pro 64GB', 'Black', 1, 1, 1, '2019', 'Not Applicable', 1, '15000', '13000', '2018-06-12 14:36:12', 1),
(3, 2, 2, 'Google Phone 1', 'okvdsnoiweng', 1, 1, 1, '2018', 'oibvweiobvioe', 1, '50000', '30000', '2018-06-12 14:40:50', 1),
(4, 2, 2, 'Google Pixel XL 128GB', 'White', 2, 2, 2, '2016', 'Not Required', 1, '60000', '30000', '2018-06-12 14:42:29', 1),
(5, 2, 3, 'Motorola Phone 1', 'dfghioj', 1, 1, 1, '2017', 'jkbfwejbfwebf', 1, '30000', '25000', '2018-06-12 14:45:23', 1),
(6, 2, 5, 'LG Phone 1', 'wpoj gweof wjef', 2, 2, 2, '2016', 'vnwieovh weiovh ieovh', 1, '40000', '30000', '2018-06-12 14:46:32', 1),
(11, 2, 1, 'Apple phone 1', 'wheifhwe', 3, 1, 1, '2018', 'fhweiofhwoiehfhweiofhwoiehfhweiofhwoiehfhweiofhwoiehfhweiofhwoieh', 1, '40000', '30000', '2018-06-16 07:23:55', 1),
(12, 2, 3, 'Motorola Phone 2', 'fehwiofh', 1, 2, 1, '2018', 'irgiojgioergjirgiojgioergjirgiojgioergjirgiojgioergjirgiojgioergj', 1, '15000', '12000', '2018-06-16 07:23:55', 1),
(14, 2, 1, 'Apple Phone 2', 'Space Grey', 2, 1, 2, '2017', 'fweifnioen', 1, '30000', '28000', '2018-06-16 10:12:20', 1),
(15, 3, 15, 'Apple Tablet 1', 'nvoivne', 3, 1, 1, '2019', 'viornve', 1, '20000', '14000', '2018-06-16 10:12:20', 1),
(16, 1, 14, 'MacBook Pro', 'Grey', 1, 1, 1, '2018', 'Macbook Pro with good condition and everything is working without any issues', 1, '90000', '60000', '2018-06-17 06:13:16', 1),
(17, 2, 4, 'OnePlus 5T 128GB', 'White', 3, 1, 1, '2018', 'Oneplus 5T with good condition and everything is working without any issues', 1, '39000', '35000', '2018-06-17 06:13:16', 1),
(18, 3, 17, 'Mcromax Tablet 1', 'Black', 4, 2, 2, '2017', 'MMX with good condition and everything is working without any issues', 1, '20000', '16000', '2018-06-17 06:13:16', 1),
(19, 1, 9, 'Dell Laptop 1', 'Black', 1, 1, 2, '2017', 'Good Laptop for gaming and for technical person also. ', 1, '60000', '25000', '2018-06-19 18:04:18', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_email` (`company_email`),
  ADD UNIQUE KEY `company_phone` (`company_phone`);

--
-- Indexes for table `product_box_type`
--
ALTER TABLE `product_box_type`
  ADD PRIMARY KEY (`product_box_type_id`),
  ADD KEY `product_box_type_ibfk_1` (`company_id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`product_brand_id`),
  ADD KEY `product_brand_ibfk_1` (`company_id`),
  ADD KEY `product_brand_ibfk_2` (`product_brand_category_id`);

--
-- Indexes for table `product_brand_warranty`
--
ALTER TABLE `product_brand_warranty`
  ADD PRIMARY KEY (`product_brand_warranty_id`),
  ADD KEY `product_brand_warranty_ibfk_1` (`company_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`),
  ADD KEY `product_category_ibfk_1` (`company_id`);

--
-- Indexes for table `product_condition`
--
ALTER TABLE `product_condition`
  ADD PRIMARY KEY (`product_condition_id`),
  ADD KEY `product_condition_ibfk_1` (`company_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_details_id`),
  ADD KEY `product_details_ibfk_1` (`product_details_box_type`),
  ADD KEY `product_details_ibfk_2` (`product_details_brand`),
  ADD KEY `product_details_ibfk_3` (`product_details_brand_warranty`),
  ADD KEY `product_details_ibfk_4` (`product_details_category`),
  ADD KEY `product_details_ibfk_5` (`product_details_condition`),
  ADD KEY `product_details_ibfk_6` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_box_type`
--
ALTER TABLE `product_box_type`
  MODIFY `product_box_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `product_brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_brand_warranty`
--
ALTER TABLE `product_brand_warranty`
  MODIFY `product_brand_warranty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_condition`
--
ALTER TABLE `product_condition`
  MODIFY `product_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_box_type`
--
ALTER TABLE `product_box_type`
  ADD CONSTRAINT `product_box_type_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD CONSTRAINT `product_brand_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_brand_ibfk_2` FOREIGN KEY (`product_brand_category_id`) REFERENCES `product_category` (`product_category_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product_brand_warranty`
--
ALTER TABLE `product_brand_warranty`
  ADD CONSTRAINT `product_brand_warranty_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_condition`
--
ALTER TABLE `product_condition`
  ADD CONSTRAINT `product_condition_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_details_box_type`) REFERENCES `product_box_type` (`product_box_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_ibfk_2` FOREIGN KEY (`product_details_brand`) REFERENCES `product_brand` (`product_brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_ibfk_3` FOREIGN KEY (`product_details_brand_warranty`) REFERENCES `product_brand_warranty` (`product_brand_warranty_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_ibfk_4` FOREIGN KEY (`product_details_category`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_ibfk_5` FOREIGN KEY (`product_details_condition`) REFERENCES `product_condition` (`product_condition_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_ibfk_6` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
