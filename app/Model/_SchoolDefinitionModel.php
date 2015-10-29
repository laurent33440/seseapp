<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of SchoolDefinition
 *
 * @author prog
 */
class SchoolDefinitionModel extends AModel{
    
    private $_schoolName;
    private $_schoolSiret;
    private $_schoolAddress1;
    private $_schoolAddress2;
    private $_schoolCity;
    private $_schoolZipCode;
    private $_schoolUrl;
    private $_schoolEmail;
    private $_schoolPhone;
    
    public function set_schoolName($_schoolName) {
        $this->_schoolName = $_schoolName;
    }

    public function set_schoolSiret($_schoolSiret) {
        $this->_schoolSiret = $_schoolSiret;
    }

    public function set_schoolAddress1($_schoolAddress1) {
        $this->_schoolAddress1 = $_schoolAddress1;
    }

    public function set_schoolAddress2($_schoolAddress2) {
        $this->_schoolAddress2 = $_schoolAddress2;
    }

    public function set_schoolCity($_schoolCity) {
        $this->_schoolCity = $_schoolCity;
    }

    public function set_schoolZipCode($_schoolZipCode) {
        $this->_schoolZipCode = $_schoolZipCode;
    }

    public function set_schoolPhone($_schoolPhone) {
        $this->_schoolPhone = $_schoolPhone;
    }

    public function set_schoolUrl($_schoolUrl) {
        $this->_schoolUrl = $_schoolUrl;
    }

    public function set_schoolEmail($_schoolEmail) {
        $this->_schoolEmail = $_schoolEmail;
    }
    
    public function get_schoolName() {
        return $this->_schoolName;
    }

    public function get_schoolSiret() {
        return $this->_schoolSiret;
    }

    public function get_schoolAddress1() {
        return $this->_schoolAddress1;
    }

    public function get_schoolAddress2() {
        return $this->_schoolAddress2;
    }

    public function get_schoolCity() {
        return $this->_schoolCity;
    }

    public function get_schoolZipCode() {
        return $this->_schoolZipCode;
    }

    public function get_schoolPhone() {
        return $this->_schoolPhone;
    }

    public function get_schoolUrl() {
        return $this->_schoolUrl;
    }

    public function get_schoolEmail() {
        return $this->_schoolEmail;
    }
     
    /**
     * Validate model towards user inputs values
     */
    public function isValide(){
        return true;
    }
    
    /**
     * 
     * @throws Exception
     */
    public function createSchool(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            //insert into table 'Etablissement'
            $id_school = $db->dbQI(array(   'eta_nom_etablissement'=>  $this->_schoolName, 
                                            'eta_siret_etablissement'=>  $this->_schoolSiret,
                                            'eta_adresse1_etablissement'=>  $this->_schoolAddress1,
                                            'eta_adresse2_etablissement'=> $this->_schoolAddress2,
                                            'eta_ville_etablissement'=> $this->_schoolCity,
                                            'eta_cp_etablissement'=>  $this->_schoolZipCode,
                                            'eta_url_etablissement'=> $this->_schoolUrl,
                                            'eta_mel_etablissement'=> $this->_schoolEmail,
                                            'eta_telephone_etablissement'=> $this->_schoolPhone
                                            ), 
                                    'Etablissement');
        }catch (Exception $e){
            echo '</br>Internal Error - creating school in db  - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    /**
     * Get members's values of model from data base
     * Warning : fields in table must match members's names order and count
     * @throws Exception
     */
    public function getSchoolFromDataBase(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            $values = $db->dbQS('Etablissement');
            $schoolParams = $values[0];//first school
            array_shift($schoolParams); //id removed
            reset($schoolParams);
            $members = $this->getClassVars();
            foreach($members as $var){
                $this->{'set'.$var}(current($schoolParams));
                next($schoolParams);
            }
        }catch (Exception $e){
            echo '</br>Internal Error - creating school in db  - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }


}
