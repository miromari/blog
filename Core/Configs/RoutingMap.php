<?php
return 
[
	'/'=> 
	[
		'controller' => 'Controllers\ArticleController',
		'action' => 'indexAction',
	],
	'/article/int'=> 
	[
		'controller' => 'Controllers\ArticleController',
		'action' => 'oneAction',
		'params' => [
			'int' => 'id'
		]
	],
	'/article/add'=> 
	[
		'controller' => 'Controllers\ArticleController',
		'action' => 'addAction',
	],
	'/article/edit/int'=> 
	[
		'controller' => 'Controllers\ArticleController',
		'action' => 'editAction',
		'params' => [
			'int' => 'id'
		]
	],
	'/article/delete/int'=> 
	[
		'controller' => 'Controllers\ArticleController',
		'action' => 'deleteAction',
		'params' => [
			'int' => 'id'
		]
	],			
	'default'=> 
	[
		'controller' => 'Controllers\BaseController',
		'action' => 'get404',
	],
	'/login'=> 
	[
		'controller' => 'Controllers\UsersController',
		'action' => 'loginAction',
	],	
	'/logout'=> 
	[
		'controller' => 'Controllers\UsersController',
		'action' => 'logoutAction',
	],
];

