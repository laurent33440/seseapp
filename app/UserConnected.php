<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use SeseSession;

/**
 * Description of UserConnected
 *
 * @author laurent
 */
class UserConnected {
    private static $_instance;
    private $session;
    
    public function __construct($debug=false){
      if($debug){
          $this->session = SeseSession::getDebugInstance(); //dev, debug
      }else{
          $this->session = SeseSession::getInstance();
      }
    }
    
    final public static function getInstance () {
            if (!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
    }
    
    public function setUserName($userName){
        $this->session->set('user_connected/name', $userName);
    }

    public function setUserGroup($userGroup) {
        $this->session->set('user_connected/group', $userGroup);
    }
    
    public function getUserName() {
        return $this->session->get('user_connected/name');
    }

    public function getUserGroup() {
        return $this->session->get('user_connected/group');
    }
    
    public function isUserConnected(){
        return $this->session->has('user_connected/name') && $this->session->has('user_connected/group');
    }
    
    
    public function eraseUserInSession(){
        if($this->session->has('user_connected/name')){
            $this->session->remove('user_connected/name');
            $this->session->remove('user_connected/group');
        }
    }


}
