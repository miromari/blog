<?php


//функция для подключения базы данных
function connect_db()
{
    $db = new PDO('mysql:host=localhost;dbname=php1', 'root', 'root');
    $db->exec("SET NAMES UTF8");
    return $db;
}

//обработка ошибки работы с БД - запись в файл
function db_error_log($query)
{
    $info = $query->errorInfo();
    $log = '|' . date("Y-m-d H:i:s") .'|'.implode('|', $info);
    $log = $log .  "\n-------------------------------------------------------------------\n";
    file_put_contents('error.log',$log, FILE_APPEND);

}

