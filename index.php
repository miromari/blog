
<!doctype html>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>
    <?php
        $news = scandir('data');

        foreach ($news as $one){

        //дополнительная проверка, так как Мак в каждую папку вставляет свой файл с таким названием.
        //Решение - если надо работать с файлами - создавать файлы с уникальным расширешнием и фильтровать по нему. Посмотреть 2 урок, разбор моего ДЗ
            if (is_file ("data/$one") && $one != '.DS_Store'){
                echo "<a href = \"article.php?f=$one\">$one</a><hr>" ;
            }
        }
    ?>

    <a href = "add.php">Добавить новость</a>
</body>
</html>
