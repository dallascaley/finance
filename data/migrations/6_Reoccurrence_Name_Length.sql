ALTER TABLE `reoccurrences` MODIFY COLUMN `name` VARCHAR(30) NOT NULL DEFAULT '';
ALTER TABLE `days` MODIFY COLUMN `reoccurrence` VARCHAR(30) NOT NULL DEFAULT '';
ALTER TABLE `dates` MODIFY COLUMN `reoccurrence` VARCHAR(30) NOT NULL DEFAULT '';