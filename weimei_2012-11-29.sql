# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: weimei
# Generation Time: 2012-11-29 12:50:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table article
# ------------------------------------------------------------

CREATE TABLE `article` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `userId` int(8) NOT NULL,
  `date` datetime NOT NULL,
  `description` char(100) NOT NULL,
  `nail` varchar(60) NOT NULL DEFAULT '/uploads/20120429/1335666084_404.jpg',
  `likeCount` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table avatar
# ------------------------------------------------------------

CREATE TABLE `avatar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `src` varchar(60) NOT NULL,
  `albumId` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table avatar_album
# ------------------------------------------------------------

CREATE TABLE `avatar_album` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `firstId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likeCount` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table comment
# ------------------------------------------------------------

CREATE TABLE `comment` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `content` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(8) NOT NULL,
  `targetId` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table pic
# ------------------------------------------------------------

CREATE TABLE `pic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `src` varchar(60) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(8) NOT NULL,
  `likeCount` int(2) NOT NULL DEFAULT '0',
  `height` int(3) NOT NULL,
  `location` varchar(200) NOT NULL DEFAULT '来自上传',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table pic_album
# ------------------------------------------------------------

CREATE TABLE `pic_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(8) NOT NULL,
  `firstId` int(10) NOT NULL,
  `picId` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table tag
# ------------------------------------------------------------

CREATE TABLE `tag` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `targetId` text NOT NULL,
  `sum` int(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table user
# ------------------------------------------------------------

CREATE TABLE `user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `ip` char(20) NOT NULL,
  `qq` int(11) NOT NULL,
  `city` varchar(10) NOT NULL,
  `about` varchar(100) NOT NULL,
  `sex` char(2) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `regTime` datetime NOT NULL,
  `birthday` date NOT NULL,
  `likeItem` text NOT NULL,
  `tagId` text NOT NULL,
  `icon` varchar(60) NOT NULL DEFAULT '/uploads/icon/0.jpg',
  `likeUser` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
