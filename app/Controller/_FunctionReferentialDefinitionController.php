<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of FunctionReferentialDefinitionController
 *
 * @author prog
 */
class FunctionReferentialDefinitionController extends AControllerState{
    private $_BUTTONS_NAMES = array('BUTTON_ADD_NAME' => 'ButtonSubmitAddFunction', 'BUTTON_DEL_NAME' => 'ButtonSubmitDelFunction');
   
    
    public function __construct(RequestHandler $request, SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    
    public function run() {
        try{
            $this->_model = new FunctionReferentialDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->set_descriptions('');//force new input on form
                    $this->showModelView(null);
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isPost()){
                        if($this->compute($this->_request->consumePostRequest()) == true){
                            $this->_model->getFunctionsFromDataBase();
                            $this->_model->set_descriptions('');//add new input on form
                            $this->showModelView(null);
                            $this->_state = self::RUNNING;
                        }else{
                            $this->_state = self::STOPPED;
                        }
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getFunctionsFromDataBase(); // retrieve datas 
                    $this->_model->set_descriptions('');//force new input on form
                    $this->showModelView(null);
                    $this->_state = self::RUNNING;
                    break;
                case self::TERMINATED:
                    break;
                case self::ON_INPUT_ERROR:
                    break;
                default :
                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
            }
        }catch (Exception $e){
            $this->_state = self::ON_INPUT_ERROR;
            $this->_error = $e;
            if (!($e instanceof DataBaseException)){
                throw new InternalException($e->getMessage());
            }else{
                $this->showModelView(array('TITLE'=>'Erreur d\'accés à la base de données', 'MESSAGE' => 'Vérifiez les informations entrées dans le formulaire'));
            }
        }
    }
    
    private function showModelView($modalParameters){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->getRootPath();
        foreach ($this->_BUTTONS_NAMES as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->_modelView = array(
                            'header' => array('VERSION'=>Version::getVersion(),
                                'CURRENT_STEP_NUMBER' => $this->_sequenceState->getCurrentStateNumber(), 'STEP_NUMBER' => $this->_sequenceState->getStatesNumber(),
                                'BACK_BUTTON'=>'true', 'FORWARD_BUTTON'=>'true',
                                'PREVIOUS_URI' => $this->getRootPath().'/previous', 'NEXT_URI'=> $this->getRootPath().'/next'),
                            'body' => $formArray);
        if($modalParameters){
            $footer =  array('INDEX'=>$this->getRootPath(),'URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL'=>'true', 'MODAL_TITLE' => $modalParameters['TITLE'], 'MODAL_MESSAGE' => $modalParameters['MESSAGE']);
        }else{
            $footer = array('INDEX'=>$this->getRootPath(),'URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL' => 'false' );
        }
        $this->_modelView['footer'] = $footer;
        $this->_viewHandler = new ViewHandler($this->getControllerName(), $this->_modelView);
        $this->_viewHandler->display();
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -update value from AJAX event
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function compute($datas){
        //check buttons
        if(array_key_exists($this->_BUTTONS_NAMES['BUTTON_ADD_NAME'], $datas)){ //add button
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            foreach($params as $model){
                $this->_model->setClassVarsValues($model);
                Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            }
//            $params = $this->findParamsFromForm($varsModel[0],$datas);
//            foreach($params as $value){
//                $this->_model->set_descriptions($value['param']);  //add descriptions  
//                Logger::getInstance()->logInfo(__CLASS__.' ADD datas ->  val : '.$value['param']);
//            }
            $this->_model->addFunctionToDataBase();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_NAMES['BUTTON_DEL_NAME'], $datas)){ //del button
                $id = $datas[$this->_BUTTONS_NAMES['BUTTON_DEL_NAME']];
                $this->_model->removeFunctionsFromIdFromDataBase($id);
                return true;
            }else{ 
                if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
                        $id = $datas['AJAX_ID'];
                        $val = $datas['AJAX_VAL'];
                        Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> id : '.$id.' val : '.$val);
                        $id = explode('#',$id);
                        $id= $id[1];
                        $this->_model->updateFunctionInDataBase(array('id'=>--$id, 'value'=>$val) );
                        return true;
                }else{//main submit all done
                    return false;
                }
            }
        }
    }
    
}
