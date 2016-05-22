-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 22, 2016 at 02:42 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `hashed_password` varchar(40) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fb_uid` varchar(100) DEFAULT NULL,
  `last_used` int(11) DEFAULT '0',
  `avatar_file` varchar(255) DEFAULT NULL,
  `avatar_remote_url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `last_user_agent` varchar(255) NOT NULL,
  `invite_code` varchar(8) NOT NULL,
  `invited_by` int(11) DEFAULT NULL,
  `device_platform` enum('iOS','Android','Web') NOT NULL,
  `pn_token` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `hashed_password`, `email`, `fb_uid`, `last_used`, `avatar_file`, `avatar_remote_url`, `created_at`, `updated_at`, `user_agent`, `last_user_agent`, `invite_code`, `invited_by`, `device_platform`, `pn_token`, `active`) VALUES
(2, 'Gaurav Sharma', 123123123123, 'd0f7a3d8f3ac835df860f4a930ff6d60', 'gdsjpr+2@gmail.com', NULL, 0, NULL, NULL, '2016-05-22 11:47:43', '2016-05-22 11:47:43', 'iOS 9.3.2/iPhone 6/App 1.0(1)', 'iOS 9.3.2/iPhone 6/App 1.0(1)', '', NULL, 'iOS', '', 1),
(4, 'Gaurav Sharma', 123123123123, 'd0f7a3d8f3ac835df860f4a930ff6d60', 'gdsjpr+1@gmail.com', NULL, 0, NULL, NULL, '2016-05-22 11:52:05', '2016-05-22 11:52:05', 'iOS 9.3.2/iPhone 6/App 1.0(1)', 'iOS 9.3.2/iPhone 6/App 1.0(1)', '', NULL, 'iOS', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
