# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.28-0ubuntu0.14.04.1)
# Database: test
# Generation Time: 2017-09-06 23:49:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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


# Dump of table reoccurrence_days
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reoccurrence_days`;

CREATE TABLE `reoccurrence_days` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reoccurrence_id` int(11) unsigned NOT NULL,
  `day` int(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reoccurrence_day_reoccurrence` (`reoccurrence_id`),
  CONSTRAINT `fk_reoccurrence_day_reoccurrence` FOREIGN KEY (`reoccurrence_id`) REFERENCES `reoccurrences` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table reoccurrences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reoccurrences`;

CREATE TABLE `reoccurrences` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float(7,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) unsigned NOT NULL,
  `action` varchar(15) NOT NULL DEFAULT '',
  `frequency` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_reoccurrences_user` (`user_id`),
  KEY `fk_reoccurrences_action` (`action`),
  KEY `fk_reoccurrences_frequency` (`frequency`),
  CONSTRAINT `fk_reoccurrences_action` FOREIGN KEY (`action`) REFERENCES `actions` (`name`),
  CONSTRAINT `fk_reoccurrences_frequency` FOREIGN KEY (`frequency`) REFERENCES `frequencies` (`name`),
  CONSTRAINT `fk_reoccurrences_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `amount` float(7,2) unsigned NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_transaction_user` (`user_id`),
  KEY `fk_transaction_action` (`action`),
  CONSTRAINT `fk_transaction_action` FOREIGN KEY (`action`) REFERENCES `actions` (`name`),
  CONSTRAINT `fk_transaction_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(31) NOT NULL DEFAULT '',
  `first_name` varchar(31) NOT NULL DEFAULT '',
  `last_name` varchar(31) DEFAULT NULL,
  `password` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
