<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Activite\ActiviteObject;


//Notice: Trying to get property of non-object in /home/laurent/Dropbox/Projets/web/seseapp/app/Model/Dal/ModelDb/Activite/ActiviteMappingProvider.php on line 63

//Strict Standards: Only variables should be passed by reference in /home/laurent/Dropbox/Projets/web/seseapp/app/Model/ActivitiesReferenceDefinitionModel.php on line 114

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
     *                          array(idFunction => functionDescription, ...) //first item is function choosen for a given activity
     *                )
     * IT MUST HAVE UNICITY FOR idActivity FOR EACH LIST.
     */
    private $_activityRefList = array();
    
    private $_activityDescriptionList = array();
    
    private $_functionList = array(); 
    
   
    public function set_activityRefList($_activitiesReferencesList,$id=null) {
        if($id!=null){
            if(!in_array( $_activitiesReferencesList, $this->_activityRefList)){
                $this->_activityRefList[$id] = $_activitiesReferencesList;
            }else{//already exist
                $this->_activityRefList[$id] = $_activitiesReferencesList.self::ERR_DUPLICATE;
            }
        }else{
            $this->_activityRefList[] = $_activitiesReferencesList;
        }
    }
    
    public function set_activityDescriptionList($_activityDescriptionList,$id=null) {
        if($id!=null){
            $this->_activityDescriptionList[$id] = $_activityDescriptionList;
        }else{
            $this->_activityDescriptionList[] = $_activityDescriptionList;//append
        }
    }

    /**
     * Set function list contain : 
     * 1 - if param1 is a list of {id, function} avalable
     *      list is added for the current id Activity
     * 2 - if param1 is a composite parameter from view (Form) 'id_function#function'
     *      'id_function' and 'function' are used to build a list with top element 'function' for the current id Activity
     * @param type $functionIdVal: list of {id, function} or composite parameter 'id_value#value'
     * @param type $idActivity : activity binded to function
     */
    public function set_functionList($functionIdVal, $idActivity=null) {
        if(!is_array($functionIdVal)){
            $f = explode('#', $functionIdVal); // view structure
            $this->_functionList[$idActivity] = $this->getReorderFunctionList($f[1]);
        }else{
            $this->_functionList[$idActivity] = $functionIdVal; // list of functions
        }
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
     * reset all class's members
     */
    public function resetModel(){
        $this->_activityRefList=array();
        $this->_functionList=array();
        $this->_activityDescriptionList=array();
    }
    
    /**
     *  GENERIC
     */
    public function addBlank(){
        $this->set_activityRefList('','new');
        $this->set_functionList($this->getDefinedFunctions(),'new'); //set default function list for future activity
        $this->set_activityDescriptionList('','new');
    }

    /**
     * Add the last activity from model to database
     */
    public function append() {
        $collection= new DataAccess('Activite');
        $item = new ActiviteObject();
        $item->act_ref_activite = end($this->_activityRefList);
        $item->act_descriptif_activite = end($this->_activityDescriptionList);
        $function = end($this->_functionList);
        $item->id_fonction=reset(array_keys($function));
        //var_dump($item->id_fonction);
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
            $list = $this->getDefinedFunctions();
            $this->_functionList[$item->id_activite] = $this->getReorderFunctionList($list[$item->id_fonction]);
        }
    }

    public function update( $property, $val,$id) {
        $collection= new DataAccess('Activite');
        $item = $collection->GetById($id);
        switch($property){
            case '_activityRefList':
                $item->act_ref_activite = $val;
                $this->_activityRefList[$id]=$val;
                break;
            case '_activityDescriptionList':
                $item->act_descriptif_activite = $val;
                $this->_activityDescriptionList[$id]=$val;
                break;
            case '_functionList':
                $this->set_functionList($val, $id);
                $idFuncAndFuncDesc= explode('#',$val);
                $item->id_fonction=$idFuncAndFuncDesc[0];
                break;
            default :
                return;
        }
        $collection->Update($item);
    }
    
    public function deleteFromId($id) {
        $collection= new DataAccess('Activite');
        $item = $collection->GetById($id);
        $collection->Delete($item);
    }

    public function deleteFromProperty($property, $val) {
        //??
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
     * -PRIVATE
     * return list functions avalable to view part 
     */
    public function getDefinedFunctions(){
        $functionModel =  new FunctionReferentialDefinitionModel();
        $functionModel->getAll();
        return  $functionModel->get_descriptionList();
    }
    
    /**
     * PRIVATE
     * 
     * Get function list and set function name on top of list from function description
     * @param num $function description to hire
     * @return List of functions ordered
     */
    public function getReorderFunctionList($functionDesc){
        $functionList =$this->getDefinedFunctions();
        //get key 
        $kf = array_keys($functionList, $functionDesc, true);
        //remove
        $functionList = array_diff($functionList, array($functionDesc));
        //add
        $functionList = array( $kf[0]=>$functionDesc)  + $functionList;
        return $functionList;
    }
    

}
