<?php

    include_once ('m/system.php');
    include_once ('m/auth.php');
    include_once ('m/DB.php');
    include_once ('m/BaseModel.php');
    include_once ('m/ArticleModel.php');

    session_start();
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];

    //Проверка авторизации
    $auth = is_auth();

    //Извлечение всех статей
    $mArticle = ArticleModel::Instance();
    $articles = $mArticle->all();

    if (!$articles){
        $content = 'Возникла ошибка!';
    }   
    else{
    //Создание шаблона
    $content = template('v/v_index.php',[
                        'articles' => $articles         
                ]);

    }
    $html = template('v/v_main.php',[
                    'title' => 'Главная страница', 
                    'content' => $content,
                    'auth' => $auth
                ]);

    echo $html;

