<?php
    
    include_once ('m/system.php');
    include_once ('m/auth.php');
    include_once ('m/DB.php');
    include_once ('m/BaseModel.php');

    session_start(); 

    $login = '';
    $password = '';
    $auth = is_auth();

	if(count($_POST) > 0){
        
       $login = trim($_POST['login']);
       $password = trim($_POST['password']);


        if($login == 'admin' && $password == 'qwerty'){

            $_SESSION['auth'] = true;

            // если стоит галочка                       
            if (isset( $_POST['remember'])){
                setcookie('login', $login, time() + 3600 * 24 * 7);
                setcookie('password', md5($password), time() + 3600 * 24 * 7);
            } 

    // Проверяем, что есть отметка, откуда мы пришли и перенаправляем туда
            if (isset($_SESSION['back'])){
                $back = $_SESSION['back'];
                header("Location: $back");  
            }
            // если отметки нет, отправляем на главную страницу
            else{
                header('Location: index.php');   
            }
            exit();
            }
    }
    else{

        unset($_SESSION['auth']);
        setcookie('login', '', time()-1);
        setcookie('password', '', time()-1);

        // Если мы пришли на логин с нуля - удаляем старую отметку back
         if (!isset($_SERVER['HTTP_REFERER'])){
            unset($_SESSION['back']);
        }

    }

//Создание шаблона
    $content = template('v/v_login.php',[
                        'login' => $login, 
                        'password' => $password

                ]);


    $html = template('v/v_main.php',[
                    'title' => 'Авторизация', 
                    'content' => $content,  
                    'auth' => $auth
                ]);

    echo $html;