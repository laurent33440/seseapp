<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Version;
//use Bootstrap;

/**
 * Description of LicenseController : show license 
 * depends on welcome controller
 * @author laurent
 */
class AboutController extends AControllerState{
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
    }
    
    public function run() {
        try{
            switch ($this->_state){ 
                case self::IDLE :
                    $this->_state = self::RUNNING;
                    $this->sendModelView();  
                    break;
                case self::RUNNING:
                        $this->sendModelView();
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
    
    public function buildBodyView(array $a=null){
        $formArray['INDEX'] = '/';
        $this->_modelView['body'] = $formArray;
    }
    

}

?>
