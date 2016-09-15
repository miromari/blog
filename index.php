<?php

    include_once ('m/auth.php');
    include_once ('m/pdo.php');
    include_once ('m/articles.php');


    session_start();
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];

    //Проверка авторизации
    $auth = is_auth();

    //Подключение к базе данных
    $db = connect_db();


    //Извлечение всех статей!
    $articles = articles_all($db);

    if (!$articles){
        echo 'Возникла ошибка!';
        exit();
    }
    include_once ('v/v_index.php');
