<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use Exception\InternalException;
//use Logger;
use Model\WelcomeTutorModel;
use Model\TutorTraineeListModel;

/**
 * Description of TeacherController
 *
 * @author laurent
 */
class TutorController extends AControllerState{
    
    private $_BUTTONS = array('BUTTON_ADD' => 'ButtonSubmitAdd', 'BUTTON_DEL' => 'ButtonSubmitDel');
    
    /**
     * response to login
     * @var use Symfony\Component\HttpFoundation\RedirectResponse;
     */
    private $_response; 
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
    }
   
    public function welcome(){// stateless
        setlocale(LC_TIME, 'fr_FR.UTF8');
        $date = strftime('%A %d %B %Y');
        $this->_model=new WelcomeTutorModel;
        $this->_model->getAllVisits();
        $formArray = $this->getValuesFromModelToForm();
        $formArray['DATE'] = $date;
        $this->buildBodyView($formArray);
        $this->sendModelView('TutorWelcome');
    }
    
    public function traineeList(){// stateless
        $this->_model=new TutorTraineeListModel;
        $this->_model->getAllTrainee();
        $formArray = $this->getValuesFromModelToForm();
        $this->buildBodyView($formArray);
        $this->sendModelView('TutorTraineeList');
    }
    
    ///////////// work definitions methods
    
//    public function workDefinition(){
//        try{
//            $this->_model = new WorkDefinitionModel();
//            switch ($this->_state){
//                case self::IDLE :
//                    $this->buildViewWorkDefinition();
//                    $this->sendModelView('WorkDefinition');
//                    $this->_state = self::RUNNING;
//                    break;
//                case self::RUNNING:
//                    if($this->_request->isMethod('POST')){
//                        if($this->_request->isXmlHttpRequest()){ 
//                            if($this->computeWorkDefinitionXmlHttpRequest($this->_request->request->all())===true){
//                                $this->buildViewWorkDefinition();
//                                $this->sendModelView('WorkDefinition');
//                            }
//                        }else{
//                            if($this->computeWorkDefinition($this->_request->request->all()) === true){
//                                $this->buildViewWorkDefinition();
//                                $this->sendModelView('WorkDefinition');
//                            }else{
//                                $this->_state = self::STOPPED;
//                                //redirect to welcome admin page
//                                $this->_response = new RedirectResponse(\Bootstrap::ENTRY_SCRIPT.'/'.'enseignant');
//                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
//                                $this->_response->prepare($this->_request);  
//                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
//                                $this->_response->send();
//                            }
//                        }
//                    }else{//direct url access
//                        $this->buildViewWorkDefinition();
//                        $this->sendModelView('WorkDefinition');
//                    }
//                    break;
//                case self::STOPPED:
//                    $this->buildViewWorkDefinition();
//                    $this->sendModelView('WorkDefinition');
//                    $this->_state = self::RUNNING;
//                    break;
//                case self::TERMINATED:
//                    break;
//                case self::ON_INPUT_ERROR:
//                    break;
//                default :
//                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
//            }
//        }catch (Exception $e){
//            $this->_state = self::ON_INPUT_ERROR;
//            $this->_error = $e;
//            if (!($e instanceof DataBaseException)){
//                throw new InternalException($e->getMessage());
//            }else{
//                throw $e;
//            }
//        }
//    }
//    
//    public function buildViewWorkDefinition(){
//        $formArray = $this->buildCompleteFormArray();
//        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
//        $formArray['INDEX'] = $this->_index;
//        foreach ($this->_BUTTONS as $bCtrl => $bForm){
//            $formArray[$bCtrl] = $bForm;
//        }
//        $this->buildBodyView($formArray);
//    }
//    
//    public function computeWorkDefinition($datas){
//        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
//        //check buttons
//        if(array_key_exists($this->_BUTTONS['BUTTON_ADD'], $datas)){
//            Logger::getInstance()->logDebug(__CLASS__.' button add trigged');
//            $varsModel = $this->_model->getClassVars();
//            Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
//            $params = $this->findAllParamsFromForm($datas, $varsModel);
//            Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
//            $this->_model->setClassVarsValues($params);
//            $this->_model->addWork();
//            //$this->_model->upDateModel();
//            return true;
//        }else{
//            if(array_key_exists($this->_BUTTONS['BUTTON_DEL'], $datas)){ //del button
//                $ref = $datas[$this->_BUTTONS['BUTTON_DEL']];
//                $this->_model->delTeacher($ref);
//                $this->_model->upDateModel();
//                return true;
//            }else{ 
//                return false;
//            }
//        }
//    }
//    
//    public function computeWorkDefinitionXmlHttpRequest($datas){
////        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
////            $nameId = $datas['AJAX_ID'];
////            $val = $datas['AJAX_VAL'];
////            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
////            if($nameId==='teacherChoosenForUpdate'){
////                $this->_model->selectTeacher($val);
////            }
////            return true;//update view
////        }else{
//            return false; //nothing to update
////        }
//    }
//    
//    ///////////// work visit definitions methods
//    
//    public function workVisitDefinition(){
//        try{
//            $this->_model = new WorkVisitDefinitionModel();
//            switch ($this->_state){
//                case self::IDLE :
//                    $this->buildViewWorkDefinition();
//                    $this->sendModelView('WorkVisitDefinition');
//                    $this->_state = self::RUNNING;
//                    break;
//                case self::RUNNING:
//                    if($this->_request->isMethod('POST')){
//                        if($this->_request->isXmlHttpRequest()){ 
//                            if($this->computeWorkDefinitionXmlHttpRequest($this->_request->request->all())===true){
//                                $this->buildViewWorkDefinition();
//                                $this->sendModelView('WorkVisitDefinition');
//                            }
//                        }else{
//                            if($this->computeWorkDefinition($this->_request->request->all()) === true){
//                                $this->buildViewWorkDefinition();
//                                $this->sendModelView('WorkVisitDefinition');
//                            }else{
//                                $this->_state = self::STOPPED;
//                                //redirect to welcome admin page
//                                $this->_response = new RedirectResponse($this->getRootPath().'/enseignant');
//                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
//                                $this->_response->prepare($this->_request);  
//                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil enseignant');
//                                $this->_response->send();
//                            }
//                        }
//                    }else{//direct url access
//                        $this->buildViewWorkDefinition();
//                        $this->sendModelView('WorkVisitDefinition');
//                    }
//                    break;
//                case self::STOPPED:
//                    $this->buildViewWorkDefinition();
//                    $this->sendModelView('WorkVisitDefinition');
//                    $this->_state = self::RUNNING;
//                    break;
//                case self::TERMINATED:
//                    break;
//                case self::ON_INPUT_ERROR:
//                    break;
//                default :
//                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
//            }
//        }catch (Exception $e){
//            $this->_state = self::ON_INPUT_ERROR;
//            $this->_error = $e;
//            if (!($e instanceof DataBaseException)){
//                throw new InternalException($e->getMessage());
//            }else{
//                throw $e;
//            }
//        }
//    }
//    
//    public function buildViewWorkVisitDefinition(){
//        $formArray = $this->buildCompleteFormArray();
//        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
//        $formArray['INDEX'] = $this->_index;
//        foreach ($this->_BUTTONS as $bCtrl => $bForm){
//            $formArray[$bCtrl] = $bForm;
//        }
//        $this->buildBodyView($formArray);
//    }
//    
//    public function computeWorkVisitDefinition($datas){
//        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
//        //check buttons
//        if(array_key_exists($this->_BUTTONS['BUTTON_ADD'], $datas)){
//            Logger::getInstance()->logDebug(__CLASS__.' button add trigged');
//            $varsModel = $this->_model->getClassVars();
//            Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
//            $params = $this->findAllParamsFromForm($datas, $varsModel);
//            Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
//            $this->_model->setClassVarsValues($params);
//            //$this->_model->addWork();
//            //$this->_model->upDateModel();
//            return true;
//        }else{
//            if(array_key_exists($this->_BUTTONS['BUTTON_DEL'], $datas)){ //del button
//                $ref = $datas[$this->_BUTTONS['BUTTON_DEL']];
//                $this->_model->delTeacher($ref);
//                $this->_model->upDateModel();
//                return true;
//            }else{ 
//                return false;
//            }
//        }
//    }
//    
//    public function computeWorkVisitDefinitionXmlHttpRequest($datas){
////        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
////            $nameId = $datas['AJAX_ID'];
////            $val = $datas['AJAX_VAL'];
////            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
////            if($nameId==='teacherChoosenForUpdate'){
////                $this->_model->selectTeacher($val);
////            }
////            return true;//update view
////        }else{
//            return false; //nothing to update
////        }
//    }
//    
//    ///////////// work teacher comment definitions methods
//    
//    public function workTeacherCommentDefinition(){
//        try{
//            $this->_model = new WorkTeacherCommentDefinitionModel();
//            switch ($this->_state){
//                case self::IDLE :
//                    $this->buildViewWorkCommentDefinition();
//                    $this->sendModelView('WorkCommentDefinition');
//                    $this->_state = self::RUNNING;
//                    break;
//                case self::RUNNING:
//                    if($this->_request->isMethod('POST')){
//                        if($this->_request->isXmlHttpRequest()){ 
//                            if($this->computeWorkDefinitionXmlHttpRequest($this->_request->request->all())===true){
//                                $this->buildViewWorkCommentDefinition();
//                                $this->sendModelView('WorkCommentDefinition');
//                            }
//                        }else{
//                            if($this->computeWorkCommentDefinition($this->_request->request->all()) === true){
//                                $this->buildViewWorkCommentDefinition();
//                                $this->sendModelView('WorkCommentDefinition');
//                            }else{
//                                $this->_state = self::STOPPED;
//                                //redirect to welcome admin page
//                                $this->_response = new RedirectResponse($this->getRootPath().'/enseignant');
//                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
//                                $this->_response->prepare($this->_request);  
//                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil enseignant');
//                                $this->_response->send();
//                            }
//                        }
//                    }else{//direct url access
//                        $this->buildViewWorkCommentDefinition();
//                        $this->sendModelView('WorkCommentDefinition');
//                    }
//                    break;
//                case self::STOPPED:
//                    $this->buildViewWorkCommentDefinition();
//                    $this->sendModelView('WorkCommentDefinition');
//                    $this->_state = self::RUNNING;
//                    break;
//                case self::TERMINATED:
//                    break;
//                case self::ON_INPUT_ERROR:
//                    break;
//                default :
//                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
//            }
//        }catch (Exception $e){
//            $this->_state = self::ON_INPUT_ERROR;
//            $this->_error = $e;
//            if (!($e instanceof DataBaseException)){
//                throw new InternalException($e->getMessage());
//            }else{
//                throw $e;
//            }
//        }
//    }
//    
//    public function buildViewWorkCommentDefinition(){
//        $formArray = $this->buildCompleteFormArray();
//        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
//        $formArray['INDEX'] = $this->_index;
//        foreach ($this->_BUTTONS as $bCtrl => $bForm){
//            $formArray[$bCtrl] = $bForm;
//        }
//        $this->buildBodyView($formArray);
//    }
//    
//    public function computeWorkCommentDefinition($datas){
//        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
//        //check buttons
//        if(array_key_exists($this->_BUTTONS['BUTTON_ADD'], $datas)){
//            Logger::getInstance()->logDebug(__CLASS__.' button add trigged');
//            $varsModel = $this->_model->getClassVars();
//            Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
//            $params = $this->findAllParamsFromForm($datas, $varsModel);
//            Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
//            $this->_model->setClassVarsValues($params);
//            //$this->_model->addWork();
//            //$this->_model->upDateModel();
//            return true;
//        }else{
//            if(array_key_exists($this->_BUTTONS['BUTTON_DEL'], $datas)){ //del button
//                $ref = $datas[$this->_BUTTONS['BUTTON_DEL']];
//                $this->_model->delTeacher($ref);
//                $this->_model->upDateModel();
//                return true;
//            }else{ 
//                return false;
//            }
//        }
//    }
//    
//    public function computeWorkCommentDefinitionXmlHttpRequest($datas){
////        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
////            $nameId = $datas['AJAX_ID'];
////            $val = $datas['AJAX_VAL'];
////            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
////            if($nameId==='teacherChoosenForUpdate'){
////                $this->_model->selectTeacher($val);
////            }
////            return true;//update view
////        }else{
//            return false; //nothing to update
////        }
//    }
//    
//    ///////////// teacher internal contact methods
//    
//    public function teacherContact() {
//        try{
//            $this->_model=new InternalContactModel();
//            switch ($this->_state){ 
//                case self::IDLE :
//                    $this->_state = self::RUNNING;
//                    $this->buildTeacherContactView();
//                    $this->sendModelView('InternalContact');  
//                    break;
//                case self::RUNNING:
//                    if($this->_request->isMethod('POST')){
//                        if($this->computeTeacherContact($this->_request->request->all()) === true){
//                            $this->modalParameters = new ModalParameters('Erreur d\'adresse mél', 'Vérifiez votre adresse mél destinataire ');
//                            $this->buildTeacherContactView();
//                            $this->sendModelView('InternalContact');
//                        }else{
//                            $this->_state = self::STOPPED;
//                            //redirect to welcome admin page
//                            $this->_response = new RedirectResponse($this->getRootPath().'/enseignant');
//                            // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
//                            $this->_response->prepare($this->_request);  
//                            Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil enseignant');
//                            $this->_response->send();
//                        }
//                        
//                    }else{//direct url access
//                        $this->buildTeacherContactView();
//                        $this->sendModelView('InternalContact');
//                    }
//                    
//                    break;
//                case self::STOPPED:
//                    break;
//                case self::TERMINATED:
//                    break;
//                case self::ON_INPUT_ERROR:
//                    break;
//                default :
//                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
//            }
//        }catch (Exception $e){
//            $this->_state = self::ON_CRITICAL_ERROR;
//            $this->_error = $e;
//            throw $e;
//        }
//    }
//    
//    public function buildTeacherContactView(){
//        $formArray = $this->buildCompleteFormArray();
//        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
//        $formArray['INDEX'] = $this->_index.'/contact_interne';
//        $this->buildBodyView($formArray);
//    }
//    
//    public function computeTeacherContact(array $datas){
//        Logger::getInstance()->logDebug(__CLASS__.'::'.__METHOD__.'  raw post : '.print_r($datas, true));
//        $varsModel = $this->_model->getClassVars();
//        Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
//        $params = $this->findAllParamsFromForm($datas, $varsModel);
//        Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
//        $this->_model->setClassVarsValues($params);
//        return !$this->_model->sendMail();
//    }
    
    
}
