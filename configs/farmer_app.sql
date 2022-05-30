-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 07:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmer_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `gender`, `email`, `telephone`, `password`, `status`, `created_at`) VALUES
(1, 'Butera', 'Butchi', 'Male', 'buterathierry@gmail.com', '0784546343', '12345', 'inactive', '2021-11-12 13:52:12'),
(4, 'Mugabo', 'Gard', 'Male', 'mugabo@gmail.com', '0785065466', '123gad', 'inactive', '2021-11-25 10:20:47'),
(5, 'GAHIMA', 'Philbert', 'Male', 'gahima@gmail.com', '0785533235', '123', 'active', '2021-12-07 00:19:36'),
(6, 'Ziggy', 'Double 5', 'Male', 'ziggy@gmail.com', '07853030440', 'abc', 'active', '2021-12-07 01:41:17'),
(7, 'Kamanzi', 'Innocent', 'Male', 'kamanzi@gmail.com', '0785534322', '12345', 'inactive', '2021-12-08 10:51:35'),
(8, 'Mugabe', 'Robert', 'Male', 'mugabe@gmail.com', '0785534311', '12345', 'active', '2021-12-08 12:51:23'),
(9, 'Danny', 'Nanone', 'Male', 'danny@gmail.com', '0781003000', '1234', 'active', '2021-12-11 01:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ann_id` int(10) NOT NULL,
  `ann_title` varchar(150) NOT NULL DEFAULT 'Announcement',
  `announcement` text NOT NULL,
  `ann_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`ann_id`, `ann_title`, `announcement`, `ann_date`) VALUES
(1, 'Farmers facilitation App', 'Muraho neza turabamenyeshako kuwa mbere taliki 25 abemerewe gufata ibyo basabye bemerewe kuza kubitwara', '2021-11-27 04:56:48'),
(11, 'Kumenyesha', 'Turabamenyesha ko mukwiye kutugereraho igihe', '2021-11-27 13:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmer_id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `national_id` varchar(30) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `land_area` varchar(20) NOT NULL,
  `province` varchar(30) NOT NULL,
  `district` varchar(80) NOT NULL,
  `sector` varchar(80) NOT NULL,
  `cell` varchar(80) NOT NULL,
  `village` varchar(80) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmer_id`, `firstname`, `lastname`, `gender`, `dob`, `national_id`, `telephone`, `password`, `land_area`, `province`, `district`, `sector`, `cell`, `village`, `status`, `created_at`) VALUES
(1, 'Iradufasha', 'Gad', 'Male', '1998-03-02', '1199004565345345', '0784557411', '1234', '40', 'SOUTH', 'Huye', 'Tumba', 'Mukoni', 'Rebero', 'inactive', '2021-11-12 22:01:12'),
(2, 'Umwali', 'Alice', 'Female', '2000-03-02', '12000404565345345', '0783476200', '1234', '54', 'SOUTH', 'Huye', 'Tumba', 'Mukoni', 'Rebero', 'active', '2021-11-12 22:13:15'),
(3, 'Mukiza', 'Fabrice', 'Male', '1998-03-02', '11998404565345345', '0788888544', '1234', '44', 'SOUTH', 'Huye', 'Rango', 'Don Bosco', 'Rebero', 'active', '2021-11-12 23:47:44'),
(4, 'Byiringiro', 'Ellis', 'Male', '1945-03-02', '119984045622222', '0783555784', '1234', '30', 'SOUTH', 'Nyanza', 'Ku mazu', 'Don Bosco', 'Rebero', 'active', '2021-11-13 00:12:20'),
(5, 'Butera', 'Thierry', 'Male', '2021-11-15', '11998805543453543', '0780567476', '1234', '32', 'SOUTH', 'Huye', 'Tumba', 'Cyarwa', 'Kiyovu', 'active', '2021-11-15 20:08:20'),
(6, 'Wilson', 'Jack', 'Male', '2021-11-11', '119999345434344444', '0785050500', '1234', '40', 'SOUTH', 'Nyanza', 'Tumba', 'Gitesanyi', 'Tumba 2', 'active', '2021-11-25 10:24:42'),
(7, 'IRERE', 'Jules Chris', 'Male', '2001-02-04', '1199883455323454322', '0783476200', '1234', '20', 'SOUTH', 'Muhanga', 'Tumba', 'Cyarwa', 'Kiyovu', 'active', '2021-11-25 11:34:30'),
(8, 'Munezero', 'Paul', 'Male', '2000-10-10', '1200003304449339', '0784576634', '123', '50', 'NORTH', 'GUCUMBI', 'KINAZI', 'KAMIKAZE', 'UMUCYO', 'inactive', '2021-11-27 21:39:13'),
(10, 'Tumusime', 'Vianney', 'Male', '2021-11-26', '199433456534876663', '0785534322', '1234', '60', 'EAST', 'HUYE', 'TUMBA', 'CYARWA', 'UMUNEZERO', 'active', '2021-11-27 21:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `fertilizer`
--

CREATE TABLE `fertilizer` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_type` varchar(150) NOT NULL,
  `quantity` int(10) NOT NULL,
  `unit_price` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fertilizer`
--

INSERT INTO `fertilizer` (`item_id`, `item_name`, `item_type`, `quantity`, `unit_price`, `created_at`) VALUES
(1, 'NPK ONE', 'Calcium', 4, 500, '2021-11-13 12:07:11'),
(2, 'DAP COOL', 'Calcium', 43, 600, '2021-11-13 13:15:34'),
(3, 'YARA MIDA', 'Planting', 100, 1120, '2021-11-13 13:16:06'),
(5, 'NPK 15', 'Inorganic', 4, 500, '2021-11-13 13:53:50'),
(7, 'NPK TWO', 'Nitrogen', 6, 700, '2021-11-13 14:13:14'),
(8, 'NPK TWO', 'Calcium', 4, 900, '2021-11-13 14:14:23'),
(9, 'Yala Mida De Casa', 'Planting', 9200, 900, '2021-11-25 10:35:28'),
(10, 'Urea 500', 'Weeding', 800, 600, '2021-11-27 07:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `harvest`
--

CREATE TABLE `harvest` (
  `harvest_id` int(10) NOT NULL,
  `farmer_id` int(10) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `harvest_price` double NOT NULL,
  `season_year` varchar(10) NOT NULL,
  `season_term` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unchecked',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harvest`
--

INSERT INTO `harvest` (`harvest_id`, `farmer_id`, `item_type`, `quantity`, `harvest_price`, `season_year`, `season_term`, `status`, `created_at`) VALUES
(1, 2, 'Fertilizer', 5, 600, '2021', 'A', 'unchecked', '2021-11-26 21:54:51'),
(2, 5, 'Short Rice', 100, 250, '2021', 'B', 'checked', '2021-11-26 21:56:55'),
(3, 7, 'Buryohe', 87, 240, '2021', 'A', 'unchecked', '2021-11-27 04:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `limitation`
--

CREATE TABLE `limitation` (
  `item_id` int(5) NOT NULL,
  `land_area` int(12) NOT NULL,
  `q_seeds` int(12) NOT NULL,
  `q_fertilizer` int(12) NOT NULL,
  `q_pesticide` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `limitation`
--

INSERT INTO `limitation` (`item_id`, `land_area`, `q_seeds`, `q_fertilizer`, `q_pesticide`) VALUES
(1, 10000, 100, 50, 25),
(2, 5000, 80, 40, 20),
(3, 2500, 70, 35, 20),
(4, 2000, 65, 30, 18),
(5, 1000, 60, 25, 20),
(6, 500, 50, 22, 17),
(7, 200, 30, 18, 15),
(8, 100, 26, 16, 14),
(9, 50, 24, 14, 12),
(10, 25, 20, 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `req_id` int(10) NOT NULL,
  `order_status` varchar(30) NOT NULL,
  `paid_telno` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `reference` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `req_id`, `order_status`, `paid_telno`, `amount`, `reference`, `order_date`) VALUES
(1, 3, 'PENDING', '0784557411', 76000000, '6fcda462-9908-4667-b149-ce028fef0f36', '2021-12-11 01:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `pesticide`
--

CREATE TABLE `pesticide` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_type` varchar(150) NOT NULL,
  `quantity` int(10) NOT NULL,
  `unit_price` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesticide`
--

INSERT INTO `pesticide` (`item_id`, `item_name`, `item_type`, `quantity`, `unit_price`, `created_at`) VALUES
(1, 'Albendazole', 'Organic', 150, 5000, '2021-11-13 14:23:28'),
(2, 'Beam (Fungicide)', 'Organic', 500, 1500, '2021-11-27 07:02:48'),
(3, 'Spermetrine', 'Non-Organic', 590, 860, '2021-11-27 07:03:54'),
(4, 'Insecticide', 'Organic', 400, 980, '2021-12-06 06:08:12'),
(5, 'Cypermethrin', 'Organic', 1600, 550, '2021-12-06 06:09:06'),
(6, 'Rocket (Fungicide)', 'Organic', 800, 1400, '2021-12-06 06:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` int(10) NOT NULL,
  `farmer_id` int(10) NOT NULL,
  `seed_id` int(10) NOT NULL,
  `seed_qty` int(10) NOT NULL,
  `fert_id` int(10) NOT NULL,
  `fert_qty` int(10) NOT NULL,
  `pest_id` int(10) NOT NULL,
  `pest_qty` int(10) NOT NULL,
  `season_year` varchar(10) NOT NULL,
  `season_term` varchar(20) NOT NULL,
  `req_status` varchar(15) NOT NULL DEFAULT 'Pending',
  `is_paid` varchar(10) NOT NULL DEFAULT 'Yes',
  `req_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `farmer_id`, `seed_id`, `seed_qty`, `fert_id`, `fert_qty`, `pest_id`, `pest_qty`, `season_year`, `season_term`, `req_status`, `is_paid`, `req_date`) VALUES
(1, 1, 1, 50, 2, 23, 1, 14, '2021', 'Term A', 'Accepted', 'Yes', '2021-11-14 07:04:03'),
(3, 2, 1, 50, 2, 23, 1, 19, '2021', 'Term B', 'Pending', 'Yes', '2021-11-14 10:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `seeds`
--

CREATE TABLE `seeds` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_type` varchar(150) NOT NULL,
  `quantity` int(10) NOT NULL,
  `unit_price` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seeds`
--

INSERT INTO `seeds` (`item_id`, `item_name`, `item_type`, `quantity`, `unit_price`, `created_at`) VALUES
(1, 'Long grain', 'Planting', 7000, 700, '2021-11-13 14:17:28'),
(2, 'Kigoli Ngufi', 'Planting', 16000, 400, '2021-11-13 14:19:38'),
(5, 'Kigoli Ndende', 'Planting', 40, 300, '2021-11-27 06:56:55'),
(6, 'Uni', 'Planting', 123, 1500, '2021-11-27 06:59:53'),
(7, 'Twigire', 'Planting', 17550, 460, '2021-12-06 06:12:52'),
(8, 'Nerica 9', 'Planting', 24000, 380, '2021-12-06 06:13:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ann_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`farmer_id`) USING BTREE;

--
-- Indexes for table `fertilizer`
--
ALTER TABLE `fertilizer`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- Indexes for table `harvest`
--
ALTER TABLE `harvest`
  ADD PRIMARY KEY (`harvest_id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `limitation`
--
ALTER TABLE `limitation`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `req_id` (`req_id`);

--
-- Indexes for table `pesticide`
--
ALTER TABLE `pesticide`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `farmer_id` (`farmer_id`),
  ADD KEY `seed_id` (`seed_id`),
  ADD KEY `fert_id` (`fert_id`),
  ADD KEY `pest_id` (`pest_id`);

--
-- Indexes for table `seeds`
--
ALTER TABLE `seeds`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ann_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `farmer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fertilizer`
--
ALTER TABLE `fertilizer`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `harvest`
--
ALTER TABLE `harvest`
  MODIFY `harvest_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `limitation`
--
ALTER TABLE `limitation`
  MODIFY `item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesticide`
--
ALTER TABLE `pesticide`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seeds`
--
ALTER TABLE `seeds`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `harvest`
--
ALTER TABLE `harvest`
  ADD CONSTRAINT `harvest_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`farmer_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `requests` (`req_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`farmer_id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`farmer_id`),
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`seed_id`) REFERENCES `seeds` (`item_id`),
  ADD CONSTRAINT `requests_ibfk_4` FOREIGN KEY (`fert_id`) REFERENCES `fertilizer` (`item_id`),
  ADD CONSTRAINT `requests_ibfk_5` FOREIGN KEY (`pest_id`) REFERENCES `pesticide` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
