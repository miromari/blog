<?php
return 
[
	'login_form' => [
		
		'fields' =>[
			'login','password'
		],
		
		'rules' => [
			'not_empty' => [
				'login','password'
			],
			'min_length' => [
				'login' => 5,
				'password' => 6
			],
			'max_length' => [
				'login' => 20,
				'password' => 20
			]
		]
	],

	'article_form' => [
		
		'fields' =>[
			'title','content'
		],
		
		'rules' => [
			'not_empty' => [
				'title','content'
			],
			'min_length' => [
				'title' => 5,
				'content' => 10
			],
			'max_length' => [
				'title' => 150,
				'content' => 65535
			]
		]
	]
];
