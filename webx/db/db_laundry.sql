-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2018 at 02:41 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `employee` (
  `employee_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 1, 'Pooja V Tendulkar', 'Parashuramanagar,kavoor', 'pooja@gmail.com', '7541258965'),
(2, 4, 'Rakshith  Kumar', 'Hampankatte, mangalore', 'rakshithkumar@gmail.com', '9900667233'),
(3, 5, 'Rakesh Nayak', 'bondel,mangalore', 'rakeshnayak@gmail.com', '7890765431'),
(8, 12, 'Saurabh Saralaya', 'as', 'nogtx7k@gmail.com', '8971056410');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`) VALUES
(1, 'SILK SAREE'),
(2, 'FANCY SAREE'),
(3, 'BLANKET'),
(4, 'JEANS'),
(5, 'CURTAINS'),
(6, 'PANT');

-- --------------------------------------------------------

--
-- Table structure for table `item_service`
--

CREATE TABLE `item_service` (
  `id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_service`
--

INSERT INTO `item_service` (`id`, `item_id`, `service_id`, `price`) VALUES
(1, 2, 2, 100),
(2, 2, 3, 80),
(3, 4, 2, 80),
(4, 5, 2, 120),
(5, 6, 4, 60),
(6, 1, 4, 180);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `delivery_date`, `status`) VALUES
(1, 2, '2018-06-18', '2018-06-27', 'not assigned'),
(2, 1, '2018-06-04', '2018-06-18', 'delivered'),
(3, 3, '2018-06-13', '2018-06-22', 'collected'),
(4, 2, '2018-06-17', '2018-06-27', 'processed'),
(5, 3, '2018-06-20', '2018-06-27', 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `id`, `quantity`) VALUES
(1, 2, 5),
(4, 4, 1),
(2, 5, 3),
(3, 2, 1),
(1, 5, 2),
(5, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `tracking_id` int(10) NOT NULL COMMENT 'Record Insertions Only',
  `order_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Tracking Status and not item-service status'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `employee_id`, `status`) VALUES
(1, 1, 3, 'Pending '),
(2, 2, 2, 'Delivered'),
(3, 3, 1, 'collected'),
(4, 4, 2, 'processed'),
(5, 5, 2, 'Pending ');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `order_id` int(10) NOT NULL,
  `review_date` date NOT NULL,
  `ratings` int(1) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(10) NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`) VALUES
(1, 'Dyeing', 'its colouring of the cloths.'),
(2, 'Dry clean', 'washing the cloths adding chemical'),
(3, 'Iron', 'ironing of cloths.'),
(4, 'wash', 'machine wash/ hand wash of cloths.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, '8971056410', '', 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `FK_customer_user_id` (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`) USING BTREE,
  ADD KEY `FK_employee_user_id` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_service`
--
ALTER TABLE `item_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_item_service_item_id` (`item_id`) USING BTREE,
  ADD KEY `FK_item_service_service_id` (`service_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_orders_customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `FK_item_service_id` (`id`) USING BTREE,
  ADD KEY `FK_order_details_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `FK_order_tracking_employee_id` (`employee_id`) USING BTREE,
  ADD KEY `FK_order_tracking_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `FK_feedback_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `tracking_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Record Insertions Only', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `FK_item_service_id` FOREIGN KEY (`id`) REFERENCES `item_service` (`id`) ON DELETE CASCADE,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
