<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of Error404Controller
 *
 * @author prog
 */
class Error404Controller extends AControllerState{
    
    public function __construct(RequestHandler $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    public function run() {
        try{  
            switch ($this->_state){
                case self::IDLE :
                    $this->showModelView(null);
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isPost()){
                        if(array_key_exists("done", $this->_request->consumePostRequest())){
                            $sequenceState->resetState();
                            $this->_state= self::TERMINATED;
                        }
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
            $this->_state = self::ON_ERROR;
            $this->_error = $e;
            throw $e;
        }
    }
    
    private function showModelView( $modalParams){
        $index = $this->getRootPath();
        $this->_modelView = array(
                            'header' => array('VERSION'=>Version::getVersion()),
                            'body' => array('INDEX'=>$index),
                            'footer' => array("URI_COMPANY"=>  Kernel::COMPANY_URI)
                        );
        $this->_viewHandler = new ViewHandler($this->getControllerName(), $this->_modelView);
        $this->_viewHandler->display();
    }
}
