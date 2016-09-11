<?php

include_once ('function.php');

session_start();
$_SESSION['back'] = $_SERVER[REQUEST_URI];

$auth = is_auth();

//Подключение к базе данных
$db = connect_db();

$sql = "SELECT id_article, title FROM articles ORDER BY date_edit DESC";
$query = $db->prepare($sql);

$query->execute();


$articles = $query->fetchAll();
// my_print_r($articles); 
?>

<!doctype html>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>
    <?php
        foreach ($articles as $article){
            echo '<a href = "article.php?id='. $article['id_article'] . '">' . $article['title'] . '</a><br>';
            
            if($auth){
                echo  '<a font = "8" href = "edit.php?id='.  $article['id_article'] .'">Редактировать</a>    ';
                echo  '<a  font = "8" href = "delete.php?id='.  $article['id_article'] .'">Удалить</a>';
            }

            echo '<hr>';      
        }
    ?>

    <a href = "add.php">Добавить новость</a><br>
    <a href="login.php"><? echo ($auth ? 'Выйти':'Войти');?></a>
</body>
</html>
