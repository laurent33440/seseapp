<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

use exception\InternalException;

/**
 * Description of TestjAjaxController
 *
 * @author laurent
 */
class TestAjaxController extends AControllerState{
    public function __construct(RequestHandler $request, SequenceState $sequenceState) {
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
                    if($this->_request->isPost()){
                        $postData = $this->_request->consumePostRequest();
                        if(array_key_exists('ajax', $postData)){
                            //echo __CLASS__.'--> ajax ok <-- ';
//                            $send='server_ok';
//                            
                            $send = json_encode(array("value"=>"server ok"));
                            echo $send;
                        }else{
                            if(array_key_exists('tiny_mce_content', $postData)){
                                echo $postData['tiny_mce_content'];
                                die();
                            }
                        }
                    }else{ 
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
                            'footer' => array('INDEX'=>$index, 'URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL' => 'false' )
                        );
        $this->_viewHandler = new ViewHandler($this->getControllerName(), $this->_modelView);
        $this->_viewHandler->display();
    }
    
}
