<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use View\ViewHandler;
use Logger;
use Bootstrap;
use Version;

/**
 * FIXME : fat class must be split...
 * @author laurent
 */

abstract class AControllerState {
    //state consts
    const IDLE='idle';
    const RUNNING='running';
    const STOPPED = 'stopped';
    const TERMINATED = 'terminated';
    const REDIRECT = 'redirect';
    const ON_INPUT_ERROR = 'onInputError';
    const ON_CRITICAL_ERROR = 'onCriticalError';
    
    protected $_request;
    
    protected $_rootName;// controller name
    
    protected $_action; //action to be performed by controller
    
    protected $_index; //index to post from form
    
    //redirect
    // @var use Symfony\Component\HttpFoundation\RedirectResponse; 
    protected $_redirect; 
    
    
    // state members
    protected $_state;
    protected $_error;
    
    //model views members
    protected $_modelView;
    protected $_viewHandler;
    protected $_model;
    protected $modalParameters = null;
    
    public function __construct(Request $request, $action) {
        $this->_request = $request;
        $this->_action=$action;
        $cl = new \ReflectionClass($this);
        $all = explode('Controller',$cl->getShortName());
        $this->_rootName = $all[0];
        if(!$this->_state = $this->getSavedSequenceState()){
            $this->_state = self::IDLE;
        }
        //OLD - $this->_index=$this->getRootPath().$this->_request->getPathInfo();
        $this->_index=  '/'.\Bootstrap::ENTRY_SCRIPT.'/'.\SeseSession::getInstance()->get('user_connected/group').
        \Logger::getInstance()->logInfo( get_class($this).' restoring state controller : '.$this->_rootName.'::'.$this->_action. '-->'.$this->_state);
    }

    public function __destruct() {
        \Logger::getInstance()->logInfo('destruct : ' .get_class($this));
        \Logger::getInstance()->logInfo( get_class($this).' saving state controller : '.$this->_rootName.'::'.$this->_action. '-->'.  $this->_state);
        $this->saveControllerState($this->_state);
    }
    
    /**
     * FIXME remove this  !
     * @param type $class
     */
    protected function setRootControllerName($class) {
        $tab=  explode('\\',$class); //avoid namespace
        $rootName =  explode("Controller",$tab[count($tab)-1]);
        $this->_rootName = $rootName[0];
    }
    
    /**
     * 
     * @return type
     */
    public function getControllerName() {
        return $this->_rootName;
    }
    
    /**
     * 
     * @param Request $request
     */
    public function setRequest(Request $request){
        $this->_request=$request;
    }
    
    /**
     * 
     * @return type
     */
    protected function getRootPath(){ 
        if(\Bootstrap::DEBUG_SESE)
            $url = '/seseapp/index.php';
        else
            $url = $_SERVER['REQUEST_URI'];
        $all = explode(\Bootstrap::getEntryScript(), $url);
        return $all[0].  \Bootstrap::getEntryScript();
    }
    
    /**
     * 
     * @param type $url
     */
    protected function redirectTo($url){
        $this->_redirect = new RedirectResponse($url);
        // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
        $this->_redirect->prepare($this->_request);  
        Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirection vers : '.$url);
        $this->_redirect->send();
    }


    ////////////////////// STATES METHODS //////////////////////////////////
   
    /**
     * 
     * @return type
     */
    public function getState() {
        return $this->_state;
    }

    /**
     * 
     * @return null
     */
    public function getError() {
        if(isset($this->_error)){
            return $this->_error;
        }else{
            return null;
        }
    }
    
    /**
     * 
     * @return type
     */
    public function isControllerIdle() {
        return $this->_state == self::IDLE;
    }

    /**
     * 
     * @return type
     */
    public function isControllerRunning() {
        return $this->_state == self::RUNNING;
    }
    
    /**
     * 
     * @return type
     */
    public function isControllerStopped() {
        return $this->_state == self::STOPPED;
    }

    /**
     * 
     * @return type
     */
    public function isControllerTerminated() {
        return $this->_state == self::TERMINATED;
    }
    
    /**
     * 
     * @return type
     */
    public function isControllerRedirect() {
        return $this->_state == self::REDIRECT;
    }
    
    /**
     * 
     * @return type
     */
    public function isControllerOnInputError() {
        return $this->_state == self::ON_INPUT_ERROR;
    }
    
    /**
     * 
     * @return type
     */
    public function isControllerOnCriticalError() {
        return $this->_state == self::ON_CRITICAL_ERROR;
    }
    
    /**
     * DEBUG purpose
     */
    public function setStateController($state){
        $this->_state = $state;
    }
        
    /**
     * 
     * @param type $state
     */
    protected function saveControllerState($state){
        \SeseSession::getInstance()->set('state_history/'.$this->_rootName.'/'.$this->_action, $state);
    }
    
    /**
     * 
     * @return null
     */
    protected function getSavedSequenceState(){
        if(\SeseSession::getInstance()->has('state_history/'.$this->_rootName.'/'.$this->_action)){
            return \SeseSession::getInstance()->get('state_history/'.$this->_rootName.'/'.$this->_action);
        }else{
            return null;
        }
    }
    
    
    ////////////////////// MODEL VIEWS METHODS //////////////////////////////////
    
    /**
     * 
     */
    protected function buildHeaderView(array $headerParams=null){
        if(!$headerParams){
            $model = new \Model\HeaderModel();
            $this->_modelView['header'] = array('SCHOOL_NAME'=>$model->get_schoolName(),
                                                'COURSE_NAME'=>$model->get_courseName(),
                                                'STUDY_YEAR'=>$model->get_studyYear(),
                                                'USER_NAME'=>$model->get_userName(),
                                                'USER_GROUP'=>$model->get_userRole(),
//                                                'INDEX'=>  \Bootstrap::APP_URL,
                                                'INDEX'=>  '/',
                //admin space
                'REFERENTIAL'=>  $this->_index.'/referentiel',
                'FUNCTION'=>  $this->_index.'/fonction',
                'ACTIVITY'=>  $this->_index.'/activite',
                'SKILL'=>  $this->_index.'/competence',
                'PROMOTION'=>  $this->_index.'/promotion',
                'TEACHER'=>  $this->_index.'/enseignant',
                'TRAINEE'=> $this->_index.'/stagiaire',
                'WORK_DATE'=>  $this->_index.'/stage',
                'PASSWORD'=>  $this->_index.'/acces',
                //teacher space
                'WORK_DEFINITION'=> $this->_index.'/stage',
                'WORK_VISIT_DEFINITION'=> $this->_index.'/visite',
                'WORK_COMMENT_DEFINITION'=> $this->_index.'/commentaire',
                'INTERNAL_CONTACT'=> $this->_index.'/contact_interne',
                //tutor space
                'TUTOR_LIST'=> $this->_index.'/liste_stagiaire',

                );
                                                
        }else{
            $this->_modelView['header'] = $headerParams;
        }
    }
    
    /**
     * 
     */
    protected function buildBodyView(array $bodyParams=null){
        if(!$bodyParams){
            ; //nothing yet
        }else{
            $this->_modelView['body']=$bodyParams;
        }
    }

    /**
     * 
     */
    protected function buildFooterView(array $footerParams=null){
        if(!$footerParams){
            if($this->modalParameters){
                $footer =  array('INDEX'=>  $this->_index,'URI_COMPANY'=> \Bootstrap::COMPANY_URI, 'SHOW_MODAL'=>'true', 'MODAL_TITLE' => $this->modalParameters->getTitle(), 'MODAL_MESSAGE' => $this->modalParameters->getMessage());
            }else{
                $footer = array('INDEX'=> $this->_index,'URI_COMPANY'=> \Bootstrap::COMPANY_URI, 'SHOW_MODAL' => 'false' );
            }
            $this->_modelView['footer'] = $footer;
        }else{
            $this->_modelView['footer'] = $footerParams;
        }
        
    }
    
    /**
     * Build structural model view  accordingly to template's view
     */
    protected function buildModelView(){
        $this->buildHeaderView();
        $this->buildBodyView();
        $this->buildFooterView();
    }
    
    /**
     * Send model view to client with http's code 200 response
     * @param optional main template view
     */
    protected function sendModelView($templateViewName=null){
        $this->buildModelView();
//        if($templateViewName===null){
//            $templateViewName = $this->getControllerName();
//        }
        $content = ViewHandler::render($this->getControllerName(), $this->_modelView, $templateViewName);
        $response = new Response('',$httpCodeResponse=200, $httpHeaders= array()); // by default -> content-type : text/html; charset=UTF-8
        $response->setContent($content);
        // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
        $response->prepare($this->_request); 
        $response->send();
        
    }

    /**
     * Get Model View send to form builder !!USED ONLY FOR TESTING PURPOSE!!
     * @return array key => value for form structure 
     */
    public function getModelView(){
        return $this->_modelView;
    }

    /**
     * Get Model 
     * @return type
     */
    public function getModel(){
        return $this->_model;
    }
    
    public function setModel($model) {
        $this->_model = $model;
    }

    /**
     * Build a one to one set of 'form name' => 'model attribute name'
     * and 'form place holder name' => 'default values model attribute'
     * 
     * @return array : set of keys => values
     */
    public function buildCompleteFormArray(){
        $keys_form = array();
        $keys_place_holder = array();
        $vars = $this->_model->getClassVars();
        foreach ($vars as $var) {
            $keys_form[]='form'.$var;
            $keys_place_holder[] = 'form_ph'.$var;
        }
        $keys = array_merge($keys_form , $keys_place_holder);
        $values = array_merge($vars , $this->_model->getClassVarsPlaceHolder());
        return  array_combine($keys, $values);
    }
    
    /**
     * Build a one to one set of 'form value name' => 'model value'
     * Support list of values for a member of array type  
     * @return set of 'form_val<member name>' => 'member value'
     */
    public function getValuesFromModelToForm(){
        $model = $this->_model->getClassVarsValues();
        $formValues =array();
        foreach ($model as $member => $value) {
            if(!is_array($value)){
                $formValues['form_val'.$member] = $value;
            }else{
                foreach ($value as $key=>$elt) {
                    $formValues['form_val'.$member][$key] = $elt;
                }
            }
        }
        return $formValues;
    }
    
    /**
     * Find all values from form towards member's model
     * @param array $formDatas : datas from form construct as set of : {<member_name-model>#param1 => value},{<member_name-model>#param1#param2 => value}, mixed datas(keys => values), ...
     * @param array $varsModel : members of model
     * @return two dimensionnals array : ordered dictionnary (member's name => member's values)  
     */
    public function findAllParamsFromForm(array $formDatas, array $varsModel){
        $keysForm = array_keys($formDatas);
        $result = array();
        $matches = array();
        foreach($keysForm as $keyForm) {
            if(!empty($formDatas[$keyForm])){
                if(preg_match('/(?P<param>\w+)##/', $keyForm, $matches) === 1){ //matches complex <form_name-model>##key => value OR <form_name-model>##key#param1#param2#... => value
                    if(in_array($matches['param'], $varsModel)){
                        $parts =explode('##',$keyForm);
                        $args=explode('#',$parts[1]);
                        if(count($args)>1){
                            $t=array();
                            for($i=1; $i<count($args);$i++){
                                $t[] = $args[$i];
                            }
                            $result[$args[0]][] = array($matches['param']=> array_merge(array($formDatas[$keyForm]),$t));
                        }else{
                            $result[$parts[1]][$matches['param']] = $formDatas[$keyForm];
                        }
                    }
                }else{ 
                    if(preg_match('/(?P<param>\w+)#/', $keyForm, $matches) === 1){ // matches <form_name-model>#param1#param2#... => value
                            if(in_array($matches['param'], $varsModel)){
                                $parts =explode('#',$keyForm);
                                $t=array();
                                for($i=1; $i<count($parts);$i++){
                                    $t[] = $parts[$i];
                                }
                                $result[$matches['param']] = array_merge(array($formDatas[$keyForm]),$t);
                            }
                    }else{
                        if(preg_match('/(?P<param>\w+)/', $keyForm, $matches) === 1){// matches simple form_param => value_param
                            if(in_array($matches['param'], $varsModel)){
                                $result[$matches['param']] = $formDatas[$keyForm];
                            }   
                        }
                        
                    }
                }
            }
        }
        return $result;
    }
    
}

/** 
 * Handle Modal Parameters for views
 * 
 */
class ModalParameters{
     private $title='';
     private $message='';
     
     public function __construct($title, $message) {
         $this->title = $title;
         $this->message = $message;
     }
     
     function getTitle() {
         return $this->title;
     }

     function getMessage() {
         return $this->message;
     }

     function setTitle($title) {
         $this->title = $title;
     }

     function setMessage($message) {
         $this->message = $message;
     }
}

?>
