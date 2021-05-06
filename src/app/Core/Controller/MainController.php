<?php

namespace Core\Controller;


abstract class MainController {
    
    public $data;
    
    public function __construct() {
        $this->data=new \Core\Drivers\Data();
    } 
}
