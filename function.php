<?php

// Проверка авторизации
function is_auth(){
   
    if (!isset($_SESSION['auth'])){
        
        if ($_COOKIE['login'] == 'admin' || $_COOKIE['password'] == md5('qwerty')){
                $_SESSION['auth'] = true;
            }
        else {
            return false;
            }
        }
    else
        return true;

}


// clean

// validate


//----------
//Для проверки
function my_print_r($array)
{   
    echo '<pre>';
    echo print_r($array);
    echo '</pre>';
}
