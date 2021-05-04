<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of Model
 *
 * @author doroshukdv
 */
class Model {
    
    protected $driver;
    
    public function __construct($driver) {
        $this->driver = $driver;     
    }
}
