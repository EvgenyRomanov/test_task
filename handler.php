<?php
    require_once "config.php";

    if (isset($_REQUEST["first_name"]) and isset($_REQUEST["last_name"]) and isset($_REQUEST["middle_name"])
        and isset($_REQUEST["email"]) and isset($_REQUEST["phone"]) and isset($_REQUEST["comment"])) {
            
            $first_name = htmlspecialchars($_REQUEST["first_name"]);
            $last_name = htmlspecialchars($_REQUEST["last_name"]);
            $middle_name = htmlspecialchars($_REQUEST["middle_name"]);
            $email = htmlspecialchars($_REQUEST["email"]);
            $phone = htmlspecialchars($_REQUEST["phone"]);
            $comment = htmlspecialchars($_REQUEST["comment"]);
            $date = $_REQUEST["created"];
            $rating = isset($_REQUEST["rating"]) ? (int)$_REQUEST["rating"] : 0;

            // Пользователь может уже существовать, добавим условие
            $result = mysqli_query($link, "SELECT `id`, `email` FROM `users` WHERE `email` = '$email'");

            if ($result) {
                $row = mysqli_fetch_assoc($result);

                if ($row["email"] === $email) {
                    $user_id = $row["id"];
                } else {
                    // Если пользователя нет в БД, то добавляем новую запись
                    $query = "INSERT INTO `users` (`first_name`, `middle_name`, `last_name`, `email`, `phone`) VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$phone')";
                    $result = mysqli_query($link, $query);
                    
                    if (!$result) {
                        echo "Ошибка MySQL: " . mysqli_error($link);
                    }
    
                    $user_id = mysqli_insert_id($link);
                }
            } else {
                echo "Ошибка MySQL: " . mysqli_error($link);
            }

            //$query = "INSERT INTO `comments` (`created_at`, `comment`, `rating`, `user_id`) VALUES (NOW(), '$comment', '$rating', '$user_id')";
            $query = sprintf("INSERT INTO `comments` (`created_at`, `comment`, `rating`, `user_id`) VALUES ('%s', '%s', '%s', '%s')", $date, mysqli_real_escape_string($link, $comment), $rating, $user_id);
            $result = mysqli_query($link, $query);
            
            if (!$result) {
                echo "Ошибка MySQL: " . mysqli_error($link);
            }
    }
?>