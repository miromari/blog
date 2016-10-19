<?php

namespace Core;

class Users

{
	// Проверка авторизации
	public static function isAuth()
	{
	   
	    if (!isset($_SESSION['auth'])){
	        
	        if (isset($_COOKIE['login']) && isset ($_COOKIE['password']) && $_COOKIE['login'] == 'admin' && $_COOKIE['password'] == md5('qwerty')){
	            $_SESSION['auth'] = true;
	            }

	        else {
	            return false;
	            }
	        }
	    return true;
	}
}
	







