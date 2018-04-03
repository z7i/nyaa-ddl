-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2018 at 07:32 AM
-- Server version: 10.0.34-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `coment`
--

CREATE TABLE `coment` (
  `comentid` varchar(11) NOT NULL,
  `username` varchar(535) NOT NULL,
  `postid` varchar(8) NOT NULL,
  `text` varchar(535) NOT NULL,
  `date` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coment`
--

INSERT INTO `coment` (`comentid`, `username`, `postid`, `text`, `date`) VALUES
('SzRFpX1AqlJ', 'Admin', 'mxpvItjz', 'who?\r\n', '08-07-2017 18:31'),
('VNzEp2ePMhf', 'Dumy', 'joAthC76', '12345', '21-06-2017 04:42');

-- --------------------------------------------------------

--
-- Table structure for table `danger`
--

CREATE TABLE `danger` (
  `ID` int(255) NOT NULL,
  `username` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `datepost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postid` varchar(8) NOT NULL,
  `username` varchar(535) NOT NULL,
  `filename` varchar(535) NOT NULL,
  `size` varchar(535) NOT NULL,
  `information` varchar(535) NOT NULL,
  `category` varchar(3) NOT NULL,
  `anonim` varchar(1) NOT NULL,
  `hidden` varchar(1) NOT NULL,
  `remake` varchar(1) NOT NULL,
  `complete` varchar(1) NOT NULL,
  `description` varchar(535) NOT NULL,
  `waktu` varchar(535) NOT NULL,
  `linkone` varchar(535) NOT NULL,
  `linktwo` varchar(535) NOT NULL,
  `linkthree` varchar(535) NOT NULL,
  `linkfourth` varchar(535) NOT NULL,
  `report` varchar(535) NOT NULL,
  `coment` varchar(535) NOT NULL,
  `view` varchar(535) NOT NULL,
  `trusted` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`datepost`, `postid`, `username`, `filename`, `size`, `information`, `category`, `anonim`, `hidden`, `remake`, `complete`, `description`, `waktu`, `linkone`, `linktwo`, `linkthree`, `linkfourth`, `report`, `coment`, `view`, `trusted`) VALUES;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` varchar(4) NOT NULL,
  `username` varchar(535) NOT NULL,
  `postid` varchar(8) NOT NULL,
  `text` varchar(535) NOT NULL,
  `date` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL,
  `status` varchar(535) NOT NULL,
  `pict` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userEmail`, `userPass`, `userStatus`, `tokenCode`, `status`, `pict`) VALUES;

-- --------------------------------------------------------

--
-- Table structure for table `trusted`
--

CREATE TABLE `trusted` (
  `ID` int(255) NOT NULL,
  `username` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coment`
--
ALTER TABLE `coment`
  ADD PRIMARY KEY (`comentid`);

--
-- Indexes for table `danger`
--
ALTER TABLE `danger`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `trusted`
--
ALTER TABLE `trusted`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danger`
--
ALTER TABLE `danger`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `trusted`
--
ALTER TABLE `trusted`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
