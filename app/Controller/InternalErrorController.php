<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Bootstrap;
use Version;
use Logger;

/**
 * Description of InternalErrorController : 
 * Display application errors 
 * Redirect to 'home' 
 *
 * @author laurent
 */
class InternalErrorController extends AControllerState{
    private $_messageError;
    
    public function __construct($messageError) {
        try{
            $this->_messageError = $messageError;
            $this->sendModelView();
        }catch (\Exception $e){
            $this->_state = self::ON_CRITICAL_ERROR;
            $this->_error = $e->getTrace();
            $result = 'Exception: "';
            $result .= $e->getMessage();
            $result .= '" @ ';
            if($this->_error[0]['class'] != '') {
              $result .= $this->_error[0]['class'];
              $result .= '->';
            }
            $result .= $this->_error[0]['function'];
            $result .= '();';
            Logger::getInstance()->logFatal(__CLASS__.$result);
            throw $e;
        }
    }
    
    public function buildModelView() {
        $url = $this->getRootPath();
        $this->_modelView = array(
                            'header' => array('VERSION'=>Version::getVersion()),
                            'body' => array('MESSAGE'=>  $this->_messageError,'INDEX'=>$url),
                            'footer' => array("URI_COMPANY"=> \Bootstrap::COMPANY_URI , 'SHOW_MODAL' => 'false' )
                        );
        
    }
}

?>
