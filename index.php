<?php

include_once 'settings.php';
// function __autoload($classname)
// {
//     include_once str_replace("\\", DIRECTORY_SEPARATOR, $classname) . '.php';
// }



function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');

session_start();

$app = new Core\App(new Core\Request($_GET,$_POST,$_SERVER));

$app->go();  

