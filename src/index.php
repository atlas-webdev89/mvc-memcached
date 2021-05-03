<?php

//Composer Autoload
require_once 'vendor/autoload.php';
//Данные подключений к БД и Memcached
require_once 'config/config.php';

try{
    $connect_object = \Core\ConnectDB::getInstance(['host' => HOST, 'db'=>DBNAME, 'user'=>USER, 'password' => PASSWORD]);
    $connect = $connect_object->getConnect();
} 
catch (\Exception $e) {
    echo $e->getMessage();
} 


ECHO HOST;