<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Competences_evaluees\Competences_evalueesObject;

use DateTime;

/**
 * Description of WorkDateModel
 *
 * @author laurent
 */
class TutorEvaluateSkillTraineeModel extends AModel implements IModel{
    //view
    private $_functionList = array(); //fonction=>array(
                                        //activite=>array( 
                                            //competence=>array(
                                                //niveau=>array(codeNiveau=>nomNiveau)
    
    private $_autonomyList=array();//autonomy=>(codeAutonomy=>nomAutonomy)
    
    private $_traineeList = array();
    
    private $_traineeName;
    
    private $_results = array();//{activite => {competence=>niveau}}
    
    private $_autonomyResults=array(); //{skill -> autonomy value}
    
    public function __construct() {
        $this->buildTraineeList();
    }

    public function get_functionList() {
        return $this->_functionList;
    }

    public function get_autonomyList() {
        return $this->_autonomyList;
    }
    
    public function get_traineeList() {//id=>name1.' '.name2
        return $this->_traineeList;
    }
    
    public function get_results() {
        return $this->_results;
    }
        
    public function set_traineeName($_traineeName) {
        $this->_traineeName = $_traineeName;
    }
    
    public function set_results($_results, $activity, $skill) {
        $this->_results[$activity][$skill] = $_results;
    }
    
    public function set_autonomyResults($_autonomyResults, $skill) {
        $this->_autonomyResults[$skill] = $_autonomyResults;
    }

    
    
    public function addBlank() {
        
    }

    public function append() {
        $id = array_search($this->_traineeName,$this->_traineeList);
        $collection = new DataAccess('Competences_evaluees');
        foreach($this->_results as $activity){
            $skillDb = new Competences_evalueesObject();
            $skillDb->id_stagiaire=$id;
            foreach ($activity as $skill => $val){
                $skillDb->coe_descriptif_competence_evaluee = $skill;
                $skillDb->coe_niveau_competence = $val;
                $skillDb->coe_niveau_autonomie = $this->_autonomyResults[$skill];
            }
            $collection->Insert($skillDb);
        }
    }

    public function deleteFromId($id) {
        
    }

    public function deleteFromProperty($property, $val) {
        
    }

    public function getAll() {
        //$this->buildTraineeList();
        $this->buildFunctionlist();
        $this->_autonomyList=  $this->buildAutonomyLevels();
    }

    public function resetModel() {
        
    }

    public function update($property, $val, $id) {
        
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
                $s = $collSkill->GetByID($skillId->id_competence);
                $skills[$s->comp_descriptif_competence] = $this->buildSkillsLevels(); 
            }
            $this->_functionList[$func->f_description][$activity->act_descriptif_activite]=$skills;
        }
    }
    
    public function buildTraineeList(){
        $collection = new DataAccess('Collaborateur');
        $tutor = $collection->GetByColumnValue('col_mel', \UserConnected::getInstance()->getUserName());
        //$tutor = $collection->GetByColumnValue('col_mel', \SeseSession::getInstance()->get('user_connected/name'));
        $collection = new DataAccess('Stage_defini');
        $works=$collection->GetAllByColumnValue('id_collaborateur', $tutor->id_collaborateur);
        foreach ($works as $work) {
            $idWork = $work->id_stage_defini;
            $collection = new DataAccess('Realiser');
            $links = $collection->GetAllByColumnValue('id_stage_defini', $idWork);
            $collection=new DataAccess('Stagiaire');
            foreach ($links as $elt){
                $trainee = $collection->GetByColumnValue('id_stagiaire',$elt->id_stagiaire );
                $this->_traineeList[$elt->id_stagiaire]=$trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire;
            }
        }
    }
            
    
    public function buildSkillsLevels(){
        return array(0=>'Très insuffisant','Insuffisant', 'Satisfaisant', 'Très bien', 'NMO'=>'Non mis en oeuvre');
    }
    
    public function buildAutonomyLevels(){
        return array(0=>'Aide totale','Aide Partielle', 'Autonomie complète');
    }
    
    
}
