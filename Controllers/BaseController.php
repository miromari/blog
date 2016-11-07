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
	    header('HTTP/1.1 404 Page Not Found');
	    $this->content = $this->tmpGenerate('Views/v_404.php');
		$this->render();
		die;

	}

	public function render()
	{
		echo $this->tmpGenerate('Views/v_main.php',[
			    'title' => $this->title, 
                'content' => $this->content,
                'auth' => $this->auth
			]);
	}

	protected function tmpGenerate($path, Array $vars = [])
	{
		ob_start();
	    extract($vars);
	    include($path);
	    return ob_get_clean();
	}

	protected function getRedirect($url)
	{
		header ("Location: $url");
		die;
	}
}