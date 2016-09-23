<?php


    include_once ('m/auth.php');
    include_once ('m/pdo.php');
    include_once ('m/articles.php');

    session_start();
    //запомнить url текущей страницы для потенциального редиректа после авторизации
    $_SESSION['back'] = $_SERVER['REQUEST_URI'];

    //Проверка авторизации
    $auth = is_auth();
    if (!$auth){
        header('Location: login.php');
        exit(); 
    }

    $error = [];
    $db_error = '';
    $title = '';
    $content = '';

    if(count($_POST) > 0){

    //Обработка полей
        $title = trim (htmlspecialchars ($_POST['title']));
        $content = trim (htmlspecialchars ($_POST['content']));

    //Валидация полей
        $error = validate($title, $content);
     
    //если ошибок нет
        if (empty($error)){
            
            //Подключение к базе данных
            $db = connect_db();

            $id_article = article_add($title, $content, $db);
            if ($id_article){
                header ("Location: article.php?id=$id_article");
                exit();
            }
            else{
                $db_error = 'Произошла ошибка - попробуйте снова!';
            }
        }
    }
        

    include_once('v/v_add.php');

