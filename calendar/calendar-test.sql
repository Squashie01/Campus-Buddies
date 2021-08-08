-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2021 at 03:39 AM
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
-- Database: `calendar-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendarevents`
--

CREATE TABLE `calendarevents` (
  `Id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Start` date NOT NULL,
  `End` date NOT NULL,
  `AllDay` tinyint(1) NOT NULL DEFAULT 0,
  `Description` text NOT NULL,
  `Backgroundcolor` text NOT NULL DEFAULT 'Orange'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendarevents`
--

INSERT INTO `calendarevents` (`Id`, `Title`, `Start`, `End`, `AllDay`, `Description`, `Backgroundcolor`) VALUES
(1, 'Test', '2021-07-15', '2021-07-15', 0, 'Test 1 of calendar Events', 'Orange'),
(2, 'Test 2', '2021-07-18', '2021-07-20', 0, 'Description for test 2', 'Orange'),
(3, 'Test 3', '2021-07-16', '2021-07-18', 1, 'An informative description of the 3rd test event for the calendar.', 'Purple');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `FirstName`, `LastName`) VALUES
(1, 'Zacarie', 'Walkes');

-- --------------------------------------------------------

--
-- Table structure for table `usercalendar`
--

CREATE TABLE `usercalendar` (
  `UserId` int(11) NOT NULL,
  `OrgId` int(11) DEFAULT NULL,
  `CalendarEventID` int(11) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usercalendar`
--

INSERT INTO `usercalendar` (`UserId`, `OrgId`, `CalendarEventID`, `Created`) VALUES
(1, NULL, 1, '2021-07-20 16:07:09'),
(1, NULL, 2, '2021-07-29 22:12:01'),
(1, NULL, 3, '2021-07-29 22:12:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendarevents`
--
ALTER TABLE `calendarevents`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `usercalendar`
--
ALTER TABLE `usercalendar`
  ADD KEY `UserId` (`UserId`),
  ADD KEY `CalendarEventID` (`CalendarEventID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendarevents`
--
ALTER TABLE `calendarevents`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usercalendar`
--
ALTER TABLE `usercalendar`
  ADD CONSTRAINT `usercalendar_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercalendar_ibfk_2` FOREIGN KEY (`CalendarEventID`) REFERENCES `calendarevents` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
