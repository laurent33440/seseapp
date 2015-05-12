<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\ModelDb\Utilisateurs\UtilisateursObject;
//use Model\Dal\ModelDb\Groupe\GroupeObject;
//use Model\Dal\ModelDb\Parametres\ParametresObject;
use Model\Dal\DbLibrary\DataAccess;
use Model\AModel;
use Bootstrap;

/**
 * Description of LoginModel
 *
 * @author laurent
 */
class LoginModel extends AModel{
    /**
     * View model
     */
    private $_userName='unknown';
    private $_userPass='secret';

    /**
     * Db object
     * @var UtilisateursObject
     */
    protected $_user;
    
    /**
     * group name for user known 
     */
    protected $_groupNameOfUser='unknown';
    
    public function __construct() {
        ;
    }
    
    public function set_userName($userName) {
        $this->_userName = $userName;
    }

    public function set_userPass($userPass) {
        $this->_userPass = $userPass;
    }

    public function get_userName() {
        return $this->_userName;
    }

    public function get_userPass() {
        return $this->_userPass;
    }

    function get_groupNameOfUser() {
        return $this->_groupNameOfUser;
    }

    
    public function isUserKnown(){
        $collection = new DataAccess('Utilisateurs');
        $users = $collection->GetAll();
        foreach ($users as $this->_user) {
//            echo $this->_user->id_utilisateur;
//            echo $this->_user->uti_identifiant;
//            echo $this->_user->uti_mel;
//            echo '--';
            if(($this->_user->uti_identifiant===$this->_userName)&&($this->_user->uti_mot_de_passe===$this->_userPass)){
                //get groupe
                $groups = new DataAccess('Groupe');
                $groupeObject = $groups->GetByID($this->_user->id_groupe);
                $this->_groupNameOfUser = $groupeObject->grp_nom_groupe;
                //add user name and group to table 'Parametres'
//                $userParam = new ParametresObject();
//                $userParam->par_code_parametre="user_connected";
//                $userParam->par_libelle_parametre=  $this->_user->uti_identifiant;
//                $userParam->par_valeur_parametre = $groupeObject->grp_nom_groupe;
//                $params = new DataAccess('Parametres');
//                $params->Insert($userParam);
                return true;
            }
        }
        return false;
    }
    
    /**
     * save user infos in session
     */
    public function saveUserInSession(){
        \SeseSession::getInstance()->set('user_connected/name', $this->_userName);
        \SeseSession::getInstance()->set('user_connected/group', $this->_groupNameOfUser);
    }
    
    /**
     * erase user saved in session
     */
    public function eraseUserInSession(){
        if(\SeseSession::getInstance()->has('user_connected/name')){
            \SeseSession::getInstance()->remove('user_connected/name');
            \SeseSession::getInstance()->remove('user_connected/group');
        }
    }
    
}
