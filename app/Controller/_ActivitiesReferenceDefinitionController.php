<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace controller;

use Symfony\Component\HttpFoundation\Request;
use model\ActivitiesReferenceDefinitionModel;
use exception\InternalException;
use Version;
use Kernel;

/**
 * Description of ActivitiesReferenceDefinitionController
 *
 * @author laurent
 */
class ActivitiesReferenceDefinitionController extends AControllerState{
    private $_BUTTONS_NAMES = array('BUTTON_ADD_NAME' => 'ButtonSubmitAddActivity', 'BUTTON_DEL_NAME' => 'ButtonSubmitDelActivity');
    
    public function __construct(Request $request, \SequenceState $sequenceState) {
        parent::__construct($request, $sequenceState);
        $this->setRootControllerName(__CLASS__);
    }
    
    public function run() {
        try{
            $this->_model = new ActivitiesReferenceDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->addBlankToModel();//force new input on form
                    $this->sendModelView();
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->compute($this->_request->request->all()) === true){ //continue processing 
//                                $this->_model->getAllActivitesToModel();//restore functions list -- see model
                                $this->_model->addBlankToModel();//force new input on form
                                $this->sendModelView();
                            }else{
                                $this->_state = self::STOPPED;
                            }
                        }else {//if AJAX don't response to client -- controller still running
                            $this->computeXmlHttpRequest($this->_request->request->all());
                        }     
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getActivitesFromDataBase();//restore model
                    $this->_model->addBlankToModel();//force new input on form
                    $this->sendModelView();
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
                $this->modalParameters = new ModalParameters('Erreur d\'accés à la base de données', 'Vérifiez les informations entrées dans le formulaire');
                //$this->sendModelView(array('TITLE'=>'Erreur d\'accés à la base de données', 'MESSAGE' => 'Vérifiez les informations entrées dans le formulaire'));
            }
        }
    }
    
    /**
     * Build structural model view for form accordingly to template's view
     */
    public function buildModelView(){
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
        if($this->modalParameters){
            $footer =  array('INDEX'=>$this->getRootPath(),'URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL'=>'true', 'MODAL_TITLE' => $this->modalParameters->getTitle(), 'MODAL_MESSAGE' => $this->modalParameters->getMessage());
        }else{
            $footer = array('INDEX'=>$this->getRootPath(),'URI_COMPANY'=>  Kernel::COMPANY_URI, 'SHOW_MODAL' => 'false' );
        }
        $this->_modelView['footer'] = $footer;
    }

    /**
     * Send model view to client with appropriate http response
     * @param interger Http code response
     * @param array optional Http Headers  
     */
    public function sendModelView( $HttpCodeResponse =200, $httpHeaders = array()){
        $this->buildModelView();
        $this->response($HttpCodeResponse, $httpHeaders);
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function compute($datas){
        \Logger::getInstance()->logDebug(__CLASS__.'-- RAW POST -- '.print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_NAMES['BUTTON_ADD_NAME'], $datas)){
            $this->_model->getActivitesFromDataBase();//restore model
            \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE ADD: --'.print_r($this->_model->getMembersModel(), true));
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            //add only the right row
            //\Logger::getInstance()->logDebug(__CLASS__.' ID ADD BUTTON : '.$datas[$this->_BUTTONS_NAMES['BUTTON_ADD_NAME']]);
            $model = $params[$datas[$this->_BUTTONS_NAMES['BUTTON_ADD_NAME']]];//get datas from button id 
            \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
//            foreach($params as $model){
            $this->_model->setClassVarsValues($model);
//                \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
//            }
            \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
            $this->_model->addActivityToDataBase();
            $this->_model->updateModelView();//update model view (functions list) 
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_NAMES['BUTTON_DEL_NAME'], $datas)){
                $this->_model->getActivitesFromDataBase();//restore model
                $id = $datas[$this->_BUTTONS_NAMES['BUTTON_DEL_NAME']];
                \Logger::getInstance()->logDebug(__CLASS__.' DEL to model ->  id : '.  $id);
                $this->_model->removeActivityFromIdFromDataBase($id);
                return true;
            }else{//main submit all done
                return false;
            }
        }
    }
    
    /**
     * Update values'model from AJAX event
     * @param array $datas (id, value) based on xHTML element from template
     * @return boolean
     */
    public function computeXmlHttpRequest($datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){
            \Logger::getInstance()->logDebug(__CLASS__.'-- RAW POST -- '.print_r($datas, true));
            $this->_model->getActivitesFromDataBase();//restore model
            $nameAndId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            \Logger::getInstance()->logDebug(__CLASS__.' AJAX datas -> id : '.$nameAndId.' val : '.$val);
            $nameAndId = explode('#',$nameAndId);
            $name=$nameAndId[0];
            $id= $nameAndId[1];
            switch ($name){
                case 'activityDescription':
                    $this->_model-> updateActivityDescription($val, $id);
                    break;
                case 'activityReference':
                    $this->_model-> updateActivityReference($val, $id);
                    break;
                case 'functionChoosenForActivity' :
                    $this->_model->updateActivityFunction($val, $id);
                    break;
                default:
                    break;
            }
            return true;
        }
        return false;
    }
    
}

