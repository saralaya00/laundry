-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2018 at 10:16 AM
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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 2, 'Deepa V Tendulkar', 'kajaraguttu,hiriadka,udupi', ' deepa123@gmail.com ', '9976890870'),
(2, 3, 'Amey Kamath', 'kulur,mangalore', 'ameykamatH@gmail.com', '9234567810'),
(3, 6, 'Deepak Shetty', 'lalbagh,mangalore', 'deepak34@gmail.com', '9976890870');

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 1, 'Pooja V Tendulkar', 'Parashuramanagar,kavoor', 'pooja@gmail.com', '7890765431'),
(2, 4, 'Rakshith  Kumar', 'Hampankatte, mangalore', 'rakshithkumar@gmail.com', '9900667233'),
(3, 5, 'Rakesh Nayak', 'bondel,mangalore', 'rakeshnayak@gmail.com', '7890765431');

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`) VALUES
(1, 'SILK SAREE'),
(2, 'FANCY SAREE'),
(3, 'BLANKET'),
(4, 'JEANS'),
(5, 'CURTAINS'),
(6, 'PANT');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `delivery_date`, `status`) VALUES
(1, 2, '2018-06-18', '2018-06-27', 'not-assigned'),
(2, 1, '2018-06-04', '2018-06-18', 'delivered'),
(3, 3, '2018-06-13', '2018-06-22', 'collected'),
(4, 2, '2018-06-17', '2018-06-27', 'processed'),
(5, 3, '2018-06-20', '2018-06-27', 'assigned');

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

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `employee_id`, `status`) VALUES
(1, 1, 3, 'Pending '),
(2, 2, 2, 'Delivered'),
(3, 3, 1, 'collected'),
(4, 4, 2, 'processed'),
(5, 5, 2, 'Pending ');

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`) VALUES
(1, 'Dyeing', 'its colouring of the cloths.'),
(2, 'Dry clean', 'washing the cloths adding chemical'),
(3, 'Iron', 'ironing of cloths.'),
(4, 'wash', 'machine wash/ hand wash of cloths.');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'Pooja V Tendulkar', 'pooja123', 'Employee'),
(2, 'Deepa V Tendulkar', 'deepa123', 'Customer'),
(3, 'Amey Kamath', 'amey123', 'Customer'),
(4, 'Rakshith', 'raksh123', 'Employee'),
(5, 'Rakesh', 'rakesh123', 'Employee'),
(6, 'Deepak ', 'deep123', 'Customer');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
