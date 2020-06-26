DROP DATABASE DB_AUTH;

CREATE DATABASE DB_AUTH;

USE DB_AUTH;

CREATE TABLE `roles` (`id` int(11) PRIMARY KEY AUTO_INCREMENT, `role` varchar(64));
INSERT INTO `roles` VALUES(null, 'Developer'),(null, 'Administrator');

CREATE TABLE `users` (`id` bigint(20) PRIMARY KEY AUTO_INCREMENT, username varchar(128), `password` varchar(255),`role_id` int(11), FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`));
INSERT INTO `users` VALUES(null, 'developer', '123', 1);

CREATE TABLE `modules` (`id` int(11) PRIMARY KEY AUTO_INCREMENT, `module` varchar(64), `url` varchar(128), `base_url` tinyint(1), `other` text);
INSERT INTO `modules` VALUES(null, 'Dashboard', 'Home', 1, '');

CREATE TABLE `module_role` (`id` int(11) PRIMARY KEY AUTO_INCREMENT, `module_id` int(11), `role_id` int(11), FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`), FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`));
INSERT INTO `module_role` VALUES(null, 1, 1);
