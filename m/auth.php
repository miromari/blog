<?php

// Проверка авторизации
function is_auth()
{
   
    if (!isset($_SESSION['auth'])){
        
        if ($_COOKIE['login'] == 'admin' || $_COOKIE['password'] == md5('qwerty')){
                $_SESSION['auth'] = true;
            }
        else {
            return false;
            }
        }
    return true;

}



//----------
//Для проверки - пока здесь
function my_print_r($array)
{   
    echo '<pre>';
    echo print_r($array);
    echo '</pre>';
}
