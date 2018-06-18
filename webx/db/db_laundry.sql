-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2018 at 12:57 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

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
  `full_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 'Divya Prasad', 'near petrol bunk ,perdoor,udupi', 'divyaprasad@gmail.com', '8748867807'),
(2, 'shyamprasad Nayak', '4-82B j p nagar,bangalore', 'syamnayak@yahoo.com', '9000857880'),
(3, 'Deepa Tendulkar', '\"sri hari\",karkala,udupi', 'deepa123@gmail.com', '9845678990'),
(4, 'saurabh saralaya', 'kadiyali,udupi', 's9work@gmail.com', '9976890870'),
(5, 'Priya Pai', 'parashurama nagar,kavoor,mangalore', 'priya123@gmail.com', '7890765431');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emoloyee_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emoloyee_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(101, 'Rakesh Nayak', 'narasinge,manipal,Udupi', 'rakeshbnayak@gmail.com', '7890654234'),
(102, 'Shubhada Bhat', 'kulur,mangalore', 'bhatshubhada@gmail.com', '9972567789'),
(104, 'Arfan ', 'udyavara,udupi', 'arfanshaik@gmail.com', '9234567810'),
(105, 'lavanya kamath', 'lalbagh,mangalore', 'lavanyakarthik@gmail.com', '8090765432'),
(106, 'Shwetha D', 'hampankatte,mangalore', NULL, '7890654256');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `order_id` int(10) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`) VALUES
(1, 'Pant'),
(2, 'Bedsheet'),
(3, 'silk saree'),
(4, 'Uniform'),
(5, 'blanket');

-- --------------------------------------------------------

--
-- Table structure for table `item_service`
--

CREATE TABLE `item_service` (
  `s_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_service`
--

INSERT INTO `item_service` (`s_id`, `item_id`, `service_id`, `price`) VALUES
(1, 4, 3, 100),
(2, 3, 1, 150),
(3, 5, 2, 180),
(4, 5, 3, 170);

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
(10, 5, '2018-06-17', '2018-06-25', 'Assigned'),
(11, 4, '2018-06-14', '2018-06-20', 'collected'),
(13, 1, '2018-06-05', '2018-06-17', 'assigned'),
(14, 2, '2018-06-16', '2018-06-23', 'collected'),
(15, 5, '2018-06-11', '2018-06-19', 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `s_id`, `quantity`) VALUES
(11, 2, 2),
(14, 4, 1),
(13, 3, 5),
(14, 1, 3),
(13, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `tracking_id` int(10) NOT NULL COMMENT 'Record Insertions Only',
  `order_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Tracking Status and not item::service status'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `employee_id`, `status`) VALUES
(1, 13, 101, 'Delivered'),
(2, 14, 102, 'Pending '),
(3, 11, 105, 'Pending '),
(4, 15, 102, 'delivered'),
(5, 10, 104, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`) VALUES
(1, 'Dry Clean', ' dry cleaning done using some chemicals which removes stain.'),
(2, 'Iron', 'Steam iron is done.'),
(3, 'Wash', 'cloths will be washed in machines.'),
(4, 'Dyeing', 'Adding colors to cloth');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emoloyee_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD KEY `FK_feedback_order_id` (`order_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_service`
--
ALTER TABLE `item_service`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `fk_on_order` (`order_id`),
  ADD KEY `fk_on_s_id` (`s_id`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `FK_order_id` (`order_id`),
  ADD KEY `FK_employee_id` (`employee_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `fk_cust` (`cust_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emoloyee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `tracking_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Record Insertions Only', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_feedback_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `item_service`
--
ALTER TABLE `item_service`
  ADD CONSTRAINT `item_service_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `item_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_on_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_on_s_id` FOREIGN KEY (`s_id`) REFERENCES `item_service` (`s_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD CONSTRAINT `FK_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`emoloyee_id`),
  ADD CONSTRAINT `FK_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_cust` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emoloyee_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
