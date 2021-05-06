<?php

namespace Controller;

use Core\Controller\DisplayController;

class IndexController extends DisplayController {

    public function __construct($container) {
       parent::__construct($container);
            $this->data->addModelController(__CLASS__);
    }
    
    public function execute() {
        ($this->data);
    }
    
    public function get_posts() {
        return $data = $this->data->query('getPosts', [],'cache');
    }
    
    public function get_pages($id) {
        return $data = $this->data->query('getPages', [$id], 'cache');
    }
}
