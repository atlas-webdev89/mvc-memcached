<?php

namespace Model;

class IndexModel extends \Core\Model\MainModel{
    
    protected $driver;

    public function __construct($driver) {
        $this->driver = $driver;
    }
    
    public function getPosts () {
            $type = 'arraydata';
            $sql = "select * from wp_posts";
            $result =  $this->driver->query($sql, $type);
        return $result;
    }
    
    public function getPages () {
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
