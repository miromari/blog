<?php

namespace Controllers;

use Core\Validator;
use Model\UsersModel;


class UsersController extends BaseController
{
	public function loginAction()
	{
		$location = isset($_SESSION['back']) ? $_SESSION['back'] : '/';

		if ($this->auth){
			$this->getRedirect($location);
		}

		$validator = new Validator();
		$validator->loadRules('login_form');  

		if($this->request->isPost()){
             		
       		$validator->run($this->request->getPost());

       		if ($validator->isValid){

		        if($validator->fields['login'] == 'admin' && $validator->fields['password'] == 'qwerty'){

		            $_SESSION['auth'] = true;

		            // если стоит галочка                       
		            if (isset( $this->request->getPost()['remember'])){
		                setcookie('login', $validator->fields['login'], time() + 3600 * 24 * 7);
		                setcookie('password', md5($validator->fields['password']), time() + 3600 * 24 * 7);
		            } 

					$this->getRedirect($location);
		        }
		    }    
		 }

		$this->content = $this->tmpGenerate('Views/v_login.php', [
	  					'login' => $validator->fields['login'], 
                        'password' => $validator->fields['password'],
                        'errors' => $validator->errors 
						]); 

	}	 
    
    public function logoutAction()
    {

        unset($_SESSION['auth']);
       	$this->auth = false;

        setcookie('login', '', time()-1);
        setcookie('password', '', time()-1);

        // Если мы пришли на логин с нуля - удаляем старую отметку back
         if (!isset($this->request->getServer()['HTTP_REFERER'])){
            unset($_SESSION['back']);
        }

        $this->getRedirect('/');

    }


	
}