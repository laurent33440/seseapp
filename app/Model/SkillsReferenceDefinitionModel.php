<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Competence\CompetenceObject;
use Model\Dal\ModelDb\Constituer\ConstituerObject;

/**
 * Description of SkillsReferenceDefinitionModel
 *
 * @author laurent
 */
class SkillsReferenceDefinitionModel extends AModel implements IModel{
    const SKILL_LEVEL = 10; // max skill level
    const AUTONOMY_LEVEL = 10; // max autonomy level
    
    /** Acts at two side  :
     * array(idSkill => skillReference)
     */
    private $_skillsReferencesList = array();
    
    /**
     * Holds list of avalable activities
     * array(idActivity => ActivityDescription)
     * 
     */
    private $_activitiesList; 
    
    /**
     * Holds list of lists of activities binded to a skill
     * array(idSkill => array(
     *                          idActivity=> ActivityDescription
     *                  )
     * )
     */
    private $_bindedActivitiesLists = array(); 
    
    /**
     * List of descriptions for each skill
     * array(idSkill => skillDescription)
     */
    private $_skillsDescriptionsList = array();
    
    /**
     * Model use for skill definition
     * @var ActivitiesReferenceDefinitionModel
     * This member is protected because it isn't binded to view template
     */
    protected $_activitiesModel;
    
    /**
     * 
     */
    public function __construct(){
        try{
            $this->_activitiesModel =  new ActivitiesReferenceDefinitionModel();
            $this->set_activitiesList($this->getDefinedActivities());
        }catch (Exception $e){
            echo '</br>Internal Error - '.__CLASS__  .' '. __METHOD__.' '.__LINE__.'</br>';
            throw $e;
        }
    }
    
    public function set_skillsReferencesList($_skillsReferencesList) {
        if(!in_array( $_skillsReferencesList, $this->_skillsReferencesList)){
            $this->_skillsReferencesList[] = $_skillsReferencesList;
        }else{//already exist, don't add to list
            //$this->_skillsReferencesList[] = $_skillsReferencesList.self::ERR_DUPLICATE;
        }
    }

    public function set_activitiesList($_activitiesList) {
        $this->_activitiesList = $_activitiesList;
    }
    
    /**
     * 
     * @param type $bindedActivity : activity description to bind
     * @param type $skillId : skill Id hosting binding  
     * @param int $activityId : optional activity id
     */
    public function set_bindedActivitiesLists($bindedActivity, $skillId=0, $activityId=null){
        if(!empty($this->_bindedActivitiesLists[$skillId])){// some binding exist ?
            if(!in_array($bindedActivity, $this->_bindedActivitiesLists[$skillId])){ //activity not already binded?
                if(!isset($activityId)){
                    $this->_bindedActivitiesLists[$skillId][]=$bindedActivity;// add at bottom of list
                }else{//update
                    $this->_bindedActivitiesLists[$skillId][$activityId]=$bindedActivity;
                }
            }
        }else{ //new binded list
            if(!isset($activityId)){
                $activityId=0;
            }
            $this->_bindedActivitiesLists[$skillId] = array($activityId=>$bindedActivity);
        }
    } 

    /**
     * 
     * @param string $_skillsDescription description to be added or updated
     * @param integer $skillId skill id to be updated or null if skill description is added
     */
    public function set_skillsDescriptionsList($_skillsDescription, $skillId=null) {
        if(!in_array($_skillsDescription, $this->_skillsDescriptionsList)){
            if($skillId === null){
                $this->_skillsDescriptionsList[] = $_skillsDescription; //append
            }else{
                $this->_skillsDescriptionsList[$skillId] = $_skillsDescription; //update
            }
        }
    }
    
    public function get_skillsReferencesList() {
        return $this->_skillsReferencesList;
    }
    
    public function get_activitiesList() {
        return $this->_activitiesList;
    }
    
    public function get_bindedActivitiesLists(){
        return $this->_bindedActivitiesLists; 
    }

    public function get_skillsDescriptionsList() {
        return $this->_skillsDescriptionsList;
    }


    public function deleteFromProperty($property, $val) {
        
    }

    public function resetModel() {
        $this->_skillsReferencesList = array();
        $this->_skillsDescriptionsList= array();
        $this->_bindedActivitiesLists= array();
        $this->_activitiesList=  $this->getDefinedActivities();
    }

    public function update($property, $val, $id) {
        
    }

    
    /**
     * return list of activities description available to view part
     */
    public function getDefinedActivities(){
        $this->_activitiesModel->getAll();
        return  $this->_activitiesModel->get_activityDescriptionList();
    }
    
    /**
     * 
     */
    public function addBlank(){
        $this->set_skillsReferencesList('');
        $this->set_bindedActivitiesLists(reset($this->_activitiesList), count($this->_bindedActivitiesLists));
        $this->set_skillsDescriptionsList('');
    }
    
    /**
     * Add last skill of model to data base
     * 
     */
    public function append(){
        $collection = new DataAccess('Competence');
        $item = new CompetenceObject();
        //var_dump($this->_skillsReferencesList);
        $item->comp_ref_competence= end($this->_skillsReferencesList);
        $item->comp_descriptif_competence = end($this->_skillsDescriptionsList);
        $item->comp_est_evaluable = true;
        $item->comp_est_evaluee = false;
        $item->comp_niveau_competence = self::SKILL_LEVEL;
        $item->comp_niveau_autonomie = self::AUTONOMY_LEVEL;
        $collection->Insert($item);
        // add entries to table 'Constituer'
        $links= new DataAccess('Constituer');
        foreach (end($this->_bindedActivitiesLists) as $idActivity => $activityDescription){ 
            $aLink = new ConstituerObject();
            $aLink->id_activite = $idActivity;
            $aLink->id_competence = $item->id_competence;
            $links->Insert($aLink);
        }
    }
    
    /**
     * Fill in model's datas from database
     * 
     */
    public function getAll(){
        $this->resetModel();
        $collection = new DataAccess('Competence');
        $all = $collection->GetAll();
        foreach($all as $skill){
            $this->_skillsReferencesList[$skill->id_competence] = $skill->comp_ref_competence;
            $this->_skillsDescriptionsList[$skill->id_competence] = $skill->comp_descriptif_competence;
            //get all activities for this skill
            $links = new DataAccess('Constituer');
            $all = $links->GetAllByColumnValue('id_competence', $skill->id_competence);
            foreach($all as  $link){
                $this->set_bindedActivitiesLists($this->_activitiesList[$link->id_activite],$skill->id_competence, $link->id_activite);
            }
        }
    }
    
    /**
     * 
     * @param type $skillId
     * @return boolean
     */
    public function deleteFromId($skillId){
        $collection = new DataAccess('Competence');
        $skill = $collection->GetByID($skillId);
        if(isset($this->_skillsReferencesList[$skillId]) && $skill != false){
            //delete entries from table 'Constituer'
            $links = new DataAccess('Constituer');
            $all = $links->GetAllByColumnValue('id_competence', $skillId);
            foreach ($all as $link) {
                $links->Delete($link);
            }
            //delete skill
            $collection->Delete($skill);
            //view
            unset($this->_skillsReferencesList[$skillId]); //delete
            unset($this->_skillsDescriptionsList[$skillId]); //delete
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Bind activity to a skill 
     * @param integer $skillId skill id ; acitivityId 
     * @return boolean true binding ok
     */
    public function bindActivityToSkill($skillId, $activityId){
        if(isset($this->_skillsReferencesList[$skillId])){
            $collection = new DataAccess('Constituer');
            if(($link= $collection->GetByCompositeKeys(array('id_competence'=>$skillId, 'id_activite'=>$activityId)))===false){
                //add binding
                $link = new ConstituerObject();
                $link->id_activite = $activityId;
                $link->id_competence= $skillId;
                $collection->Insert($link);
            }
            return true;
        }
        return false;
    }


    /**
     * 
     * @param type $skillId
     * @param type $activityDescription
     * @return boolean
     */
    public function freeBindedActivity($skillId, $activityId){
        if(isset($this->_skillsReferencesList[$skillId])){
            $collection = new DataAccess('Constituer');
            if(($link= $collection->GetByCompositeKeys(array('id_competence'=>$skillId, 'id_activite'=>$activityId)))!=false){
                //delete binding
                $collection->Delete($link);
            }
            //view
            unset($this->_bindedActivitiesLists[$skillId][$activityId]); //delete
            return true;
        }
        return false;
    }
    
    //UNUSED
//    public function updateBindedActivity($skillId, $activityId, $newActivityDescription){
//        if(isset($this->_skillsReferencesList[$skillId])){
//            $a = $this->_bindedActivitiesLists[$skillId];
//            if(isset($a[$activityId])){
//                if(in_array($newActivityDescription, $this->_activitiesList)){
//                    //view
//                    $activityToUpdate = $a[$activityId];
//                    $a[$activityId] = $newActivityDescription;
//                    $this->_bindedActivitiesLists[$skillId] = $a;
//                    //db
//                    $skillReference = $this->_skillsReferencesList[$skillId];
//                    $newId = $this->_activitiesModel->getActivityIdFromActivityDescription($newActivityDescription);
//                    $oldId = $this->_activitiesModel->getActivityIdFromActivityDescription($activityToUpdate);
//                    $skillIdDb = $this->getSkillIdFromSkillReference($skillReference);
//                    return $this->_dataBaseHandler->dbQU('Constituer', array('id_activite' => "$newId"),"id_activite = '$oldId' AND id_competence = '$skillIdDb'");
//                }
//            }
//        }
//        return false; 
//    }
    
    
    /**
     * UNUSED
     * PRIVATE
     * "SELECT id_competence FROM `Competence` WHERE comp_ref_competence = \'some ref\'";
     * @param type $skillReference
     */
//    public function getSkillIdFromSkillReference($skillReference){
//        $r = $this->_dataBaseHandler->dbQS('Competence', array('id_competence'), "comp_ref_competence = '$skillReference'", persistant\PdoCrud::MODE_FETCH_SIMPLE);
//        if($r->rowCount()===1)
//            foreach ($r as $id)
//                return $id['id_competence'];
//        else
//            return false;
//    }
    
}
