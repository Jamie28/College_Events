-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2016 at 10:20 PM
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
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `approve_e`
--

CREATE TABLE `approve_e` (
  `aid` int(11) NOT NULL,
  `evt_id` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approve_e`
--

INSERT INTO `approve_e` (`aid`, `evt_id`, `approved`) VALUES
(2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `evt_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `evt_id`, `uid`, `text`) VALUES
(1, 1, 6, 'This was such a fun event...I will definitely be going next Year!!');

-- --------------------------------------------------------

--
-- Table structure for table `in_rso`
--

CREATE TABLE `in_rso` (
  `uid` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_rso`
--

INSERT INTO `in_rso` (`uid`, `rso_id`, `since`) VALUES
(3, 3, '2016-07-11 22:15:47'),
(8, 3, '2016-07-11 22:16:55'),
(9, 3, '2016-07-11 22:15:47'),
(10, 3, '2016-07-11 22:15:47'),
(11, 3, '2016-07-11 22:15:47'),
(12, 1, '2016-07-11 23:16:28'),
(12, 2, '2016-07-11 23:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `my_event`
--

CREATE TABLE `my_event` (
  `evt_id` int(11) NOT NULL,
  `evt_time` time NOT NULL,
  `evt_comment` text NOT NULL,
  `evt_date` date NOT NULL,
  `evt_contact` varchar(10) NOT NULL,
  `evt_name` varchar(50) NOT NULL,
  `evt_description` varchar(50) DEFAULT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_event`
--

INSERT INTO `my_event` (`evt_id`, `evt_time`, `evt_comment`, `evt_date`, `evt_contact`, `evt_name`, `evt_description`, `location`) VALUES
(1, '14:18:19', 'How-To Help', '2016-07-28', '352-222-84', 'Linear Math', 'Presentation', 'UCF'),
(2, '18:29:41', 'Pokemon Go event by the reflection pond', '2016-07-28', '352-555-55', 'Pokemon Go', 'Freshman Event', 'UCF'),
(3, '15:45:55', 'Freshman Social Hour', '2016-08-02', '6678893211', 'Social Hour', 'Free Lunch', 'UCF'),
(4, '15:44:06', 'Music Included', '2016-08-03', '1234567892', 'Hokie Pokie', 'Competition', 'UCF'),
(5, '17:00:00', 'Resume Needed', '2016-08-03', '1124566786', 'CWEP Info Session', 'Lockheed Martin Info', 'UCF');

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
(5, 'Tommy', 'password', 'tommy@ucf.edu'),
(6, 'jim', 'pas', 'j@ucf.edu'),
(7, 'florida', 'pass', 'florida@f.edu'),
(8, 'Tammy', 'password', 'tammy@ucf.edu'),
(9, 'jeff', 'password', 'jeff@ucf.edu'),
(10, 'bob', 'password', 'bob@ucf.edu'),
(11, 'kevin', 'password', 'kevin@ucf.edu'),
(12, 'lucas', 'password', 'lucas@ucf.edu'),
(13, 'Jim', 'password', 'jim@uf.edu'),
(14, NULL, NULL, NULL),
(15, NULL, NULL, NULL),
(16, NULL, NULL, NULL),
(17, NULL, NULL, NULL),
(18, NULL, NULL, NULL),
(19, NULL, NULL, NULL),
(20, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `private`
--

CREATE TABLE `private` (
  `evt_id` int(11) NOT NULL,
  `unv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `private`
--

INSERT INTO `private` (`evt_id`, `unv_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE `public` (
  `evt_id` int(11) NOT NULL,
  `unv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public`
--

INSERT INTO `public` (`evt_id`, `unv_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `evt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rso`
--

CREATE TABLE `rso` (
  `rso_id` int(11) NOT NULL,
  `rso_name` varchar(50) DEFAULT NULL,
  `unv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rso`
--

INSERT INTO `rso` (`rso_id`, `rso_name`, `unv_id`) VALUES
(1, 'Math Club', 1),
(2, 'Sports Club', 1),
(3, 'Dodgeball Club', 1),
(4, 'UF Club', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rso_e`
--

CREATE TABLE `rso_e` (
  `evt_id` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rso_e`
--

INSERT INTO `rso_e` (`evt_id`, `rso_id`) VALUES
(1, 1);

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
(2, 1),
(3, 1),
(6, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 2),
(7, 4);

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
(3, 'University of South Florida', NULL, NULL, 'usf.edu', NULL),
(4, 'Florida University', NULL, NULL, 'f.edu', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `approve_e`
--
ALTER TABLE `approve_e`
  ADD PRIMARY KEY (`aid`,`evt_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
  ADD PRIMARY KEY (`evt_id`),
  ADD KEY `unv_id` (`unv_id`);

--
-- Indexes for table `public`
--
ALTER TABLE `public`
  ADD PRIMARY KEY (`evt_id`),
  ADD KEY `unv_id` (`unv_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`comment_id`);

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
-- AUTO_INCREMENT for table `approve_e`
--
ALTER TABLE `approve_e`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `my_event`
--
ALTER TABLE `my_event`
  MODIFY `evt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `rso`
--
ALTER TABLE `rso`
  MODIFY `rso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `unv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `private`
--
ALTER TABLE `private`
  ADD CONSTRAINT `fk_private_unv_id` FOREIGN KEY (`unv_id`) REFERENCES `university` (`unv_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `public`
--
ALTER TABLE `public`
  ADD CONSTRAINT `fk_public_unv_id` FOREIGN KEY (`unv_id`) REFERENCES `university` (`unv_id`);

--
-- Constraints for table `rso`
--
ALTER TABLE `rso`
  ADD CONSTRAINT `fk_unv_id` FOREIGN KEY (`unv_id`) REFERENCES `university` (`unv_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
