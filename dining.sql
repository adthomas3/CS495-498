-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2015 at 07:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dining`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `FirstName` text,
  `LastName` text,
  `StudentID` varchar(9) NOT NULL DEFAULT '',
  `EmployeeType` text,
  `PhoneNumber` varchar(10) NOT NULL DEFAULT '',
  `Email` text,
  `Address` text,
  `Pass` text,
  `Unit` text,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`FirstName`, `LastName`, `StudentID`, `EmployeeType`, `PhoneNumber`, `Email`, `Address`, `Pass`, `Unit`) VALUES
('Jeff', 'McDaniel', '12345678', 'Student', '123456789', 'jsmcdaniel@bsu.edu', 'Baker Hall', 'sdifj', NULL),
('Zach', 'Sawyer', '456235987', 'Manager', '4568923578', 'zaswayer@bsu.edu', '897 ascx', 'qwerty', 'Atrium'),
('Conor', 'Williamson', '987654357', 'Director', '9856345879', 'cgwiliamson@bsu.edu', 'uizslkdmc', 'pass', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `Job` text NOT NULL,
  `JobDescription` text NOT NULL,
  `Unit` text NOT NULL,
  `JobNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`Job`, `JobDescription`, `Unit`, `JobNumber`) VALUES
('Grill', '', 'Noyer', ''),
('Custodial', '', 'Atrium', ''),
('Cashier', '', 'Noyer', ''),
('Grill', '', 'Noyer', '123');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `Unit` text NOT NULL,
  `Job` text NOT NULL,
  `Hours` text NOT NULL,
  `Day` text NOT NULL,
  `JobNumber` int(11) NOT NULL,
  `StudentID` varchar(9) NOT NULL,
  PRIMARY KEY (`JobNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Unit`, `Job`, `Hours`, `Day`, `JobNumber`, `StudentID`) VALUES
('Noyer', 'Grill', '5-8', 'Monday', 123, '12345678'),
('Atrium', 'Custodial', '6-8', 'Tuesday', 364, '12345678'),
('Noyer', 'Cashier', '2-9', 'Wednseday', 475, '12345678');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
