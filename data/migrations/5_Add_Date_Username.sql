ALTER TABLE `dates` ADD `username` varchar(31) NOT NULL DEFAULT '' AFTER `reoccurrence`;
ALTER TABLE `dates` DROP PRIMARY KEY;
ALTER TABLE `dates` ADD PRIMARY KEY(`reoccurrence`,`username`,`date`);
ALTER TABLE `dates` ADD CONSTRAINT fk_dates_reoccurrence FOREIGN KEY (`reoccurrence`,`username`) REFERENCES reoccurrences(`name`,`username`);
