-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2018 at 11:46 AM
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

INSERT INTO `customer` (`customer_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(1, 'Divya Prasad', 'near petrol bunk ,perdoor,udupi', 'divyaprasad@gmail.com', '8748867807'),
(2, 'shyamprasad Nayak', '4-82B j p nagar,bangalore', 'syamnayak@yahoo.com', '9000857880'),
(3, 'Deepa Tendulkar', '\"sri hari\",karkala,udupi', 'deepa123@gmail.com', '9845678990'),
(4, 'saurabh saralaya', 'kadiyali,udupi', 's9work@gmail.com', '9976890870'),
(5, 'Priya Pai', 'parashurama nagar,kavoor,mangalore', 'priya123@gmail.com', '7890765431');

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `full_name`, `address`, `email`, `contact_no`) VALUES
(101, 'Rakesh Nayak', 'narasinge,manipal,Udupi', 'rakeshbnayak@gmail.com', '7890654234'),
(102, 'Shubhada Bhat', 'kulur,mangalore', 'bhatshubhada@gmail.com', '9972567789'),
(104, 'Arfan ', 'udyavara,udupi', 'arfanshaik@gmail.com', '9234567810'),
(105, 'lavanya kamath', 'lalbagh,mangalore', 'lavanyakarthik@gmail.com', '8090765432'),
(106, 'Shwetha D', 'hampankatte,mangalore', NULL, '7890654256');

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`) VALUES
(1, 'Pant'),
(2, 'Bedsheet'),
(3, 'silk saree'),
(4, 'Uniform'),
(5, 'blanket');

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `delivery_date`, `status`) VALUES
(10, 5, '2018-06-17', '2018-06-25', 'Assigned'),
(11, 4, '2018-06-14', '2018-06-20', 'collected'),
(13, 1, '2018-06-05', '2018-06-17', 'assigned'),
(14, 2, '2018-06-16', '2018-06-23', 'collected'),
(15, 5, '2018-06-11', '2018-06-19', 'assigned');

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `employee_id`, `status`) VALUES
(1, 13, 101, 'Delivered'),
(2, 14, 102, 'Pending '),
(3, 11, 105, 'Pending '),
(4, 15, 102, 'delivered'),
(5, 10, 104, 'Pending');

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`) VALUES
(1, 'Dry Clean', ' dry cleaning done using some chemicals which removes stain.'),
(2, 'Iron', 'Steam iron is done.'),
(3, 'Wash', 'cloths will be washed in machines.'),
(4, 'Dyeing', 'Adding colors to cloth');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
