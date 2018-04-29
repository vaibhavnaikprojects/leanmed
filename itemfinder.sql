-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 09:51 AM
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
  `userId` varchar(100) DEFAULT NULL,
  `updatedBy` varchar(100) NOT NULL,
  `storageId` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` varchar(255) DEFAULT NULL,
  `ref` int(11) NOT NULL,
  `frequency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `ItemName`, `itemDesc`, `itemType`, `userId`, `updatedBy`, `storageId`, `status`, `history`, `ref`, `frequency`) VALUES
(17, 'Laptop', 'Personal Laptop', 'personal', 'vaibhavsnaik09@gmail.com', 'vaibhavsnaik09@gmail.com', 2, 'active', NULL, 17, 0),
(18, 'Duster', 'whiteboard duster', 'shared', 'vaibhavsnaik09@gmail.com', 'vaibhavsnaik09@gmail.com', 7, 'active', NULL, 0, 0),
(19, 'Personal Thing', 'Personal', 'personal', 'prakhar.sapre2610@gmail.com', 'prakhar.sapre2610@gmail.com', 6, 'active', 'Prakhar Sapre wants to add item named Personal Thing', 0, 0),
(20, 'shared item', 'shared', 'shared', 'prakhar.sapre2610@gmail.com', 'prakhar.sapre2610@gmail.com', 2, 'active', 'Prakhar Sapre wants to add item named shared item', 0, 1);

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
  `ref` int(11) NOT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`storageId`, `storageName`, `storageDesc`, `history`, `userId`, `status`, `ref`, `roomId`) VALUES
(2, 'table', 'study table', '', 'vaibhavsnaik09@gmail.com', 'active', 0, 1),
(5, 'Check', 'testing', 'Prakhar Sapre wants to add storage named Check', 'prakhar.sapre2610@gmail.com', 'active', 0, 4),
(6, 'drawer', 'table drawer', 'Prakhar Sapre wants to add storage named drawer', 'prakhar.sapre2610@gmail.com', 'active', 0, 2),
(7, 'cupboard', 'bedroom 2 cupboard', 'Prakhar Sapre wants to add storage named cupboard', 'prakhar.sapre2610@gmail.com', 'active', 0, 2),
(8, 'dining table', 'dining table', 'Prakhar Sapre wants to add storage named dining table', 'prakhar.sapre2610@gmail.com', 'active', 0, 3);

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
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `storageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
