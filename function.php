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


//функция для подключения базы данных
function connect_db()
{
    $db = new PDO('mysql:host=localhost;dbname=php1', 'root', 'root');
    $db->exec("SET NAMES UTF8");
    return $db;
}



//----------
//Для проверки
function my_print_r($array)
{   
    echo '<pre>';
    echo print_r($array);
    echo '</pre>';
}
