# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.46-0ubuntu0.14.04.2)
# Database: finances
# Generation Time: 2017-09-09 17:18:08 +0000
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
  `name` varchar(15) NOT NULL DEFAULT '',
  `username` varchar(31) NOT NULL DEFAULT '',
  `balance` float(7,2) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`,`username`),
  KEY `fk_accounts_user` (`username`),
  KEY `fk_accounts_type` (`type`),
  CONSTRAINT `fk_accounts_type` FOREIGN KEY (`type`) REFERENCES `accounttypes` (`name`),
  CONSTRAINT `fk_accounts_user` FOREIGN KEY (`username`) REFERENCES `users` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table accounttypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accounttypes`;

CREATE TABLE `accounttypes` (
  `name` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
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
  `localization` varchar(31) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`key`,`localization`),
  KEY `fk_contents_localization` (`localization`),
  CONSTRAINT `fk_contents_localization` FOREIGN KEY (`localization`) REFERENCES `localizations` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table dates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dates`;

CREATE TABLE `dates` (
  `reoccurrence` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`reoccurrence`,`date`),
  KEY `fk_dates_type` (`type`),
  CONSTRAINT `fk_dates_type` FOREIGN KEY (`type`) REFERENCES `datetypes` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table datetypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `datetypes`;

CREATE TABLE `datetypes` (
  `name` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table days
# ------------------------------------------------------------

DROP TABLE IF EXISTS `days`;

CREATE TABLE `days` (
  `reoccurrence` varchar(15) NOT NULL,
  `day` tinyint(2) NOT NULL,
  PRIMARY KEY (`reoccurrence`,`day`),
  CONSTRAINT `fk_days_reoccurrence` FOREIGN KEY (`reoccurrence`) REFERENCES `reoccurrences` (`name`)
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
  `name` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table names
# ------------------------------------------------------------

DROP TABLE IF EXISTS `names`;

CREATE TABLE `names` (
  `name` varchar(63) NOT NULL DEFAULT '',
  `username` varchar(31) NOT NULL,
  `cardinality` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`,`name`,`cardinality`),
  CONSTRAINT `fk_names_user` FOREIGN KEY (`username`) REFERENCES `users` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table reoccurrences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reoccurrences`;

CREATE TABLE `reoccurrences` (
  `name` varchar(15) NOT NULL DEFAULT '',
  `username` varchar(31) NOT NULL DEFAULT '',
  `amount` float(7,2) NOT NULL DEFAULT '0.00',
  `action` varchar(15) NOT NULL DEFAULT '',
  `frequency` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`,`username`),
  KEY `fk_reoccurrences_user` (`username`),
  KEY `fk_reoccurrences_action` (`action`),
  KEY `fk_reoccurrences_frequency` (`frequency`),
  CONSTRAINT `fk_reoccurrences_frequency` FOREIGN KEY (`frequency`) REFERENCES `frequencies` (`name`),
  CONSTRAINT `fk_reoccurrences_action` FOREIGN KEY (`action`) REFERENCES `actions` (`name`),
  CONSTRAINT `fk_reoccurrences_user` FOREIGN KEY (`username`) REFERENCES `users` (`name`)
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
  `action` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`,`account`,`posted`),
  KEY `fk_transactions_account` (`account`),
  KEY `fk_transactions_action` (`action`),
  CONSTRAINT `fk_transactions_user` FOREIGN KEY (`username`) REFERENCES `users` (`name`),
  CONSTRAINT `fk_transactions_account` FOREIGN KEY (`account`) REFERENCES `accounts` (`name`),
  CONSTRAINT `fk_transactions_action` FOREIGN KEY (`action`) REFERENCES `actions` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `name` varchar(31) NOT NULL DEFAULT '',
  `email` varchar(254) NOT NULL DEFAULT '',
  `password` varchar(31) NOT NULL DEFAULT '',
  `timezone` varchar(15) NOT NULL DEFAULT '',
  `localization` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_users_timezone` (`timezone`),
  KEY `fk_users_localization` (`localization`),
  CONSTRAINT `fk_users_localization` FOREIGN KEY (`localization`) REFERENCES `localizations` (`name`),
  CONSTRAINT `fk_users_timezone` FOREIGN KEY (`timezone`) REFERENCES `timezones` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
