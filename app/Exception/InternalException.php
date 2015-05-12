<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exception;

use Controller\InternalErrorController;

/**
 * Description of internalException
 *
 * @author laurent
 */
class InternalException extends \Exception{
     
     public function __construct($msg) {
        parent::__construct($msg);
        \Logger::getInstance()->logFatal(__CLASS__.'Internal exception message : '.$msg);
        new InternalErrorController($msg);
    }
}

?>
