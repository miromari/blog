<!doctype html>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>
    <?php
        include_once ('function.php');
        session_start();
        $_SESSION['back'] = $_SERVER[REQUEST_URI];
        $auth = is_auth();

        $news = scandir('data');

        foreach ($news as $one){

        //дополнительная проверка, так как Мак в каждую папку вставляет свой файл с таким названием
        //Решение - делать файл с уникальным расширением и фильтровать по нему    
            if (is_file ("data/$one") && $one != '.DS_Store'){
                echo "<a href = \"article.php?f=$one\">$one</a><hr>" ;
            }
        }
    ?>

    <a href = "add.php">Добавить новость</a><br>
    <a href="login.php"><? echo ($auth ? 'Выйти':'Войти');?></a>
</body>
</html>
