<?php

namespace Core;

class App
{
	private $request;
	private $routs;

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->routs = include_once ROOT . '/Core/Configs/RoutingMap.php';
	}

	public function go()
	{
		$params = $this->getRoutByRequest();

		// echo '<pre>';
		// var_dump($params);
		// die;

		if(!$params){
			$params = $this->getRoutByParams('default');
		}
		$ctrl = new $params['controller']($this->request);

 		if ($this->request->rout != '/login'){
			$_SESSION['back'] = $_SERVER['REQUEST_URI'];
		}

		$action = $params['action'];
		$ctrl->$action();

 		$ctrl->render(); 

	}

	private function getRoutByRequest()
	{
		$routKit = explode('/', $this->request->rout);
		$routParams = false;
		
		foreach ($routKit as $num => $item){
			if (is_numeric($item)){
				$routParams = $item;
				$item = 'int';
			}

			$routKit[$num] = $item;
		}

		if(!$routParams){
			return isset($this->routs[$this->request->rout]) ? ($this->routs[$this->request->rout]) : false;
		}

		$routPattern = implode('/', $routKit);
		$routPatterns = [];

		foreach ($this->routs as $key => $value){
			if (stripos($key, 'int')){
				$routPatterns[] = $key;  
			}
		}

		if (!in_array($routPattern, $routPatterns)){
			return false;
		}

		$params = $this->routs[$routPattern];
		$this->request->setGet($params['params']['int'],$routParams);
		return $params;

	}
	private function getRoutByParams($rout)
	{
		return isset($this->routs[$rout]) ? $this->routs[$rout] : false;
	}

	
}
