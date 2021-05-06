<?php

namespace Core\BootLoader;

class Bootstrap {
   static public function registerFabrica () {
        //DI Dependency Injection 
        $container = new \Pimple\Container();        
                //Данные для подключения к базе данных
                $container['db'] = [
                            'host' =>       HOST,
                            'dbname' =>     DBNAME,
                            'user' =>       USER,
                            'password' =>   PASSWORD    
                ];
                
                //Данные для Memcached
                $container['memcache'] = MEMCACHED;
                //Корень приложения
                $container['document_root'] = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

                //Register dataBase connection (PDO) Singleton
                $container['pdo'] = function ($container) {
                        $connect = \Core\Connect\ConnectDB::getInstance($container ['db']);
                    return $connect->getConnect();
                };
                //Driver DB
                $container ['driverDB'] = function ($container) {
                    return new \Core\Drivers\DriverDB($container['pdo']);
                };
                
                //memcahced
                $container ['driverMemcached'] = function ($container) {
                        $obj = \Core\Connect\ConnectMemcached::getInstance($container['memcache']);
                    return $obj->getMemcached();
                };
                
                //Объект для работы с данными 
                $container['dataObject']=function ($container) {
                    return new \Core\Drivers\Data($container); 
                };
        return $container;
    }
}
