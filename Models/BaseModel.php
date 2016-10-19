<?php

namespace Models;

use Core\SQL;

abstract class BaseModel
{
    protected $pdo;
    protected $table;
    protected $pk;


    public function __construct()
    {
        $this->pdo = SQL::Instance();
    }

    public function all()
    {
        return $this->pdo->query("SELECT * FROM {$this->table}");
    }

    public function get($id)
    {

         $res  = $this->pdo->query( "SELECT * FROM {$this->table} WHERE {$this->pk} = '$id'");
         
        return $res ? $res[0] : false;

    }

    public function delete($id)
    {    
        return $this->pdo->delete($this->table, "$this->pk = '$id'");
    }

    // $object  - [key1 => 'value1', key2 => 'value2']
    public function add($object)
    {
        return $this->pdo->insert($this->table, $object);
    }
    
    public function edit($id, $object)
    {
        return $this->pdo->update($this->table, $object, "$this->pk = '$id'");
    }












    //обработка ошибки работы с БД - запись в файл
    protected function errorLog($query)
    {
        $info = $query->errorInfo();
        $log = '|' . date("Y-m-d H:i:s") .'|'.implode('|', $info);
        $log = $log .  "\n-------------------------------------------------------------------\n";
        file_put_contents('error.log',$log, FILE_APPEND);

    }


}





