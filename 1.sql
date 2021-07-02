-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 10:39 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userid` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `password`) VALUES
('admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `discount` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `discount`, `status`) VALUES
(11, 'PRSO9CZG0D', 35, 'Valid'),
(12, 'PRWXYU83ET', 10, 'Valid'),
(13, 'PRFVQ6QZZE', 20, 'Valid');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` char(30) NOT NULL,
  `name` char(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `mobile` int(50) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `name`, `address`, `mobile`, `email`, `image`, `password`) VALUES
('c-27', 'kross', 'dhaka', 1818181818, 'kross@gmail.com', '29c8800e681fa02ee84564de88370703.jpg', '12345'),
('c-40', 'benzema', 'chittagong', 1818890776, 'benzema@gmail.com', 'b6699f26fc8c3630a8daaaf4b5a893c7.jpg', '12345'),
('c-68', 'ekram', 'Barisal', 181111111, 'ekram@gmail.com', '0d6fba70fa529daa57ad5e4711133581.jpg', '12345'),
('c-81', 'fara', 'dhaka', 2147483647, 'fara@gmail.com', 'a4ae6658acbc785e90264dcab5730c8d.jpg', 'fara');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` char(30) NOT NULL,
  `cus_id` char(30) DEFAULT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `t_price` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `cus_id`, `p_id`, `quantity`, `t_price`, `order_date`, `status`) VALUES
('O-539', 'c-27', 999, 1, 1040, '2021-05-29', 0),
('O-702', 'c-68', 99, 3, 2340, '2021-05-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` char(30) NOT NULL,
  `pname` char(50) NOT NULL,
  `ptype` varchar(100) DEFAULT NULL,
  `brandname` char(50) DEFAULT NULL,
  `bprice` float DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `pname`, `ptype`, `brandname`, `bprice`, `image`) VALUES
('1', 'random', 'cloth', 'urahs', 500, 'e101460e82d143ab37b22a30f4ab3e64.jpg'),
('110', 'exotic', 'wildlife', 'dgdfg', 5000, '5d383236fcffbee850deab0bcddbf628.jpg'),
('2', 'random1', 'shoe', 'random1', 100, '2da18eaea13b45d1c526d3685bc912f6.jpg'),
('3', 'random2', 'WILDLIFE', 'random2', 110, '334d240a1287bac468f61c28c2c5c250.jpg'),
('7', 'random7', 'street', 'random7', 111, '00b17774347288ae0bc8e3f13021b303.jpg'),
('9090', 'llllllllll', 'wildlife', 'llllllllll', 10000, 'f022895bd0c202eea054479a942681ee.jpg'),
('99', 'mac', 'urban', 'apple', 1200, 'e7fd68223485c8a91a41918641bf05a2.jpg'),
('999', 'Apple', 'wildlife', 'Mac', 1300, 'adb860165c3728bcc7724e6a58f691ac.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `rating` int(10) NOT NULL,
  `reviewDetails` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `p_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `p_id` char(30) NOT NULL,
  `sellingPrice` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`p_id`, `sellingPrice`, `quantity`) VALUES
('2', 100, 1),
('3', 1100, 3),
('7', 120, 0),
('9090', 1200, 2),
('99', 3000, 20),
('999', 2000, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_order` (`cus_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON UPDATE CASCADE;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `fk_store` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
