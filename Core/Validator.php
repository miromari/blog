<?php

namespace Core;

class Validator
{
	public $fields;
	public $errors;
	public $isValid;

	protected $entity;
	protected $rules;
	protected $map;
	
	public function __construct()
	{
		$this->map = include_once 'Configs/ValidationMap.php';
		$this->rules = false;
		$this->isValid = true;
		$this->errors = [];
	}

	public function loadRules($entity)
	{
		$this->entity = $entity;
		$this->rules = $this->map[$entity];
		$this->extractFields([]);

		return $this;
	}

	public function run(array $post)
	{
		$this->extractFields($post);

		$rules = $this->rules['rules'];
		foreach ($rules as $k => $rule){
			if ($k === 'not_empty'){
				foreach($this->fields as $name => $value){
					if (in_array($name, $rule)){
						if($value === '' || $value === null){
							$this->errors[$name] = 'not be empty';
						}
					} 
				}
			}

			if ($k == 'max_length'){

			}
		}

		if (!empty($this->error)){
			$this->isValid = false;
		}

		return $this;
	}

	private function extractFields(array $post)
	{
		foreach ($this->rules['fields'] as $field){
			if (!isset($post[$field]) || trim($post[$field]) === ''){
				$this->fields[$field] = null;
				continue;
			}

			$this->fields[$field] = htmlspecialchars(trim($post[$field]));
		}
	}
}