-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2016 at 02:44 PM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ppr_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Short_Name` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Phone_Number` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Activated` tinyint(1) unsigned DEFAULT '0',
  `Added_Date` int(11) unsigned DEFAULT NULL,
  `Added_By` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`Id`, `Name`, `Short_Name`, `Location`, `Phone_Number`, `Email`, `Activated`, `Added_Date`, `Added_By`) VALUES
(1, 'Main Branch Kabul', 'KBL_MAIN', 'Sello Street, Kabul Afghanistan', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(90) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Type` int(6) unsigned DEFAULT NULL,
  `Activated` tinyint(1) unsigned DEFAULT '0',
  `Added_By` int(11) unsigned DEFAULT NULL,
  `Added_Date` int(11) unsigned DEFAULT NULL,
  `Last_Online` int(11) unsigned DEFAULT NULL,
  `Reset_Token` varchar(255) DEFAULT NULL,
  `Password_Expired` tinyint(3) unsigned DEFAULT '0',
  `Photo` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Gender` tinyint(1) unsigned DEFAULT '0',
  `Date_Of_Birth` int(11) unsigned DEFAULT NULL,
  `Store_Id` int(11) unsigned DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `Facebook` varchar(255) DEFAULT NULL,
  `Skype` varchar(255) DEFAULT NULL,
  `Home_Address` text,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Type`, `Activated`, `Added_By`, `Added_Date`, `Last_Online`, `Reset_Token`, `Password_Expired`, `Photo`, `Name`, `Last_Name`, `Gender`, `Date_Of_Birth`, `Store_Id`, `Mobile`, `Facebook`, `Skype`, `Home_Address`) VALUES
(1, 'hammed@farsales.com', '11ae78392f6dcd2f01f9c837171b7f9d4cb2a381', 1, 1, NULL, NULL, NULL, NULL, 0, NULL, 'Sayed Hammed', 'Rohani', 1, NULL, 1, '0567489625', NULL, NULL, NULL),
(2, 'khan@khan.com', '75f62e6fdc942b4dbca0669bcc1d9ebd2190e154', 1, 1, NULL, 1454659490, NULL, NULL, 0, 'png', 'khan', 'khan', 1, 1104537600, 1, '123', 'abc', 'abc', 'abc'),
(3, 'Hasibabed@farsales.com', '701b389b848a2b1cfab867093101d8d5ac56addd', 1, 1, NULL, 1454679241, NULL, NULL, 1, '', 'Hasib', 'Abed', 1, 631152000, 1, '+93 702076258', '', '', 'Kabul');

-- --------------------------------------------------------

--
-- Table structure for table `users_contacts`
--

CREATE TABLE IF NOT EXISTS `users_contacts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE IF NOT EXISTS `users_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) unsigned DEFAULT NULL,
  `IP_Address` varchar(255) DEFAULT NULL,
  `Date` int(11) unsigned DEFAULT NULL,
  `Data` text,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE IF NOT EXISTS `users_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Details` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`Id`, `Name`, `Details`) VALUES
(1, 'Admin', 'Adminstrator'),
(2, 'Store Admin', 'Store Administrator'),
(3, 'Research', 'Research');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
