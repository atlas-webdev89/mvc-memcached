<?php

namespace Core\Drivers;

class Data {
    protected $memcached;
    protected $model;
    protected $driverDB;
    protected $controller;

    public function __construct ($container) {
        $this->memcached = $container['driverMemcached'];
        $this->driverDB = $container['driverDB'];
       // $this->getMemcache();
    }

    
    public function getMemcache() {
       $obj = \Core\Connect\ConnectMemcached::getInstance(MEMCACHED);
                     $this->memcached = $obj->getMemcached();
    }
    //Получение объекта модели для текущего контроллера
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
    
    //Посредник для выполения запросов на получение данных
    public function query($query, array $params = null, $cache = '') {
            
        if($cache != '' && $cache == 'cache') {
                $key =  "KEY".md5($query.$this->controller);
                
                        $time_cache = \Library\Timer::getInstanse('start');
                            if($cash = $this->memcached->get($key)){
                                return $cash;
                            }
                        echo $time_cache->finish();

                        $data = $this->model->$query($params);
                   $this->memcached->set($key, $data);
                return $data;
            }
            
        return $this->model->$query($params);
    }
    
    //Запросы в БД без кеширования
    public function queryNoCache ($query, array $params =null) {
        return $this->model->$query($params);
    }
    
   
    
    
}
