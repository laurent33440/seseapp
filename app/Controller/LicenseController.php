<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

use Symfony\Component\HttpFoundation\Request;
use Version;
use Bootstrap;

/**
 * Description of LicenseController : show license 
 * depends on welcome controller
 * @author laurent
 */
class LicenseController extends AControllerState{
    
    public function __construct(Request $request) {
        parent::__construct($request);
    }
    
    public function run() {
        try{
            switch ($this->_state){ // FIXME : uses state of Welcome controller that is Licence controller is sub state
                case self::IDLE :
                    $this->_state = self::RUNNING;
                    $this->sendModelView();  
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(array_key_exists("read", $this->_request->request->all())){
                            $this->_state= self::TERMINATED;
                        }
                    }else{//repost
                        $this->sendModelView();
                    }
                    break;
                case self::STOPPED:
                    break;
                case self::TERMINATED:
                    break;
                case self::ON_INPUT_ERROR:
                    break;
                default :
                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
            }
        }catch (Exception $e){
            $this->_state = self::ON_CRITICAL_ERROR;
            $this->_error = $e;
            throw $e;
        }
    }
    
//    public function __destruct() {
//       parent::__destruct();
//    }
    
    public function buildModelView(){
        $index = $this->getRootPath();
        $this->_modelView = array(
                            'header' => array('VERSION'=>Version::getVersion()),
                            'body' => array('INDEX'=>$index),
                            'footer' => array("URI_COMPANY"=> \Bootstrap::COMPANY_URI, 'SHOW_MODAL' => 'false')
                        );
    }

}

?>
