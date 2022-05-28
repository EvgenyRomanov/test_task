
USE `test`;


INSERT INTO `users` (`first_name`, `middle_name`, `last_name`, `email`, `phone`) VALUES ('ivan', 'ivanovich', 'ivanov', 'ivanov@example.com', '+79857776655');
INSERT INTO `users` (`first_name`, `middle_name`, `last_name`, `email`, `phone`) VALUES ('petr', 'petrovich', 'petrov', 'petrov@example.com', '+79857776644');


INSERT INTO `comments` (`created_at`, `comment`, `rating`, `user_id`) VALUES (NOW(), 'это комментарий пользователя ivanov', 4, 1);
INSERT INTO `comments` (`created_at`, `comment`, `rating`, `user_id`) VALUES (NOW(), 'это комментарий пользователя petrov', 5, 2);

