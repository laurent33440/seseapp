<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\ModelDb\Utilisateurs\UtilisateursObject;
use Model\Dal\ModelDb\Etablissement\EtablissementObject;
use Model\Dal\ModelDb\Annee\AnneeObject;
use Model\Dal\ModelDb\Referentiel_de_formation\Referentiel_de_formationObject;
//use Model\Dal\ModelDb\Groupe\GroupeObject;
use Model\Dal\ModelDb\Parametres\ParametresObject;
use Model\Dal\DbLibrary\DataAccess;
use Model\AModel;

/**
 * Description of HeaderModel
 *
 * @author laurent
 */
class HeaderModel {
    
    //view part
    private $_schoolName;
    private $_courseName;
    private $_studyYear;
    private $_userName='unknown user';
    private $_userRole='unknown user role';
    
    
    public function get_schoolName() {
        return $this->_schoolName;
    }

    public function get_courseName() {
        return $this->_courseName;
    }

    public function get_studyYear() {
        return $this->_studyYear;
    }

    public function get_userName() {
        return $this->_userName;
    }

    public function get_userRole() {
        return $this->_userRole;
    }
    
    public function __construct() {
        $collection = new DataAccess('Etablissement');
        $school = $collection->GetAll();
        if(count($school)!=1){
            // error multiple schools! 
        }else{//ok
            $this->_schoolName=$school[0]->eta_nom_etablissement;
        }
        $collection = new DataAccess('Referentiel_de_formation');
        $ref = $collection->GetAll();
        if(count($ref)!=1){
            // error multiple Referentiel_de_formation! 
        }else{//ok
            $this->_courseName=$ref[0]->rdf_nom_formation;
        }
        $collection = new DataAccess('Annee');
        $year = $collection->GetAll();
        if(count($year)!=1){
            // error multiple Annee! 
        }else{//ok
            $this->_courseName=$year[0]->annee_scolaire;
        }
//        if(\SeseSession::getInstance()->has('user_connected/name')){
            $this->_userName= \UserConnected::getInstance()->getUserName();
            //$this->_userName= \SeseSession::getInstance()->get('user_connected/name');
//        }
//        if(\SeseSession::getInstance()->has('user_connected/group')){
            $this->_userRole= \UserConnected::getInstance()->getUserGroup();
//        }
    }
}
