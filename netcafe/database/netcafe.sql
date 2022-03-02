-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 12:07 PM
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
-- Database: `netcafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE `computer` (
  `idcomputer` int(11) NOT NULL,
  `idcomputer_tier` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `computer`
--

INSERT INTO `computer` (`idcomputer`, `idcomputer_tier`, `price`) VALUES
(1, 1, 20),
(2, 2, 40),
(3, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `computer_tier`
--

CREATE TABLE `computer_tier` (
  `idcomputer_tier` int(11) NOT NULL,
  `CPU` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GPU` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RAM` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `computer_tier`
--

INSERT INTO `computer_tier` (`idcomputer_tier`, `CPU`, `GPU`, `RAM`) VALUES
(1, 'i3-7100', 'GTX750Ti', '8GB'),
(2, 'i5-7400', 'GTX1060', '16GB');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idmember` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idmember`, `name`, `address`, `city`, `zipcode`) VALUES
(2, 'Chonasit Umphawan', 'Naresuan University', 'Pthisanulok', 65000),
(3, 'Panuphan Injan', '111/11', 'Phitsanolok', 10100);

-- --------------------------------------------------------

--
-- Table structure for table `member_has_computer`
--

CREATE TABLE `member_has_computer` (
  `idcheckin` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `idcomputer` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cntime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_has_computer`
--

INSERT INTO `member_has_computer` (`idcheckin`, `idmember`, `idcomputer`, `time`, `date`, `cntime`) VALUES
(0, 2, 1, 1000, '2022-03-02', '17:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `idreservation` int(11) NOT NULL,
  `idcomputer` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `restime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `idcomputer`, `idmember`, `time`, `date`, `restime`) VALUES
(0, 1, 2, 1000, '2022-03-10', '05:22:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`idcomputer`),
  ADD KEY `computer_FKIndex1` (`idcomputer_tier`),
  ADD KEY `IFK_Rel_01` (`idcomputer_tier`);

--
-- Indexes for table `computer_tier`
--
ALTER TABLE `computer_tier`
  ADD PRIMARY KEY (`idcomputer_tier`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `member_has_computer`
--
ALTER TABLE `member_has_computer`
  ADD PRIMARY KEY (`idcheckin`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idreservation`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `computer`
--
ALTER TABLE `computer`
  ADD CONSTRAINT `computer_ibfk_1` FOREIGN KEY (`idcomputer_tier`) REFERENCES `computer_tier` (`idcomputer_tier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
