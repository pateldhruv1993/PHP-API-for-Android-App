-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2015 at 11:40 PM
-- Server version: 5.5.40
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whathappend`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `post` text NOT NULL,
  `user` varchar(16) NOT NULL,
  `long` float(9,6) DEFAULT NULL,
  `lat` float(9,6) DEFAULT NULL,
  `range` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reports` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `user`, `long`, `lat`, `range`, `timestamp`, `reports`) VALUES
(184, 'hdhs', 'test', -78.339775, 18.294916, 999999999, '2014-12-23 12:37:41', 0),
(185, '\nwhat happened \n', 'test', -79.380493, 43.640656, 999999999, '2015-01-29 16:09:17', 0),
(186, '??????', 'test', -79.799255, 43.687168, 999999999, '2015-07-06 18:57:21', 0),
(180, 'check', 'test', -79.799263, 43.687183, 999999999, '2014-12-09 23:10:55', 0),
(181, 'shit sucks', 'test', -79.735527, 43.656368, 999999999, '2014-12-12 22:03:27', 1),
(182, 'ggg', 'test', -79.802361, 43.698200, 999999999, '2014-12-14 15:24:28', 0),
(183, 'f', 'test', -79.802361, 43.698193, 999999999, '2014-12-14 15:26:53', 0),
(176, 'need an a', 'test', -79.740349, 43.655399, 999999999, '2014-12-12 21:42:53', 1),
(177, 'in Scarborough', 'test', -79.294708, 43.814079, 999999999, '2014-12-04 23:24:20', 0),
(178, 'home', 'test', -79.801857, 43.697899, 999999999, '2014-12-05 13:29:14', 0),
(179, 'h\n', 'test', -79.799225, 43.687134, 999999999, '2014-12-09 21:05:12', 0),
(172, 'test', 'test', -79.740150, 43.655704, 999999999, '2014-12-12 21:42:58', 1),
(171, 'Lets see', 'test', -79.734612, 43.657055, 999999999, '2014-12-03 14:33:52', 0),
(170, 'yo', 'test', 0.000000, 0.000000, 999999999, '2014-12-03 14:32:32', 0),
(169, 'b', 'test', 0.000000, 0.000000, 999999999, '2014-12-03 14:30:42', 0),
(168, 'omg', 'test', -79.734612, 43.657055, 999999999, '2014-12-03 14:24:10', 0),
(167, 'gg', 'test', 0.000000, 0.000000, 999999999, '2014-12-03 14:22:11', 0),
(166, 'wtf', 'aram', 0.000000, 0.000000, 999999999, '2014-12-03 14:16:34', 0),
(165, 'fff', 'aram', -79.734612, 43.657055, 999999999, '2014-12-12 21:43:02', 2),
(164, 'nothing happend yet', 'aram', 0.000000, 0.000000, 999999999, '2014-12-03 14:12:54', 0),
(175, 'Hi guys ', 'hchan', -79.740334, 43.655399, 999999999, '2014-12-03 18:32:54', 0),
(162, 'timmies dark roast yukkk!!!!', 'test', -79.734612, 43.657055, 999999999, '2014-12-09 23:10:46', 2),
(173, 'vishal', 'test', -79.740166, 43.655640, 999999999, '2014-12-03 15:39:57', 0),
(174, 'amazing work guys !!!', 'test', -79.740173, 43.655655, 999999999, '2014-12-03 15:40:27', 0),
(160, 'ggey', 'test', -79.740334, 43.655514, 999999999, '2014-12-01 19:44:56', 0),
(159, 'hsh', 'test', -79.740334, 43.655514, 999999999, '2014-12-01 19:44:50', 0),
(158, 'dgg', 'test', -79.734589, 43.657059, 999999999, '2014-12-01 19:30:24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `post` (`post`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=187;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
