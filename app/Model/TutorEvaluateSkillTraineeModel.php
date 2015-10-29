<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Attitude_professionnelle_evaluee\Attitude_professionnelle_evalueeObject;
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
    
    private $_professionnalSkillList=array();//id=>description
    
    private $_traineeName;
    
    private $_professionalResults=array();//professionalSkill => level
    
    private $_results = array();//{activite => {competence=>niveau}}
    
    private $_autonomyResults=array(); //{skill -> autonomy value}
    
    private $_referenceDbList=array();
    
    public function __construct() {
        $this->_referenceDbList = $this->getReferenceDb('stgdef_status_stage');
        $this->buildTraineeList();
    }

    public function get_functionList() {
        return $this->_functionList;
    }

    public function get_autonomyList() {
        return $this->_autonomyList;
    }
    
    public function get_professionnalSkillList() {
        return $this->_professionnalSkillList;
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
   
    public function set_professionalResults($_professionalResults, $skill) {
        $this->_professionalResults[$skill] = $_professionalResults;
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
        $collection = new DataAccess('Attitude_professionnelle_evaluee');
        foreach($this->_professionalResults as $skill=>$level){
            $skill =str_replace('_', ' ', $skill);
            $skillProDb = new Attitude_professionnelle_evalueeObject();
            $skillProDb->id_stagiaire=$id;
            $skillProDb->aproeva_critere=$skill;
            $skillProDb->aproeva_choix=$level;           
            $collection->Insert($skillProDb);
        }
        $collection = new DataAccess('Competences_evaluees');
        foreach($this->_results as $activity){
            $skillDb = new Competences_evalueesObject();
            $skillDb->id_stagiaire=$id;
            foreach ($activity as $skill => $val){
                $skillDb->coe_niveau_autonomie = $this->_autonomyResults[$skill];
                $skill =str_replace('_', ' ', $skill);
                $skillDb->coe_descriptif_competence_evaluee = $skill;
                $skillDb->coe_niveau_competence = $val;
                //$skillDb->coe_niveau_autonomie = $this->_autonomyResults[$skill];
            }
            $collection->Insert($skillDb);
//            var_dump($skillDb);
//            die();
        }
        $collection=new DataAccess('Realiser');
        $links = $collection->GetAllByColumnValue('id_stagiaire', $id);
        $collection = new DataAccess('Stage_defini');
        foreach ($links as $link) {
            $work = $collection->GetByColumnValue('id_stage_defini', $link->id_stage_defini);
            if ($work->stgdef_status === $this->_referenceDbList['STAGE_EN_COURS']){
                $work->stgdef_est_evalue = '1';
                $collection->Update($work);
                break;
            }
        }
    }

    public function deleteFromId($id) {
        
    }

    public function deleteFromProperty($property, $val) {
        
    }

    public function getAll() {
        //$this->buildTraineeList();  constructor
        $this->restoreTraineeResults();
    }

    public function resetModel() {
        
    }

    public function update($property, $val, $id) {
        
    }
    
    public function buildProfessionnalSkillList(){
        $coll = new DataAccess('Attitude_professionnelle');
        $all = $coll->GetAll();
        foreach ($all as $item) {
            $this->_professionnalSkillList[$item->apro_critere] = $this->buildProfessionnalSkillLevel();
        }
    }

    /**
     * Build data structure for skills form - reset view model
     * restore trainee results if id if provided
     * @param int $retoreIdTrainee Id of trainee to bu used for restored results (optional)
     */
    public function buildFunctionlist($restoreIdTrainee=null){
        $this->_functionList=array();//reset
        $collection = new DataAccess('Activite');
        $activities = $collection->GetAll();
        $collFunc= new DataAccess('Fonction');
        $collConst = new DataAccess('Constituer');
        $collSkill = new DataAccess('Competence');
        if($restoreIdTrainee!=null){
            $coEvalSkill =  new DataAccess('Competences_evaluees');
            $skillsEval = $coEvalSkill->GetAllByColumnValue('id_stagiaire', $restoreIdTrainee);
        }
        foreach ($activities as $activity) {
            $func = $collFunc->GetByID($activity->id_fonction);
            $skillsId = $collConst->GetAllByColumnValue('id_activite', $activity->id_activite);
            $skills= array();
            if($restoreIdTrainee!=null){
                foreach ($skillsId as $skillId) {
                    $s = $collSkill->GetByID($skillId->id_competence);
                    foreach($skillsEval as $sEval){
                        if($s->comp_descriptif_competence === $sEval->coe_descriptif_competence_evaluee){
                            //var_dump($this->getReorderedList($sEval->coe_niveau_competence, $this->buildSkillsLevels()));
                            $skills[$s->comp_descriptif_competence] = $this->getReorderedList($sEval->coe_niveau_competence, $this->buildSkillsLevels());
                            //autonomy
                            $this->_autonomyList[$s->comp_descriptif_competence] = $this->getReorderedList($sEval->coe_niveau_autonomie, $this->buildAutonomyLevels());
                        }else{//add skill not evaluated
                            $k = array_keys($skills);
                            if(!in_array($s->comp_descriptif_competence, $k)){//check if corresponding evaluated skill not already added
                                $skills[$s->comp_descriptif_competence] = $this->buildSkillsLevels();
                                $this->_autonomyList[$s->comp_descriptif_competence] = $this->buildAutonomyLevels();
                            }
                        }
                    }
                }
            }else{
                foreach ($skillsId as $skillId) {
                    $s = $collSkill->GetByID($skillId->id_competence);
                    $skills[$s->comp_descriptif_competence] = $this->buildSkillsLevels(); 
                    $this->_autonomyList[$s->comp_descriptif_competence] = $this->buildAutonomyLevels();
                }
            }
            $this->_functionList[$func->f_description][$activity->act_descriptif_activite]=$skills;
        }
    }
    
    public function buildTraineeList(){
        $collection = new DataAccess('Collaborateur');
        $tutor = $collection->GetByColumnValue('col_mel', \UserConnected::getInstance()->getUserName());
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
        $this->_traineeName=  reset($this->_traineeList);//first name 
    }
    
    public function restoreTraineeResults(){
         $id = array_search($this->_traineeName,$this->_traineeList);
         if($this->isTraineeEvaluated($id)){
            //pro
             $co=new DataAccess('Attitude_professionnelle_evaluee');
             $allPro = $co->GetAllByColumnValue('id_stagiaire',$id);
             foreach($allPro as $pro){
                 $this->_professionnalSkillList[$pro->aproeva_critere]=  $this->getReorderedList($pro->aproeva_choix, $this->buildProfessionnalSkillLevel());
             }
             //
             $this->buildFunctionlist($id);
         }else{
             $this->buildProfessionnalSkillList();
             $this->buildFunctionlist(null);
         }
    }
    
    public function isTraineeEvaluated($traineeId){
        $co = new DataAccess('Realiser');
        $link = $co->GetByColumnValue('id_stagiaire', $traineeId);
        $co = new DataAccess('Stage_defini');
        $w = $co->GetByID($link->id_stage_defini);
        return $w->stgdef_est_evalue === '1';
    }
    
    public function buildSkillsLevels(){
        return array(0=>'Très insuffisant','Insuffisant', 'Satisfaisant', 'Très bien', 'Non mis en oeuvre');
    }
    
    public function buildAutonomyLevels(){
        return array(0=>'Aide totale','Aide Partielle', 'Autonomie complète');
    }
    
    public function buildProfessionnalSkillLevel(){
        return array(0=>'Négligée','Moyenne', 'Bonne','Excellent');
    }
    
    /**
     * Build list of of element with element to hire on top
     * @param elementto hire
     * @return List ordered
     */
    public function getReorderedList($i, array $list){
        //get val
        $v = $list[$i];
        //remove
        $list = array_diff($list, array($v));
        //add
        $list = array_merge(array($v),$list);
        return $list;
    }
    
    
}
