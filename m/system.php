<?php

// Проверка авторизации
function template($path, $vars = [])
{
    ob_start();
    extract($vars);
    include($path);
    $res = ob_get_clean();
    return $res;
}



//----------
//Для проверки - пока здесь
function my_print_r($array)
{   
    echo '<pre>';
    echo print_r($array);
    echo '</pre>';
}
