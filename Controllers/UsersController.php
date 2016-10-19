<?php

namespace Controllers;

use Core\Tmp;
use Model\UsersModel;

class UsersController extends BaseController
{
	public function loginAction()
	{
		$login = '';
    	$password = '';
    

		if(count($this->request->getPost()) > 0){
        
       	$login = trim($this->request->getPost()['login']);
       	$password = trim($this->request->getPost()['password']);


	        if($login == 'admin' && $password == 'qwerty'){

	            $_SESSION['auth'] = true;

	            // если стоит галочка                       
	            if (isset( $this->request->getPost()['remember'])){
	                setcookie('login', $login, time() + 3600 * 24 * 7);
	                setcookie('password', md5($password), time() + 3600 * 24 * 7);
	            } 

	    		// Проверяем, что есть отметка, откуда мы пришли и перенаправляем туда, а если  нет, отправляем на главную страницу
	      		$location = isset($_SESSION['back']) ? $_SESSION['back'] : '/';
	            header("Location: $location");   
	            exit();
	        }
		 }
	    else{

	        unset($_SESSION['auth']);
	        setcookie('login', '', time()-1);
	        setcookie('password', '', time()-1);

	        // Если мы пришли на логин с нуля - удаляем старую отметку back
	         if (!isset($this->request->getServer()['HTTP_REFERER'])){
	            unset($_SESSION['back']);
	        }

	    }

		$this->content = Tmp::generate('Views/v_login.php', [
			  					'login' => $login, 
		                        'password' => $password
								]);
	}
}