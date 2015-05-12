<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exception;

use Controller\InternalErrorController;

/**
 * Description of DataBaseException
 *
 * @author laurent
 */
class DataBaseException extends \Exception{
    private $_msg;
    
    public function __construct($msg) {
        $this->_msg = $msg;
        \Logger::getInstance()->logFatal(__CLASS__.$msg);
        new InternalErrorController($msg);
    }

}

?>
