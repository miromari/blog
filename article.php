<?php
    include_once ('m/auth.php');
    include_once ('m/pdo.php');
    include_once ('m/articles.php');

    session_start();
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];

    //Проверка авторизации
    $auth = is_auth();

     $id_article = (int)$_GET['id'];
    
    //  Проверка, что GET - число
    if($id_article > 0){

        //Подключение к базе данных
        $db = connect_db();

        $article = article_get($id_article, $db);
        
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
include_once('v/v_article.php');