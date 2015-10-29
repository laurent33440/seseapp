<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\InternalContactModel;

/**
 * Description of LostPasswordModel
 *
 * @author laurent
 */
class LostPasswordModel extends AModel{
    const MESSAGE = "<p> <h2> Mot de passe perdu : </h2> </p> <p> <h3> Voici le mot de passe :</h3></p> <p> __PASSWORD__  </p><p><h3>à utiliser pour accéder à votre espace personnel </h3> </p> ";
    
    //view 
    private $_userMail='unknow@somewhere.org';
    
    public function get_userMail() {
        return $this->_userMail;
    }

    public function set_userMail($_userMail) {
        $this->_userMail = $_userMail;
    }
    
    public function __construct() {
    }
    
    public function isMailKnown(){
        $collection = new DataAccess('Utilisateurs');
        $user = $collection->GetByColumnValue('uti_mel', $this->_userMail);
        if($user===false){
            return false;
        }else{
            return true;
        }
    }
    
    public function sendNewPassword(){
        $msg = self::MESSAGE;
        $password= $this->randomPassword();
        $msg=str_replace('__PASSWORD__', $password, $msg);
        $sender = new InternalContactModel();
        $sender->setEmailTo($this->_userMail);
        $sender->setSubject('Application SESE : Mot de passe perdu');
        $sender->set_message($msg);
        if($sender->sendMailFromProperties()){
            $this->setNewPasswordToUser($password);
            return true;
        }else{
            return false;
        }
    }
    
    private function randomPassword( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%*()_=+?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
    
    private function setNewPasswordToUser($password){
        $collection = new DataAccess('Utilisateurs');
        $user = $collection->GetByColumnValue('uti_mel', $this->_userMail);
        $user->uti_mot_de_passe = $password;
        $collection->Update($user);
    }
    
}
