<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Cookie;
//use Version;
//use Bootstrap;
use Exception\InternalException;
use Logger;
use Model\GeneralReferenceDefinitionModel;
use Model\FunctionReferentialDefinitionModel;
use Model\ActivitiesReferenceDefinitionModel;
use Model\SkillsReferenceDefinitionModel;
use Model\PromotionModel;
use Model\TeacherDefinitionModel;
use Model\TraineeDefinitionModel;
use Model\WorkDateModel;
use Model\AdminPasswordDefinitionModel;



/**
 * Description of AdminController
 *
 * @author laurent
 */
class AdminController extends AControllerState{
    
    private $_BUTTONS_FUNCTIONS = array('BUTTON_ADD_FUNCTION' => 'ButtonSubmitAddFunction', 'BUTTON_DEL_FUNCTION' => 'ButtonSubmitDelFunction');
    private $_BUTTONS_ACTIVITIES = array('BUTTON_ADD_ACTIVITY' => 'ButtonSubmitAddActivity', 'BUTTON_DEL_ACTIVITY' => 'ButtonSubmitDelActivity');
    private $_BUTTONS_SKILLS = array('BUTTON_ADD_SKILL' => 'ButtonSubmitAddSkill', 
                                    'BUTTON_DEL_SKILL' => 'ButtonSubmitDelSkill',
                                    'BUTTON_BIND_ACTIVITY' => 'ButtonSubmitBindActivity',
                                    'BUTTON_FREE_ACTIVITY' => 'ButtonSubmitFreeActivity');
    private $_BUTTONS_PROMOTIONS = array('BUTTON_ADD_PROMOTION' => 'ButtonSubmitAddPromotion', 'BUTTON_DEL_PROMOTION' => 'ButtonSubmitDelPromotion');
    private $_BUTTONS_TEACHERS = array('BUTTON_ADD_TEACHER' => 'ButtonSubmitAddTeacher', 'BUTTON_DEL_TEACHER' => 'ButtonSubmitDelTeacher');
    
    //private $_BUTTONS = array('BUTTON_ADD' => 'ButtonSubmitAdd', 'BUTTON_DEL' => 'ButtonSubmitDel');
   
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
    }
    
   
    public function welcome(){// stateless
        setlocale(LC_TIME, 'fr_FR.UTF8');
        $date = strftime('%A %d %B %Y');
        $this->buildBodyView(array('DATE'=>$date));
        $this->sendModelView('AdminWelcome');
    }
    
    ///////////// general referential definitions methods
    
    public function generalReferentialDefinition(){
         try{
            $this->_model=new GeneralReferenceDefinitionModel();
            switch ($this->_state){ 
                case self::IDLE :
                    $this->buildSendView();
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        $this->computeGeneralReferentialDefinition($this->_request->request->all());
                        $this->_state = self::STOPPED;
                        //redirect to welcome admin page
                        $this->redirectTo($this->_index);
                    }else{//direct url access
                        $this->buildSendView();
                    }
                    break;
                case self::STOPPED: 
                    $this->buildSendView();
                    $this->_state = self::RUNNING;
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
            $this->_state = self::ON_INPUT_ERROR;
            $this->_error = $e;
            if (!($e instanceof DataBaseException)){
                throw new InternalException($e->getMessage());
            }else {
                throw $e;
            }
        }
    }
    
    public function buildSendView(){
        //get values from model
        $this->_model->getReferentialFromDataBase();
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/referentiel';
        //var_dump($formArray);
        $this->buildBodyView($formArray);
        $this->sendModelView('GeneralReferenceDefinition');  
    }
    
    public function computeGeneralReferentialDefinition(array $datas){
        $varsModel = $this->_model->getClassVars();
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        $this->_model->setClassVarsValues($params);
        $this->_model->createReferential();
    }


    ///////////// functions definitions methods
    
    public function functionDefinition(){
        try{
            $this->_model = new FunctionReferentialDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getFunctionsFromDataBase();
                    $this->_model->set_descriptions('');//force new input on form
                    $this->buildSendViewFunctionDefinition();
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computeFonctionDefinition($this->_request->request->all()) === true){
                                $this->_model->getFunctionsFromDataBase();
                                $this->_model->set_descriptions('');//add new input on form
                                $this->buildSendViewFunctionDefinition();
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->redirectTo($this->_index);
                            }
                        }else {//if AJAX don't response to client -- controller still running
                            $this->computeXmlHttpRequestFunctionDefinition($this->_request->request->all());
                        } 
                    }else{//direct url access
                        $this->_model->getFunctionsFromDataBase();
                        $this->_model->set_descriptions('');//add new input on form
                        $this->buildSendViewFunctionDefinition();
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getFunctionsFromDataBase(); // retrieve datas 
                    $this->_model->set_descriptions('');//force new input on form
                    $this->buildSendViewFunctionDefinition();
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
                throw $e;
            }
        }
    }
    
    public function buildSendViewFunctionDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/fonction';
        foreach ($this->_BUTTONS_FUNCTIONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->sendModelView('FunctionReferentialDefinition');
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function computeFonctionDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.'raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_FUNCTIONS['BUTTON_ADD_FUNCTION'], $datas)){ //add button
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            Logger::getInstance()->logInfo(__CLASS__.' all params : '.  print_r($params, true));
            foreach($params as $model){
                $this->_model->setClassVarsValues($model);
                Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            }
            $this->_model->addFunctionToDataBase();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_FUNCTIONS['BUTTON_DEL_FUNCTION'], $datas)){ //del button
                $id = $datas[$this->_BUTTONS_FUNCTIONS['BUTTON_DEL_FUNCTION']];
                $this->_model->delFunctionFromDataBase($id); 
                return true;
            }else{ //main submit all done
                return false;
            }
        }
    }
    
    /**
     * -update value from AJAX event
     * @param array $datas
     * @return boolean
     */
    public function computeXmlHttpRequestFunctionDefinition(array $datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
            $id = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> id : '.$id.' val : '.$val);
            $id = explode('#',$id);
            $id= $id[1];
            $this->_model->updateFunctionInDataBase(array('id'=>$id, 'value'=>$val) );
            return true;
        }
    }
    
    ///////////// activities definitions methods

    public function activityDefinition(){
        try{
            $this->_model = new ActivitiesReferenceDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->addBlankToModel();//force new input on form
                    $this->buildViewActivityDefinition();
                    $this->sendModelView('ActivitiesReferenceDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computeActivityDefinition($this->_request->request->all()) === true){ //continue processing 
//                                $this->_model->getAllActivitesToModel();//restore functions list -- see model
                                $this->_model->addBlankToModel();//force new input on form
                                $this->buildViewActivityDefinition();
                                $this->sendModelView('ActivitiesReferenceDefinition');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_redirect->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                                $this->_redirect->send();
                            }
                        }else {//if AJAX don't response to client -- controller still running
                            $this->computeXmlHttpRequestActivityDefinition($this->_request->request->all());
                        }     
                    }else {//direct url access
                        $this->_model->getActivitesFromDataBase();//restore model
                        $this->_model->addBlankToModel();//force new input on form
                        $this->buildViewActivityDefinition();
                        $this->sendModelView('ActivitiesReferenceDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getActivitesFromDataBase();//restore model
                    $this->_model->addBlankToModel();//force new input on form
                    $this->buildViewActivityDefinition();
                    $this->sendModelView('ActivitiesReferenceDefinition');
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
    
    public function buildViewActivityDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->getRootPath().$this->_request->getPathInfo();
        foreach ($this->_BUTTONS_ACTIVITIES as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function computeActivityDefinition($datas){
        \Logger::getInstance()->logDebug(__CLASS__.'-- RAW POST -- '.print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_ACTIVITIES['BUTTON_ADD_ACTIVITY'], $datas)){
            $this->_model->getActivitesFromDataBase();//restore model
            \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE ADD: --'.print_r($this->_model->getMembersModel(), true));
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            //add only the right row
            //\Logger::getInstance()->logDebug(__CLASS__.' ID ADD BUTTON : '.$datas[$this->_BUTTONS_NAMES['BUTTON_ADD_NAME']]);
            $model = $params[$datas[$this->_BUTTONS_ACTIVITIES['BUTTON_ADD_ACTIVITY']]];//get datas from button id 
            \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
//            foreach($params as $model){
            $this->_model->setClassVarsValues($model);
//                \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
//            }
            \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
            $this->_model->addActivityToDataBase();
            $this->_model->updateModelView();//update model view (functions list) -- move this to model
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_ACTIVITIES['BUTTON_DEL_ACTIVITY'], $datas)){
                $this->_model->getActivitesFromDataBase();//restore model
                $id = $datas[$this->_BUTTONS_ACTIVITIES['BUTTON_DEL_ACTIVITY']];
                \Logger::getInstance()->logDebug(__CLASS__.' DEL to model ->  id : '.  $id);
                $this->_model->removeActivityFromIdFromDataBase(++$id); // 0 based
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
    public function computeXmlHttpRequestActivityDefinition($datas){
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
                    $this->_model-> updateActivityDescription($val, $id); // FIXME update have to be generic see model
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
    
    ///////////// skills definitions methods

    public function skillDefinition(){
        try{
            if($this->_model === null){
                $this->_model = new SkillsReferenceDefinitionModel();
            }
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->addBlankToModel();//force new input on form
                    $this->buildViewSkillDefinition();
                    $this->sendModelView('SkillsReferenceDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            $this->_model->getSkillsFromDataBase();//restore model for processing
                            if($this->computeSkill($this->_request->request->all()) === true){ //continue processing 
                                $this->_model->addBlankToModel();//force new input on form 
                                $this->buildViewSkillDefinition();
                                $this->sendModelView('SkillsReferenceDefinition');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_redirect->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                                $this->_redirect->send();
                            }
                        }else {//if AJAX, don't response to client -- controller still running
                            $this->computeXmlHttpRequest($this->_request->request->all());
                        }     
                    }else{// direct url access
                        $this->_model->getSkillsFromDataBase();//restore model
                        $this->_model->addBlankToModel();//force new input on form
                        $this->buildViewSkillDefinition();
                        $this->sendModelView('SkillsReferenceDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getSkillsFromDataBase();//restore model
                    $this->_model->addBlankToModel();//force new input on form
                    $this->buildViewSkillDefinition();
                    $this->sendModelView('SkillsReferenceDefinition');
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
    
    public function buildViewSkillDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->getRootPath().$this->_request->getPathInfo();
        foreach ($this->_BUTTONS_SKILLS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function computeSkill($datas){
        \Logger::getInstance()->logDebug(__CLASS__.'-- RAW POST -- '.print_r($datas, true));
        //check trigged form buttons
        $a = array_intersect(array_keys($datas), array_values($this->_BUTTONS_SKILLS));
        $button = array_shift($a);
        \Logger::getInstance()->logDebug(__CLASS__.'-- BUTTON Trigged--> : '.print_r($button, true));
        switch ($button){
            case $this->_BUTTONS_SKILLS['BUTTON_ADD_SKILL'] : 
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE ADD: --'.print_r($this->_model->getMembersModel(), true));
                $varsModel = $this->_model->getClassVars();
                $params = $this->findAllParamsFromForm($datas, $varsModel);
                //add only the right row
                //\Logger::getInstance()->logDebug(__CLASS__.' ID ADD BUTTON : '.$datas[$this->_BUTTONS_NAMES['BUTTON_ADD_NAME']]);
                $model = $params[$datas[$this->_BUTTONS_SKILLS['BUTTON_ADD_SKILL']]];//get datas from button id --> skill id
                \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
                $this->_model->setClassVarsValues($model);
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
                $this->_model->addSkillToDataBase();
                return true;
                break;
            case $this->_BUTTONS_SKILLS['BUTTON_BIND_ACTIVITY'] : 
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE ADD: --'.print_r($this->_model->getMembersModel(), true));
                $varsModel = $this->_model->getClassVars();
                $params = $this->findAllParamsFromForm($datas, $varsModel);
                //add only the right row
                $skillId = $datas[$this->_BUTTONS_SKILLS['BUTTON_BIND_ACTIVITY']];//get datas from button id --> skill id
                $model = $params[$skillId];
                \Logger::getInstance()->logDebug(__CLASS__.' BIND Activity to skill : ADD to model ->  val : '.  print_r($model, true));
                $this->_model->setClassVarsValues($model);
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
                $this->_model->bindMultipleActivitiesToSkill($skillId);
                return true;
                break;
            case $this->_BUTTONS_SKILLS['BUTTON_FREE_ACTIVITY'] :
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE FREE Activity: --'.print_r($this->_model->getMembersModel(), true));
                $freeParams = explode('#',$datas[$this->_BUTTONS_SKILLS['BUTTON_FREE_ACTIVITY']]);
                $this->_model->freeBindedActivity($freeParams[0], $freeParams[1]);// skill id , activity description
                return true;
                break;
            case $this->_BUTTONS_SKILLS['BUTTON_DEL_SKILL'] : 
                $skillId = $datas[$this->_BUTTONS_SKILLS['BUTTON_DEL_SKILL']];
                $this->_model->deleteSkill($skillId);
                return true;
                break;
            default : //submit form, all done
                return false;
        }
    }
    
    /**
     * Update values'model from AJAX event
     * @param array $datas (id, value) based on xHTML element from template
     * @return boolean true if events was handled, false else 
     */
    public function computeXmlHttpRequest($datas){
        // FIXME  : TO BE DONE
    }
    
    ///////////// promotions definitions methods
    
    public function promotionDefinition(){
        try{
            $this->_model = new PromotionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->addBlankToViewModel();//force new input on form
                    $this->buildViewPromotionDefinition();
                    $this->sendModelView('PromotionDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->computePromotionDefinition($this->_request->request->all()) === true){
                            $this->_model->getAllPromotions();
                            $this->_model->addBlankToViewModel();//add new input on form
                            $this->buildViewPromotionDefinition();
                            $this->sendModelView('PromotionDefinition');
                        }else{
                            $this->_state = self::STOPPED;
                            //redirect to welcome admin page
                            $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                            // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                            $this->_redirect->prepare($this->_request);  
                            Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                            $this->_redirect->send();
                        }
                    }else{//direct url access
                        $this->_model->getAllPromotions();
                        $this->_model->addBlankToViewModel();//add new input on form
                        $this->buildViewPromotionDefinition();
                        $this->sendModelView('PromotionDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAllPromotions();
                    $this->_model->addBlankToViewModel();//add new input on form
                    $this->buildViewPromotionDefinition();
                    $this->sendModelView('PromotionDefinition');
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
                throw $e;
            }
        }
    }
    
    public function buildViewPromotionDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->getRootPath().$this->_request->getPathInfo();
        foreach ($this->_BUTTONS_PROMOTIONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    public function computePromotionDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.'raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_ADD_PROMOTION'], $datas)){
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            foreach($params as $model){
                $this->_model->setClassVarsValues($model);
                Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            }
            $this->_model->appendPromotion();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION'], $datas)){ //del button
                $ref = $datas[$this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION']];
                $this->_model->delPromotion($ref);
                return true;
            }else{ 
//                if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
//                        $id = $datas['AJAX_ID'];
//                        $val = $datas['AJAX_VAL'];
//                        Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> id : '.$id.' val : '.$val);
//                        $id = explode('#',$id);
//                        $id= $id[1];
//                        $this->_model->updateFunctionInDataBase(array('id'=>--$id, 'value'=>$val) );
//                        return true;
//                }
//            else{//main submit all done
                    return false;
            }
        }
    }
    
    ///////////// teachers definitions methods
    
    public function teacherDefinition(){
        try{
            $this->_model = new TeacherDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->buildViewTeacherDefinition();
                    $this->sendModelView('TeacherDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            if($this->computeTeacherXmlHttpRequest($this->_request->request->all())===true){
                                $this->buildViewTeacherDefinition();
                                $this->sendModelView('TeacherDefinition');
                            }
                        }else{
                            if($this->computeTeacherDefinition($this->_request->request->all()) === true){
                                $this->buildViewTeacherDefinition();
                                $this->sendModelView('TeacherDefinition');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_redirect->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                                $this->_redirect->send();
                            }
                        }
                    }else{//direct url access
                        $this->buildViewTeacherDefinition();
                        $this->sendModelView('TeacherDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->buildViewTeacherDefinition();
                    $this->sendModelView('TeacherDefinition');
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
                throw $e;
            }
        }
    }
    
    public function buildViewTeacherDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index;
        foreach ($this->_BUTTONS_TEACHERS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    public function computeTeacherDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_TEACHERS['BUTTON_ADD_TEACHER'], $datas)){
            Logger::getInstance()->logDebug(__CLASS__.' button add trigged');
            $varsModel = $this->_model->getClassVars();
            Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
            $this->_model->setClassVarsValues($params);
            $this->_model->addTeacher();
            $this->_model->upDateModel();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_TEACHERS['BUTTON_DEL_TEACHER'], $datas)){ //del button
                $ref = $datas[$this->_BUTTONS_TEACHERS['BUTTON_DEL_TEACHER']];
                $this->_model->delTeacher($ref);
                $this->_model->upDateModel();
                return true;
            }else{ 
                return false;
            }
        }
    }
    
    public function computeTeacherXmlHttpRequest($datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
            $nameId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
            if($nameId==='teacherChoosenForUpdate'){
                $this->_model->selectTeacher($val);
            }
            return true;//update view
        }else{
            return false; //nothing to update
        }
    }
    
    ///////////// trainee definitions methods
    
    public function traineeDefinition(){
        try{
            $this->_model = new TraineeDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->buildViewTraineeDefinition();
                    $this->sendModelView('TraineeDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            if($this->computeTraineeXmlHttpRequest($this->_request->request->all())===true){
                                $this->buildViewTraineeDefinition();
                                $this->sendModelView('TraineeDefinition');
                            }
                        }else{
                            if($this->computeTraineeDefinition($this->_request->request->all()) === true){
                                $this->buildViewTraineeDefinition();
                                $this->sendModelView('TraineeDefinition');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_redirect->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                                $this->_redirect->send();
                            }
                        }
                    }else{//direct url access
                        $this->buildViewTraineeDefinition();
                        $this->sendModelView('TraineeDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->buildViewTraineeDefinition();
                    $this->sendModelView('TraineeDefinition');
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
                throw $e;
            }
        }
    }
    
    public function buildViewTraineeDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index;
        foreach ($this->_BUTTONS_TEACHERS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    public function computeTraineeDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_TEACHERS['BUTTON_ADD_TEACHER'], $datas)){
            Logger::getInstance()->logDebug(__CLASS__.' button add trigged');
            $varsModel = $this->_model->getClassVars();
            Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
            $this->_model->setClassVarsValues($params);
            $this->_model->addTrainee();
            $this->_model->upDateModel();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_TEACHERS['BUTTON_DEL_TEACHER'], $datas)){ //del button
                $ref = $datas[$this->_BUTTONS_TEACHERS['BUTTON_DEL_TEACHER']];
                $this->_model->delTrainee($ref);
                $this->_model->upDateModel();
                return true;
            }else{ 
                return false;
            }
        }
    }
    
    public function computeTraineeXmlHttpRequest($datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
            $nameId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
            if($nameId==='traineeChoosenForUpdate'){
                $this->_model->selectTrainee($val);
            }
            return true;//update view
        }else{
            return false; //nothing to update
        }
    }
    
    ///////////// work date definitions methods
    
    public function workDateDefinition(){
        try{
            $this->_model = new WorkDateModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->addBlankToViewModel();//force new input on form
                    $this->buildViewWorkdateDefinition();
                    $this->sendModelView('WorkDateDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->computeWorkDateDefinition($this->_request->request->all()) === true){
                            $this->_model->getAllWorkDates();
                            $this->_model->addBlankToViewModel();//add new input on form
                            $this->buildViewWorkdateDefinition();
                            $this->sendModelView('WorkDateDefinition');
                        }else{
                            $this->_state = self::STOPPED;
                            //redirect to welcome admin page
                            $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                            // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                            $this->_redirect->prepare($this->_request);  
                            Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                            $this->_redirect->send();
                        }
                    }else{//direct url access
                        //$this->_model->getAllPromotions();
                        $this->_model->addBlankToViewModel();//add new input on form
                        $this->buildViewWorkdateDefinition();
                        $this->sendModelView('WorkDateDefinition');
                    }
                    break;
                case self::STOPPED:
                    //$this->_model->getAllPromotions();
                    $this->_model->addBlankToViewModel();//add new input on form
                    $this->buildViewWorkdateDefinition();
                    $this->sendModelView('WorkDateDefinition');
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
                throw $e;
            }
        }
    }
    
    public function buildViewWorkdateDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->getRootPath().$this->_request->getPathInfo();
        foreach ($this->_BUTTONS_PROMOTIONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    public function computeWorkDateDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.'::'.__METHOD__.'-->raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_ADD_PROMOTION'], $datas)){
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            foreach($params as $model){
                $this->_model->setClassVarsValues($model);
                Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            }
            $this->_model->appendWorkDate();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION'], $datas)){ //del button
                $ref = $datas[$this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION']];
                $this->_model->delWorkDate($ref);
                return true;
            }else{ 
                if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
//                        $id = $datas['AJAX_ID'];
//                        $val = $datas['AJAX_VAL'];
//                        Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> id : '.$id.' val : '.$val);
//                        $id = explode('#',$id);
//                        $id= $id[1];
//                        $this->_model->updateFunctionInDataBase(array('id'=>--$id, 'value'=>$val) );
                        return true;
                }
//            else{//main submit all done
                    return false;
            }
        }
    }
    
    ///////////// admin password definitions methods
    
    public function adminPasswordDefinition(){
        try{
            $this->_model = new AdminPasswordDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->buildViewAdminPasswordDefinition();
                    $this->sendModelView('AdminPasswordDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            if($this->computeAdminPasswordXmlHttpRequest($this->_request->request->all())===true){
                                $this->buildViewAdminPasswordDefinition();
                                $this->sendModelView('AdminPasswordDefinition');
                            }
                        }else{
                            if($this->computeAdminPasswordDefinition($this->_request->request->all()) === true){
                                $this->buildViewAdminPasswordDefinition();
                                $this->sendModelView('AdminPasswordDefinition');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_redirect = new RedirectResponse($this->getRootPath().'/administrateur');
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_redirect->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                                $this->_redirect->send();
                            }
                        }
                    }else{//direct url access
                        $this->buildViewAdminPasswordDefinition();
                        $this->sendModelView('AdminPasswordDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->buildViewAdminPasswordDefinition();
                    $this->sendModelView('AdminPasswordDefinition');
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
                throw $e;
            }
        }
    }
    
    public function buildViewAdminPasswordDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index;
        $this->buildBodyView($formArray);
    }
    
    public function computeAdminPasswordDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
        $varsModel = $this->_model->getClassVars();
        Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
        $this->_model->setClassVarsValues($params);
        $result=$this->_model->checkPasswords();
        Logger::getInstance()->logDebug(__CLASS__.'::'.__METHOD__.' model result : '.$result);
        if($result===true){ // -- WARNING STRICT EQUALITY NEEDED
            //password changed - done
            return false;
        }else{// wrong passwords... 
            $this->modalParameters=new ModalParameters('Informations fournies incorrectes...', $result);
            Logger::getInstance()->logDebug(__CLASS__.' model result : '.$result);
            return true;
        }

    }
    
    public function computeAdminPasswordXmlHttpRequest($datas){
        return true;//continue 
//        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
//            $nameId = $datas['AJAX_ID'];
//            $val = $datas['AJAX_VAL'];
//            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
////            if($nameId==='traineeChoosenForUpdate'){
////                $this->_model->selectTrainee($val);
////            }
//            return true;//update view
//        }else{
//            return false; //nothing to update
//        }
    }
    
    
    
    
}
