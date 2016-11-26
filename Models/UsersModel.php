<?php

namespace Models;

class UsersModel extends BaseModel

{
	
	public static $instance;

    public static function Instance()
    {
        if (self::$instance == null){
            self::$instance = new ArticleModel();
        }

        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();

        $this->table = 'users';
        $this->pk = 'id_user';
    }


    public function GetByLogin($login)
    {
    	// !!!!Защита от sql-инъекции

    	$res  = $this->pdo->query( "SELECT * FROM {$this->table} WHERE login = '$login'");
         
        return $res ? $res[0] : false;
    }



	
}
	







