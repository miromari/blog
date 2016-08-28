<?php
        $fname = $_GET['f'];

        /* проверки:
            - $fname !=
            - файл есть file_exists
            - файл не папка
        */

        if($fname != '' && file_exists("data/$fname") && is_file("data/$fname") ){

            $text = file_get_contents("data/$fname");
            echo '<h1>' . $fname . '</h1>';
            echo '<p>' . $text . '</p>';
        }

        else {
            header ("Location: index.php");
            exit();
        }
    ?>


<!doctype html>
<html>
<head>
    <title>Страница новости</title>
</head>
<body>
    <a href = "edit.php?f=<? echo $fname?>">Редактировать</a><br>
    <a href = "index.php">К списку новостей</a>
</body>
</html>
