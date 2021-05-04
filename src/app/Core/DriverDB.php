<?php

namespace Core;

class DriverDB {
    
    protected static $db;
    
    protected $count_sql =0;
    protected $time_query = 0;
    
    protected $object_time;
    protected $array = [];

    public function __construct($pdo) {
        if (isset ($pdo)){
            self::$db = $pdo;
        }else 
            throw new \PDOException ("Нет подключения к БД");
    }
    
    //Функция получения количества запросов к БД
    public function getCountQuery () {
        return $this->count_sql;
    }
    
    //Функция получения времени выполнения sql запросов
    public function getTimeQuery () {
        return $this->time_query;
    }

    public function query ($sql, $type, array $data = NULL){ 
        
        $this->count_sql++;
        $this->object_time=\Library\Timer::getInstanse('start');
        
        switch ($type){
            case 'arraydata':                
                    $row =  self::$db->prepare($sql);
                    $row->execute($data);
                    
                    $this->er($sql);
                    
                return $row->fetchAll();
                break;
            case 'count':                
                    $row =  self::$db->prepare($sql);
                    $row->execute($data);
                    $this->er($sql);
                return $row->rowCount();
                break;
            case 'insert':
                    $row = self::$db->prepare($sql);
                    $row->execute($data);
                return self::$db->lastInsertId();
                break;
        }
        
       
    }
    
    protected function er ($sql) {
        $this->array[][$sql] = $this->object_time->finish();
            $this->time_query +=$this->object_time->finish();
    }
    
    public function getArraySql () {
        return $this->array;
    }
}