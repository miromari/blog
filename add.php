<?php

    include_once ('m/system.php');
    include_once ('m/auth.php');
    include_once ('m/DB.php');
    include_once ('m/BaseModel.php');
    include_once ('m/ArticleModel.php');

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
        $mArticle = ArticleModel::Instance();
        $error = $mArticle->validate($title, $content);
     
    //если ошибок нет
        if (empty($error)){
            
            $id_article = $mArticle->add($title, $content);
            if ($id_article){
                header ("Location: article.php?id=$id_article");
                exit();
            }
            else{
                $db_error = 'Произошла ошибка - попробуйте снова!';
            }
        }
    }
        

//Создание шаблона
    $content = template('v/v_add.php',[
                        'title' => $title, 
                        'content' => $content,
                        'error' => $error,  
                        'db_error' => $db_error
                ]);

    
    $html = template('v/v_main.php',[
                    'title' => 'Добавление новости', 
                    'content' => $content,
                    'auth' => $auth

                ]);

    echo $html;

