<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Exception\InternalException;
use Logger;
use Model\WelcomeTutorModel;
use Model\DisplayDocumentModel;
use Model\TutorTraineeListModel;
use Model\InternalContactModel;
use Model\TutorTraineeActivityListModel;
use Model\TutorEvaluateSkillTraineeModel;
use Model\PasswordDefinitionModel;

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
        //menu entries
        $this->_modelView['header'] = array(
                'TUTORDOCUMENT'=> $this->_index.'/document',
                'INTERNAL_CONTACT'=> $this->_index.'/contact_interne',
                'TUTOR_LIST'=> $this->_index.'/liste_stagiaire',
                'ACTIVITIES_LIST' => $this->_index.'/liste_activites',
                'EVALUATE' => $this->_index.'/evaluation_stagiaire',
                'TUTORPASS' => $this->_index.'/mot_de_passe'
            );
    }
   
    ///////////// tutor welcome
    public function welcome(){// stateless
        setlocale(LC_TIME, 'fr_FR.UTF8');
        $date = strftime('%A %d %B %Y');
        $this->_model=new WelcomeTutorModel();
        $this->_model->getAll();
        $formArray = $this->getValuesFromModelToForm();
        $formArray['DATE'] = $date;
        $this->buildBodyView($formArray);
        $this->sendModelView('TutorWelcome');
    }
    
    ///////////// tutor documents list
    
    public function tutorDocumentList(){// stateless
        $this->_model=new DisplayDocumentModel();
        $this->_model->getAll();
        $formArray = $this->getValuesFromModelToForm();
        $this->buildBodyView($formArray);
        $this->sendModelView('DisplayDocument');
    }
    
    ///////////// tutor trainee list
    public function traineeList(){// stateless
        $this->_model=new TutorTraineeListModel;
        $this->_model->getAll();
        $formArray = $this->getValuesFromModelToForm();
        $this->buildBodyView($formArray);
        $this->sendModelView('TutorTraineeList');
    }
    
    ///////////// tutor internal contact methods
    
    public function tutorContact() {
        try{
            $this->_model=new InternalContactModel();
            switch ($this->_state){ 
                case self::IDLE :
                    $this->_state = self::RUNNING;
                    $this->buildTutorContactView();
                    $this->sendModelView('InternalContact');  
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->computeTutorContact($this->_request->request->all()) === true){
                            $this->modalParameters = new ModalParameters('Erreur d\'adresse mél', 'Vérifiez votre adresse mél destinataire ');
                            $this->buildTutorContactView();
                            $this->sendModelView('InternalContact');
                        }else{
                            $this->_state = self::STOPPED;
                            //redirect to welcome page
                            $this->_response = new RedirectResponse($this->_index);
                            // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                            $this->_response->prepare($this->_request);  
                            Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil tuteur');
                            $this->_response->send();
                        }
                        
                    }else{//direct url access
                        $this->buildTutorContactView();
                        $this->sendModelView('InternalContact');
                    }
                    
                    break;
                case self::STOPPED:
                    $this->_state = self::RUNNING;
                    $this->buildTutorContactView();
                    $this->sendModelView('InternalContact');  
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
    
    public function buildTutorContactView(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/contact_interne';
        $this->buildBodyView($formArray);
    }
    
    public function computeTutorContact(array $datas){
        Logger::getInstance()->logDebug(__CLASS__.'::'.__METHOD__.'  raw post : '.print_r($datas, true));
        $varsModel = $this->_model->getClassVars();
        Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
        $this->_model->setClassVarsValues($params);
        return !$this->_model->sendMail();
    }
    
    ///////////// tutor activity list
    
    public function traineeActivityList(){// stateless
        $this->_model=new TutorTraineeActivityListModel();
        $this->_model->getAll();
        $formArray = $this->getValuesFromModelToForm();
        $this->buildBodyView($formArray);
        $this->sendModelView('TutorTraineeActivityList');
    }
    
    ///////////// evaluate skills of trainee
    
    public function evaluateTrainee(){
        try{
            $this->_model = new TutorEvaluateSkillTraineeModel();
            switch ($this->_state){
                case self::IDLE :
                    $this->_model->getAll();
                    $this->buildView();
                    $this->sendModelView('TutorEvaluateSkillTrainee');
                    $this->_state = self::RUNNING;
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            if($this->computeWorkDefinitionXmlHttpRequest($this->_request->request->all())===true){
                                $this->buildView();
                                $this->sendModelView('TutorEvaluateSkillTrainee');
                            }
                        }else{
                            if($this->computeEvaluateSkillTrainee($this->_request->request->all()) === true){
                                $this->_model->getAll();//update
                                $this->buildView();
                                $this->sendModelView('TutorEvaluateSkillTrainee');
                            }else{
                                $this->_state = self::STOPPED;
                                //redirect to welcome admin page
                                $this->_response = new RedirectResponse($this->_index);
                                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                                $this->_response->prepare($this->_request);  
                                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers l\'accueil tuteur');
                                $this->_response->send();
                            }
                        }
                    }else{//direct url access
                        $this->_model->getAll();
                        $this->buildView();
                        $this->sendModelView('TutorEvaluateSkillTrainee');
                    }
                    break;
                case self::STOPPED:
                    $this->_model->getAll();
                    $this->buildView();
                    $this->sendModelView('TutorEvaluateSkillTrainee');
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
    
    public function buildView(){
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        $formArray['INDEX'] = $this->_index.'/evaluation_stagiaire';
        foreach ($this->_BUTTONS as $bCtrl => $bForm){
            $formArray[$bCtrl] = $bForm;
        }
        $this->buildBodyView($formArray);
    }
    
    public function computeEvaluateSkillTrainee($datas){
        Logger::getInstance()->logDebug(__CLASS__.' raw post :'.  print_r($datas, true));
        $varsModel = $this->_model->getClassVars();
        Logger::getInstance()->logDebug(__CLASS__.' model vars : '.print_r($varsModel, true));
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        Logger::getInstance()->logDebug(__CLASS__.' params : '.print_r($params, true));
        $r = $this->_model->setClassVarsValues($params);
        Logger::getInstance()->logDebug(__CLASS__.' set resultat  : '.print_r($this->_model->get_results(), true));
        $this->_model->append();
        return false;
    }
    
    public function computeWorkDefinitionXmlHttpRequest($datas){
//        if(array_key_exists('AJAX_UPDATE', $datas)){ // client's javascript event
//            $nameId = $datas['AJAX_ID'];
//            $val = $datas['AJAX_VAL'];
//            Logger::getInstance()->logInfo(__CLASS__.' AJAX datas -> name id : '.$nameId.' ::: val : '.$val);
//            if($nameId==='teacherChoosenForUpdate'){
//                $this->_model->selectTeacher($val);
//            }
//            return true;//update view
//        }else{
            return false; //nothing to update
//        }
    }
    
    /////////////  password update methods
   
    public function passwordDefinition(){
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
        $txt = array(   'TXT_HEADER1' => 'Modification de votre mot de passe',
                        'TXT_HEADER2' => 'Dans ce formulaire vous allez pouvoir modifier le mot de passe',
                        'TXT_FORM'=> 'Informations relatives à votre mot de passe dans l\'application SESE'
                );
        $formArray = $this->buildCompleteFormArray();
        $formArray = array_merge($formArray, $this->getValuesFromModelToForm());
        foreach ($txt as $t=>$val){
            $formArray[$t]=$val;
        }
        $formArray['INDEX'] = $this->_index.'/';
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
