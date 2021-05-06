<?php

namespace Core\Drivers;

class Data {
    protected $memcached;
    protected $model;
    protected $connectDB;
    protected $driverDB;
    protected $controller;


    public function __construct () {
        $this->getConnectMysql();
        $this->getDriverDB();
        $this->getMemcached();
        
    }
    
    
    protected function getMemcached () {
        if(defined('MEMCACHED')) 
            {
                //Memcached
                $memcached = \Core\Connect\ConnectMemcached::getInstance(MEMCACHED);
                $this->memcached = $memcached->getMemcached();
            }
    }
    
    protected function getDriverDB () {
        $this->driverDB = new \Core\Drivers\DriverDB ($this->connectDB);
    }

    protected function getConnectMysql () {
        $connect_object = \Core\Connect\ConnectDB::getInstance(['host' => HOST, 'dbname'=>DBNAME, 'user'=>USER, 'password' => PASSWORD]);
        $this->connectDB = $connect_object->getConnect();
    }
    
    public function addModelController ($controller) {
                if(isset($controller) && !empty($controller)) {
                    $this->controller = $controller;
                }else {
                    throw new \Exception("Not set Controller");
                }
                
                $a = (new \ReflectionClass($controller));
                $name_controller = str_replace('Controller', '', $a->getShortName());
                $class_model = "\Model\\".$name_controller."Model";
                
                if($this->model instanceof $class_model){
                    return $this->model;
                }
                
                if(class_exists($class_model)){
                    $this->model = new $class_model($this->driverDB);
                }else {
                    throw new \Exception("Not Found Class ".$class_model);
                }
    }
    
    public function query($query, array $params =null, $cache ='') {
        if($cache != '' && $cache == 'cache') {
            echo "KEY".md5($query.$this->controller);
        }
        
        return $this->model->$query($params);
    }
    
   
    
    
}
