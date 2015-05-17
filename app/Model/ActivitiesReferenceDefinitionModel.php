<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

//use Model\IModel;
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
     * activityRefList = array(idActivity => ref)
     * activityDescriptionList = array(idActivity => description)
     * functionList = array(idActivity => 
     *                          array(idFunction => functionDescription) first item is function choosen for a given activity
     *                )
     */
    private $_activityRefList = array();
    
    private $_activityDescriptionList = array();
    
    protected $_functionList = array(); 
    
   
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

    public function set_functionsList($functionIdVal, $idActivity) {
        $f = explode('::', $functionIdVal);
        $this->_functionList[$idActivity] = array($f[0]=>$f[1]);//idFunction=>FunctionDescription
    }
    
    public function get_activityRefList() {
        return $this->_activityRefList;
    }

    public function get_activityDescriptionList() {
        return $this->_activityDescriptionList;
    }

    public function get_functionList() {
        return $this->_functionList;
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
     * Add the last activity from model to database
     */
    public function append() {
        $collection= new DataAccess('Activite');
        $item = new ActiviteObject();
        $item->act_ref_activite = end($this->_activityRefList);
        $item->act_descriptif_activite = end($this->_activityDescriptionListList);
        $function = end($this->_functionList);
        $item->id_fonction=reset(array_keys($function));
        $collection->Insert($item);
    }
    
    /**
     * Fill in model's datas from database
     * 
     */
    public function getAll(){
        $this->resetModel();
        $collection= new DataAccess('Activite');
        $all = $collection->GetAll();
        foreach ($all as $item) {
            $this->_activityRefList[$item->id_activite] = $item->act_ref_activite;
            $this->_activityDescriptionList[$item->id_activite] = $item->act_descriptif_activite;
            $this->_functionList[$item->id_activite] = $this->getReorderFunctionList($item->id_fonction);
        }
        
            
    }

    public function update( $property, $val,$id) {
        $collection= new DataAccess('Activite');
        $item = $collection->GetById($id);
        switch($property){
            case 'activityRef':
                $item->act_ref_activite = $val;
                $this->_activityRefList[$id]=$val;
                break;
            case 'activityDescription':
                $item->act_descriptif_activite = $val;
                $this->_activityDescriptionList[$id]=$val;
                break;
            case 'function':
                $this->set_functionsList($val, $id);
                $idFuncAndFuncDesc= explode('::',$val);
                $item->id_fonction=$idFuncAndFuncDesc[0];
                break;
            default :
                return;
        }
        $collection->Update($item);
    }
    
    public function deleteFromId($id) {

    }

    public function deleteFromProperty($property, $val) {

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
     * PRIVATE
     * 
     * reset all class's members
     */
    public function resetModel(){
        $this->_activityRefList=array();
        $this->_functionList=array();
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
        for ($i=0; $i<count($this->_functionList); $i++) {
            if(!is_array($this->_functionList[$i])){
                $this->_functionList[$i]=$this->getReorderFunctionList($functionModel->getFunctionIdDbFromDescription($this->_functionList[$i]));
            }
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
