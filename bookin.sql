-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 12:38 PM
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
-- Database: `bookin`
--

-- --------------------------------------------------------

--
-- Table structure for table `ikorodubookin`
--

CREATE TABLE `ikorodubookin` (
  `ID` int(50) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
  `KinName` varchar(50) NOT NULL,
  `KinPhone` varchar(50) NOT NULL,
  `Amount` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Vehicle` varchar(50) NOT NULL,
  `Date` varchar(50) NOT NULL,
  `SeatNo` varchar(50) NOT NULL,
  `Ticketer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `LastLogin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `Password`, `LastLogin`) VALUES
(1, 'admin', 'admin', '19- Dec- 2019  Time 12:36:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ikorodubookin`
--
ALTER TABLE `ikorodubookin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ikorodubookin`
--
ALTER TABLE `ikorodubookin`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
