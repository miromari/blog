<?php


abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $pk;


    public function __construct()
    {
        $this->db = DB::Instance();
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->db->prepare($sql);
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
        $query = $this->db->prepare($sql);
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
        $query = $this->db->prepare($sql);
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





