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
use Model\LostPasswordModel;
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
    
    ///////////////////// Login handling methods ///////////////////////////////
    /**
     * Login page Handling
     */
    public function login(){
        $this->_model=new LoginModel();
        try{
            switch ($this->_state){ 
                case self::IDLE :
                    $this->_state = self::RUNNING;
                    $this->buildSendViewLogin(); 
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->compute($this->_request->request->all()) === true){ //continue processing : wrong parameters
                            $this->modalParameters = new ModalParameters('Erreur d\'authentification', 'Vérifiez votre identifiant et/ou votre mot de passe ');
                        }else{ //authentication done
                            $this->_state=self::IDLE;
                            //fire good controller
                            $this->_response->send();
                        }   
                    }
                    $this->buildSendViewLogin();
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
    
    public function buildSendViewLogin(){
        $formArray = $this->buildCompleteFormArray();
        $formArray['INDEX'] = '/';
        $formArray['ABOUT'] = $this->_index.'apropos';
        $formArray['LOSTPASSWORD'] = $this->_index.'identification';
        $this->buildBodyView($formArray);
        $this->sendModelView('Login');  
    }
    
    /**
     * Compute datas from form
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
    
    ///////////////////// About handling methods ///////////////////////////////
    /**
     * About page information
     */
    public function about() {
        $formArray['INDEX'] = '/';
        $this->buildBodyView($formArray);
        $this->sendModelView('About');  
    }
    
    ///////////////////// Lost password handling methods ///////////////////////
    /**
     * Lost password page handling
     */
    public function lostPassword(){
        $this->_model= new LostPasswordModel();
        try{
            switch ($this->_state){ 
                case self::IDLE :
                    $this->_state = self::RUNNING;
                    $this->buildSendViewLostPassword();  
                    break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->checkMail($this->_request->request->all()) === false){ //continue processing : wrong parameters
                            $this->modalParameters = new ModalParameters('Erreur d\'adresse mél', 'Vérifiez la justesse du mél renseigné ');
                        }else{// email seems ok
                            //send email with new password
                            if(!$this->_model->sendNewPassword()){
                                $this->modalParameters = new ModalParameters('Erreur sur l\'envoie du mél ...', 'Le service de messagerie ne peut accéder à votre mél. Contactez votre administrateur si nécessaire');
                            }else{
                                $this->modalParameters = new ModalParameters('Mél envoyé', 'Consultez votre boite mél. Un nouveau mot de passe vous a été fourni');
                            }
                        }   
                    }
                    $this->buildSendViewLostPassword();
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
    
    public function buildSendViewLostPassword(){
        $formArray = $this->buildCompleteFormArray();
        $formArray['INDEX'] = '/';
        $formArray['CHECK'] = $this->_index.'identification';
        $this->buildBodyView($formArray);
        $this->sendModelView('LostPassword');  
    }
    
    public function checkMail(array $datas){
        $varsModel = $this->_model->getClassVars();
        $params = $this->findAllParamsFromForm($datas, $varsModel);
        $this->_model->setClassVarsValues($params);
        return $this->_model->isMailKnown(); 
    }
    
    
    
    
    
    
    
}
