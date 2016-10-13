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

    $id_article = (int)$_GET['id'];
    $error = [];
    $db_error = '';

    $mArticle = new ArticleModel();
    
    if(count($_POST) > 0){
 
        //если нажали кнопку "Сохранить"
        if (isset($_POST['save'])) {

            //Обработка полей
            $title = trim (htmlspecialchars ($_POST['title']));
            $content = trim (htmlspecialchars ($_POST['content']));

        //Валидация полей
            $error = $mArticle->validate($title, $content);

        //если ошибок нет
            if (empty($error)){
                 if($mArticle->edit($id_article, $title, $content)){
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
                
                if ($mArticle->delete($id_article)){
                    header ("Location: index.php");
                    exit();
                }
                else{
                    $db_error =  'Произошла ошибка - попробуйте снова!';  
                }

            } 
            else{
                $db_error =  'Такой статьи не существует!';
            }
        }
    }
    // Пришли через GET -нужно заполнить формы

    else{ 
//  Проверка, что GET число
        if($id_article > 0){


            $article = $mArticle->get($id_article);

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

