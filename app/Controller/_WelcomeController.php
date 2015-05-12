<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

use Symfony\Component\HttpFoundation\Request;
use SequenceState;
use Version;
use Kernel;
use exception\InternalException;

/**
 * Description of WelcomeController
 *
 * @author laurent
 */
class WelcomeController extends AControllerState{
    
    public function __construct(Request $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    public function run(){
        try{
            switch ($this->_state){
                case self::IDLE :
                    $this->showModelView($modalParams=null);
                    $this->_state = self::RUNNING;  
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                    //check agreed license
                        if(array_key_exists("read", $this->_request->request->all())){
                            $this->_state= self::TERMINATED;
                        }
                    }else{ //repost
                        $this->showModelView(null);
                    }
                    break;
                case self::STOPPED:
                    break;
                case self::TERMINATED:
                    $this->_state = self::IDLE;
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
    
    public function __destruct() {
        parent::__destruct();
    }
    
    private function showModelView( $modalParams){
        $index = $this->getRootPath();
        $this->_modelView = array(
                            'header' => array('VERSION'=>Version::getVersion()),
                            'body' => array('INDEX'=>$index, 'URI_LICENSE'=>$index.'/license'),
                            'footer' => array('URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL' => 'false' )
                        );
        //$this->_viewHandler = new ViewHandler($this->getControllerName(), $this->_modelView);
        //$this->_viewHandler->display();
        $this->response();
    }
    
}

?>
