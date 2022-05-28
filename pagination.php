<?php

$countView = 3; // количество комментариев на странице

// номер страницы
if (isset($_GET['page'])) {
    $pageNum = (int)$_GET['page'];
} else {
    $pageNum = 1;
}

$startIndex = ($pageNum-1) * $countView; // с какой записи начать выборку

// запрос к бд
$sql = mysqli_query($link, "SELECT `comment` FROM `comments` ORDER BY `created_at` DESC LIMIT $startIndex, $countView");

$commentsData = mysqli_fetch_all($sql, MYSQLI_ASSOC);

// получение полного количества новостей
$sql2 = mysqli_query($link, "SELECT comment FROM `comments`");
$countAllComments = mysqli_num_rows($sql2);

// номер последней страницы
$lastPage = ceil($countAllComments / $countView);

?>