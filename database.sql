DROP DATABASE DB_AUTH;

CREATE DATABASE DB_AUTH;

USE DB_AUTH;

CREATE TABLE `users` (id bigint(20) PRIMARY KEY AUTO_INCREMENT, username varchar(128), `password` varchar(255));

CREATE TABLE `roles` (id int(11) PRIMARY KEY AUTO_INCREMENT, `role` varchar(64));

CREATE TABLE `role_user` (id int(11) PRIMARY KEY AUTO_INCREMENT, `user_id` bigint(20), role_id int(11), FOREIGN KEY (`user_id`) REFERENCES `users` (`id`), FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`));