<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace exception;

/**
 * Description of ModalException
 *
 * @author prog
 */
class ModalException extends \Exception{
    private $_title;
    private $_msg;
    
    public function __construct($_title, $message) {
        parent::__construct($message, $code, $previous);
        $this->_title = $_title;
        $this->_msg = $message;
        echo 'modal exception';
        //die();
    }
    
    public function getMessage(){
        return $this->_msg;
    }

    
}
