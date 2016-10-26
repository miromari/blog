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
				'login' => [5],
				'password' => [8]
			],
			'max_length' => [
				'login' => [20],
				'password' => [20]
			]
		]
	]
];

