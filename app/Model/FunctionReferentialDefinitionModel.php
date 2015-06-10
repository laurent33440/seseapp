<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Fonction\FonctionObject;

/**
 * Description of FunctionReferentialDefinition
 *
 * @author prog
 */
class FunctionReferentialDefinitionModel extends AModel implements IModel{
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
        $collection= new DataAccess('Fonction');
        $f= new FonctionObject();
        $f->f_description = end($this->_descriptionList);
        $collection->Insert($f);
    }
    
    /**
     * Get members's values of model from data base
     * 
     */
    public function getAll(){
        $this->resetModel();
        $collection= new DataAccess('Fonction');
        $funcs = $collection->GetAll();
        foreach($funcs as $func){
            $this->_descriptionList[$func->id_fonction] = $func->f_description;
        }    
    }
    
    /**
     * 
     * @param array $func
     */
    public function update($property, $val, $id){
        if($property==='_descriptionList'){
            $collection = new DataAccess('Fonction');
            $f = $collection->GetByID($id);
            $f->f_description = $val;
            $collection->Update($f);
            $this->_descriptionList[$id]=$val;
        }
    }
    
    /**
     * 
     */
    public function deleteFromId($id){
        $collection= new DataAccess('Fonction');
        $f =$collection->GetByID($id);
        $collection->Delete($f);
    }
    
    
    /**
     * 
     * @param num $id data base of an existing function
     * @return string function description if exists null else
     */
//    public function getFunctionDescriptionFromIdDb($id){
//        $collection = new DataAccess('Fonction');
//        $f=$collection->GetByColumnValue('id_fonction', $id);
//        return $f->f_description;
//    }
    
    /**
     * 
     * @param string $description data base of an existing function
     * @return num id function if exists null else
     */
//    public function getFunctionIdDbFromDescription($description){
//        $collection = new DataAccess('Fonction');
//        $f=$collection->GetByColumnValue('f_description', $description);
//        return $f->id_fonction;
//    }

    
   


    
}
