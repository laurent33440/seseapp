<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Attitude_professionnelle\Attitude_professionnelleObject;

/**
 * Description of ProfessionnalSkillDefinitionModel
 *
 * @author prog
 */
class ProfessionalSkillDefinitionModel extends AModel implements IModel{
    /**
     * DATA STRUCTURE
     * array(idFunction => functionDescription)
     */
    private $_descriptionList=array();
    
    public function get_descriptionList() {
        return $this->_descriptionList;
    }
    
    // for setter view
    public function set_descriptionList($_description, $id=null) {
        $this->_descriptionList[$id] = $_description;
    }
    
    public function addBlank() {
        $this->_descriptionList['new'] ='';
    }

    public function deleteFromProperty($property, $val) {
        
    }

    public function resetModel() {
        $this->_descriptionList=array();
    }

    /**
     * Add last value of model view to 'Fonction' table
     */
    public function append(){
        $collection= new DataAccess('Attitude_professionnelle');
        $f= new Attitude_professionnelleObject();
        $f->apro_critere = end($this->_descriptionList);
        $collection->Insert($f);
    }
    
    /**
     * Get members's values of model from data base
     * 
     */
    public function getAll(){
        $this->resetModel();
        $collection= new DataAccess('Attitude_professionnelle');
        $all = $collection->GetAll();
        foreach($all as $func){
            $this->_descriptionList[$func->id_attitude_professionnelle] = $func->apro_critere;
        }    
    }
    
    /**
     * 
     * @param array $func
     */
    public function update($property, $val, $id){
        if($property==='_descriptionList'){
            $collection = new DataAccess('Attitude_professionnelle');
            $f = $collection->GetByID($id);
            $f->apro_critere = $val;
            $collection->Update($f);
            $this->_descriptionList[$id]=$val;
        }
    }
    
    /**
     * 
     */
    public function deleteFromId($id){
        $collection= new DataAccess('Attitude_professionnelle');
        $f =$collection->GetByID($id);
        $collection->Delete($f);
    }
    
    
}
