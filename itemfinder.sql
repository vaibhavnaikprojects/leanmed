-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 11:43 PM
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
-- Database: `itemfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `houseId` int(11) NOT NULL,
  `houseName` varchar(20) NOT NULL,
  `houseDesc` varchar(200) DEFAULT NULL,
  `houseKey` int(11) NOT NULL,
  `admin` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`houseId`, `houseName`, `houseDesc`, `houseKey`, `admin`) VALUES
(2, '123', 'ccvz', 394213, 'vaibhavsnaik09@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL,
  `ItemName` varchar(200) NOT NULL,
  `itemDesc` varchar(200) DEFAULT NULL,
  `itemType` varchar(10) NOT NULL,
  `userId` varchar(100) DEFAULT NULL,
  `updatedBy` varchar(100) NOT NULL,
  `storageId` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `ItemName`, `itemDesc`, `itemType`, `userId`, `updatedBy`, `storageId`, `status`, `history`) VALUES
(13, 'books', 'book of AI', 'personal', 'prakhar.sapre2610@gmail.com', 'prakhar.sapre2610@gmail.com', 2, 'pending', 'Prakhar Sapre wants to edit item named books'),
(14, 'pen', 'parker pen', 'personal', 'prakhar.sapre2610@gmail.com', 'prakhar.sapre2610@gmail.com', 6, 'active', 'Prakhar Sapre wants to add item named pen');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logId` int(11) NOT NULL,
  `log` varchar(200) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logId`, `log`, `createdDate`, `userId`) VALUES
(7, '', '2018-03-30 05:51:52', 'vaibhavsnaik09@gmail.com'),
(8, 'Vaibhav Naik added room 1', '2018-03-30 07:00:14', 'vaibhavsnaik09@gmail.com'),
(9, 'Vaibhav Naik added room this time it works', '2018-03-30 07:01:37', 'vaibhavsnaik09@gmail.com'),
(10, 'Vaibhav Naik deleted room', '2018-03-30 07:19:30', 'vaibhavsnaik09@gmail.com'),
(11, 'Vaibhav Naik deleted room', '2018-03-30 07:20:26', 'vaibhavsnaik09@gmail.com'),
(12, 'Vaibhav Naik deleted room', '2018-03-30 07:22:28', 'vaibhavsnaik09@gmail.com'),
(13, 'Vaibhav Naik deleted room', '2018-03-30 07:34:11', 'vaibhavsnaik09@gmail.com'),
(14, 'Mansoor Abbas Ali wwants to add storage bottle', '2018-03-30 22:57:22', 'mansoor.abbas@mavs.uta.edu'),
(15, 'Vaibhav Naik added room gallery', '2018-03-30 23:00:33', 'vaibhavsnaik09@gmail.com'),
(16, 'kaustubh Agnihotri wwants to add storage chech', '2018-03-30 23:37:11', 'kaustubhsanjiv.agnihotri@mavs.uta.edu'),
(17, 'Vaibhav Naik added room check', '2018-03-30 23:39:02', 'vaibhavsnaik09@gmail.com'),
(18, 'Prakhar Sapre wwants to add storage test', '2018-03-31 04:12:04', 'prakhar.sapre2610@gmail.com'),
(19, 'Prakhar Sapre wwants to add storage Testing', '2018-03-31 04:20:38', 'prakhar.sapre2610@gmail.com'),
(20, '', '2018-03-31 04:27:34', 'vaibhavsnaik09@gmail.com'),
(21, 'Vaibhav Naik deleted a room', '2018-04-05 22:59:48', 'vaibhavsnaik09@gmail.com'),
(22, 'Vaibhav Naik removed the user from the house', '2018-04-06 05:35:08', 'vaibhavsnaik09@gmail.com'),
(23, 'Vaibhav Naik invited user to the house', '2018-04-06 05:36:30', 'vaibhavsnaik09@gmail.com'),
(24, 'Vaibhav Naik removed the user mansoor.abbas@mavs.uta.edu from the house', '2018-04-06 06:47:36', 'vaibhavsnaik09@gmail.com'),
(25, 'Vaibhav Naik invited user Mansoor Abbas Ali to the house', '2018-04-06 06:47:53', 'vaibhavsnaik09@gmail.com'),
(26, 'Vaibhav Naik removed the user mansoor.abbas@mavs.uta.edu from the house', '2018-04-06 06:51:53', 'vaibhavsnaik09@gmail.com'),
(27, 'Vaibhav Naik invited user Mansoor Abbas Ali to the house', '2018-04-06 06:52:01', 'vaibhavsnaik09@gmail.com'),
(28, 'Prakhar Sapre wants to edit storage named second table', '2018-04-06 07:24:28', 'prakhar.sapre2610@gmail.com'),
(29, 'Prakhar Sapre wants to add storage named third table', '2018-04-06 07:24:44', 'prakhar.sapre2610@gmail.com'),
(30, 'Vaibhav Naikdeleted storage', '2018-04-06 08:15:52', 'vaibhavsnaik09@gmail.com'),
(31, 'Prakhar Sapre wants to add storage named Check', '2018-04-06 08:19:59', 'prakhar.sapre2610@gmail.com'),
(32, 'Prakhar Sapre wants to add storage named ', '2018-04-12 01:47:11', 'prakhar.sapre2610@gmail.com'),
(33, 'Prakhar Sapre wants to add storage named drawer', '2018-04-12 01:52:57', 'prakhar.sapre2610@gmail.com'),
(34, 'Prakhar Sapre wants to add storage named ', '2018-04-12 03:38:36', 'prakhar.sapre2610@gmail.com'),
(35, 'Prakhar Sapre wants to add storage named table', '2018-04-12 03:54:54', 'prakhar.sapre2610@gmail.com'),
(36, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:13:25', 'prakhar.sapre2610@gmail.com'),
(37, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:14:46', 'prakhar.sapre2610@gmail.com'),
(38, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:16:14', 'prakhar.sapre2610@gmail.com'),
(39, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:16:21', 'prakhar.sapre2610@gmail.com'),
(40, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:16:27', 'prakhar.sapre2610@gmail.com'),
(41, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:22:19', 'prakhar.sapre2610@gmail.com'),
(42, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:25:13', 'prakhar.sapre2610@gmail.com'),
(43, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:28:16', 'prakhar.sapre2610@gmail.com'),
(44, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:37:04', 'prakhar.sapre2610@gmail.com'),
(45, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:38:49', 'prakhar.sapre2610@gmail.com'),
(46, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:45:13', 'prakhar.sapre2610@gmail.com'),
(47, 'Prakhar Sapre wants to add storage named table', '2018-04-13 01:46:41', 'prakhar.sapre2610@gmail.com'),
(48, 'Prakhar Sapredeleted item', '2018-04-13 01:52:44', 'prakhar.sapre2610@gmail.com'),
(49, 'Prakhar Sapre wants to add storage named cupboard', '2018-04-14 00:30:41', 'prakhar.sapre2610@gmail.com'),
(50, 'Prakhar Sapre wants to add storage named cupboard', '2018-04-14 00:49:08', 'prakhar.sapre2610@gmail.com'),
(51, 'Prakhar Sapre wants to add storage named cupboard', '2018-04-14 01:18:40', 'prakhar.sapre2610@gmail.com'),
(52, 'Prakhar Sapre wants to add storage named cupboard', '2018-04-14 01:19:15', 'prakhar.sapre2610@gmail.com'),
(53, 'Prakhar Sapre wants to add storage named table', '2018-04-14 23:30:41', 'prakhar.sapre2610@gmail.com'),
(54, 'Prakhar Sapre wants to edit item named book2', '2018-04-14 23:40:38', 'prakhar.sapre2610@gmail.com'),
(55, 'Prakhar Sapre wants to edit item named book2', '2018-04-14 23:41:51', 'prakhar.sapre2610@gmail.com'),
(56, 'Prakhar Sapredeleted item', '2018-04-14 23:49:18', 'prakhar.sapre2610@gmail.com'),
(57, 'Prakhar Sapredeleted item', '2018-04-14 23:49:25', 'prakhar.sapre2610@gmail.com'),
(58, 'Prakhar Sapredeleted item', '2018-04-14 23:52:26', 'prakhar.sapre2610@gmail.com'),
(59, 'Prakhar Sapredeleted item', '2018-04-14 23:55:53', 'prakhar.sapre2610@gmail.com'),
(60, 'Prakhar Sapredeleted item', '2018-04-14 23:56:38', 'prakhar.sapre2610@gmail.com'),
(61, 'Prakhar Sapredeleted item', '2018-04-15 00:03:18', 'prakhar.sapre2610@gmail.com'),
(62, 'Prakhar Sapre wants to add storage named table', '2018-04-15 00:05:16', 'prakhar.sapre2610@gmail.com'),
(63, 'Prakhar Sapredeleted item', '2018-04-15 00:05:25', 'prakhar.sapre2610@gmail.com'),
(64, 'Prakhar Sapre wants to add storage named cupboard', '2018-04-15 00:06:57', 'prakhar.sapre2610@gmail.com'),
(65, 'Prakhar Sapredeleted item', '2018-04-15 00:07:36', 'prakhar.sapre2610@gmail.com'),
(66, 'Prakhar Sapre wants to add storage named table', '2018-04-15 00:09:28', 'prakhar.sapre2610@gmail.com'),
(67, 'Prakhar Sapredeleted item', '2018-04-15 00:09:37', 'prakhar.sapre2610@gmail.com'),
(68, 'Prakhar Sapredeleted item', '2018-04-15 00:20:03', 'prakhar.sapre2610@gmail.com'),
(69, 'Prakhar Sapre wants to add storage named table', '2018-04-15 00:22:01', 'prakhar.sapre2610@gmail.com'),
(70, 'Prakhar Sapredeleted item', '2018-04-15 00:27:25', 'prakhar.sapre2610@gmail.com'),
(71, 'Prakhar Sapre wants to add storage named table', '2018-04-15 00:27:44', 'prakhar.sapre2610@gmail.com'),
(72, 'Prakhar Sapre wants to add storage named drawer', '2018-04-15 00:28:20', 'prakhar.sapre2610@gmail.com'),
(73, 'Prakhar Sapre wants to edit item named books', '2018-04-18 21:24:36', 'prakhar.sapre2610@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `logusers`
--

CREATE TABLE `logusers` (
  `logUserId` int(11) NOT NULL,
  `logId` int(11) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomId` int(11) NOT NULL,
  `roomName` varchar(20) NOT NULL,
  `roomDesc` varchar(200) NOT NULL,
  `houseId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomId`, `roomName`, `roomDesc`, `houseId`) VALUES
(1, 'bedroom1', 'bedroom1 from the door', 2),
(2, 'bedroom2', 'bedroom2 from the door', 2),
(3, 'hall', 'house hall', 2),
(4, 'bathroom1', 'bathroom for bedroom1', 2),
(5, 'bathroom2', 'bathroom for bedroom2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `storageId` int(11) NOT NULL,
  `storageName` varchar(200) NOT NULL,
  `storageDesc` varchar(200) DEFAULT NULL,
  `history` varchar(255) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`storageId`, `storageName`, `storageDesc`, `history`, `userId`, `status`, `roomId`) VALUES
(2, 'table', 'study table', '', 'vaibhavsnaik09@gmail.com', 'active', 1),
(5, 'Check', 'testing', 'Prakhar Sapre wants to add storage named Check', 'prakhar.sapre2610@gmail.com', 'active', 4),
(6, 'drawer', 'table drawer', 'Prakhar Sapre wants to add storage named drawer', 'prakhar.sapre2610@gmail.com', 'active', 2),
(7, 'cupboard', 'bedroom 2 cupboard', 'Prakhar Sapre wants to add storage named cupboard', 'prakhar.sapre2610@gmail.com', 'active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `emailId` varchar(200) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL,
  `userType` int(11) NOT NULL,
  `houseId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`emailId`, `userName`, `password`, `status`, `userType`, `houseId`) VALUES
('kaustubhsanjiv.agnihotri@mavs.uta.edu', 'kaustubh Agnihotri', '202cb962ac59075b964b07152d234b70', 'active', 2, 2),
('mansoor.abbas@mavs.uta.edu', 'Mansoor Abbas Ali', '', 'pending', 2, 2),
('prakhar.sapre2610@gmail.com', 'Prakhar Sapre', '202cb962ac59075b964b07152d234b70', 'active', 2, 2),
('vaibhavsnaik09@gmail.com', 'Vaibhav Naik', '202cb962ac59075b964b07152d234b70', 'active', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`houseId`),
  ADD KEY `FK_HOUSES_USERS` (`admin`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `FK_ITEMS_USERS` (`userId`),
  ADD KEY `FK_ITEMS_STORAGE` (`storageId`),
  ADD KEY `FK_ITEMS_CREATED` (`updatedBy`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `logusers`
--
ALTER TABLE `logusers`
  ADD PRIMARY KEY (`logUserId`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomId`),
  ADD KEY `FK_ROOMS_HOUSES` (`houseId`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`storageId`),
  ADD KEY `FK_STORAGE_ROOMS` (`roomId`),
  ADD KEY `FK_STORAGE_USERS` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`emailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `houseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `logusers`
--
ALTER TABLE `logusers`
  MODIFY `logUserId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `storageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `FK_HOUSES_USERS` FOREIGN KEY (`admin`) REFERENCES `users` (`emailId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_ITEMS_CREATED` FOREIGN KEY (`updatedBy`) REFERENCES `users` (`emailId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ITEMS_STORAGE` FOREIGN KEY (`storageId`) REFERENCES `storage` (`storageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ITEMS_USERS` FOREIGN KEY (`userId`) REFERENCES `users` (`emailId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `FK_ROOMS_HOUSES` FOREIGN KEY (`houseId`) REFERENCES `houses` (`houseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storage`
--
ALTER TABLE `storage`
  ADD CONSTRAINT `FK_STORAGE_ROOMS` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`roomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_STORAGE_USERS` FOREIGN KEY (`userId`) REFERENCES `users` (`emailId`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
