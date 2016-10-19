<?php

namespace Core;

class App
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function go()
	{
		$params = $this->getRoutByRequest();
		if(!$params){
			$params = $this->getRoutByParams('default');
		}
		$ctrl = new $params['controller']($this->request);
		$action = $params['action'];
 		if ($ctrl->$action() === false){
 			$ctrl = new \Controllers\PageController($this->request);
 			$ctrl->PageNotFoundAction();
 		}

 		$ctrl->render(); 

	}

	private function getRoutByRequest()
	{
		return isset($this->routs()[$this->request->rout]) ? $this->routs()[$this->request->rout] : false;
	}
	private function getRoutByParams($rout)
	{
		return isset($this->routs()[$rout]) ? $this->routs()[$rout] : false;
	}

	public function routs()
	{
		return [
			'/'=> [
				'controller' => 'Controllers\ArticleController',
				'action' => 'indexAction',
			],
			'/article'=> [
				'controller' => 'Controllers\ArticleController',
				'action' => 'oneAction',
			],
			'/add'=> [
				'controller' => 'Controllers\ArticleController',
				'action' => 'addAction',
			],
			'/edit'=> [
				'controller' => 'Controllers\ArticleController',
				'action' => 'editAction',
			],			
			'/delete'=> [
				'controller' => 'Controllers\ArticleController',
				'action' => 'deleteAction',
			],			
			'default'=> [
				'controller' => 'Controllers\BaseController',
				'action' => 'get404',
			],
			'/login'=> [
				'controller' => 'Controllers\UsersController',
				'action' => 'loginAction',
			],
		];
	}
}
