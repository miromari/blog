<?php
    include_once ('function.php');
    session_start();
    $_SESSION['back'] = $_SERVER[REQUEST_URI];
    $auth = is_auth();


     $id_article = (int)$_GET['id'];

    
    // // Проверка, что GET непустой и статья существует 
        
    if($id_article > 0){

        //Подключение к базе данных
        $db = connect_db();

        $sql = "SELECT * FROM articles WHERE id_article = '$id_article'";
        $query = $db->prepare($sql);
        $res = $query->execute();
        $article = $query->fetch();
        
        if(empty($article)){
            header ("Location: index.php");
            exit();
        }

        $title = $article['title'];
        $content = $article['content'];



    }else {
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
        <?echo '<h1>' . $title . '</h1>';
          echo '<p>' . $content . '</p> <hr>';

    if($auth) {?>
        <a href = "edit.php?id=<? echo $id_article?>">Редактировать</a> | 
    <?}?>

    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php"><? echo ($auth ? 'Выйти':'Войти');?></a>
</body>
</html>
