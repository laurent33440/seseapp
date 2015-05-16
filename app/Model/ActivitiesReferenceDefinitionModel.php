<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use IModel;
use Dal\DbLibrary\DataAccess;
use Dal\ModelDb\Activite\ActiviteObject;

/**
 * Description of ActivitiesReferenceDefinitionModel
 *
 * @author laurent
 */
class ActivitiesReferenceDefinitionModel extends AModel implements IModel{
    
    /**
     * DATA STRUCTURE - VIEW MODEL
     * 
     * activityRefList = array(id=>ref)
     * activityDescriptionList = array(id=>description)
     * functionList = array(idFunction => functionDescription
     */
    private $_activityRefList = array();
    
    private $_activityDescriptionList = array();
    
    protected $_functionsList = array(); 
    
    
    /**
     *  REFACTOR
     */
    public function __construct(){}
    
   
    public function set_activityRefList($_activitiesReferencesList) {
        if(!in_array( $_activitiesReferencesList, $this->_activityRefList)){
            $this->_activityRefList[] = $_activitiesReferencesList;
        }else{//already exist
            $this->_activityRefList[] = $_activitiesReferencesList.self::ERR_DUPLICATE;
        }
    }
    
    public function set_activityDescriptionList($_activityDescriptionList) {
        $this->_activityDescriptionList[] = $_activityDescriptionList;
    }

    public function set_functionsList($_functionsList) {
        $this->_functionsList[] = $_functionsList;
    }
    
    public function get_activityRefList() {
        return $this->_activityRefList;
    }

    public function get_activityDescriptionList() {
        return $this->_activityDescriptionList;
    }

        
    public function get_functionsList() {
        return $this->_functionsList;
    }
    
    public function deleteFromId($id) {

    }

    public function deleteFromProperty($property) {

    }

    public function update($property) {

    }

    
    /**
     * PRIVATE
     * 
     * reset all class's members
     */
    public function resetModel(){
        $this->_activityRefList=array();
        $this->_functionsList=array();
    }
    
    /**
     *  GENERIC
     */
    public function addBlank(){
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
        $functionModel->getAll();
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
     */
    public function append() {
        $collection= new DataAccess('Activite');
        $item = new ActiviteObject();
        $item->act_ref_activite = $this->_activityRefList[count($this->_activityRefList)-1][0];
        $item->act_descriptif_activite = $this->_activityRefList[count($this->_activityRefList)-1][2];
        $fid = $this->_activityRefList[count($this->_activityRefList)-1][1];

    }
    
    
    
    /**
     * GENERIC GETALL 
     * 
     * Fill in model's datas from database
     * 
     */
    public function getAll(){
        $this->resetModel();
            
    }
    
    /**
     * PRIVATE
     * 
     * "SELECT id_activite FROM `Activite` WHERE act_ref_activite = \'A1-1 test\'";
     * @param type $activityReference
     */
    public function getActivityIdFromActivityReference($activityReference){
        
    }
    
    /**
     * INTER MODELS SERVICE
     * 
     * "SELECT id_activite FROM `Activite` WHERE act_descriptif_activite = \'une description\'";
     * @param type $activityDescription
     */
    public function getActivityIdFromActivityDescription($activityDescription){
        
    }
    
    /**
     * INTER MODELS SERVICE
     * 
     * "SELECT act_descriptif_activite FROM `Activite` WHERE id_activite = \'1234\'";
     * @param type $activityId
     */
    public function getActivityDescriptionFromActivityId($activityId){
        
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
 
    }
    
    /**
     * GENERIC DELETE 
     * 
     * @throws Exception
     */
    public function delActivitiesFromDataBase( array $activitiesIdToDelete = null){

    }
    
    /**
     * GENERIC DELETE 
     * 
     * Remove an activity from data base
     * @param integer $id 
     */
    public function removeActivityFromIdFromDataBase($id){
        
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
        $functionModel->getAll();
        $functionList =  $functionModel->get_descriptions();
        $functionDesc = $functionModel->getFunctionDescriptionFromIdDb($functionId);
        //remove
        $functionList = array_diff($functionList, array($functionDesc));
        //add
        array_unshift($functionList, $functionDesc);
        return $functionList;
    }
    

}
