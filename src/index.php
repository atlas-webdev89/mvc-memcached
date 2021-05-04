<?php

//Уровень логирования
error_reporting(E_ALL);
//Вывод ошибок
ini_set('display_errors', 1);
//Ошибки при старте php 
ini_set('display_startup_errors', 1);
//Включение лога ошибок и указания файла для записи.
ini_set('log_errors', 'On');
ini_set('error_log', '/var/log/php/php_errors.log');

//Composer Autoload
require_once 'vendor/autoload.php';
//Данные подключений к БД и Memcached
require_once 'config/config.php';

//Время выполнения скрипка и значение потребляемой памяти
//\Library\Timer::start();


\Library\UsageMemory::start();

try{
    $time_load_page = \Library\Timer::getInstanse('start');
    $connect_object = \Core\ConnectDB::getInstance(['host' => HOST, 'dbname'=>DBNAME, 'user'=>USER, 'password' => PASSWORD]);
    $connect = $connect_object->getConnect();
    
    //Драйвер для работы с mysql
    $driver = new \Core\DriverDB ($connect);
    //Модель
    $model = new \Model\Model($driver);
} 
catch (\Exception $e) {
    echo $e->getMessage();
} 





for ($i = 0; $i < 2000000; $i++) {
    $array[] = rand(0, 1000000);
}
$sql = "select * from wp_posts";
$driver->query($sql, 'arraydata');
$driver->query($sql, 'count');


//Количество запросов в БД, время генерации страницы и потребляемая память
echo "Количество запросов к БД - ".$driver->getCountQuery()."<br>";
echo $time_load_page->finish()." сек<br>";
echo "Потребляемая память - ". \Library\UsageMemory::finish_memory()."<br>";
echo "<br>";
echo (\Library\UsageMemory::finish_peak_memory())." байт <br>";


echo $driver->getTimeQuery()."<br>";
print_r($driver->getArraySql());
