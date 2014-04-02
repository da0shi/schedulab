CREATE DATABASE IF NOT EXISTS `schedulab`;

GRANT ALL PRIVILEGES
ON `schedulab`.*
TO 'schedulab'@'localhost'
IDENTIFIED BY 'schedulab';

CREATE TABLE IF NOT EXISTS `schedulab`.`users` (
	`id` unsigned int NOT NULL AUTO_INCREMENT,
	`email` varchar(100) NOT NULL,
	`password` varchar(100) NOT NULL,
	`name` varchar(50) NOT NULL,
	`group_id` smallint DEFAULT 1,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL,
	`is_enabled` boolean DEFAULT TRUE,
	`sort` int DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`email`)
);

CREATE TABLE IF NOT EXISTS `schedulab`.`group` (
	`id` unsigned int NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`description` text NULL,
	`sort` int DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`name`)
);

CREATE TABLE IF NOT EXISTS `schedulab`.`schedule` (
	`id` unsigned int NOT NULL AUTO_INCREMENT,
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
	PRIMARY KEY (`id`),
	UNIQUE KEY (`name`)
);
