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
							$this->errors[$name] = 'Поле не должно быть пустым';
							
						}
					} 
				}
			}

			if ($k === 'min_length'){
				foreach ($this->fields as $name => $value){
					if (isset($rule[$name]) && mb_strlen($value) > 0 && mb_strlen($value) < $rule[$name]){	
						$this->errors[$name] = 'Поле должно содержать более ' . $rule[$name] . ' символов' ;
					}
				}
			}

			if ($k === 'max_length'){
				foreach ($this->fields as $name => $value){
					if (isset($rule[$name]) && mb_strlen($value) > $rule[$name]){
						$this->errors[$name] = 'Поле не должно превышать ' . $rule[$name] . ' символов';
					}
				}
			}
		}

		if (!empty($this->errors)){
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