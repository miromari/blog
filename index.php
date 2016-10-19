<?php

function __autoload($classname)
{
    include_once str_replace("\\", DIRECTORY_SEPARATOR, $classname) . '.php';
}

include_once ('Models/system.php');

session_start();
$_SESSION['back'] = $_SERVER['REQUEST_URI'];

$app = new Core\App(new Core\Request($_GET,$_POST,$_SERVER));

$app->go();  