<?php

    include_once ('m/system.php');
    include_once ('m/auth.php');
    include_once ('m/pdo.php');
    include_once ('m/articles.php');


    session_start();
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];

    //Проверка авторизации
    $auth = is_auth();

    //Подключение к базе данных
    $db = connect_db();


    //Извлечение всех статей
    $articles = articles_all($db);

    if ($articles === false){
        echo 'Возникла ошибка!';
    }
    elseif ($articles  == []){
        echo 'Нет новостей для отображения';
    }
   
    //Создание шаблона
    $content = template('v/v_index.php',[
                        'articles' => $articles 
                        
                ]);

    
    $html = template('v/v_main.php',[
                    'title' => 'Главная страница', 
                    'content' => $content,
                    'auth' => $auth
                ]);

    echo $html;

