<?php

namespace Core\Controller;


abstract class MainController {
    
    public $data;
    
    public function __construct($container) {
        $this->data=$container['dataObject'];
    } 
}
