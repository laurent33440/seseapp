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
class FunctionReferentialDefinitionModel extends AModel{
    //view
    private $_descriptions=array();
    
    public function get_descriptions() {
        return $this->_descriptions;
    }
    
    // for setter view
    public function set_descriptions($_description) {
        $this->_descriptions[] = $_description;
    }
    
    /**
     * Add last value of model view to 'Fonction' table
     */
    public function addFunctionToDataBase(){
        $collection= new DataAccess('Fonction');
        $f= new FonctionObject();
        $f->f_description = $this->_descriptions[count($this->_descriptions)-1];
        $collection->Insert($f);
    }
    
    /**
     * 
     */
    public function delFunctionFromDataBase($id){
        $collection= new DataAccess('Fonction');
        $f =$collection->GetByID($id);
        $collection->Delete($f);
    }
    
    /**
     * Get members's values of model from data base
     * 
     */
    public function getFunctionsFromDataBase(){
        $this->_descriptions=array();
        $collection= new DataAccess('Fonction');
        $funcs = $collection->GetAll();
        foreach($funcs as $func){
            $this->_descriptions[$func->id_fonction] = $func->f_description;
        }    
    }
    
    /**
     * 
     * @param num $id data base of an existing function
     * @return string function description if exists null else
     */
    public function getFunctionDescriptionFromIdDb($id){
        $collection = new DataAccess('Fonction');
        $f=$collection->GetByColumnValue('id_fonction', $id);
        return $f->f_description;
    }
    
    /**
     * 
     * @param string $description data base of an existing function
     * @return num id function if exists null else
     */
    public function getFunctionIdDbFromDescription($description){
        $collection = new DataAccess('Fonction');
        $f=$collection->GetByColumnValue('f_description', $description);
        return $f->id_fonction;
    }

    /**
     * 
     * @param array $func
     */
    public function updateFunctionInDataBase(array $func){
        $collection = new DataAccess('Fonction');
        $f = $collection->GetByID($func['id']);
        $f->f_description = $func['value'];
        $collection->Update($f);
    }
    
    /**
     * Erase empty and blank values from array - keep ordering key 
     * @param array $a : array to clean
     * @return array 
     */
    public function delBlankEmptyValues(array $a){
        $a = array_map('trim', $a); //suppress blanks at begining and at end of values in array
        return array_values(array_filter($a));
    }       


    
}
