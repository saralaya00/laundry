-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2018 at 09:36 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `FK_customer_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 2, 'Deepa V Tendulkar', 'kajaraguttu,hiriadka,udupi', ' deepa123@gmail.com ', '9976890870'),
(2, 3, 'Amey Kamath', 'kulur,mangalore', 'ameykamatH@gmail.com', '9234567810'),
(3, 6, 'Deepak Shetty', 'lalbagh,mangalore', 'deepak34@gmail.com', '9976890870');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL,
  PRIMARY KEY (`employee_id`) USING BTREE,
  KEY `FK_employee_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 1, 'Pooja V Tendulkar', 'Parashuramanagar,kavoor', 'pooja@gmail.com', '7541258965'),
(2, 4, 'Rakshith  Kumar', 'Hampankatte, mangalore', 'rakshithkumar@gmail.com', '9900667233'),
(3, 5, 'Rakesh Nayak', 'bondel,mangalore', 'rakeshnayak@gmail.com', '7890765431'),
(9, 13, 'Raksha Rao', 'alevoor', 'sraoraksha@gmail.com', '9482037703'),
(10, 14, 'Raksha Rao', 'alevoor', 'sraoraksha@gmail.com', '7353363477'),
(11, 15, 'Raksha Rao', 'alevoor', 'sraoraksha@gmail.com', '7586932561');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(30) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `flag`) VALUES
(1, 'SILK SAREE', 0),
(2, 'FANCY SAREE', 0),
(3, 'BLANKET', 0),
(4, 'JEANS', 0),
(5, 'CURTAINS', 0),
(6, 'PANT', 0),
(7, 't-shirt', 0),
(8, 'Shirt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_service`
--

CREATE TABLE IF NOT EXISTS `item_service` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `price` int(4) NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_service_item_id` (`item_id`) USING BTREE,
  KEY `FK_item_service_service_id` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `item_service`
--

INSERT INTO `item_service` (`id`, `item_id`, `service_id`, `price`, `flag`) VALUES
(35, 1, 1, 10, 0),
(36, 1, 5, 50, 1),
(37, 1, 3, 10, 1),
(38, 1, 2, 20, 1),
(39, 2, 2, 30, 1),
(40, 3, 2, 50, 1),
(41, 4, 2, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FK_orders_customer_id` (`customer_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `delivery_date`, `status`) VALUES
(1, 2, '2018-06-18', '2018-06-27', 'not assigned'),
(2, 1, '2018-06-04', '2018-06-18', 'not assigned'),
(3, 3, '2018-06-13', '2018-06-22', 'assigned'),
(4, 2, '2018-06-17', '2018-06-27', 'collected'),
(5, 3, '2018-06-20', '2018-06-27', 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `FK_item_service_id` (`id`) USING BTREE,
  KEY `FK_order_details_order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE IF NOT EXISTS `order_tracking` (
  `tracking_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Record Insertions Only',
  `order_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Tracking Status and not item-service status',
  PRIMARY KEY (`tracking_id`),
  KEY `FK_order_tracking_employee_id` (`employee_id`) USING BTREE,
  KEY `FK_order_tracking_order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `employee_id`, `status`) VALUES
(1, 5, 2, ''),
(2, 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `order_id` int(10) NOT NULL,
  `review_date` date NOT NULL,
  `ratings` int(1) NOT NULL,
  `description` text NOT NULL,
  KEY `FK_feedback_order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(10) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(30) NOT NULL,
  `description` text,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `flag`) VALUES
(1, 'Dyeing', 'its colouring of the cloths.', 1),
(2, 'Dry clean', 'washing the cloths adding chemical', 1),
(3, 'Iron', 'ironing of cloths.', 1),
(4, 'wash', 'machine wash/ hand wash of cloths.', 1),
(5, 'Bleaching', '..', 1),
(7, 'Garning', '/.,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'Pooja V Tendulkar', 'pooja123', 'Employee'),
(2, 'Deepa V Tendulkar', 'deepa123', 'Customer'),
(3, 'Amey Kamath', 'amey123', 'Customer'),
(4, 'Rakshith', 'raksh123', 'Employee'),
(5, 'Rakesh', 'rakesh123', 'Employee'),
(6, 'Deepak ', 'deep123', 'Customer'),
(13, '9482037703', '', 'Employee'),
(14, '7353363477', '', 'Employee'),
(15, '7586932561', '', 'Employee');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_customer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_employee_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `item_service`
--
ALTER TABLE `item_service`
  ADD CONSTRAINT `FK_item_service_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `FK_item_service_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_item_service_id` FOREIGN KEY (`id`) REFERENCES `item_service` (`id`),
  ADD CONSTRAINT `FK_order_details_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD CONSTRAINT `FK_order_tracking_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `FK_order_tracking_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_feedback_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
