<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;


/**
 * Description of TutorTraineeActivityListModel
 *
 * @author laurent
 */
class TutorTraineeActivityListModel extends AModel implements IModel{
    
    //id_activity=>activity_description
    private $_activityList = array();
    
    public function set_activityList($id, $activity) {
        $this->_activityList[$id] = $activity;
    }

    public function get_activityList() {
        return $this->_activityList;
    }
    
    public function addBlank() {
        
    }

    public function append() {
        
    }

    public function deleteFromId($id) {
        
    }

    public function deleteFromProperty($property, $val) {
        
    }

    public function getAll() {
        $this->resetModel();
        $collection = new DataAccess('Activite');
        $activities = $collection->GetAll();
        foreach ($activities as $activity) {
            $this->set_activityList($activity->id_activite, $activity->act_descriptif_activite);
        }
    }

    public function resetModel() {
        $this->_activityList=array();
    }

    public function update($property, $val, $id) {
        
    }

    
}
