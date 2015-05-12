<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of CreateAdminAccountModel
 *
 * @author prog
 */
class CreateAdminAccountModel extends AModel{
    private $_adminName;
    private $_adminPass;
    private $_adminPassConfirm; // not in db
    private $_adminEmail;
    
    public function getClassVarsPlaceHolder(){
        return array(   'Nom administrateur', 
                        '', 
                        '', 
                        'mél administrateur');
    }
    
    public function set_adminName($_adminName) {
        $this->_adminName = $_adminName;
    }

    public function set_adminPass($_adminPass) {
        $this->_adminPass = $_adminPass;
    }

    public function set_adminPassConfirm($_adminPassConfirm) {
        $this->_adminPassConfirm = $_adminPassConfirm;
    }

    public function set_adminEmail($_adminEmail) {
        $this->_adminEmail = $_adminEmail;
    }
    
    public function get_adminName() {
        return $this->_adminName;
    }

    public function get_adminPass() {
        return $this->_adminPass;
    }

    public function get_adminPassConfirm() {
        return $this->_adminPassConfirm;
    }

    public function get_adminEmail() {
        return $this->_adminEmail;
    }
        
    /**
     * Validate model towards user inputs values
     */
    public function isValide(){
        if($this->_adminPass == $this->_adminPassConfirm){
            return true;
        }else{
            return false;
        }
    }
    
    public function createAdmin(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            $id_grp_admin =1;
            //check if group administrator already exist (id=1)
            $found=false;
            if( $tst = $db->dbQS('Groupe', array('grp_nom_groupe'), 'id_groupe = 1')){
                foreach ($tst as $row){
                    if($row['grp_nom_groupe']== 'administrateur'){
                        $found=true;
                        break;
                    }
                }
            }
            if(!$found){
                //insert "administrateur" in 'Groupe' table - get id
                $id_grp_admin = $db->dbQI(array('grp_nom_groupe'=>'administrateur'), 'Groupe');
            }
            //insert into table 'Utilisateurs'
            $id_admin = $db->dbQI(array('uti_identifiant'=>  $this->_adminName, 
                                            'uti_mot_de_passe'=>  $this->_adminPass,
                                            'uti_mel' => $this->_adminEmail,
                                            'uti_etat_compte' => 'actif',
                                            'uti_derniere_connexion' => null,
                                            'id_groupe' => $id_grp_admin), 
                                    'Utilisateurs');
        }catch (Exception $e){
            echo '</br>Internal Error - creating admin user in db  - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    public function getAdminFromDatabase(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            $users = $db->dbQS('Utilisateurs', array('uti_identifiant', 'uti_mel'), 'id_groupe = 1');
            $admin = $users[0];
            $this->set_adminName($admin['uti_identifiant']);
            $this->set_adminEmail($admin['uti_mel']);
        }catch (Exception $e){
            echo '</br>Internal Error - creating admin user in db  - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    /**
     * 
     * @throws Exception
     */
    public function delAdminFromDataBase(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            $n = $db->dbQD('Utilisateurs', 'id_groupe=1');
            return $n;
        }catch (Exception $e){
            echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }

//    private function is_multiArrayEmpty($multiarray) {
//        if(is_array($multiarray) and !empty($multiarray)){
//            $tmp = array_shift($multiarray);
//                if(!$this->is_multiArrayEmpty($multiarray) or !  $this->is_multiArrayEmpty($tmp)){
//                    return false;
//                }
//                return true;
//        }
//        if(empty($multiarray)){
//            return true;
//        }
//        return false;
//    } 


}
