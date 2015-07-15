<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;


use UserConnected;
use Model\Dal\DbLibrary\DataAccess;
use \Exception\InternalException;

/**
 * Description of AdminPasswordDefinitionModel
 *
 * @author laurent
 */
class PasswordDefinitionModel extends AModel{
    //view
    private $_adminCurrentPassword;
    private $_adminNewPassword;
    private $_adminConfirmPassword;
    
    public function get_adminCurrentPassword() {
        return $this->_adminCurrentPassword;
    }

    public function get_adminNewPassword() {
        return $this->_adminNewPassword;
    }

    public function get_adminConfirmPassword() {
        return $this->_adminConfirmPassword;
    }

    public function set_adminCurrentPassword($_adminCurrentPassword) {
        $this->_adminCurrentPassword = $_adminCurrentPassword;
    }

    public function set_adminNewPassword($_adminNewPassword) {
        $this->_adminNewPassword = $_adminNewPassword;
    }

    public function set_adminConfirmPassword($_adminConfirmPassword) {
        $this->_adminConfirmPassword = $_adminConfirmPassword;
    }
    
    /**
     * Check password consistency to update
     * @return string|boolean : true if password updated, error message else
     * @throws InternalException if user can't be found in session
     */
    public function checkPasswords(){
        //check if user is administrateur
        $user=  UserConnected::getInstance();
        if($user->isUserConnected()){
            //if($session->get('user_connected/group')==='administrateur'){
                //check password administrateur
                $collection = new DataAccess('Utilisateurs');
                $user = $collection->GetByColumnValue('uti_identifiant', $user->getUserName());
                if($user->uti_mot_de_passe === $this->_adminCurrentPassword){
                    //check that new passwords matches
                    if($this->_adminNewPassword===$this->_adminConfirmPassword){
                        //update password
                        $user->uti_mot_de_passe = $this->_adminNewPassword;
                        $collection->Update($user);
                        return true;
                    }else{
                        return 'La confirmation du nouveau mot de passe n\'est pas réalisée';
                    }
                }else{
                    return 'Mot de passe administrateur incorrect!';
                }
                
//            }else{
//                return 'Vous n\'êtes pas administrateur, vous ne pouvez pas changer le mot de passe!';
//            }
            
        }else{
            throw new InternalException('Pas d\'utilisateur connecté enregistré dans la session!!!');
        }
    }

}
