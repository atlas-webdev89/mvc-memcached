<?php

namespace Model;

class Model {
    
    protected $driver;
    protected $memcached;


    public function __construct($driver, $memcached = null) {
        $this->driver = $driver;     
        $this->memcached = $memcached;
    }
    
    public function getPosts () {
            $type = 'arraydata';
            $sql = "select * from wp_posts";
            
           
                $result =  $this->driver->query($sql, $type);
           
        return $result;
    }
    
    public function getPosts2 () {
            $type = 'arraydata';
            $sql = "select * from wp_posts";
            
            
                $result =  $this->driver->query($sql, $type);
          
        return $result;
    }
    
    public function addTerm ($name, $slug) {
        $type = 'insert';
        $sql = "";
        $sql = "INSERT INTO `wp_terms` (name, slug, term_group) VALUES (:name, :slug, :term_group)";
        $data_array=array(
                    'name'      => $name,
                    'slug'    => $slug,
                    'term_group' => '0',
                );
            $result =  $this->driver->query($sql, $type, $data_array);
        return $result;  
    }
}
