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


function clean_field($field)
{
    $res = '';
    $res = trim ($field);
    $res = htmlspecialchars($res);
    return $res;
}

// function file_error($filename)
// {
//     $error = '';
//     //проверка на то, что название состоит из цифр
//     if (!ctype_digit($title)){
//         $error = 'Название должно содержать только цифры!';
//     }
//     //проверка на то, что название уникально в случае, если оно изменено
//     elseif ($title != $fname && file_exists("data/$title") ){
//         $error = 'Такое название уже есть!';
//     }



// }


//----------
//Для проверки
function my_print_r($array)
{   
    echo '<pre>';
    echo print_r($array);
    echo '</pre>';
}
