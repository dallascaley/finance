# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.28-0ubuntu0.14.04.1)
# Database: test
# Generation Time: 2017-09-08 18:15:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `account` varchar(15) NOT NULL DEFAULT '',
  `username` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table actions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `actions`;

CREATE TABLE `actions` (
  `name` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `actions` WRITE;
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;

INSERT INTO `actions` (`name`)
VALUES
	('credit'),
	('debit');

/*!40000 ALTER TABLE `actions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `key` varchar(15) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `localization` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table days
# ------------------------------------------------------------

DROP TABLE IF EXISTS `days`;

CREATE TABLE `days` (
  `reoccurrence` varchar(15) NOT NULL DEFAULT '',
  `day` tinyint(2) NOT NULL,
  PRIMARY KEY (`reoccurrence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table frequencies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `frequencies`;

CREATE TABLE `frequencies` (
  `name` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `frequencies` WRITE;
/*!40000 ALTER TABLE `frequencies` DISABLE KEYS */;

INSERT INTO `frequencies` (`name`)
VALUES
	('annually'),
	('bi-monthly'),
	('bi-weekly'),
	('daily'),
	('monthly'),
	('weekdays'),
	('weekends'),
	('weekly');

/*!40000 ALTER TABLE `frequencies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table localizations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `localizations`;

CREATE TABLE `localizations` (
  `localization` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`localization`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table names
# ------------------------------------------------------------

DROP TABLE IF EXISTS `names`;

CREATE TABLE `names` (
  `username` varchar(31) NOT NULL DEFAULT '',
  `name` varchar(63) NOT NULL DEFAULT '',
  `cardinality` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table reoccurrences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reoccurrences`;

CREATE TABLE `reoccurrences` (
  `reoccurrence` varchar(15) NOT NULL DEFAULT '',
  `username` varchar(31) NOT NULL DEFAULT '',
  `amount` float(7,2) NOT NULL DEFAULT '0.00',
  `action` varchar(15) NOT NULL DEFAULT '',
  `frequency` varchar(15) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timezones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timezones`;

CREATE TABLE `timezones` (
  `name` varchar(15) NOT NULL DEFAULT '',
  `gmt_offset` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `username` varchar(31) NOT NULL DEFAULT '',
  `account` varchar(15) NOT NULL DEFAULT '',
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float(7,2) NOT NULL,
  `action` varchar(15) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(31) NOT NULL DEFAULT '',
  `email` varchar(254) NOT NULL DEFAULT '',
  `password` varchar(31) NOT NULL DEFAULT '',
  `timezone` varchar(15) NOT NULL DEFAULT '',
  `localization` varchar(31) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
