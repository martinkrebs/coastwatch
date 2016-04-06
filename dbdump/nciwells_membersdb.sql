-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2016 at 10:44 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nciwells_membersdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `diarydates`
--

CREATE TABLE `diarydates` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(40) NOT NULL,
  `date` date DEFAULT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diarydates`
--

INSERT INTO `diarydates` (`id`, `title`, `author`, `date`, `postdate`) VALUES
(1, 'Satans Birthday', 'Peter Peterson', '2016-10-25', '2016-04-05 11:33:37'),
(2, 'Strategy Meeting', 'Baby Floops II', '2016-10-11', '2016-04-05 11:34:47'),
(4, 'Boot Sale', 'Boo Tsale', '2016-12-10', '2016-04-05 11:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `filename`) VALUES
(1, 'documents/Changes to the Channel.pdf'),
(10, 'documents/Icom radio Operation.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `filename`) VALUES
(11, 'newsletters/Issue 1 July 2009.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text,
  `author` varchar(40) NOT NULL,
  `date` date DEFAULT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `body`, `author`, `date`, `postdate`) VALUES
(1, 'First Notice', 'This is just a test notice', 'Martin Krebs', NULL, '2016-04-05 11:26:26'),
(2, 'Second Notice', 'Second test notice', 'Joe Soap', NULL, '2016-04-05 11:26:59'),
(3, 'Third Notice', 'And yet another test notice', 'Billy Nomates', NULL, '2016-04-05 11:27:31'),
(5, 'Another Notice', 'Running out of things to say...', 'Frank Wankf', NULL, '2016-04-05 11:29:04'),
(6, 'Take Notice', 'Mind you heed this warning', 'Count Dracular', NULL, '2016-04-05 11:29:36'),
(7, 'Notice of Intent', 'I will be writing more notices...', 'A Looser', NULL, '2016-04-05 11:30:38'),
(8, 'Last Notice', 'This is the last notice, for now ...', 'Tinpan Pete', NULL, '2016-04-05 11:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `caption` text,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `filename`, `caption`, `position`) VALUES
(7, 'gallery/Evening-light-November-2007.jpg', 'Evening Light, November', 1),
(8, 'gallery/Lifeboat-launch-x.jpg', 'Lifeboat launch', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diarydates`
--
ALTER TABLE `diarydates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diarydates`
--
ALTER TABLE `diarydates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
