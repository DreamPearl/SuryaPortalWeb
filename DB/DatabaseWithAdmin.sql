-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2016 at 11:48 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tap`
--
CREATE DATABASE IF NOT EXISTS `tap` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tap`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(1000) NOT NULL,
  `startdate` date NOT NULL,
  `duedate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE IF NOT EXISTS `apply` (
  `userid` int(11) NOT NULL,
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jobid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 Not Apply,1 Applied, 2 Accepted, 3 Rejected',
  UNIQUE KEY `userid` (`userid`,`jobid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) NOT NULL,
  `toid` int(11) NOT NULL,
  `text` varchar(150) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `login`
--
CREATE TABLE IF NOT EXISTS `login` (
`isAdmin` int(11)
,`userid` int(11)
,`username` varchar(20)
,`password` varchar(50)
,`emailid` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `isAdmin` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `location` varchar(100) NOT NULL,
  `course` varchar(20) NOT NULL,
  `qualification` varchar(100) NOT NULL DEFAULT '',
  `resume` longblob NOT NULL,
  `resumeFilename` varchar(100) NOT NULL DEFAULT 'new',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`isAdmin`, `userid`, `username`, `password`, `emailid`, `mobile`, `location`, `course`, `qualification`, `resume`, `resumeFilename`) VALUES
(1, 3, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'admin@abc.com', '1987654230', 'Unknown', '-----', '', '', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `searchjob`
--

CREATE TABLE IF NOT EXISTS `searchjob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobtitle` varchar(30) NOT NULL,
  `qualification` varchar(30) NOT NULL,
  `skillsrequired` varchar(70) NOT NULL,
  `salary` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `studycorner`
--

CREATE TABLE IF NOT EXISTS `studycorner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `studyinfo` longblob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vacencyrequest`
--
CREATE TABLE IF NOT EXISTS `vacencyrequest` (
`userid` int(11)
,`jobid` int(11)
,`id` int(11)
,`status` int(11)
,`lastchange` timestamp
,`jobtitle` varchar(30)
,`qualification` varchar(30)
,`skillsrequired` varchar(70)
,`salary` varchar(20)
);
-- --------------------------------------------------------

--
-- Structure for view `login`
--
DROP TABLE IF EXISTS `login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `login` AS select `registration`.`isAdmin` AS `isAdmin`,`registration`.`userid` AS `userid`,`registration`.`username` AS `username`,`registration`.`password` AS `password`,`registration`.`emailid` AS `emailid` from `registration`;

-- --------------------------------------------------------

--
-- Structure for view `vacencyrequest`
--
DROP TABLE IF EXISTS `vacencyrequest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vacencyrequest` AS select `apply`.`userid` AS `userid`,`apply`.`jobid` AS `jobid`,`searchjob`.`id` AS `id`,`apply`.`status` AS `status`,`apply`.`lastchange` AS `lastchange`,`searchjob`.`jobtitle` AS `jobtitle`,`searchjob`.`qualification` AS `qualification`,`searchjob`.`skillsrequired` AS `skillsrequired`,`searchjob`.`salary` AS `salary` from ((`apply` join `searchjob`) join `registration`) where ((`registration`.`userid` = `apply`.`userid`) and (`searchjob`.`id` = `apply`.`jobid`));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
