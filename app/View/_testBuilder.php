<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace view;

/**
 * Description of testBuilder
 *
 * @author prog
 */
class testBuilder extends AViewBuilder{
    public function __construct($params) {
        $all = explode('Builder',__CLASS__);
        $this->_name = $all[0];
        parent::__construct($this->_name, $params);
    }
}
