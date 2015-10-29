<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;

/**
 * Description of WorkDateModel
 *
 * @author laurent
 */
class WorkTeacherCommentDefinitionModel extends AModel implements IModel{
    //view
    private $_comments=array();//trainee=>comment
    
    //
    protected $updateTrainee;
    
    public function __construct() {
    }

    public function get_comments() {
        return $this->_comments;
    }

    //second parameter is optional for setter in view model
    public function set_comments($comment,$trainee) {
        $this->_comments[$trainee] = $comment;
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
        $this->_comments=array();//reset
        $collection = new DataAccess('Enseignant');
        $teacher = $collection->GetByColumnValue('ens_mel_enseignant', \UserConnected::getInstance()->getUserName());
        $collection = new DataAccess('Stagiaire');
        $trainees = $collection->GetAllByColumnValue('id_enseignant', $teacher->id_enseignant);
        $collection = new DataAccess('Activite_et_visite');
        foreach ($trainees as $trainee) {
            $visit = $collection->GetByColumnValue('id_stagiaire', $trainee->id_stagiaire);
            if($visit !=false){
                $this->set_comments( $visit->aev_commentaire_visite, $trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire);
            }else{
                $this->set_comments( 'Non défini', $trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire);
            }
        }
    }

    public function resetModel() {
        
    }

    public function update($property, $val, $id=null) {
        if($property == "updateTrainee"){
            //$val is fisrt name+' '+ last name of trainee
            $names=  explode(' ', $val);
            //var_dump($this->_comments);
            $comment = $this->_comments[$names[0].'_'.$names[1]];//blank are replaced by _ in array
            
            //get id trainee
            $collection = new DataAccess('Stagiaire');
            $trainee = $collection->GetByColumnValue('sta_nom_stagiaire', $names[1]);
            //var_dump($trainee);
            //get good Activite_et_visite
            $collection = new DataAccess('Activite_et_visite');
            $visit = $collection->GetByColumnValue('id_stagiaire', $trainee->id_stagiaire);
            var_dump($visit);
            var_dump($comment);
            $visit->aev_commentaire_visite = $comment;
            var_dump($visit);
            $collection->Update($visit);
        }
    }

        /**
     * 
     * 
     */
//    public function addBlankToViewModel(){
//        $this->_visits[]='';
//    }

    /**
     * Get all work date from data base - reset view model
     */
//    public function getAllComments(){
//        $this->_comments=array();//reset
//        $collection = new DataAccess('Enseignant');
//        $teacher = $collection->GetByColumnValue('ens_mel_enseignant', \UserConnected::getInstance()->getUserName());
//        $this->idTeacher= $teacher->id_enseignant;
//        $collection = new DataAccess('Stagiaire');
//        $trainees = $collection->GetAllByColumnValue('id_enseignant', $this->idTeacher);
//        $collection = new DataAccess('Activite_et_visite');
//        foreach ($trainees as $trainee) {
//            if($visit = $collection->GetByColumnValue('id_stagiaire', $trainee->id_stagiaire)!=false){
//                $this->set_comments($trainee->sta_prenom_stagiare.' '.$trainee->sta_nom_stagiare, $visit->aev_commentaire_visite);
//            }else{
//                $this->set_comments($trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire, 'Non défini');
//            }
//        }
//    }
    
    /**
     * Append last model view to data base
     */
//    public function appendWorkDate(){
//        $name = $this->_visits[count($this->_visits)-1];//last
//        $dOn = $this->_dateOn[count($this->_dateOn)-1];//last
//        $dOff = $this->_dateOff[count($this->_dateOff)-1];//last
//        $this->addWorkDate($name, $dOn, $dOff);
//    }
//    
//    /**
//     * Add work date to data base
//     * @param type $name
//     * @param type $dateOn
//     * @param type $dateOff
//     */
//    public function addWorkDate($name, $dateOn, $dateOff){
//        $collection = new DataAccess('Stage');
//        $work = new StageObject;
//        $work->stg_denomination_periode = $name;
//        $work->stg_date_debut = $dateOn;
//        $work->stg_date_fin = $dateOff;
//        $collection->Insert($work);
//    }
//    
//    /**
//     * Delete work date from database
//     * @param type $workName
//     */
//    public function delWorkDate($workName){
//        $collection = new DataAccess('Stage');
//        $work=$collection->GetByColumnValue('stg_denomination_periode',$workName);
//        $collection->Delete($work);
//    }
//    
//    /**
//     * Update work date in data base
//     * @param type $workName
//     * @param type $dateOn
//     * @param type $dateOff
//     */
//    public function updatePromotion($workName, $dateOn, $dateOff){
//        $collection = new DataAccess('Stage');
//        $work=$collection->GetByColumnValue('stg_denomination_periode',$workName);
//        $work->stg_denomination_periode = $workName;
//        $work->stg_date_debut = $dateOn;
//        $work->stg_date_fin = $dateOff;
//        $collection->Update($work);
//    }
//    

    
    
    
}
