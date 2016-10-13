<?php


class DB
{
	private static $db;

	public static function Instance()
	{
		if (self::$db ==null){
			self::$db = self::get();
		}

		return self::$db;
	}
	private static function get()
	{
	    $db = new PDO('mysql:host=localhost;dbname=php1', 'root', 'root');
	    $db->exec("SET NAMES UTF8");
	    return $db;
	}	

}




