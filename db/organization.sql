-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2014 at 02:12 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `organization`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE IF NOT EXISTS `job_titles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `familyname` varchar(255) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `manager_id` bigint(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `familyname`, `username`, `password`, `type`, `manager_id`, `email`, `active`) VALUES
(1, 'admin', 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 0, 0, '0', 1),
(2, 'shervin', 'shervin', 'shervin', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 's@s.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_job_title`
--

CREATE TABLE IF NOT EXISTS `member_job_title` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) unsigned NOT NULL,
  `job_title_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `head` bigint(20) NOT NULL,
  `parent_division` bigint(20) DEFAULT NULL,
  `child_trail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `head`, `parent_division`, `child_trail`) VALUES
(1, 'karyan', 2, NULL, '1,'),
(6, 'Human Resources', 2, 1, '1,6,'),
(7, 'Cellular Networks', 2, 1, '1,7,'),
(8, 'Software', 2, 1, '1,8,'),
(9, 'Wireless', 2, 1, '1,9,'),
(10, 'Logistics', 2, 6, '1,6,10,'),
(11, 'Commercial', 2, 1, '1,11,'),
(12, 'Internal Purchase', 2, 10, '1,6,10,12,'),
(13, 'External Purchase', 2, 10, '1,6,10,13,'),
(14, 'Maintenance', 2, 9, '1,9,14,'),
(15, 'Installation', 2, 9, '1,9,15,'),
(16, 'Microwave', 2, 1, '1,16,'),
(17, 'Web', 2, 8, '1,8,17,'),
(18, 'Mobile', 2, 8, '1,8,18,'),
(19, '3G', 2, 7, '1,7,19,'),
(20, '2G', 2, 7, '1,7,20,'),
(21, 'Domestic', 2, 11, '1,11,21,'),
(22, 'Financial', 2, 6, '1,6,22,'),
(23, 'Microwave', 2, 9, '1,9,23,'),
(24, 'Wi-Fi', 2, 9, '1,9,24,'),
(25, 'Over-seas', 2, 11, '1,11,25,');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_members_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_members_roles`
--

INSERT INTO `tbl_members_roles` (`id`, `member_id`, `role_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_objects`
--

CREATE TABLE IF NOT EXISTS `tbl_objects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_objects`
--

INSERT INTO `tbl_objects` (`id`, `title`) VALUES
(1, 'organization');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) unsigned DEFAULT NULL,
  `right_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `table_name` varchar(150) DEFAULT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `object_id`, `right_id`, `role_id`, `table_name`, `create_date`) VALUES
(1, 1, 1, 1, '', '2014-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rights`
--

CREATE TABLE IF NOT EXISTS `tbl_rights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_rights`
--

INSERT INTO `tbl_rights` (`id`, `title`) VALUES
(1, 'full'),
(2, 'view'),
(3, 'add'),
(4, 'delete'),
(5, 'update');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `title`) VALUES
(1, 'organization_admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
