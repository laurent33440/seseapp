<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;

use DateTime;

/**
 * Description of WorkDateModel
 *
 * @author laurent
 */
class TutorSkillsFormModel extends AModel{
    //view
    private $_functionList = array(); //fonction=>array(
                                        //activite=>array( 
                                            //competence=>array(
                                                //niveau=>array(codeNiveau=>nomNiveau)
    
    private $_autonomyList=array();//autonomy=>(codeAutonomy=>nomAutonomy)
    
    public function __construct() {
        $this->_autonomyList=  $this->buildAutonomyLevels();
    }

    public function get_functionList() {
        return $this->_functionList;
    }

    public function get_autonomyList() {
        return $this->_autonomyList;
    }

    /**
     * Build data structure for skills form - reset view model
     */
    public function buildFunctionlist(){
        $this->_functionList=array();//reset
        $collection = new DataAccess('Activite');
        $activities = $collection->GetAll();
        $collFunc= new DataAccess('Fonction');
        $collConst = new DataAccess('Constituer');
        $collSkill = new DataAccess('Competence');
        foreach ($activities as $activity) {
            $func = $collFunc->GetByID($activity->id_fonction);
            $skillsId = $collConst->GetAllByColumnValue('id_activite', $activity->id_activite);
            $skills= array();
            foreach ($skillsId as $skillId) {
                $s = $collSkill->GetByID($skillId);
                $skills[$s->comp_intitule_competence] = $this->buildSkillsLevels(); 
            }
            $this->_functionList[$func->f_description][$activity->act_intitule_activite]=$skills;
        }
    }
    
    public function buildSkillsLevels(){
        return array(0=>'Très insuffisant','Insuffisant', 'Satisfaisant', 'Très bien', 'NMO'=>'Non mis en oeuvre');
    }
    
    public function buildAutonomyLevels(){
        return array(0=>'Aide totale','Aide Partielle', 'Autonomie complète');
    }
    
    
}
