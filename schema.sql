
CREATE DATABASE `test`;
USE `test`;


-- Пользователи.
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(128) NOT NULL,
    `middle_name` VARCHAR(128) NOT NULL,
    `last_name` VARCHAR(128) NOT NULL,
    `email` VARCHAR(128) NOT NULL UNIQUE,
    `phone` VARCHAR(64) NOT NULL UNIQUE
);



-- Комментарии.
CREATE TABLE `comments` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `created_at` DATETIME NOT NULL,                           
    `comment` TEXT NOT NULL,                                  
    `rating` TINYINT,
    `user_id` INT NOT NULL,
    FOREIGN KEY `user_index` (`user_id`) REFERENCES `users` (`id`)
);

