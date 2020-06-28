DROP DATABASE DB_AUTH;
CREATE DATABASE DB_AUTH;
USE DB_AUTH;

CREATE TABLE `roles` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `role` varchar(64) NOT NULL
);
INSERT INTO `roles` VALUES(1, 'Developer'),(2, 'Administrator');

CREATE TABLE `users` (
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(128) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role_id` int(11) NOT NULL,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
);
INSERT INTO `users` VALUES(1, 'developer', '123', 1),(2, 'administrator', '123', 2);

CREATE TABLE `modules` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `module` varchar(64) NOT NULL,
    `url` varchar(128),
    `base_url` boolean,
    `parent` int(11),
    `is_parent` boolean,
    `other` text
);
INSERT INTO `modules` VALUES(1, 'Home', 'Home', 1, null, 0, '');
INSERT INTO `modules` VALUES(2, 'Developer', '#', 0, null, 1, '');
INSERT INTO `modules` VALUES(3, 'Menu Management', 'Module', 1, 2, 0, '');
INSERT INTO `modules` VALUES(4, 'Access Management', 'Access', 1, 2, 0, '');

CREATE TABLE `module_role` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `module_id` int(11) NOT NULL,
    `role_id` int(11) NOT NULL,
    FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
);
INSERT INTO `module_role` VALUES(1, 1, 1);
INSERT INTO `module_role` VALUES(2, 2, 1);
INSERT INTO `module_role` VALUES(3, 3, 1);
INSERT INTO `module_role` VALUES(4, 4, 1);
