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
class WorkDateModel extends AModel implements IModel{
    //view
    private $_workDateName=array();
    private $_dateOn = array();
    private $_dateOff = array();
    
    public function __construct() {
    }

    public function get_workDateName() {
        return $this->_workDateName;
    }

    public function get_dateOn() {
        return $this->_dateOn;
    }

    public function get_dateOff() {
        return $this->_dateOff;
    }

    public function set_workDateName($_workDateName,$id=null) {
        $this->_workDateName[$id] = $_workDateName;
    }

    public function set_dateOn($_dateOn ,$id=null) {
        $this->_dateOn[$id] = $_dateOn;
    }

    public function set_dateOff($_dateOff, $id=null) {
        $this->_dateOff[$id] = $_dateOff;
    }
    
    
    public function addBlank() {
        $this->_workDateName['new']='';
        $this->_dateOn['new']='';
        $this->_dateOff['new']='';
    }

    public function append() {
        $name = end($this->_workDateName);//last
        $dOn = end($this->_dateOn);//last
        $dOff = end($this->_dateOff);//last
        $collection = new DataAccess('Stage');
        $work = new StageObject;
        $work->stg_denomination_periode = $name;
        $work->stg_date_debut = $dOn;
        $work->stg_date_fin = $dOff;
        $collection->Insert($work);
    }

    public function deleteFromId($id) {
        $collection = new DataAccess('Stage');
        $work=$collection->GetByID($id);
        $collection->Delete($work);
    }

    public function deleteFromProperty($property, $val) {
        //
    }

    public function getAll() {
        $this->resetModel();
        $collection = new DataAccess('Stage');
        $works = $collection->GetAll();
        foreach ($works as $work) {
            $this->set_workDateName($work->stg_denomination_periode, $work->id_stage);
            $this->set_dateOn($work->stg_date_debut, $work->id_stage);
            $this->set_dateOff($work->stg_date_fin ,$work->id_stage);
        }
    }

    public function resetModel() {
        $this->_workDateName=array();
        $this->_dateOn=array();
        $this->_dateOff=array();
    }

    public function update($property, $val, $id) {
        //
    }

    
    
    //////////////////
    /**
     * 
     */
//    public function addBlankToViewModel(){
//        $this->_workDateName[]='';
//        $this->_dateOn[]='';
//        $this->_dateOff[]='';
//    }
//
//    /**
//     * Get all work date from data base - reset view model
//     */
//    public function getAllWorkDates(){
//        $this->_workDateName=array();//reset
//        $this->_dateOn=array();
//        $this->_dateOff=array();
//        $collection = new DataAccess('Stage');
//        $works = $collection->GetAll();
//        foreach ($works as $work) {
//            $this->set_workDateName($work->stg_denomination_periode);
//            $this->set_dateOn($work->stg_date_debut);
//            $this->set_dateOff($work->stg_date_fin);
//        }
//    }
//    
//    /**
//     * Append last model view to data base
//     */
//    public function appendWorkDate(){
//        $name = $this->_workDateName[count($this->_workDateName)-1];//last
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
    
    /** UNUSED
     * Update work date in data base
     * @param type $workName
     * @param type $dateOn
     * @param type $dateOff
     */
//    public function updatePromotion($workName, $dateOn, $dateOff){
//        $collection = new DataAccess('Stage');
//        $work=$collection->GetByColumnValue('stg_denomination_periode',$workName);
//        $work->stg_denomination_periode = $workName;
//        $work->stg_date_debut = $dateOn;
//        $work->stg_date_fin = $dateOff;
//        $collection->Update($work);
//    }
    
}
