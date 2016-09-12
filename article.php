<?php
    include_once ('function.php');
    session_start();
    $_SESSION['back'] = $_SERVER[REQUEST_URI];

    //Проверка авторизации
    $auth = is_auth();

     $id_article = (int)$_GET['id'];
    
    //  Проверка, что GET - число
    if($id_article > 0){

        //Подключение к базе данных
        $db = connect_db();

        $sql = "SELECT * FROM articles WHERE id_article = '$id_article'";
        $query = $db->prepare($sql);
        $query->execute();
        $article = $query->fetch();
        
        //Если такой статьи нет
        if(empty($article)){
            header ("Location: index.php");
            exit();
        }

        $title = $article['title'];
        $content = $article['content'];

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
    <h2><?=$title ?></h2>
    <p> <?=$content ?></p><hr>
    
    <?if($auth):?>
    <a href = "edit.php?id=<?=$id_article?>">Редактировать</a> | 
    <?endif?>

    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php"><?=($auth?'Выйти':'Войти')?></a>


</body>
</html>
