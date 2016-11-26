<?php

namespace Models;

use Core\PDO;

class SessionModel extends BaseModel
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

        $this->table = 'sessions';
        $this->pk = 'id_session';
    }

    
}


    