<?php
        $fname = $_GET['f'];
        $path = "data/$fname";

    
    // Проверка, что GET непустой, что такой файл существует и не является папкой
    // !!!!Нужно добавить полный запрет '../'  
        
        if($fname != '' && file_exists($path) && is_file($path) ){

            $text = file_get_contents($path);
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
    <hr><a href = "edit.php?f=<? echo $fname?>">Редактировать</a> | 
    <a href = "index.php">К списку новостей</a>
</body>
</html>
