<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Exception\InternalException;
use Model\LoginModel;
use Logger;


/**
 * Description of LoginController
 *
 * @author laurent
 */
class LoginController extends AControllerState{
    
    /**
     * response to login
     * @var use Symfony\Component\HttpFoundation\RedirectResponse;
     */
    private $_response; 
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
    }
    
    public function check(){
        $this->_model=new LoginModel();
        //$this->_model->eraseUserInSession();
        if($this->_request->isMethod('POST')){
            if($this->compute($this->_request->request->all()) === true){ //continue processing : wrong parameters
                $this->modalParameters = new ModalParameters('Erreur d\'authentification', 'Vérifiez votre identifiant et/ou votre mot de passe ');
                $this->_state=self::RUNNING;
                $this->sendModelView();
            }else{ //authentication done
                $this->_state=self::IDLE;
                //fire good controller
                $this->_response->send();
            }   
        }else{ //first view
            $this->_state=self::RUNNING;
            $this->sendModelView();
        }
    }
    
//    protected function buildHeaderView(array $a=null){
//        $model = new \Model\HeaderModel();
//        $this->_modelView['header'] = array('SCHOOL_NAME'=>$model->get_schoolName(),
//                                            'COURSE_NAME'=>$model->get_courseName(),
//                                            'STUDY_YEAR'=>$model->get_studyYear(),
//                                            );
//    }
    
    public function buildBodyView(array $a=null){
        $formArray = $this->buildCompleteFormArray();
        $formArray['INDEX'] = '/';
        $formArray['ABOUT'] = \Bootstrap::ENTRY_SCRIPT.'/apropos';
        $this->_modelView['body'] = $formArray;
    }
    
    /**
     * Acts toward events from form :
     * -Add new value to model
     * -Del value from model
     * -valide submit form
     * @param array $datas : posted datas from form 
     * @return boolean true if controller must run for further inputs , false if submit form
     */
    public function compute(array $datas){
        $varsModel = $this->_model->getClassVars();
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        $this->_model->setClassVarsValues($params);
        if($this->_model->isUserKnown()){
            //get groupe name
            $grpName = $this->_model->get_groupNameOfUser();
            if($grpName != false){
                //save user known
                $this->_model->saveUserConnected();
                $this->_response = new RedirectResponse(\Bootstrap::ENTRY_SCRIPT.'/'.$grpName);
                // see symfony: Avant d'envoyer la réponse, vous devez vous assurer qu'elle est conforme avec les les spécifications HTTP en appelant la méthode prepare(): 
                $this->_response->prepare($this->_request);  
                Logger::getInstance()->logInfo('Class '.__CLASS__. ' -- Redirect to '.$grpName.' for user :'.$this->_model->get_userName());
            }else{
                Logger::getInstance()->logFatal('Class '.__CLASS__. ' -- Group name '.$grpName.' unknown for user :'.$this->_model->get_userName());
                throw new InternalException('Class '.__CLASS__. ' -- Group name '.$grpName.' unknown for user :'.$this->_model->get_userName());
            }
        }else{
            return true; //continue running
        }
    }
    
}
