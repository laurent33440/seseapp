<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of CreateDataBaseController
 *
 * @author laurent
 */
class CreateDataBaseController extends AControllerState{
    
    public function __construct(RequestHandler $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    public function run() {
        try{
            $this->_model = new AccessDataBase();
            Logger::getInstance()->logInfo( get_class($this).' computing this state : '.$this->_state);
            switch ($this->_state){
                case self::IDLE :
                    $this->showModelView(null);
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isPost()){
                        $this->computePostData($this->_request->consumePostRequest());
                        $logic=new CreateDataBaseModel($this->_model);
                        $logic->createDataBase();
                        $this->_state= self::STOPPED;
                    }else{//else repost?
                        $this->showModelView(null);
                    }
                    break;
                case self::STOPPED:
                    $this->showModelView(null); //FIXME : retrieve model's datas if any
                    $this->_state = self::RUNNING;
                    break;
                case self::TERMINATED:
                    break;
                case self::ON_INPUT_ERROR:
                    $this->showModelView(array('TITLE'=>'Erreur d\'accés à la base de données', 
                                        'MESSAGE' => 'Vérifiez les informations entrées dans le formulaire'));
                    $this->_state= self::RUNNING;
                    break;
                default :
                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
            }
        }catch (Exception $e){
            $this->_state = self::ON_INPUT_ERROR;
            $this->_error = $e;
            if (!($e instanceof DataBaseException)){
//                throw new InternalException($e->getMessage());
            }else{
                $this->showModelView(array('TITLE'=>'Erreur d\'accés à la base de données', 
                                    'MESSAGE' => 'Vérifiez les informations entrées dans le formulaire'));
            }
        }
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    private function showModelView( $modalParameters){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->getRootPath();
        $this->_modelView = array(
                            'header' => array('VERSION'=>Version::getVersion(),
                                              'CURRENT_STEP_NUMBER' => $this->_sequenceState->getCurrentStateNumber(), 'STEP_NUMBER' => $this->_sequenceState->getStatesNumber(),
                                              'BACK_BUTTON'=>'false', 'FORWARD_BUTTON'=>'true',
                                              'PREVIOUS_URI' => $this->getRootPath().'/previous', 'NEXT_URI'=> $this->getRootPath().'/next'),
                            'body' => $formArray);
        if($modalParameters){
            $footer =  array('URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL'=>'true', 'MODAL_TITLE' => $modalParameters['TITLE'], 'MODAL_MESSAGE' => $modalParameters['MESSAGE']);
        }else{
            $footer = array('URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL' => 'false' );
        }
        $this->_modelView['footer'] = $footer;
        $this->_viewHandler = new ViewHandler($this->getControllerName(), $this->_modelView);
        $this->_viewHandler->display();
    }
     
    
}

?>
