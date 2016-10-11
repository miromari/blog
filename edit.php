<?php
 
    include_once ('m/system.php');
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

//Подключение к базе данных
    $db = connect_db(); 

    $id_article = (int)$_GET['id'];
    $error = [];
    $db_error = '';


    if(count($_POST) > 0){
 
        //если нажали кнопку "Сохранить"
        if (isset($_POST['save'])) {

            //Обработка полей
            $title = trim (htmlspecialchars ($_POST['title']));
            $content = trim (htmlspecialchars ($_POST['content']));

        //Валидация полей
            $error = validate($title, $content);

        //если ошибок нет
            if (empty($error)){
                 if(article_edit($id_article, $title, $content, $db)){
                    header ("Location: article.php?id=$id_article");
                    exit();
                 }     
                else{                  
                    $db_error = 'Произошла ошибка - попробуйте снова!';  
                }
            }

        }
        
    //Если нажали кнопку "Удалить"
        elseif (isset($_POST['delete'])) {

            if ($id_article > 0){
                
                if (article_delete($id_article, $db)){
                    header ("Location: index.php");
                    exit();
                }
                else{
                    $error =  'Произошла ошибка - попробуйте снова!';  
                }

            } 
            else{
                $error =  'Такой статьи не существует!';
            }
        }
    }
    // Пришли через GET -нужно заполнить формы

    else{ 
//  Проверка, что GET число
        if($id_article > 0){


            $article = article_get($id_article, $db);

            //Если  статьи не существует
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
    }

//Создание шаблона
    $content = template('v/v_edit.php',[
                        'id_article' => $id_article, 
                        'title' => $title, 
                        'content' => $content,  
                        'error' => $error,  
                        'db_error' => $db_error
                ]);


    $html = template('v/v_main.php',[
                    'title' => 'Редактирование новости', 
                    'content' => $content,  
                    'auth' => $auth
                ]);

    echo $html;

