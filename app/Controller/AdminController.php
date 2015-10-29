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
use Model\ProfessionalSkillDefinitionModel;
use Model\DocumentDefinitionModel;
use Model\PromotionModel;
use Model\TeacherDefinitionModel;
use Model\TraineeDefinitionModel;
use Model\WorkDateModel;
use Model\PasswordDefinitionModel;



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
    private $_BUTTONS_TEACHERS = array('BUTTON_CREATE_TEACHER' => 'ButtonSubmitCreateTeacher',
                                    'BUTTON_EDIT_TEACHER' => 'ButtonSubmitEditTeacher',
                                    'BUTTON_ADD_TEACHER' => 'ButtonSubmitAddTeacher', 
                                    'BUTTON_IMPORT_TEACHER' => 'ButtonSubmitImportTeacher',
                                    'BUTTON_CHOOSE_IMPORT_TEACHER' => 'ButtonSubmitChooseImportTeacher',
                                    'BUTTON_DEL_TEACHER' => 'ButtonSubmitDelTeacher');
    
    //private $_BUTTONS = array('BUTTON_ADD' => 'ButtonSubmitAdd', 'BUTTON_DEL' => 'ButtonSubmitDel');
   
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
        //menu entries
        $this->_modelView['header'] = array(
                'REFERENTIAL'=>  $this->_index.'/referentiel',
                'FUNCTION'=>  $this->_index.'/fonction',
                'ACTIVITY'=>  $this->_index.'/activite',
                'SKILL'=>  $this->_index.'/competence',
                'PROFESSIONAL' => $this->_index.'/attitude_professionnelle',
                'DOCUMENT'=>  $this->_index.'/document',
                'PROMOTION'=>  $this->_index.'/promotion',
                'TEACHER'=>  $this->_index.'/enseignant',
                'TRAINEE'=> $this->_index.'/stagiaire',
                'WORK_DATE'=>  $this->_index.'/stage',
                'PASSWORD'=>  $this->_index.'/acces',
        );
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
                    $this->_model->getAll();
                    $this->buildSendView();
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        $this->_model->getAll();
                        if(!$this->_request->isXmlHttpRequest()){ 
                            $this->computeGeneralReferentialDefinition($this->_request->request->all());
                            $this->_state = self::STOPPED;
                            //redirect to welcome admin page
                            $this->redirectTo($this->_index);
                        }else{
                            $this->computeXmlGeneralReferentialDefinition($this->_request->request->all());
                        }
                    }else{//direct url access
                        $this->_model->getAll();
                        $this->buildSendView();
                    }
                    break;
                case self::STOPPED: 
                    $this->_model->getAll();
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
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/referentiel';
        //var_dump($formArray);
        $this->buildBodyView($formArray);
        $this->buildGeneralReferentialDefinitionFooterView();
        $this->sendModelView('GeneralReferenceDefinition');  
    }
    
    public function buildGeneralReferentialDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/referentiel';
        $this->_modelView['footer'] = $footer;
    }
    
    public function computeGeneralReferentialDefinition(array $datas){
        $varsModel = $this->_model->getClassVars();
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        $this->_model->setClassVarsValues($params);
        $this->_model->append();
    }
    
    public function computeXmlGeneralReferentialDefinition(array $datas){
        Logger::getInstance()->logDebug(__CLASS__.' AJAX : '.print_r($datas,true));
        if(in_array('texte_change', $datas)){
            $this->_model->update($datas['AJAX_ID'], $datas['AJAX_VAL']);
        }
    }

    ///////////// functions definitions methods
    
    public function functionDefinition(){
        try{
            $this->_model = new FunctionReferentialDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();
                    $this->_model->addBlank();;//force new input on form
                    $this->buildSendViewFunctionDefinition();
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computeFonctionDefinition($this->_request->request->all()) === true){
                                $this->_model->getAll();
                                $this->_model->addBlank();;//add new input on form
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
                        $this->_model->getAll();
                        $this->_model->addBlank();//add new input on form
                        $this->buildSendViewFunctionDefinition();
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll(); // retrieve datas 
                    $this->_model->addBlank();//force new input on form
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
        $this->buildFonctionDefinitionFooterView();
        $this->sendModelView('FunctionReferentialDefinition');
    }
    
    public function buildFonctionDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/fonction';
        $this->_modelView['footer'] = $footer;
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
            Logger::getInstance()->logDebug(__CLASS__.'properties model : '.print_r($varsModel, true));
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            Logger::getInstance()->logInfo(__CLASS__.' all params : '.  print_r($params, true));
            $model = $params[$datas[$this->_BUTTONS_FUNCTIONS['BUTTON_ADD_FUNCTION']]];//get datas from button id 
            $this->_model->setClassVarsValues($model);
            Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            $this->_model->append();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_FUNCTIONS['BUTTON_DEL_FUNCTION'], $datas)){ //del button
                $id = $datas[$this->_BUTTONS_FUNCTIONS['BUTTON_DEL_FUNCTION']];
                if(!$this->_model->deleteFromId($id)){
                    $this->modalParameters = new ModalParameters('Impossible de supprimer cette fonction', 'Cette fonction est utilisé par une ou des activités déjà définies  ');
                }
                return true;
            }else{ //main submit all done
                return false;
            }
        }
    }
    
    /**
     * -update value from AJAX event
     * @param array $datas
     *      AJAX_ID = propertyName#Id_Or_Key_for_this_property
     *      AJAX_VAL = value to be updated
     * @return boolean
     */
    public function computeXmlHttpRequestFunctionDefinition(array $datas){
        Logger::getInstance()->logDebug(__CLASS__.' AJAX : '.print_r($datas,true));
        if(in_array('texte_change', $datas)){
            $params = explode('#', $datas['AJAX_ID']);
            $this->_model->update($params[0], $datas['AJAX_VAL'], $params[1]);
        }
    }
    
    ///////////// activities definitions methods

    public function activityDefinition(){
        try{
            $this->_model = new ActivitiesReferenceDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();//restore model
                    $this->_model->addBlank();//force new input on form
                    $this->buildViewActivityDefinition();
                    $this->sendModelView('ActivitiesReferenceDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computeActivityDefinition($this->_request->request->all()) === true){ //continue processing 
                                $this->_model->getAll();
                                $this->_model->addBlank();//force new input on form
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
                        $this->_model->getAll();//restore model
                        $this->_model->addBlank();//force new input on form
                        $this->buildViewActivityDefinition();
                        $this->sendModelView('ActivitiesReferenceDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();//restore model
                    $this->_model->addBlank();//force new input on form
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
        $formArray['INDEX'] = $this->_index.'/activite';
        foreach ($this->_BUTTONS_ACTIVITIES as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->buildActivityDefinitionFooterView();
    }
    
    public function buildActivityDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/activite';
        $this->_modelView['footer'] = $footer;
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
            $this->_model->getAll();//restore model
            \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE ADD: --'.print_r($this->_model->getMembersModel(), true));
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            //add only the right row
            \Logger::getInstance()->logDebug(__CLASS__.' ID ADD BUTTON : '.$datas[$this->_BUTTONS_ACTIVITIES['BUTTON_ADD_ACTIVITY']]);
            \Logger::getInstance()->logDebug(__CLASS__.' params extract : '.  print_r($params, true));
            $model = $params[$datas[$this->_BUTTONS_ACTIVITIES['BUTTON_ADD_ACTIVITY']]];//get datas from button id 
            \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            $this->_model->setClassVarsValues($model);
            \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
            $this->_model->append();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_ACTIVITIES['BUTTON_DEL_ACTIVITY'], $datas)){
                $this->_model->getAll();//restore model
                $id = $datas[$this->_BUTTONS_ACTIVITIES['BUTTON_DEL_ACTIVITY']];
                \Logger::getInstance()->logDebug(__CLASS__.' DEL to model ->  id : '.  $id);
                if(!$this->_model->deleteFromId($id)){
                    $this->modalParameters = new ModalParameters('Impossible de supprimer cette activité', 'Cette activité est utilisé par une ou des compétences déjà définies  ');
                }
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
            $this->_model->getAll();//restore model
            $nameAndId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            \Logger::getInstance()->logDebug(__CLASS__.' AJAX datas -> id : '.$nameAndId.' val : '.$val);
            $nameAndId = explode('#',$nameAndId);
            $name=$nameAndId[0];
            $id= $nameAndId[1];
            $this->_model->update($name, $val, $id);
            return true;
        }
        return false;
    }
    
    ///////////// skills definitions methods

    public function skillDefinition(){
        try{
            $this->_model = new SkillsReferenceDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();//restore model
                    $this->_model->addBlank();//force new input on form
                    $this->buildViewSkillDefinition();
                    $this->sendModelView('SkillsReferenceDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            $this->_model->getAll();//restore model for processing
                            if($this->computeSkill($this->_request->request->all()) === true){ //continue processing 
                                $this->_model->getAll();//restore model->update view model
                                $this->_model->addBlank();//force new input on form 
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
                            $this->computeXmlHttpRequestSkillDefinition($this->_request->request->all());
                        }     
                    }else{// direct url access
                        $this->_model->getAll();//restore model
                        $this->_model->addBlank();//force new input on form
                        $this->buildViewSkillDefinition();
                        $this->sendModelView('SkillsReferenceDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();//restore model
                    $this->_model->addBlank();//force new input on form
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
        $formArray['INDEX'] = $this->_index.'/competence';
        foreach ($this->_BUTTONS_SKILLS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->buildSkillDefinitionFooterView();
    }
    
    public function buildSkillDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/competence';
        $this->_modelView['footer'] = $footer;
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
                \Logger::getInstance()->logDebug(__CLASS__.' Params from form : '.print_r($params, true));
                //\Logger::getInstance()->logDebug(__CLASS__.' ID ADD BUTTON : '.$datas[$this->_BUTTONS_NAMES['BUTTON_ADD_NAME']]);
                $model = $params[$datas[$this->_BUTTONS_SKILLS['BUTTON_ADD_SKILL']]];//get datas from button id --> skill id
                \Logger::getInstance()->logDebug(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
                $this->_model->setClassVarsValues($model);
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
                $this->_model->append();
                return true;
                break;
            case $this->_BUTTONS_SKILLS['BUTTON_BIND_ACTIVITY'] : 
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE ADD: --'.print_r($this->_model->getMembersModel(), true));
                $varsModel = $this->_model->getClassVars();
                $params = $this->findAllParamsFromForm($datas, $varsModel);
                //add only the right row
                $skillId = $datas[$this->_BUTTONS_SKILLS['BUTTON_BIND_ACTIVITY']];//get datas from button id --> skill id
                $model = $params[$skillId];
                \Logger::getInstance()->logDebug(__CLASS__.' BIND Activity to skill : ADD to model ->  val : '.  print_r($skillId, true));
                $this->_model->setClassVarsValues($model);
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model AFTER ADD: --'.print_r($this->_model->getMembersModel(), true));
                $this->_model->bindActivityToSkill($skillId);
                return true;
                break;
            case $this->_BUTTONS_SKILLS['BUTTON_FREE_ACTIVITY'] :
                \Logger::getInstance()->logDebug(__CLASS__.'-- Members model BEFORE FREE Activity: --'.print_r($this->_model->getMembersModel(), true));
                $freeParams = explode('#',$datas[$this->_BUTTONS_SKILLS['BUTTON_FREE_ACTIVITY']]);
                $this->_model->freeBindedActivity($freeParams[0], $freeParams[1]);// skill id , activity id selected
                return true;
                break;
            case $this->_BUTTONS_SKILLS['BUTTON_DEL_SKILL'] : 
                $skillId = $datas[$this->_BUTTONS_SKILLS['BUTTON_DEL_SKILL']];
                $this->_model->deleteFromId($skillId);
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
    public function computeXmlHttpRequestSkillDefinition($datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){
            \Logger::getInstance()->logDebug(__CLASS__.'-- RAW POST -- '.print_r($datas, true));
            $this->_model->getAll();//restore model
            $nameAndId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            \Logger::getInstance()->logDebug(__CLASS__.' AJAX datas -> id : '.$nameAndId.' val : '.$val);
            $nameAndId = explode('#',$nameAndId);
            $name=$nameAndId[0];
            if($name==='activityChoosenForSkill'){//activity update for a given skill 
                $skillId = $nameAndId[1];
                $oldIdActivity = $nameAndId[2];
                $this->_model->update($name, $val, array('skillId'=>$skillId, 'idActivityToUpdate'=>$oldIdActivity));
            }else{//skill update
                $id= $nameAndId[1];
                $this->_model->update($name, $val, $id);
            }
            return true;
        }
        return false;
    }
    
    ///////////// professionnal skill definitions methods
    
    public function professionalSkillDefinition(){
        try{
            $this->_model = new ProfessionalSkillDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();
                    $this->_model->addBlank();;//force new input on form
                    $this->buildSendViewProfessionalSkillDefinition();
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computeFonctionDefinition($this->_request->request->all()) === true){
                                $this->_model->getAll();
                                $this->_model->addBlank();;//add new input on form
                                $this->buildSendViewProfessionalSkillDefinition();
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->redirectTo($this->_index);
                            }
                        }else {//if AJAX don't response to client -- controller still running
                            $this->computeXmlHttpRequestProfessionalSkillDefinition($this->_request->request->all());
                        } 
                    }else{//direct url access
                        $this->_model->getAll();
                        $this->_model->addBlank();//add new input on form
                        $this->buildSendViewProfessionalSkillDefinition();
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll(); // retrieve datas 
                    $this->_model->addBlank();//force new input on form
                    $this->buildSendViewProfessionalSkillDefinition();
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
    
    public function buildSendViewProfessionalSkillDefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/attitude_professionnelle';
        foreach ($this->_BUTTONS_FUNCTIONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->buildProfessionalSkillDefinitionFooterView();
        $this->sendModelView('ProfessionalSkillDefinition');
    }
    
    public function buildProfessionalSkillDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/attitude_professionnelle';
        $this->_modelView['footer'] = $footer;
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function computeProfessionalSkillDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.'raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_FUNCTIONS['BUTTON_ADD_FUNCTION'], $datas)){ //add button
            $varsModel = $this->_model->getClassVars();
            Logger::getInstance()->logDebug(__CLASS__.'properties model : '.print_r($varsModel, true));
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            Logger::getInstance()->logInfo(__CLASS__.' all params : '.  print_r($params, true));
            $model = $params[$datas[$this->_BUTTONS_FUNCTIONS['BUTTON_ADD_FUNCTION']]];//get datas from button id 
            $this->_model->setClassVarsValues($model);
            Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            $this->_model->append();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_FUNCTIONS['BUTTON_DEL_FUNCTION'], $datas)){ //del button
                $id = $datas[$this->_BUTTONS_FUNCTIONS['BUTTON_DEL_FUNCTION']];
                $this->_model->deleteFromId($id); 
                return true;
            }else{ //main submit all done
                return false;
            }
        }
    }
    
    /**
     * -update value from AJAX event
     * @param array $datas
     *      AJAX_ID = propertyName#Id_Or_Key_for_this_property
     *      AJAX_VAL = value to be updated
     * @return boolean
     */
    public function computeXmlHttpRequestProfessionalSkillDefinition(array $datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
            $params = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            $params = explode('#',$params);
            $property=$params[0];
            $id= $params[1];
            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> property : '.$property.' val : '.$val.'  id : '.$id);
            $this->_model->update($property, $val, $id);
            return true;
        }
    }
    
    ///////////// promotions definitions methods
    
    public function promotionDefinition(){
        try{
            $this->_model = new PromotionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->addBlank();//force new input on form
                    $this->_model->getAll();
                    $this->buildViewPromotionDefinition();
                    $this->sendModelView('PromotionDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computePromotionDefinition($this->_request->request->all()) === true){
                                $this->_model->getAll();
                                $this->_model->addBlank();//add new input on form
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
                        }else{
                            $this->computeXmlHttpRequestPromotionDefinition($this->_request->request->all());
                        }
                    }else{//direct url access
                        $this->_model->getAll();
                        $this->_model->addBlank();//add new input on form
                        $this->buildViewPromotionDefinition();
                        $this->sendModelView('PromotionDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();
                    $this->_model->addBlank();//add new input on form
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
        $formArray['INDEX'] = $this->_index.'/promotion';
        //$formArray['INDEX'] = $this->getRootPath().$this->_request->getPathInfo();
        foreach ($this->_BUTTONS_PROMOTIONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->buildPromotionDefinitionFooterView();
    }
    
    public function buildPromotionDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/promotion';
        $this->_modelView['footer'] = $footer;
    }
    
    public function computePromotionDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.'raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_ADD_PROMOTION'], $datas)){
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            Logger::getInstance()->logInfo(__CLASS__.' PARAMS : '.  print_r($params, true));
            $id = $datas[$this->_BUTTONS_PROMOTIONS['BUTTON_ADD_PROMOTION']];//get id to append
            $this->_model->setClassVarsValues($params[$id]);
            Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($params[$id], true));
            $this->_model->append();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION'], $datas)){ //del button
                $id = $datas[$this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION']];
                $this->_model->deleteFromId($id);
                return true;
            }else{ 
                return false;
            }
        }
    }
    
    public function computeXmlHttpRequestPromotionDefinition($datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){
            \Logger::getInstance()->logDebug(__CLASS__.'-- RAW POST -- '.print_r($datas, true));
            $this->_model->getAll();//restore model
            $nameAndId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            \Logger::getInstance()->logDebug(__CLASS__.' AJAX datas -> id : '.$nameAndId.' val : '.$val);
            $nameAndId = explode('#',$nameAndId);
            $name=$nameAndId[0];
            $id= $nameAndId[1];
            $this->_model->update($name, $val, $id);
            return true;
        }
        return false;
    }
    
    ///////////// teachers definitions methods
    
    public function teacherDefinition(){
        try{
            $this->_model = new TeacherDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();//restore
                    $this->buildViewTeacherDefinition();
                    $this->sendModelView('TeacherDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            if($this->computeTeacherXmlHttpRequest($this->_request->request->all())===true){
                                $this->_model->getAll();//update view
                                $this->buildViewTeacherDefinition();
                                $this->sendModelView('TeacherDefinition');
                            }
                        }else{
                            if($this->computeTeacherDefinition($this->_request->request->all()) === true){
                                $this->_model->getAll();//update view
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
                        $this->_model->getAll();//restore
                        $this->buildViewTeacherDefinition();
                        $this->sendModelView('TeacherDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();//restore
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
        $formArray['INDEX'] = $this->_index.'/enseignant';
        foreach ($this->_BUTTONS_TEACHERS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->buildTeacherDefinitionFooterView();
    }
    
    public function buildTeacherDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/enseignant';
        $this->_modelView['footer'] = $footer;
    }
    
    public function computeTeacherDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
        $varsModel = $this->_model->getClassVars();
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        $this->_model->setClassVarsValues($params);
        //check buttons
        $a = array_intersect(array_keys($datas), array_values($this->_BUTTONS_TEACHERS));
        $button = array_shift($a);
        \Logger::getInstance()->logDebug(__CLASS__.'-- BUTTON Trigged--> : '.print_r($button, true));
        switch ($button){
            case $this->_BUTTONS_TEACHERS['BUTTON_CREATE_TEACHER']:
                $this->_model->set_editFormVisible(1);
                $this->_model->addBlank();
                return true;
            case $this->_BUTTONS_TEACHERS['BUTTON_EDIT_TEACHER']:
                $this->_model->set_editFormVisible(1);
                //retrieve teacher infos
                $teacherDatas = $this->_model->get_teachersList();
                $teacherId = array_keys($teacherDatas);
                $this->_model->update('_teacherId',$teacherId[0]);
                return true;
            case $this->_BUTTONS_TEACHERS['BUTTON_ADD_TEACHER']:
//                Logger::getInstance()->logDebug(__CLASS__.' button add trigged');
//                Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
//                Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
//                Logger::getInstance()->logDebug(__CLASS__.' teacherId : '.print_r($this->_model->get_teachersList(), true));
                $this->_model->append();
                $this->_model->set_editFormVisible(0);
                return true;
            case $this->_BUTTONS_TEACHERS['BUTTON_DEL_TEACHER']:
                $teacherDatas = $this->_model->get_teachersList();
                $teacherId = array_keys($teacherDatas);
                $this->_model->deleteFromId($teacherId[0]);
                return true;
            case $this->_BUTTONS_TEACHERS['BUTTON_IMPORT_TEACHER']:
                $this->_model->set_importFormVisible(1);
                return true;
            case $this->_BUTTONS_TEACHERS['BUTTON_CHOOSE_IMPORT_TEACHER']:
                //FIXME : to be done
                $this->_model->set_importFormVisible(0);
                return true;
            default : //submit form, all done
                return false;
        }
    }
    
    public function computeTeacherXmlHttpRequest($datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
            $nameId = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
            if($nameId==='_teachersList'){
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
                    $this->_model->addBlank();//force new input on form
                    $this->_model->getAll();
                    $this->buildViewWorkdateDefinition();
                    $this->sendModelView('WorkDateDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if(!$this->_request->isXmlHttpRequest()){ 
                            if($this->computeWorkDateDefinition($this->_request->request->all()) === true){
                                $this->_model->getAll();
                                $this->_model->addBlank();//add new input on form
                                $this->buildViewWorkdateDefinition();
                                $this->sendModelView('WorkDateDefinition');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_redirect = new RedirectResponse($this->_index);
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_redirect->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                                $this->_redirect->send();
                            }
                        }else{
                            $this->computeXmlHttpRequestWorkDateDefinition($this->_request->request->all());
                        }
                    }else{//direct url access
                        $this->_model->getAll();
                        $this->_model->addBlank();//add new input on form
                        $this->buildViewWorkdateDefinition();
                        $this->sendModelView('WorkDateDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();
                    $this->_model->addBlank();//add new input on form
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
        $formArray['INDEX'] = $this->_index.'/stage';
        foreach ($this->_BUTTONS_PROMOTIONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
        $this->buildWorkDateDefinitionFooterView();
    }
    
    public function buildWorkDateDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['INDEX'] = $this->_index.'/stage';
        $this->_modelView['footer'] = $footer;
    }
    
    public function computeWorkDateDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.'::'.__METHOD__.'-->raw post :'.  print_r($datas, true));
        //check buttons
        if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_ADD_PROMOTION'], $datas)){
            $varsModel = $this->_model->getClassVars();
            $params = $this->findAllParamsFromForm($datas, $varsModel);
            $id = $datas[$this->_BUTTONS_PROMOTIONS['BUTTON_ADD_PROMOTION']];
            $model=$params[$id];
            //foreach($params as $model){
                $this->_model->setClassVarsValues($model);
                Logger::getInstance()->logInfo(__CLASS__.' ADD to model ->  val : '.  print_r($model, true));
            //}
            $this->_model->append();
            return true;
        }else{
            if(array_key_exists($this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION'], $datas)){ //del button
                $id = $datas[$this->_BUTTONS_PROMOTIONS['BUTTON_DEL_PROMOTION']];
                $this->_model->deleteFromId($id);
                return true;
            }else{ 
                if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
                        return true;
                }
                    return false;
            }
        }
    }
    
    /**
     * -update value from AJAX event
     * @param array $datas
     *      AJAX_ID = propertyName#Id_Or_Key_for_this_property
     *      AJAX_VAL = value to be updated
     * @return boolean
     */
    public function computeXmlHttpRequestWorkDateDefinition(array $datas){
        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
            $params = $datas['AJAX_ID'];
            $val = $datas['AJAX_VAL'];
            $params = explode('#',$params);
            $property=$params[0];
            $id= $params[1];
            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> property : '.$property.' val : '.$val.'  id : '.$id);
            $this->_model->update($property, $val, $id);
            return true;
        }
    }
    
    
    ///////////// admin password definitions methods
   
    public function adminPasswordDefinition(){
        try{
            $this->_model = new PasswordDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->buildViewPasswordDefinition();
                    $this->sendModelView('PasswordDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            if($this->computeAdminPasswordXmlHttpRequest($this->_request->request->all())===true){
                                $this->buildViewPasswordDefinition();
                                $this->sendModelView('PasswordDefinition');
                            }
                        }else{
                            if($this->computePasswordDefinition($this->_request->request->all()) === true){
                                $this->buildViewPasswordDefinition();
                                $this->sendModelView('PasswordDefinition');
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
                        $this->buildViewPasswordDefinition();
                        $this->sendModelView('PasswordDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->buildViewPasswordDefinition();
                    $this->sendModelView('PasswordDefinition');
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
    
    public function buildViewPasswordDefinition(){
        $txt = array(   'TXT_HEADER1' => 'Modification du mot de passe administrateur',
                        'TXT_HEADER2' => 'Dans ce formulaire vous allez pouvoir modifier le mot de passe administrateur',
                        'TXT_FORM'=> 'Informations relatives au mot de passe de l\'administrateur de l\'application SESE'
                );
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        foreach ($txt as $t=>$val){
            $formArray[$t]=$val;
        }
        $formArray['INDEX'] = $this->_index.'/acces';
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
    }
    
    ///////////// documents definitions methods
    
    public function documentDefinition(){
        try{
            $this->_model = new DocumentDefinitionModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();
                    $this->buildViewDocumentDefinition();
                    $this->sendModelView('DocumentDefinition');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            $this->computeDocumentDefinitionXmlHttpRequest($this->_request->request->all());
                        }else{
                            $this->computeDocumentDefinition($this->_request->request->all());
                            $this->_state = self::STOPPED;
                            //redirect to welcome admin page
                            $this->_redirect = new RedirectResponse($this->_index);
                            // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                            $this->_redirect->prepare($this->_request);  
                            Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil administrateur');
                            $this->_redirect->send();
                        }
                    }else{//direct url access
                        $this->_model->getAll();
                        $this->buildViewDocumentDefinition();
                        $this->sendModelView('DocumentDefinition');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();
                    $this->buildViewDocumentDefinition();
                    $this->sendModelView('DocumentDefinition');
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
    
    public function buildViewDocumentdefinition(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/document';
        $this->buildBodyView($formArray);
        $this->buildDocumentDefinitionFooterView();
    }
        
    
    public function buildDocumentDefinitionFooterView(array $void=null){
        parent::buildFooterView();
        $footer = $this->_modelView['footer'];
        $footer['DOC']=$this->_model->get_documentContent();
        $footer['TITLE']=$this->_model->get_documentSubject();
        $footer['INDEX'] = $this->_index.'/document';
        $this->_modelView['footer'] = $footer;
    }


    public function computeDocumentDefinition($datas){
        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
        $varsModel = $this->_model->getClassVars();
        Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
        $this->_model->setClassVarsValues($params);
        $this->_model->append();
        Logger::getInstance()->logDebug(__CLASS__.' acces au document : '.print_r($this->_model->get_access(), true));
    }
    
    public function computeDocumentDefinitionXmlHttpRequest($datas){
        Logger::getInstance()->logDebug(__CLASS__.' AJAX : '.print_r($datas,true));
        if(in_array('document_change', $datas)){
            $this->_model->update('_docName', $datas['AJAX_VAL']);
            $send = json_encode(array('title'=> $this->_model->get_documentSubject(),'doc'=>  $this->_model->get_documentContent()));
//            Logger::getInstance()->logDebug(__CLASS__.' SEND : '.print_r($send,true));
//            $send = json_encode(array('title'=> 'titre test tests tests ','doc'=>  'kjqsghdqsjkhdgqskdjhqsgsdkj'));
            echo $send;
        }
    }
    
    
    
    
    
}
