<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of FunctionReferentialDefinition
 *
 * @author prog
 */
class FunctionReferentialDefinitionModel extends AModel{
    
    private $_descriptions;
    
    public function __construct() {
        $this->_descriptions = array();
    }
    
    public function get_descriptions() {
        return $this->_descriptions;
    }

    public function set_descriptions($_description) {
        $this->_descriptions[] = $_description;
    }
    
    /**
     * 
     * @throws Exception
     */
    public function addFunctionToDataBase(){
        $copy = $this->delBlankEmptyValues($this->_descriptions);
        $this->getFunctionsFromDataBase();
        $this->delFunctionsFromDataBase();
        $test = array_merge($copy, $this->_descriptions);
        $this->_descriptions = array_keys(array_flip($test)); //supress all duplicate values
        $this->_descriptions = $this->delBlankEmptyValues($this->_descriptions);
        $this->writeModelToDataBase();
    }
    
    /**
     * 
     * @throws Exception
     */
    public function delFunctionsFromDataBase($functionsValsToDelete = '*'){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            if($functionsValsToDelete == '*'){ //delete all
                $n = $db->dbQD('Fonction');
            }else{
                foreach ($functionsValsToDelete as $val) {
                    $n = $db->dbQD('Fonction', "f_description = '$val'");
                }
            }
        }catch (Exception $e){
            echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    
    /**
     * Get members's values of model from data base
     * 
     */
    public function getFunctionsFromDataBase(){
        try{
            $this->_descriptions=array();
            $rows = $this->getRawFunctionsFromDataBase();
            foreach($rows as $row){
                    $this->set_descriptions($row['f_description']); //remove id
            }
        }catch (Exception $e){
            echo '</br>Internal Error   - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    /**
     * Get raw values from data base that is all elements of table
     * @return array of table content
     * @throws Exception
     */
    public function getRawFunctionsFromDataBase(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            $rows = $db->dbQS('Fonction');
            return $rows;
        }catch (Exception $e){
            echo '</br>Internal Error  - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    /**
     * 
     * @param num $id data base of an existing function
     * @return string function description if exists null else
     */
    public function getFunctionDescriptionFromIdDb($id){
        $rows = $this->getRawFunctionsFromDataBase();
        foreach($rows as $row){
                if($row['id_fonction']===$id){
                    return $row['f_description'];
                }
        }
        return null;
    }
    
    /**
     * 
     * @param string $description data base of an existing function
     * @return num id function if exists null else
     */
    public function getFunctionIdDbFromDescription($description){
        $rows = $this->getRawFunctionsFromDataBase();
        foreach($rows as $row){
                if($row['f_description']===$description){
                    return $row['id_fonction'];
                }
        }
        return null;
    }


    /**
     * 
     * @param array $func
     */
    public function updateFunctionInDataBase(array $func){
        $this->getFunctionsFromDataBase();
        $this->delFunctionsFromDataBase();
        $this->_descriptions[$func['id']] = $func['value'];
        $this->writeModelToDataBase();
    }
    
    /**
     * 
     * @param array $func
     */
    public function removeFunctionsFromDataBase($funcName){
        $this->getFunctionsFromDataBase();
        $this->delFunctionsFromDataBase();
        $this->_descriptions = array_merge(array_diff($this->_descriptions,array($funcName)));
        $this->writeModelToDataBase();
    }
    
    /**
     * 
     * @param num function id user view (1,2, ...)
     */
    public function removeFunctionsFromIdFromDataBase($funcId){
        $this->getFunctionsFromDataBase();
        $this->delFunctionsFromDataBase();
        unset($this->_descriptions[--$funcId]);
        $this->_descriptions = array_merge(array(),$this->_descriptions );
        $this->writeModelToDataBase();
    }


    /**
     * 
     * @throws Exception
     */
    public function writeModelToDataBase(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $db = $accessDb->connectToDataBaseDefined();
            //insert into table 
            foreach($this->_descriptions as $description){
                $id_referential = $db->dbQI(array(   'f_description'=>  $description
                                                ), 'Fonction');
            }
        }catch (Exception $e){
            echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
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
