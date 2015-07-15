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
class TutorTraineeListModel extends AModel implements IModel{
    //view
    private $_traineeList=array();//trainee=>(period=>teacher)
    
    public function __construct() {
        //$this->getAllTrainee();
    }

    public function get_traineeList() {
        return $this->_traineeList;
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
        $collection = new DataAccess('Collaborateur');
        $tutor = $collection->GetByColumnValue('col_mel', \UserConnected::getInstance()->getUserName());
        //$tutor = $collection->GetByColumnValue('col_mel', \SeseSession::getInstance()->get('user_connected/name'));
        $collection = new DataAccess('Stage_defini');
        $works=$collection->GetAllByColumnValue('id_collaborateur', $tutor->id_collaborateur);
        foreach ($works as $work) {
            $idWork = $work->id_stage_defini;
            $idTeacher = $work->id_enseignant;
            $collection = new DataAccess('Enseignant');
            $teacher = $collection->GetByColumnValue('id_enseignant', $idTeacher);
            $teacherN = $teacher->ens_prenom_enseignant.' '.$teacher->ens_nom_enseignant;
            $collection = new DataAccess('Realiser');
            $links = $collection->GetAllByColumnValue('id_stage_defini', $idWork);
            $collection=new DataAccess('Stagiaire');
            foreach ($links as $elt){
                $trainee = $collection->GetByColumnValue('id_stagiaire',$elt->id_stagiaire );
                $period = $this->getWorkPeriod($elt->id_stagiaire);
                $this->_traineeList[$trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire] = array(
                    $period => $teacherN
                );
            }
        }
    }

    public function resetModel() {
        $this->_traineeList=array();//reset
    }

    public function update($property, $val, $id) {
        
    }

    /**
     * Get all work date from data base - reset view model
     */
//    public function getAllTrainee(){
//        $this->_traineeList=array();//reset
//        $collection = new DataAccess('Collaborateur');
//        $tutor = $collection->GetByColumnValue('col_mel', \UserConnected::getInstance()->getUserName());
//        //$tutor = $collection->GetByColumnValue('col_mel', \SeseSession::getInstance()->get('user_connected/name'));
//        $collection = new DataAccess('Stage_defini');
//        $works=$collection->GetAllByColumnValue('id_collaborateur', $tutor->id_collaborateur);
//        foreach ($works as $work) {
//            $idWork = $work->id_stage_defini;
//            $idTeacher = $work->id_enseignant;
//            $collection = new DataAccess('Enseignant');
//            $teacher = $collection->GetByColumnValue('id_enseignant', $idTeacher);
//            $teacherN = $teacher->ens_prenom_enseignant.' '.$teacher->ens_nom_enseignant;
//            $collection = new DataAccess('Realiser');
//            $links = $collection->GetAllByColumnValue('id_stage_defini', $idWork);
//            $collection=new DataAccess('Stagiaire');
//            foreach ($links as $elt){
//                $trainee = $collection->GetByColumnValue('id_stagiaire',$elt->id_stagiaire );
//                $period = $this->getWorkPeriod($elt->id_stagiaire);
//                $this->_traineeList[$trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire] = array(
//                    $period => $teacherN
//                );
//            }
//        }
//    }
    
    public function getWorkPeriod($idTrainee){
        $c=new DataAccess('Realiser');
        $work = $c->GetByColumnValue('id_stagiaire', $idTrainee);
        $c=new DataAccess('Stage_defini');
        $theWork=$c->GetByColumnValue('id_stage_defini', $work->id_stage_defini);
        $c = new DataAccess('Stage');
        $mainW = $c->GetByColumnValue('id_stage', $theWork->id_stage);
        $begDate = $this->convertMysqlToFrDate($mainW->stg_date_debut);
        $endDate = $this->convertMysqlToFrDate($mainW->stg_date_fin);
        return $begDate.'--->'.$endDate;
    }

    public function convertMysqlToFrDate($mysqlDate){
        date_default_timezone_set('Europe/Paris');
        $date = new DateTime($mysqlDate);
        //return $date->format('D F Y'); //convert to french
        return $date->format('d/m/Y');
    }
    
   
    
    
    
}
