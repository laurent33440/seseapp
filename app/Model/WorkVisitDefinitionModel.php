<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Stage\StageObject;

/**
 * Description of WorkDateModel
 *
 * @author laurent
 */
class WorkVisitDefinitionModel extends AModel implements IModel{
    //view
    private $_visits=array();//trainee=>date
    
    //current id
    protected $idTeacher;
    
    public function __construct() {
    }

    public function get_visits() {
        return $this->_visits;
    }

    //second parameter is optional for setter in view model
    public function set_visits($trainee, $_date=null) {
        $this->_visits[$trainee] = $_date;
    }
    
    
    public function addBlank() {
        //
    }

    public function append() {
        
    }

    public function deleteFromId($id) {
        
    }

    public function deleteFromProperty($property, $val) {
        
    }

    public function getAll() {
        $this->resetModel();
        $collection = new DataAccess('Enseignant');
        $teacher = $collection->GetByColumnValue('ens_mel_enseignant', \UserConnected::getInstance()->getUserName());
        $this->idTeacher= $teacher->id_enseignant;
        $collection = new DataAccess('Stagiaire');
        $trainees = $collection->GetAllByColumnValue('id_enseignant', $this->idTeacher);
        $collection = new DataAccess('Activite_et_visite');
        foreach ($trainees as $trainee) {
            $visit = $collection->GetByColumnValue('id_stagiaire', $trainee->id_stagiaire);
            if($visit !=false){
                $this->set_visits($trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire, $visit->aev_date_visite);
            }else{
                $this->set_visits($trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire, 'Non défini');
            }
        }
    }

    public function resetModel() {
        $this->_visits=array();//reset
    }

    public function update($property, $val, $id) {
        
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
//    public function getAllVisits(){
//        $this->_visits=array();//reset
//        $collection = new DataAccess('Enseignant');
//        $teacher = $collection->GetByColumnValue('ens_mel_enseignant', \SeseSession::getInstance()->get('user_connected/name'));
//        $this->idTeacher= $teacher->id_enseignant;
//        $collection = new DataAccess('Stagiaire');
//        $trainees = $collection->GetAllByColumnValue('id_enseignant', $this->idTeacher);
//        $collection = new DataAccess('Activite_et_visite');
//        foreach ($trainees as $trainee) {
//            if($visit = $collection->GetByColumnValue('id_stagiaire', $trainee->id_stagiaire)!=false){
//                $this->set_visits($trainee->sta_prenom_stagiare.' '.$trainee->sta_nom_stagiare, $visit->aev_date_visite);
//            }else{
//                $this->set_visits($trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire, 'Non défini');
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


// UTILISATION D'UNE CLASSE QUE L'ON POURRAIT PASSER AU TEMPLATE ENGINE POUR PLUS DE FLEXIBILITE -- !! PB import de la dite classe au niveau template !! 
//class Appointment {
//    private $date;
//    private $hour;
//    
//    public function getDate() {
//        return $this->date;
//    }
//
//    public function getHour() {
//        return $this->hour;
//    }
//
//    public function setDate($date) {
//        $this->date = $date;
//    }
//
//    public function setHour($hour) {
//        $this->hour = $hour;
//    }
//    
//}
