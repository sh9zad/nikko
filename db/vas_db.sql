-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2014 at 08:29 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vas_db`
--

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
(1, 'Admin', 'Admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 0, 0, 'admin@admin.com', 1),
(2, 'Test', 'User', 'test', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 'a@a.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_alias`
--

CREATE TABLE IF NOT EXISTS `service_alias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `alias` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inputs`
--

CREATE TABLE IF NOT EXISTS `tbl_inputs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `scode` varchar(50) DEFAULT NULL,
  `text` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_processed` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_inputs`
--

INSERT INTO `tbl_inputs` (`id`, `message`, `sender`, `scode`, `text`, `date`, `is_processed`) VALUES
(1, '%7Bget%7Dtest%3Dtrue%26sender%3D09124936721%26scode%3D203851%26text%3D%2524_SESSION%255B%2527error%2527%255D%7Bpost%7D', '09124936721', '203851', '%24_SESSION%5B%27error%27%5D', '2014-10-14 10:36:35', 0),
(2, '{get}test=true&sender=09124936721&scode=203851&text=%24_POST%5B%27test%27%5D{post}', '09124936721', '203851', '$_POST[''test'']', '2014-10-14 10:40:53', 0),
(3, '{get}test=true&sender=09124936721&scode=203851&text=INSERT+INTO+%60tbl_inputs%60+%28%60message%60%2C+%60sender%60%2C+%60scode%60%2C+%60text%60%29+VALUES+%28%27%7Bget%7Dtest%3Dtrue%26sender%3D09124936721%26scode%3D203851%26text%3D%2524_POST%255B%2527test%2527%255D%7Bpost%7D%27%2C+%2709124936721%27%2C+%27203851%27%2C+%27%24_POST%5B%5C%27test%5C%27%5D%27+%29{post}', '09124936721', '203851', 'INSERT INTO `tbl_inputs` (`message`, `sender`, `scode`, `text`) VALUES (''{get}test=true&sender=09124936721&scode=203851&text=%24_POST%5B%27test%27%5D{post}'', ''09124936721'', ''203851'', ''$_POST[\\''test\\'']'' )', '2014-10-14 10:41:22', 0),
(4, '{get}test=true&sender=09124936721&scode=203851&text=INSERT+INTO+%60tbl_inputs%60+%28%60message%60%2C+%60sender%60%2C+%60scode%60%2C+%60text%60%29+VALUES+%28%27%7Bget%7Dtest%3Dtrue%26sender%3D09124936721%26scode%3D203851%26text%3D%2524_POST%255B%2527test%2527%255D%7Bpost%7D%27%2C+%2709124936721%27%2C+%27203851%27%2C+%27%24_POST%5B%5C%27test%5C%27%5D%27+%29{post}', '09124936721', '203851', 'INSERT INTO `tbl_inputs` (`message`, `sender`, `scode`, `text`) VALUES (''{get}test=true&sender=09124936721&scode=203851&text=%24_POST%5B%27test%27%5D{post}'', ''09124936721'', ''203851'', ''$_POST[\\''test\\'']'' )', '2014-10-14 10:42:16', 0),
(5, '{get}test=true&sender=09124936721&scode=203851&text=strong{post}', '09124936721', '203851', 'strong', '2014-10-14 10:44:17', 0),
(6, '{get}test=true&sender=09124936721&scode=203851&text=%D8%A8%D8%A7+%D8%B3%D9%84%D8%A7%D9%85+%D9%88+%D8%B9%D8%B1%D8%B6+%D8%A7%D8%AF%D8%A8%D8%8C%0D%0A%D8%A7%D8%AD%D8%AA%D8%B1%D8%A7%D9%85%D8%A7%D9%8B+%D8%B9%D8%B7%D9%81+%D8%A8%D9%87+%D9%87%D9%85%DA%A9%D8%A7%D8%B1%DB%8C+%D9%87%D8%A7%DB%8C+%D9%81%DB%8C+%D9%85%D8%A7%D8%A8%DB%8C%D9%86+%D8%AF%D8%B1+%D9%85%D8%A7%D9%87+%D9%87%D8%A7%DB%8C+%DA%AF%D8%B0%D8%B4%D8%AA%D9%87%D8%8C+%D8%B6%D9%85%D9%86+%D8%AA%D8%B4%DA%A9%D8%B1+%D9%88+%D9%82%D8%AF%D8%B1%D8%AF%D8%A7%D9%86%DB%8C+%D8%A7%D8%B2+%D8%AA%D8%B9%D8%A7%D9%85%D9%84%D8%A7%D8%AA+%D8%B3%D8%A7%D8%B2%D9%86%D8%AF%D9%87+%D9%88+%D8%B2%D8%AD%D9%85%D8%A7%D8%AA+%D9%87%D9%85%DA%A9%D8%A7%D8%B1%D8%A7%D9%86+%DA%AF%D8%B1%D8%A7%D9%85%DB%8C%D8%8C+%D8%AE%D9%88%D8%A7%D9%87%D8%B4%D9%85%D9%86%D8%AF+%D8%A7%D8%B3%D8%AA+%D9%86%D8%B3%D8%A8%D8%AA+%D8%A8%D9%87+%D8%A7%D8%AE%D8%AA%D8%B5%D8%A7%D8%B5+%D8%B2%D9%85%D8%A7%D9%86%DB%8C+%DA%A9%D9%88%D8%AA%D8%A7%D9%87+%D8%AC%D9%87%D8%AA+%D8%A8%D8%B1%DA%AF%D8%B2%D8%A7%D8%B1%DB%8C+%D8%AC%D9%84%D8%B3%D9%87+%D8%AD%D8%B6%D9%88%D8%B1%DB%8C+%D8%A7%D9%82%D8%AF%D8%A7%D9%85+%D9%81%D8%B1%D9%85%D9%88%D8%AF%D9%87+%D8%AA%D8%A7+%D9%86%D8%B3%D8%A8%D8%AA+%D8%A8%D9%87+%D8%A8%D8%B1%D8%B1%D8%B3%DB%8C+%D8%A7%D8%B3%D8%AA%D8%B1%D8%A7%D8%AA%DA%98%DB%8C+%D9%87%D8%A7%DB%8C+%D8%A2%D8%AA%DB%8C+%D8%A2%D9%86+%D8%B3%D8%A7%D8%B2%D9%85%D8%A7%D9%86++%D9%88+%D8%A8%D9%87%D8%B1%D9%87+%D9%85%D9%86%D8%AF%DB%8C+%D8%A7%D8%B2+%D9%86%D9%82%D8%B7%D9%87+%D9%86%D8%B8%D8%B1%D8%A7%D8%AA+%D9%88+%D8%B1%D8%A7%D9%87%D9%86%D9%85%D8%A7%DB%8C%DB%8C+%D8%AC%D9%86%D8%A7%D8%A8%D8%B9%D8%A7%D9%84%DB%8C+%D8%AF%D8%B1+%D8%B1%D8%A7%D8%B3%D8%AA%D8%A7%DB%8C+%D8%B2%D9%85%DB%8C%D9%86%D9%87+%D8%B3%D8%A7%D8%B2%DB%8C+%D9%87%D9%85%DA%A9%D8%A7%D8%B1%DB%8C+%D9%87%D8%A7%DB%8C+%D8%A8%DB%8C%D8%B4%D8%AA%D8%B1+%D8%AF%D8%B1+%D8%A2%DB%8C%D9%86%D8%AF%D9%87+%D8%AA%D9%88%D8%A7%D9%81%D9%82%D8%A7%D8%AA%DB%8C+%D8%AD%D8%A7%D8%B5%D9%84+%DA%AF%D8%B1%D8%AF%D8%AF.%0D%0A%D9%BE%DB%8C%D8%B4%D8%A7%D9%BE%DB%8C%D8%B4+%D8%A7%D8%B2+%D8%AD%D8%B3%D9%86+%D9%86%D8%B8%D8%B1+%D8%AC%D9%86%D8%A7%D8%A8%D8%B9%D8%A7%D9%84%DB%8C+%DA%A9%D9%85%D8%A7%D9%84+%D8%A7%D9%85%D8%AA%D9%86%D8%A7%D9%86+%D8%AD%D8%A7%D8%B5%D9%84+%D8%A7%D8%B3%D8%AA.%0D%0A{post}', '09124936721', '203851', 'با سلام و عرض ادب،\r\nاحتراماً عطف به همکاری های فی مابین در ماه های گذشته، ضمن تشکر و قدردانی از تعاملات سازنده و زحمات همکاران گرامی، خواهشمند است نسبت به اختصاص زمانی کوتاه جهت برگزاری جلسه حضوری اقدام فرموده تا نسبت به بررسی استراتژی های آتی آن سازمان  و بهره مندی از نقطه نظرات و راهنمایی جنابعالی در راستای زمینه سازی همکاری های بیشتر در آینده توافقاتی حاصل گردد.\r\nپیشاپیش از حسن نظر جنابعالی کمال امتنان حاصل است.\r\n', '2014-10-14 12:55:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_members_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_objects`
--

CREATE TABLE IF NOT EXISTS `tbl_objects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) unsigned NOT NULL,
  `right_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
