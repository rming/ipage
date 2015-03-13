-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-11-12 00:56:10
-- 服务器版本： 5.5.28-log
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipage`
--

-- --------------------------------------------------------

--
-- 表的结构 `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
`id` bigint(20) unsigned NOT NULL,
  `uid` bigint(20) unsigned DEFAULT NULL,
  `prefix` varchar(32) DEFAULT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `target` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- 表的结构 `domain_old`
--

CREATE TABLE IF NOT EXISTS `domain_old` (
`id` bigint(20) unsigned NOT NULL,
  `uid` bigint(20) unsigned DEFAULT NULL,
  `prefix` varchar(32) DEFAULT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `target` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- 表的结构 `domain_resolve`
--

CREATE TABLE IF NOT EXISTS `domain_resolve` (
`id` bigint(20) unsigned NOT NULL,
  `domain_id` bigint(20) unsigned DEFAULT NULL,
  `prefix` varchar(32) DEFAULT NULL,
  `resolve_action` tinyint(4) unsigned DEFAULT NULL,
  `resolve_type` tinyint(3) unsigned DEFAULT NULL,
  `target` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `resolve_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;


--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` bigint(20) NOT NULL,
  `group_id` int(11) unsigned DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` char(30) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `token_time` datetime DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_old`
--
ALTER TABLE `domain_old`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_resolve`
--
ALTER TABLE `domain_resolve`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `domain_old`
--
ALTER TABLE `domain_old`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `domain_resolve`
--
ALTER TABLE `domain_resolve`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
