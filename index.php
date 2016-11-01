<?php

include_once 'settings.php';
function __autoload($classname)
{
    include_once str_replace("\\", DIRECTORY_SEPARATOR, $classname) . '.php';
}

session_start();

$app = new Core\App(new Core\Request($_GET,$_POST,$_SERVER));

try{
	$app->go();  	
}
catch(Exception $e){

echo '<pre>';
var_dump($e);
}
