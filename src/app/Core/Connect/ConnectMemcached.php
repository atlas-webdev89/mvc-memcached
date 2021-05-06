<?php

namespace Core\Connect;

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
        
        $memcached = $this->createMemcacheServers($connect);
            
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
    
    //Создание пула серверов Memcached
    private function createMemcacheServers (array $cluster) {
            $memcached = new \Memcached();
            $memcached->setOption(\Memcached::OPT_DISTRIBUTION, \Memcached::DISTRIBUTION_CONSISTENT);
            $memcached->setOption(\Memcached::OPT_SERVER_FAILURE_LIMIT, 2);
            $memcached->setOption(\Memcached::OPT_REMOVE_FAILED_SERVERS, true);
            $memcached->setOption(\Memcached::OPT_TCP_NODELAY, false);
            $memcached->addServers($cluster);
        return $memcached;
    }
}
