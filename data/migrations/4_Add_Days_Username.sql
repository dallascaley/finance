ALTER TABLE `days` ADD `username` varchar(31) NOT NULL DEFAULT '' AFTER `reoccurrence`;
ALTER TABLE `days` DROP FOREIGN KEY fk_days_reoccurrence;
ALTER TABLE `days` DROP PRIMARY KEY;
ALTER TABLE `days` ADD PRIMARY KEY(`reoccurrence`,`username`,`day`);
ALTER TABLE `days` ADD CONSTRAINT fk_days_reoccurrence FOREIGN KEY (`reoccurrence`,`username`) REFERENCES reoccurrences(`name`,`username`);
