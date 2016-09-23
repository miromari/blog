<?php
	session_start(); 

    $login = '';
    $password = '';

	if(count($_POST) > 0){
        
       $login = $_POST['login'];
       $password = $_POST['password'];

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

include_once('v/v_login.php');