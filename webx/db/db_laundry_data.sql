-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2018 at 01:55 PM
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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 5, 'Rameh', 'udp', 'udp@gmail.com', '8971056410'),
(2, 7, 'Nagesh', 'Udupi', 'nagesh123@gmail.com', '7586984524'),
(3, 8, 'Sheefa', 'Udupi', 'ss123@gmail.com', '7845124578'),
(4, 9, 'Sam', 'Bangaloru', 'sam123@gmail.com', '8654125689');

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `user_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 2, 'Raksha Rao', 'udupi', 'sraorakhsa@gmail.com', '1234567890'),
(2, 3, 'Pooja Tendulkar', 'hiritadka', 'poojavt@gmail.com', '0987654322'),
(3, 6, 'Saurabh Saralaya', '\"Saurabha\" 1-2-125b\nbehind kadiyali post office', 'nogtx7k@gmail.com', '1111111111'),
(4, 11, 'Dheeraj Rai', 'Mysore', 'dhee@gmail.com', '8575839383');

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`) VALUES
(1, 'T-shirt'),
(2, 'Pants'),
(3, 'Socks'),
(4, 'Lungi');

--
-- Dumping data for table `item_service`
--

INSERT INTO `item_service` (`id`, `item_id`, `service_id`, `price`, `flag`) VALUES
(1, 1, 1, 20, 1),
(2, 3, 1, 1, 1),
(3, 1, 3, 20, 1),
(4, 1, 2, 50, 1),
(5, 1, 4, 10, 1),
(6, 2, 4, 30, 1),
(7, 3, 4, 40, 1);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `delivery_date`, `status`) VALUES
(1, 1, '2018-07-21', '0000-00-00', 'assigned'),
(3, 1, '2018-07-21', '2018-08-04', 'delivered'),
(6, 1, '2018-09-09', '0000-00-00', 'assigned'),
(7, 1, '2018-09-09', '0000-00-00', 'not assigned'),
(8, 3, '2018-09-09', '0000-00-00', 'assigned');

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `id`, `quantity`) VALUES
(1, 3, 2),
(3, 3, 5),
(6, 1, 10),
(6, 2, 5),
(6, 3, 1),
(7, 3, 3),
(7, 1, 3),
(8, 1, 3),
(7, 2, 3),
(7, 2, 10),
(8, 4, 3);

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `employee_id`, `status`) VALUES
(1, 1, 1, ''),
(2, 1, 1, 'assigned'),
(3, 1, 1, 'delivered'),
(4, 1, 2, 'assigned'),
(5, 6, 1, ''),
(6, 6, 3, 'assigned'),
(7, 8, 2, ''),
(8, 8, 2, '');

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`) VALUES
(1, 'Wash', '........'),
(2, 'Dry Clean', 'Wash with chemicals'),
(3, 'Iron', '...'),
(4, 'Bleach', 'Bleach your clothes with our premium service');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin'),
(2, 'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646', '916f37ba7eb4459bc5c2e7a13a5b89882c2ced553dc8e29c753b12b74eb46412', 'Employee'),
(3, 'd88a8cfc6a4483536de276fc6c0b9b906ed26425ca26d6e8dbea33be769f1ac6', '916f37ba7eb4459bc5c2e7a13a5b89882c2ced553dc8e29c753b12b74eb46412', 'Employee'),
(5, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Customer'),
(6, 'd2d02ea74de2c9fab1d802db969c18d409a8663a9697977bb1c98ccdd9de4372', '916f37ba7eb4459bc5c2e7a13a5b89882c2ced553dc8e29c753b12b74eb46412', 'Employee'),
(7, '7a3e6b16cb75f48fb897eff3ae732f3154f6d203b53f33660f01b4c3b6bc2df9', '7a3e6b16cb75f48fb897eff3ae732f3154f6d203b53f33660f01b4c3b6bc2df9', 'Customer'),
(8, 'a1dd6837f284625bdb1cb68f1dbc85c5dc4d8b05bae24c94ed5f55c477326ea2', 'a1dd6837f284625bdb1cb68f1dbc85c5dc4d8b05bae24c94ed5f55c477326ea2', 'Customer'),
(9, '88c0413bfef1d0570a8a6f9c780a8d2c9e90c4d107551d62bf3cec9ff1f5b634', '88c0413bfef1d0570a8a6f9c780a8d2c9e90c4d107551d62bf3cec9ff1f5b634', 'Customer'),
(10, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Admin'),
(11, 'a9d4a67f0d94bf9f6862b006d47e3aa28d72b1721fd521a499dcc7134bcb59b2', '916f37ba7eb4459bc5c2e7a13a5b89882c2ced553dc8e29c753b12b74eb46412', 'Employee');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
