<?php

namespace Models;

use Core\PDO;

class ArticleModel extends BaseModel
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

        $this->table = 'articles';
        $this->pk = 'id_article';
    }

    //Валидация полей, поиск ошибок
    public function validate($title, $content)

    {
        $error = [];

        if ($title == ''){
            $error['title'] = 'Поле не должно быть пустым!';
        }
        elseif (mb_strlen($title) < 5){
            $error['title']  = 'Слишком короткое название!';
        }

        elseif (mb_strlen($title) > 150){
             $error['title'] = 'Название не должно превышать 150 символов!';
        }

        if ($content == '' ){
            $error['content'] = 'Поле не должно быть пустым!';
        }
        elseif (mb_strlen($content) < 10){
            $error['content']  = 'Минимальная длина текста - 100 символов!';
        }

        elseif (mb_strlen($content) > 65535){
             $error['content'] = 'Текст не должен превышать 65535 символов!';
        }
        
        return $error;
    }
}


    