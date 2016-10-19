<?php

namespace Models;

use Core\PDO;

abstract class BaseModel
{
    protected $pdo;
    protected $table;
    protected $pk;


    public function __construct()
    {
        $this->pdo = PDO::Instance();
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->pdo->prepare($sql);
        $res = $query->execute();

        if (!$res){
            $this->errorLog($query);
            return false;  
        }
        else{
            return $query->fetchAll();
        }
    }

    public function get($id)
    {

         $sql = "SELECT * FROM {$this->table} WHERE {$this->pk} = '$id'";
        $query = $this->pdo->prepare($sql);
        $res = $query->execute();
        
        if (!$res){
            $this->errorLog($query);
            return false;  
        }
        else{
            return $query->fetch();
        }

    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->pk} =:id";
        $params = ['id' => $id];
        $query = $this->pdo->prepare($sql);
        $res = $query->execute($params);

        if (!$res) {
            $this->errorLog($query);
            return false;
        }else{
            return true;
        }

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





