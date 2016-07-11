-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2016 at 08:34 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_systems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uid`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `in_rso`
--

CREATE TABLE `in_rso` (
  `uid` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `my_event`
--

CREATE TABLE `my_event` (
  `evt_id` int(11) NOT NULL,
  `evt_time` time NOT NULL,
  `evt_comment` varchar(100) DEFAULT NULL,
  `evt_date` date NOT NULL,
  `evt_contact` bigint(20) UNSIGNED DEFAULT NULL,
  `evt_name` varchar(50) DEFAULT NULL,
  `evt_description` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_event`
--

INSERT INTO `my_event` (`evt_id`, `evt_time`, `evt_comment`, `evt_date`, `evt_contact`, `evt_name`, `evt_description`) VALUES
(1, '19:00:00', 'teams of 4 only', '2016-07-29', NULL, 'Dodgeball', 'Tournament Style'),
(2, '13:30:00', 'Students must bring their own textbooks!', '2016-07-24', NULL, 'Tutoring', 'CECS Event');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`uid`, `username`, `password`, `email`) VALUES
(1, 'Sally', 'password', NULL),
(2, 'Ally', 'password', NULL),
(3, 'Normie', 'password', NULL),
(4, 'Mark', 'password', 'mark@unv.edu'),
(5, 'Tommy', 'password', 'tommy@ucf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `private`
--

CREATE TABLE `private` (
  `evt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE `public` (
  `evt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rso`
--

CREATE TABLE `rso` (
  `rso_id` int(11) NOT NULL,
  `rso_name` varchar(50) DEFAULT NULL,
  `unv_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rso`
--

INSERT INTO `rso` (`rso_id`, `rso_name`, `unv_id`, `owner_id`) VALUES
(1, 'Math Club', 1, 0),
(2, 'Sports Club', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rso_e`
--

CREATE TABLE `rso_e` (
  `evt_id` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `uid` int(11) NOT NULL,
  `unv_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`uid`, `unv_id`) VALUES
(4, 0),
(5, 0),
(3, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `s_admin`
--

CREATE TABLE `s_admin` (
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_admin`
--

INSERT INTO `s_admin` (`uid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `unv_id` int(11) NOT NULL,
  `unv_name` varchar(50) NOT NULL,
  `population` int(11) DEFAULT NULL,
  `description` text,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`unv_id`, `unv_name`, `population`, `description`, `email`, `address`) VALUES
(1, 'University of Central Florida', 60000, 'Florida university near downtown Orlando.', 'ucf.edu', '4000 Central Florida Blvd, Orlando, FL 32816'),
(2, 'University of Florida', NULL, NULL, 'uf.edu', NULL),
(3, 'University of South Florida', NULL, NULL, 'usf.edu', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `in_rso`
--
ALTER TABLE `in_rso`
  ADD PRIMARY KEY (`uid`,`rso_id`);

--
-- Indexes for table `my_event`
--
ALTER TABLE `my_event`
  ADD PRIMARY KEY (`evt_id`,`evt_time`,`evt_date`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`evt_id`);

--
-- Indexes for table `public`
--
ALTER TABLE `public`
  ADD PRIMARY KEY (`evt_id`);

--
-- Indexes for table `rso`
--
ALTER TABLE `rso`
  ADD PRIMARY KEY (`rso_id`),
  ADD KEY `unv_id` (`unv_id`);

--
-- Indexes for table `rso_e`
--
ALTER TABLE `rso_e`
  ADD PRIMARY KEY (`evt_id`,`rso_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `unv_id` (`unv_id`);

--
-- Indexes for table `s_admin`
--
ALTER TABLE `s_admin`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`unv_id`),
  ADD UNIQUE KEY `unv_name` (`unv_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `my_event`
--
ALTER TABLE `my_event`
  MODIFY `evt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rso`
--
ALTER TABLE `rso`
  MODIFY `rso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `unv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rso`
--
ALTER TABLE `rso`
  ADD CONSTRAINT `fk_unv_id` FOREIGN KEY (`unv_id`) REFERENCES `university` (`unv_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
