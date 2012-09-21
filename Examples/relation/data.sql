-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 09 月 21 日 14:39
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `examples`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_card`
--

CREATE TABLE IF NOT EXISTS `think_card` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `member_id` mediumint(6) NOT NULL,
  `card` varchar(25) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_dept`
--

CREATE TABLE IF NOT EXISTS `think_dept` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `think_dept`
--

INSERT INTO `think_dept` (`id`, `name`) VALUES
(1, '开发部'),
(2, '销售部'),
(3, '财务部');

-- --------------------------------------------------------

--
-- 表的结构 `think_groups`
--

CREATE TABLE IF NOT EXISTS `think_groups` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `think_groups`
--

INSERT INTO `think_groups` (`id`, `name`) VALUES
(1, '项目组1'),
(2, '项目组2'),
(3, '项目组3');

-- --------------------------------------------------------

--
-- 表的结构 `think_member`
--

CREATE TABLE IF NOT EXISTS `think_member` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `dept_id` smallint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_member_groups`
--

CREATE TABLE IF NOT EXISTS `think_member_groups` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `groups_id` mediumint(5) NOT NULL,
  `member_id` mediumint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=333 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_profile`
--

CREATE TABLE IF NOT EXISTS `think_profile` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `member_id` mediumint(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
