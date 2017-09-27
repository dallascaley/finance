CREATE TABLE `sessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(31) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timezone` varchar(31) NOT NULL DEFAULT '',
  `utc_offset` tinyint(2) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;