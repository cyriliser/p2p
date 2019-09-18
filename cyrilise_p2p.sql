-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2019 at 07:49 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyrilise_p2p`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(90) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `surname`, `email`, `password`, `phone`) VALUES
(7, 'siya@gmail.com', 'sya', 'mbatha', 'siya@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', ''),
(8, 'yaya', '', '', 'yaya@gmail.com', '4409eae53c2e26a65cfc24b3a2359eb9', '012346789');

-- --------------------------------------------------------

--
-- Table structure for table `adminrefscomplaints`
--

CREATE TABLE `adminrefscomplaints` (
  `id` int(11) NOT NULL,
  `from_user` int(11) DEFAULT NULL,
  `msg` varchar(5000) DEFAULT NULL,
  `opened` bit(1) DEFAULT NULL,
  `date_received` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminusercomplaints`
--

CREATE TABLE `adminusercomplaints` (
  `id` int(11) NOT NULL,
  `from_user` int(11) DEFAULT NULL,
  `msg` varchar(5000) DEFAULT NULL,
  `opened` bit(1) DEFAULT NULL,
  `date_received` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `ref_sender` int(11) DEFAULT NULL,
  `user_sender` int(11) DEFAULT NULL,
  `msg` varchar(5000) DEFAULT NULL,
  `opened` bit(1) DEFAULT NULL,
  `date_received` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `owner`, `ref_sender`, `user_sender`, `msg`, `opened`, `date_received`) VALUES
(1, 8, 2, NULL, '<a href=\'/api/reference_manager.php?confirm=2\'>Confirm payment for yaya_ref4</a>', b'0', '2019-09-10'),
(2, 8, 2, NULL, '<a href=\'/api/reference_manager.php?confirm=2\'>Confirm payment for yaya_ref4</a>', b'0', '2019-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `return_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `amount`, `return_amount`) VALUES
(1, 'Basic', 500, 1000),
(2, 'Starter', 1000, 2000),
(3, 'Premium', 1500, 3000),
(4, 'Pro', 2000, 4000),
(5, 'Ultimate', 2500, 5000),
(6, 'Queen', 3000, 6000),
(7, 'King', 3500, 7000),
(8, 'Silver', 4000, 8000),
(9, 'Gold', 4500, 9000),
(10, 'Platinum', 5000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `refs`
--

CREATE TABLE `refs` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `contact_cell` int(11) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `account_no` int(11) DEFAULT NULL,
  `linked_cell` int(11) DEFAULT NULL,
  `referer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refs`
--

INSERT INTO `refs` (`id`, `username`, `email`, `password`, `name`, `surname`, `date_of_birth`, `contact_cell`, `bank_name`, `account_no`, `linked_cell`, `referer_id`) VALUES
(1, 'yaya_ref5', 'yaya_ref5@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'yaya_ref5', 'yaya_ref5', '0000-00-00', 0, 'capitec', 0, 0, 8),
(2, 'yaya_ref4', 'yaya_ref4@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'yaya_ref4', 'yaya_ref4', '0000-00-00', 0, 'capitec', 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sub_transactions`
--

CREATE TABLE `sub_transactions` (
  `id` int(11) NOT NULL,
  `main_transaction_id` int(11) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `marked_as_paid` int(11) NOT NULL,
  `marked_as_recieved` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_transactions`
--

INSERT INTO `sub_transactions` (`id`, `main_transaction_id`, `payer_id`, `recipient_id`, `amount`, `marked_as_paid`, `marked_as_recieved`, `status`) VALUES
(1, 1, 1, 2, 2000, 1, 1, 'completed'),
(2, 2, 3, 1, 4000, 1, 1, 'completed'),
(3, 24, 1, 3, 4000, 1, 1, 'completed'),
(4, 25, 2, 1, 2000, 1, 1, 'completed'),
(5, 26, 3, 2, 4000, 1, 1, 'completed'),
(6, 30, 14, 3, 1000, 1, 1, 'completed'),
(7, 42, 15, 16, 1000, 1, 1, 'completed'),
(8, 46, 16, 15, 2000, 1, 1, 'completed'),
(9, 45, 15, 14, 2000, 1, 1, 'completed'),
(10, 49, 20, 8, 3000, 1, 1, 'completed'),
(11, 50, 8, 20, 3000, 1, 1, 'completed'),
(12, 50, 23, 20, 3000, 1, 1, 'completed'),
(19, 51, 25, 8, 500, 1, 1, 'completed'),
(21, 52, 8, 23, 1000, 1, 1, 'completed'),
(22, 54, 26, 8, 2000, 1, 1, 'completed'),
(23, 53, 8, 25, 4000, 1, 1, 'completed'),
(24, 55, 25, 26, 4000, 1, 1, 'completed'),
(25, 56, 34, 8, 1000, 1, 1, 'completed'),
(26, 57, 8, 25, 2000, 1, 1, 'completed'),
(27, 59, 25, 8, 2000, 1, 1, 'completed'),
(28, 59, 26, 8, 2000, 1, 1, 'completed'),
(29, 58, 8, 34, 2000, 1, 1, 'completed'),
(30, 60, 34, 25, 2000, 1, 1, 'completed'),
(31, 60, 35, 25, 2000, 1, 1, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `transaction_package_id` int(11) NOT NULL,
  `recieved_amount` int(11) NOT NULL DEFAULT 0,
  `total_return_amount` int(11) NOT NULL,
  `completed_sub_transactions` int(11) NOT NULL DEFAULT 0,
  `total_sub_transactions` int(11) NOT NULL DEFAULT 1,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `recipient_id`, `transaction_package_id`, `recieved_amount`, `total_return_amount`, `completed_sub_transactions`, `total_sub_transactions`, `status`) VALUES
(1, 2, 2, 2000, 2000, 1, 1, 'completed'),
(2, 1, 4, 4000, 4000, 1, 1, 'completed'),
(24, 3, 4, 4000, 4000, 1, 1, 'completed'),
(25, 1, 2, 2000, 2000, 1, 1, 'complete'),
(26, 2, 4, 4000, 4000, 1, 1, 'completed'),
(30, 3, 8, 1000, 8000, 1, 1, 'completed'),
(42, 16, 2, 1000, 2000, 1, 1, 'completed'),
(43, 17, 2, 0, 2000, 0, 1, 'completed'),
(44, 18, 2, 0, 2000, 0, 1, 'completed'),
(45, 14, 2, 2000, 2000, 1, 1, 'completed'),
(46, 15, 2, 2000, 2000, 1, 1, 'completed'),
(47, 16, 2, 0, 2000, 0, 1, 'completed'),
(48, 15, 8, 0, 8000, 0, 1, 'completed'),
(49, 8, 3, 3000, 3000, 1, 1, 'completed'),
(50, 20, 6, 6000, 6000, 2, 2, 'completed'),
(51, 8, 6, 500, 6000, 1, 1, 'completed'),
(52, 23, 1, 1000, 1000, 1, 1, 'completed'),
(53, 25, 6, 4000, 6000, 1, 1, 'completed'),
(54, 8, 8, 2000, 8000, 1, 1, 'completed'),
(55, 26, 4, 4000, 4000, 1, 1, 'completed'),
(56, 8, 1, 1000, 1000, 1, 1, 'completed'),
(57, 25, 8, 2000, 8000, 1, 1, 'completed'),
(58, 34, 2, 2000, 2000, 1, 1, 'completed'),
(59, 8, 4, 4000, 4000, 2, 2, 'completed'),
(60, 25, 4, 4000, 4000, 2, 2, 'completed'),
(61, 26, 4, 0, 4000, 0, 1, 'pending'),
(62, 8, 4, 0, 4000, 0, 1, 'pending'),
(63, 34, 4, 0, 4000, 0, 1, 'pending'),
(64, 35, 4, 0, 4000, 0, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_cell` varchar(10) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `account_no` varchar(11) NOT NULL,
  `linked_cell` varchar(10) NOT NULL,
  `selected_package` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `reg_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `surname`, `date_of_birth`, `contact_cell`, `bank_name`, `account_no`, `linked_cell`, `selected_package`, `status`, `reg_time`) VALUES
(1, 'username1', 'username1@gmail.com', '92877af70a45fd6a2ed7fe81e1236b78', 'user1', 'user1', '1997-12-04', '123469874', 'capitec', '123467896', '0123469874', 2, 0, 1566673990),
(2, 'username2', 'username2@gmail.com', 'password', 'user2', 'user2', '1997-12-04', '123469874', 'capitec', '123467896', '0123469874', 4, 0, 1566679320),
(3, 'username3', 'username3@gmail.com', '92877af70a45fd6a2ed7fe81e1236b78', 'user3', 'user3', '1997-12-04', '123469874', 'capitec', '123467896', '0123469874', 8, 0, 1566679684),
(4, 'username4', 'username4@gmail.com', 'password', 'user4', 'user4', '1997-12-04', '123469874', 'capitec', '123467896', '0123469874', 7, 0, 1566383573),
(5, 'username5', 'username5@gmail.com', 'password', 'user5', 'user5', '1997-12-04', '123469874', 'capitec', '123467896', '0123469874', 7, 0, 1566383573),
(7, 'siya', 'siya@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'sya', 'mbatha', '1997-04-12', '0648818573', 'capitec', '21321621634', '3231681422', NULL, 0, 0),
(8, 'yaya', 'yaya@gmail.com', '4409eae53c2e26a65cfc24b3a2359eb9', 'yaya', 'dee', '0000-00-00', '2163464', 'capitec', '6444464', '4124424', 4, 3, 1568143317),
(9, 'sma', 'sma@gmail.com', 'a289fa4252ed5af8e3e9f9bee545c172', 'sma', 'sma', '1998-02-10', '0123467898', 'capitec', '64649874468', '1321461321', NULL, 0, 0),
(12, 'mpilo', 'mpilo@gmail.com', '237ae5d9b8dcac0cda36f5621f5f4d18', 'mpilo', 'mpilo', '1998-02-10', '0123467898', 'capitec', '64649874468', '1321461321', NULL, 0, 0),
(13, 'rose', 'rose@gmail.com', 'fcdc7b4207660a1372d0cd5491ad856e', '', '', '0000-00-00', '', 'capitec', '', '', NULL, 0, 0),
(14, 'user1', 'user1@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'user1', 'user1', '1997-04-12', '123467896', 'capitec', '123467896', '1234698710', 8, 0, 1567548717),
(15, 'user2', 'user2', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'user2', 'user2', '0000-00-00', '1234768124', 'capitec', '87324659837', '9328746592', 8, 0, 1567546694),
(16, 'user3', 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 'user3', 'user3', '0000-00-00', 'user3', 'capitec', 'user3', 'user3', 4, 0, 1567200964),
(17, 'user4', 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'user4', 'user4', '0000-00-00', 'user4', 'capitec', 'user4', 'user4', 2, 0, 1567093490),
(18, 'user5', 'user5', '0a791842f52a0acfbb3a783378c066b8', 'user5', 'user5', '0000-00-00', 'user5', 'capitec', 'user5', 'user5', 2, 0, 1567093546),
(19, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', '0000-00-00', 'test', 'capitec', 'test', 'test', NULL, 0, 0),
(20, 'test1', 'test1@gmail.com', '5a105e8b9d40e1329780d62ea2265d8a', 'test1', 'test1', '0000-00-00', 'test1', 'capitec', 'test1', 'test1', 6, 0, 1567558221),
(21, 'test2', 'test2@gmail.com', 'c52ecd93c1ec34fd0dfde14de883c3a2', '', '', '0000-00-00', '', 'capitec', '', '', NULL, 0, 0),
(23, 'test3', 'test3@gmail.com', '8ad8757baa8564dc136c1e07507f4a98', 'test3', 'test3', '0000-00-00', 'test3', 'capitec', 'test3', 'test3', 1, 0, 1567558220),
(24, 'refered1_y', 'refered1_yaya@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'refered1_y', 'refered1_y', '0000-00-00', 'refered1_y', 'capitec', 'refered1_ya', 'refered1_y', NULL, 0, 0),
(25, 'yaya_ref2', 'yaya_ref2@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'yaya_ref2', 'yaya_ref2', '0000-00-00', 'yaya_ref2', 'capitec', 'yaya_ref2', 'yaya_ref2', 4, 0, 1568103856),
(26, 'yaya_ref3', 'yaya_ref3@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'yaya_ref3', 'yaya_ref3', '0000-00-00', 'yaya_ref3', 'capitec', 'yaya_ref3', 'yaya_ref3', 4, 3, 1568103920),
(27, 'test4', 'test4@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'test4', 'test4', '0000-00-00', 'test4', 'capitec', 'test4', 'test4', NULL, 0, 0),
(34, 'test6', 'test6@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'test6', 'test6', '0000-00-00', 'test6', 'capitec', 'test6', 'test6', 4, 3, 1568147111),
(35, 'lolly', 'lolly@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'lolly', 'lolly', '0000-00-00', 'lolly', 'capitec', 'lolly', 'lolly', 4, 3, 1568147298);

-- --------------------------------------------------------

--
-- Table structure for table `users_statuses`
--

CREATE TABLE `users_statuses` (
  `id` int(11) NOT NULL,
  `value` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_statuses`
--

INSERT INTO `users_statuses` (`id`, `value`, `description`) VALUES
(0, 'select_package', 'if the user is at a stage where they need to select a package plan'),
(1, 'await_verification', 'first state user is in after registration'),
(2, 'allocated_to_pay', 'when the user has been allocated to pay another user'),
(3, 'wait_for_payer', 'when a user has to wait to be allocated another user to pay them'),
(4, 'wait_to_receive', 'when a user has been allocated and is waiting to confirm receiving of payment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `adminrefscomplaints`
--
ALTER TABLE `adminrefscomplaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user` (`from_user`);

--
-- Indexes for table `adminusercomplaints`
--
ALTER TABLE `adminusercomplaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user` (`from_user`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`),
  ADD KEY `user_sender` (`user_sender`),
  ADD KEY `ref_sender` (`ref_sender`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `refs`
--
ALTER TABLE `refs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referer_id` (`referer_id`);

--
-- Indexes for table `sub_transactions`
--
ALTER TABLE `sub_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `selected_package` (`selected_package`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `users_statuses`
--
ALTER TABLE `users_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `adminrefscomplaints`
--
ALTER TABLE `adminrefscomplaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminusercomplaints`
--
ALTER TABLE `adminusercomplaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `refs`
--
ALTER TABLE `refs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_transactions`
--
ALTER TABLE `sub_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users_statuses`
--
ALTER TABLE `users_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminrefscomplaints`
--
ALTER TABLE `adminrefscomplaints`
  ADD CONSTRAINT `adminrefscomplaints_ibfk_1` FOREIGN KEY (`from_user`) REFERENCES `refs` (`id`);

--
-- Constraints for table `adminusercomplaints`
--
ALTER TABLE `adminusercomplaints`
  ADD CONSTRAINT `adminusercomplaints_ibfk_1` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inbox_ibfk_2` FOREIGN KEY (`user_sender`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inbox_ibfk_3` FOREIGN KEY (`ref_sender`) REFERENCES `refs` (`id`);

--
-- Constraints for table `refs`
--
ALTER TABLE `refs`
  ADD CONSTRAINT `refs_ibfk_1` FOREIGN KEY (`referer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
