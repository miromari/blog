<?php

namespace Controllers;

use Core\Tmp;
use Core\Request;
use Models\UsersModel;

class BaseController
{
	
	protected $title;
	protected $content;
	protected $auth;
	protected $request;

	public function __construct(Request $request)
	{
		$this->title = 'Maria\'s blog';
		$this->auth = UsersModel::isAuth();
		$this->request = $request;

	}

	public function get404()
	{
	    header ('HTTP/1.1 404 Page Not Found');
	    $this->content = Tmp::generate('Views/v_404.php');
		$this->render();
		die;
	}

	public function render()
	{
		echo Tmp::generate('Views/v_main.php',[
			    'title' => $this->title, 
                'content' => $this->content,
                'auth' => $this->auth
			]);
	}
}