<?php

namespace Core;

class ConnectMemcached {
    
    static protected $_instance;
    static protected $_memcached;
    
    protected function __construct($connect) {
        $this->connect($connect);
    }
    
    protected function connect($connect) {
        
        if(self::$_memcached instanceof \Memcached) {
            return self::$_memcached;
        }
        
        $memcached = new \Memcached();
        $memcached->addServer($connect['host'], $connect['port']);
            
        if($memcached instanceof \Memcached) {
                self::$_memcached = $memcached;
        }else {
                throw new \Exception("Not connection from memcached");
        }
    }

    static public function getInstance($connect) {
            if(self::$_instance === null){
                self::$_instance = new self($connect);
            }
        return self::$_instance;
        
    }
    public function getMemcached() {
        return self::$_memcached;
    }
}
