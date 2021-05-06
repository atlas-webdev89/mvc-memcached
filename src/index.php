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

\Library\UsageMemory::start();
$time_load_page = \Library\Timer::getInstanse('start');

//DI Dependency Injection 
$container = \Core\BootLoader\Bootstrap::registerFabrica();

for ($i = 0; $i < 2000000; $i++) {
    $array[] = rand(0, 1000000);
}

try{
        $re = new \Controller\IndexController($container);
        
        $data = $re->get_posts();
         $data = $re->get_posts();
          $data = $re->get_posts();
         
         $data = $re->get_pages(124);
          $data = $re->get_pages(124);
          $data = $re->get_pages(124);
    
}  catch (\Exception $e) {
        echo $e->getMessage();
}

//Количество запросов в БД, время генерации страницы и потребляемая память
echo "Количество запросов к БД - ".$container['driverDB']->getCountQuery()."<br>";
echo "Потребляемая память - ". \Library\UsageMemory::finish_memory()."<br>";
echo "максимальное значение памяти " .(\Library\UsageMemory::finish_peak_memory())." байт <br>";
//Время выполения всех sql запросов
echo "Время выполения всех sql запросов - ". $container['driverDB']->getTimeQuery()."<br>";
//Время генерации страницы
echo "Время генерации страницы - ".$time_load_page->finish()." сек<br>";