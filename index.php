<?php
    require_once "config.php";
    require_once "pagination.php";
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Custom -->
    <link rel="stylesheet" href="css/style.css" />

    <script>
        $(document).ready(function() { 
            $("#ajaxform").submit(function(){    // перехватываем все при событии отправки
                var form = $(this);              // запишем форму, чтобы потом не было проблем с this
                var error = false;               // предварительно ошибок нет
                form.find('input[name="first_name"], input[name="last_name"], input[name="middle_name"], input[name="email"], input[name="phone"], textarea').each( function(){ // пробежим по каждому полю в форме
                    if ($(this).val() == '') {   // если находим пустое
                        alert('Заполните поле "'+$(this).attr('name')+'"!');
                        error = true;            // ошибка
                    }
                });
                if (!error) {                    // если ошибки нет
                    var data = form.serialize(); // подготавливаем данные
                    $.ajax({                     // инициализируем ajax запрос
                        type: 'POST', 
                        url: 'handler.php', 
                        data: data,              // данные для отправки
                        error: function (xhr, ajaxOptions, thrownError) { // в случае неудачного завершения запроса к серверу
                                 alert(xhr.status);   // покажем ответ сервера
                                 alert(thrownError);  // и текст ошибки
                             },
                        complete: function(data) {    // событие после любого исхода
                            // очищаем поля формы
                            $(':input','#ajaxform')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .prop('checked', false)
                            .prop('selected', false);
                            $('input[type="radio"]').prop('checked', false);
                        }
                    });
                }
                return false; // деактивируем стандартную отправку формы
            });
        });
    </script>

    <title>Тестовое задание</title>
</head>
<body>
    
    <form id="ajaxform" action="">
        <!-- 2 column grid layout with text inputs for the first and last names -->
        <div class="row mb-4">
            <div class="col">
            <div class="form-outline">
                <input type="text" id="form6Example1" class="form-control" name="first_name"/>
                <label class="form-label" for="form6Example1">Имя</label>
            </div>
            </div>
            <div class="col">
            <div class="form-outline">
                <input type="text" id="form6Example2" class="form-control" name="last_name"/>
                <label class="form-label" for="form6Example2">Фамилия</label>
            </div>
            </div>
            <div class="col">
            <div class="form-outline">
                <input type="text" id="form6Example3" class="form-control" name="middle_name"/>
                <label class="form-label" for="form6Example3">Отчество</label>
            </div>
            </div>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form6Example5" class="form-control" name="email"/>
            <label class="form-label" for="form6Example5">Email</label>
        </div>
        <!-- Phone input -->
        <div class="form-outline mb-4">
            <input type="tel" id="typePhone" class="form-control" name="phone"/>
            <label class="form-label" for="typePhone">Телефон</label>
        </div>
        <!-- Message input -->
        <div class="form-outline mb-4">
            <textarea class="form-control" id="form6Example7" rows="4" name="comment"></textarea>
            <label class="form-label" for="form6Example7">Комментарий</label>
        </div>
        <!-- Date input hidden -->
        <input type="datetime" name="created" hidden value="<?= date('Y-m-d H:i:s'); ?>">
        <!-- Rating input -->
        <div class="form-outline mb-4 rating-area">
            <input type="radio" id="star-5" name="rating" value="5">
            <label for="star-5" title="Оценка «5»"></label>	
            <input type="radio" id="star-4" name="rating" value="4">
            <label for="star-4" title="Оценка «4»"></label>    
            <input type="radio" id="star-3" name="rating" value="3">
            <label for="star-3" title="Оценка «3»"></label>  
            <input type="radio" id="star-2" name="rating" value="2">
            <label for="star-2" title="Оценка «2»"></label>    
            <input type="radio" id="star-1" name="rating" value="1">
            <label for="star-1" title="Оценка «1»"></label>
        </div>
        <!-- Submit button -->
        <input type="submit" class="btn btn-primary btn-block mb-4">
    </form>
    
    <div id="content">
        <!-- Вывод пагинатора -->
        <ul id="paginator">
            <?php if ($pageNum > 1) { ?>
                <li><a href="/index.php?page=1">&lt;&lt;</a></li>
                <li><a href="/index.php?page=<?= $pageNum - 1; ?>">&lt;</a></li>
            <?php } ?>
            
            <?php for ($i = 1; $i<=$lastPage; $i++) { ?>
                <li <?= ($i == $pageNum) ? 'class="current"' : ''; ?>><a href="/index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
            <?php } ?>
            
            <?php if ($pageNum < $lastPage) { ?>
                <li><a href="/index.php?page=<?= $pageNum + 1; ?> ">&gt;</a></li>
                <li><a href="/index.php?page=<?= $lastPage; ?>">&gt;&gt;</a></li>
            <?php } ?>
        </ul>

        <!-- Вывод комментариев -->
        <ul class="list-group list-group-light list-group-small justify-content-center">
        <?php foreach ($commentsData as $oneComment) { ?>
            <li class="list-group-item"><?= $oneComment['comment']; ?></li>
        <?php } ?>
        </ul>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"></script>

</body>
</html>