CREATE DATABASE IF NOT EXISTS `schedulab`;

GRANT ALL PRIVILEGES
ON `schedulab`.*
TO 'schedulab'@'localhost'
IDENTIFIED BY 'schedulab';

DROP TABLE IF EXISTS `schedulab`.`users`;
CREATE TABLE IF NOT EXISTS `schedulab`.`users` (
	`id` int unsigned NOT NULL AUTO_INCREMENT,
	`email` varchar(100) NOT NULL,
	`password` varchar(100) NOT NULL,
	`name` varchar(50) NOT NULL,
	`group_id` int unsigned DEFAULT 1,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL,
	`is_enabled` boolean DEFAULT TRUE,
	`sort` int DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`email`)
);

DROP TABLE IF EXISTS `schedulab`.`groups`;
CREATE TABLE IF NOT EXISTS `schedulab`.`groups` (
	`id` int unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`description` text NULL,
	`sort` int DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`name`)
);

DROP TABLE IF EXISTS `schedulab`.`schedules`;
CREATE TABLE IF NOT EXISTS `schedulab`.`schedules` (
	`id` int unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int NOT NULL,
	`title` varchar(100) NOT NULL,
	`description` text NULL,
	`start_at` datetime NOT NULL,
	`end_at` datetime NOT NULL,
	`remined_at` datetime DEFAULT NULL,
	`is_joinable` boolean DEFAULT FALSE,
	`created_at` datetime NOT NULL,
	`update_at` datetime NOT NULL,
	`sort` int DEFAULT 0,
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `schedulab`.`users_schedules`;
CREATE TABLE IF NOT EXISTS `schedulab`.`users_schedules` (
	`user_id` int unsigned NOT NULL,
	`schedule_id` int unsigned NOT NULL,
	`status` boolean DEFAULT NULL,
	PRIMARY KEY (`user_id`, `schedule_id`)
);

/**
DROP TABLE IF EXISTS `schedulab`.`categories`;
 CREATE TABLE IF NOT EXISTS `schedulab`.`categories` (
	`id`,
	`name`,
	`description`,
 );
 */
