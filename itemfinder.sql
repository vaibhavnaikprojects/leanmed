-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 01:33 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
  `userId` varchar(25) DEFAULT NULL,
  `updatedBy` varchar(100) NOT NULL,
  `storageId` int(11) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(31, 'Prakhar Sapre wants to add storage named Check', '2018-04-06 08:19:59', 'prakhar.sapre2610@gmail.com');

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
(5, 'Check', 'testing', 'Prakhar Sapre wants to add storage named Check', 'prakhar.sapre2610@gmail.com', 'pending', 4);

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
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `logusers`
--
ALTER TABLE `logusers`
  MODIFY `logUserId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `storageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
