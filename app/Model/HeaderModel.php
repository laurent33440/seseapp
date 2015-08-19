<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use UserConnected;

/**
 * Description of HeaderModel
 * Class used by AControllerState to get generals infos for header
 * Fill in properties according to user connected or not
 * @author laurent
 */
class HeaderModel {
    
    //view part
    private $_schoolName;
    private $_courseName;
    private $_studyYear;
    private $_userName='';
    private $_userRole='';
    
    
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
        $this->_schoolName=$school[0]->eta_nom_etablissement;
        $collection = new DataAccess('Referentiel_de_formation');
        $ref = $collection->GetAll();
        $this->_courseName=$ref[0]->rdf_nom_formation;
        $collection = new DataAccess('Annee');
        $year = $collection->GetAll();
        $this->_courseName=$year[0]->annee_scolaire;
        if(UserConnected::getInstance()->isUserConnected()){
            $this->_userName= \UserConnected::getInstance()->getUserName();
            $this->_userRole= \UserConnected::getInstance()->getUserGroup();
        }
    }
}
