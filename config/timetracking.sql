-- Adminer 4.8.1 MySQL 8.0.29 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `pause`;
CREATE TABLE `pause` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pause_start` int DEFAULT NULL,
  `pause_end` int DEFAULT NULL,
  `pause` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `time_entry`;
CREATE TABLE `time_entry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start` int DEFAULT NULL,
  `end` int DEFAULT NULL,
  `hours` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `workday`;
CREATE TABLE `workday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time_entries` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `pauses` varchar(255) DEFAULT NULL,
  `pause_total` int DEFAULT NULL,
  `hours_total` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- 2022-07-10 14:31:43
