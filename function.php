<?php

// Проверка авторизации
function is_loggedIn(){
   
    session_start();

    if (!isset($_SESSION['auth'])){
        
        if ($_COOKIE['login'] != 'admin' || $_COOKIE['password'] != 'qwerty') {
            
            header('Location: login.php');
            exit();       
        }
    }

}
