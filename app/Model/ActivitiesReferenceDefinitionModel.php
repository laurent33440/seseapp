<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of ActivitiesReferenceDefinitionModel
 *
 * @author laurent
 */
class ActivitiesReferenceDefinitionModel extends AModel{
    
    /* Acts at two side  :
     * 1) As reference counter for activities count.
     * 2) holds references for activities 
     */
    private $_activitiesReferencesList = array();
    
    /* Acts at two side  :
     * 1) Holds list of lists of functions. One list by activity. 
     * The first element of function list is the function choosen by user for a given activity : view model
     * 2) Set by controller to the function name send by the form : data model
     */
    private $_functionsList = array(); 
    
    /*
     * List of short descriptions by activity 
     */
    private $_activitiesDescriptionsList = array();
    
    /**
     *  REWORK
     */
    public function __construct(){
        try{
            //connect to database 
            $accessDb = new AccessDataBase();
            $this->_dataBaseHandler = $accessDb->connectToDataBaseDefined();
        }catch (Exception $e){
            echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    public function set_activitiesReferencesList($_activitiesReferencesList) {
        if(!in_array( $_activitiesReferencesList, $this->_activitiesReferencesList)){
            $this->_activitiesReferencesList[] = $_activitiesReferencesList;
        }else{//already exist
            $this->_activitiesReferencesList[] = $_activitiesReferencesList.self::ERR_DUPLICATE;
        }
    }

    public function set_functionsList($_functionsList) {
        $this->_functionsList[] = $_functionsList;
    }

    public function set_activitiesDescriptionsList($_activitiesDescriptionsList) {
        $this->_activitiesDescriptionsList[] = $_activitiesDescriptionsList;
    }
    
    public function get_activitiesReferencesList() {
        //var_dump($this->_activitiesReferencesList);
        return $this->_activitiesReferencesList;
    }
    
    public function get_functionsList() {
        return $this->_functionsList;
    }

    public function get_activitiesDescriptionsList() {
        return $this->_activitiesDescriptionsList;
    }
    
    /**
     * PRIVATE
     * 
     * reset all class's members
     */
    public function resetModel(){
        $this->_activitiesReferencesList=array();
        $this->_activitiesDescriptionsList=array();
        $this->_functionsList=array();
    }
    
    /**
     *  GENERIC
     */
    public function addBlankToModel(){
        $this->set_activitiesReferencesList('');
        $this->set_functionsList($this->getDefinedFunctions()); //set default function list for future activity
        $this->set_activitiesDescriptionsList('');
    }

    /**
     * -PRIVATE
     * return list functions avalable to view part 
     */
    public function getDefinedFunctions(){
        $functionModel =  new FunctionReferentialDefinitionModel();
        $functionModel->getFunctionsFromDataBase();
        return  $functionModel->get_descriptions();
    }
    
    /**
     * -PRIVATE
     * Matches needs for view part 
     */
    public function updateModelView(){
        $functionModel =  new FunctionReferentialDefinitionModel();
        for ($i=0; $i<count($this->_functionsList); $i++) {
            if(!is_array($this->_functionsList[$i])){
                $this->_functionsList[$i]=$this->getReorderFunctionList($functionModel->getFunctionIdDbFromDescription($this->_functionsList[$i]));
            }
        }
    }
    
    /**
     * GENERIC ADD
     * Add the last activity from model to database
     * @return num db Id of added activity, -1 if the row already exists
     * @throws Exception
     */
    public function addActivityToDataBase() {
//        var_dump($this->_activitiesReferencesList);
        //if(!($this->isExistingBlankInArray($this->_activitiesReferencesList) || $this->isExistingBlankInArray($this->_activitiesDescriptionsList))){ //all activity params must be set
            try{
//                if(count($this->_activitiesReferencesList) === 1) //first activity added to model
//                    array_shift($this->_functionsList); //suppress functions list (view model) 
                $functionModel =  new FunctionReferentialDefinitionModel();
                if(is_array($this->_functionsList[count($this->_activitiesReferencesList)-1])){ // list of functions
                    $func = $this->_functionsList[count($this->_activitiesReferencesList)-1][0];//first element of list is the function choosen
                }else{ //func choosen by user from form - just an item
                    $func = $this->_functionsList[count($this->_activitiesReferencesList)-1];
                }
                $functionId = $functionModel->getFunctionIdDbFromDescription($func);
                $id_activity = $this->_dataBaseHandler->dbQI(array( 'act_ref_activite'=> $this->_activitiesReferencesList[count($this->_activitiesReferencesList)-1], 
                                            'act_descriptif_activite' => $this->_activitiesDescriptionsList[count($this->_activitiesReferencesList)-1],
                                            'act_est_realisee' => false,
                                            'id_fonction' => $functionId
                                            ), 
                                    'Activite');
            }catch (\Exception $e){
                echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
                throw $e;
            }
        //}
    }
    
    
    
    /**
     * GENERIC GETALL 
     * 
     * Fill in model's datas from database
     * 
     */
    public function getActivitesFromDataBase(){
            $this->resetModel();
            $rows = $this->_dataBaseHandler->dbQS('Activite');
            //fill
            foreach($rows as $row){
                    $this->set_activitiesReferencesList($row['act_ref_activite']);
                    $this->set_activitiesDescriptionsList($row['act_descriptif_activite']);
                    $funcs=$this->getReorderFunctionList($row['id_fonction']);
                    $this->set_functionsList($funcs);//retrieve fonction list with top element as id function stored in activity
            }
    }
    
    /**
     * PRIVATE
     * 
     * "SELECT id_activite FROM `Activite` WHERE act_ref_activite = \'A1-1 test\'";
     * @param type $activityReference
     */
    public function getActivityIdFromActivityReference($activityReference){
        $r = $this->_dataBaseHandler->dbQS('Activite', array('id_activite'), "act_ref_activite = '$activityReference'", persistant\PdoCrud::MODE_FETCH_SIMPLE);
        if($r->rowCount()===1)
            foreach ($r as $id)
                return $id['id_activite'];
        else
            return false;
    }
    
    /**
     * INTER MODELS SERVICE
     * 
     * "SELECT id_activite FROM `Activite` WHERE act_descriptif_activite = \'une description\'";
     * @param type $activityDescription
     */
    public function getActivityIdFromActivityDescription($activityDescription){
        $r = $this->_dataBaseHandler->dbQS('Activite', array('id_activite'), "act_descriptif_activite = '$activityDescription'", persistant\PdoCrud::MODE_FETCH_SIMPLE);
        if($r->rowCount()===1)
            foreach ($r as $id)
                return $id['id_activite'];
        else
            return false;
    }
    
    /**
     * INTER MODELS SERVICE
     * 
     * "SELECT act_descriptif_activite FROM `Activite` WHERE id_activite = \'1234\'";
     * @param type $activityId
     */
    public function getActivityDescriptionFromActivityId($activityId){
        $r = $this->_dataBaseHandler->dbQS('Activite', array('act_descriptif_activite'), "id_activite = '$activityId'", persistant\PdoCrud::MODE_FETCH_SIMPLE);
        if($r->rowCount()===1)
            foreach ($r as $id)
                return $id['act_descriptif_activite'];
        else
            return false;
    }
    
    /**
     * UPDATE MODEL 1
     * 
     * Update model view and db of description activity 
     * @param string $value  new value
     * @param numerical $id id (view side 1,2,3...) of activity
     * @return int : number of rows updated
     */
    public function updateActivityDescription($value, $id){
        //var_dump($this->_activitiesDescriptionsList);
        $oldValue = $this->_activitiesDescriptionsList[--$id];
        //view
        $this->_activitiesDescriptionsList[$id] = $value;
        //db
        //update `Activite` set "`act_descriptif_activite`=`$value`" where "`act_descriptif_activite`=`$oldValue`"
        return $this->_dataBaseHandler->dbQU('Activite', array('act_descriptif_activite' => "$value"), "act_descriptif_activite = '$oldValue'");
    }
    
    /**
     * UPDATE MODEL 2
     * 
     * Update model view and db of activity reference
     * @param string $value  new value
     * @param numerical $id id (view side 1,2,3...) of activity
     * @return int : number of rows updated
     */
    public function updateActivityReference($value, $id){
         $oldValue = $this->_activitiesReferencesList[--$id];
        //view
        $this->_activitiesReferencesList[$id] = $value;
        //db
        //update `Activite` set "`act_ref_activite`=`$value`" where "`act_ref_activite`=`$oldValue`"
        return $this->_dataBaseHandler->dbQU('Activite', array('act_ref_activite' => "$value"), "act_ref_activite = '$oldValue'");
    }
    
    /**
     * UPDATE MODEL 3
     * 
     * Update model view and db of activity function
     * @param string $value  new value
     * @param numerical $id id (view side 1,2,3...) of activity
     * @return int : number of rows updated
     */
    public function updateActivityFunction($value, $id){
        $ref = $this->_activitiesReferencesList[--$id];
        //view
        $this->_functionsList[$id] = $value;
        //db
        $functionModel =  new FunctionReferentialDefinitionModel();
        $idFunc = $functionModel->getFunctionIdDbFromDescription($value);
        //update `Activite` set "`id_fonction`=`$idFunc`" where "`act_ref_activite`=`$ref`"
        return $this->_dataBaseHandler->dbQU('Activite', array('id_fonction' => "$idFunc"), "act_ref_activite = '$ref'");
    }
    
    /**
     * GENERIC DELETE 
     * 
     * @throws Exception
     */
    public function delActivitiesFromDataBase( array $activitiesIdToDelete = null){
//        try{
            //connect to database 
//            $accessDb = new AccessDataBase();
//            $db = $accessDb->connectToDataBaseDefined();
            if($activitiesIdToDelete == null){ //delete all
                $n = $this->_dataBaseHandler->dbQD('Activite');
            }else{
                foreach ($activitiesIdToDelete as $val) {
                    $n = $this->_dataBaseHandler->dbQD('Activite', "id_activite = '$val'");
                }
            }
//        }catch (Exception $e){
//            echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
//            throw $e;
//        }
    }
    
    /**
     * GENERIC DELETE 
     * 
     * Remove an activity from data base
     * @param integer $id : id num of model view (1,2,3...)
     */
    public function removeActivityFromIdFromDataBase($id){
        $idDb = $this->getActivityIdFromActivityReference($this->_activitiesReferencesList[--$id]);
        if($idDb){
            $this->delActivitiesFromDataBase(array($idDb));
            unset($this->_activitiesReferencesList[$id]);
            unset($this->_functionsList[$id]);
            unset($this->_activitiesDescriptionsList[$id]);
            //reorder lists
            $this->_activitiesReferencesList = array_merge(array(),$this->_activitiesReferencesList );
            $this->_functionsList = array_merge(array(),$this->_functionsList );
            $this->_activitiesDescriptionsList = array_merge(array(),$this->_activitiesDescriptionsList );
        }
    }


    /**
     * PRIVATE
     * 
     * Get function list and set function name on top of list from function db id
     * @param num $functionId function db id to hire
     * @return List of functions ordered
     */
    public function getReorderFunctionList($functionId){
        //retrieve function description from id
        $functionModel =  new FunctionReferentialDefinitionModel();
        $functionModel->getFunctionsFromDataBase();
        $functionList =  $functionModel->get_descriptions();
        $functionDesc = $functionModel->getFunctionDescriptionFromIdDb($functionId);
        //remove
        $functionList = array_diff($functionList, array($functionDesc));
        //add
        array_unshift($functionList, $functionDesc);
        return $functionList;
    }
    

}
