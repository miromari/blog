<!doctype html>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>
    <?php
        session_start();

        $news = scandir('data');

        foreach ($news as $one){

        //дополнительная проверка, так как Мак в каждую папку вставляет свой файл с таким названием
        //Решение - делать файл с уникальным расширением и фильтровать по нему    
            if (is_file ("data/$one") && $one != '.DS_Store'){
                echo "<a href = \"article.php?f=$one\">$one</a><hr>" ;
            }
        }
    ?>

    <a href = "add.php">Добавить новость</a>
</body>
</html>
