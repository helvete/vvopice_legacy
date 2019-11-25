-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: wm25.wedos.net:3306
-- Generation Time: Nov 25, 2019 at 12:37 PM
-- Server version: 5.5.30
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d34308_001`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--
-- Creation: Jun 02, 2015 at 10:43 PM
-- Last update: Dec 08, 2015 at 02:33 AM
-- Last check: Dec 08, 2015 at 02:33 AM
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(8) NOT NULL,
  `ticket_id` int(8) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `user` int(8) DEFAULT NULL,
  `action_type` int(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--
-- Creation: Dec 15, 2015 at 09:37 AM
-- Last update: Nov 01, 2019 at 09:04 AM
-- Last check: Dec 15, 2016 at 03:16 PM
--

CREATE TABLE IF NOT EXISTS `forum` (
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `text` text COLLATE utf8_czech_ci,
  `ip` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_action`
--
-- Creation: Dec 18, 2012 at 09:09 PM
-- Last update: Oct 13, 2019 at 09:46 PM
-- Last check: Dec 08, 2015 at 02:33 AM
--

CREATE TABLE IF NOT EXISTS `forum_action` (
  `time` datetime DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `text` varchar(4096) COLLATE utf8_czech_ci DEFAULT NULL,
  `ip` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_bu`
--
-- Creation: Dec 18, 2012 at 09:09 PM
-- Last update: Oct 13, 2019 at 09:46 PM
-- Last check: Dec 08, 2015 at 02:33 AM
--

CREATE TABLE IF NOT EXISTS `forum_bu` (
  `id` int(2) NOT NULL,
  `time` datetime NOT NULL,
  `co` varchar(64) COLLATE latin2_czech_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

-- --------------------------------------------------------

--
-- Table structure for table `opo`
--
-- Creation: Dec 27, 2012 at 05:22 PM
-- Last update: Feb 16, 2017 at 08:07 PM
-- Last check: Dec 08, 2015 at 02:33 AM
--

CREATE TABLE IF NOT EXISTS `opo` (
  `slovo` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `slovnidruh` int(1) NOT NULL,
  `rodpodst` int(1) NOT NULL,
  `itemid` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`time`),
  ADD KEY `time` (`time`),
  ADD KEY `time_2` (`time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
