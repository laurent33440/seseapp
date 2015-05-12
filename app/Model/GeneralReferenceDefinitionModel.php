<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Referentiel_de_formation\Referentiel_de_formationObject;

/**
 * Description of GeneralReferenceDefinitionModel
 *
 * @author prog
 */
class GeneralReferenceDefinitionModel extends AModel{
    private $_trainingName;
    private $_trainingDomain;
    private $_referentialReference;
    private $_referencialName;
    private $_referentialSpecification;
    private $_trainingTime;
    private $_internshipDuration;
    
    public function get_trainingName() {
        return $this->_trainingName;
    }

    public function get_trainingDomain() {
        return $this->_trainingDomain;
    }

    public function get_referentialReference() {
        return $this->_referentialReference;
    }

    public function get_referencialName() {
        return $this->_referencialName;
    }

    public function get_referentialSpecification() {
        return $this->_referentialSpecification;
    }

    public function get_trainingTime() {
        return $this->_trainingTime;
    }

    public function get_internshipDuration() {
        return $this->_internshipDuration;
    }

    public function set_trainingName($_trainingName) {
        $this->_trainingName = $_trainingName;
    }

    public function set_trainingDomain($_trainingDomain) {
        $this->_trainingDomain = $_trainingDomain;
    }

    public function set_referentialReference($_referentialReference) {
        $this->_referentialReference = $_referentialReference;
    }

    public function set_referencialName($_referencialName) {
        $this->_referencialName = $_referencialName;
    }

    public function set_referentialSpecification($_referentialSpecification) {
        $this->_referentialSpecification = $_referentialSpecification;
    }

    public function set_trainingTime($_trainingTime) {
        $this->_trainingTime = $_trainingTime;
    }

    public function set_internshipDuration($_internshipDuration) {
        $this->_internshipDuration = $_internshipDuration;
    }
    
    /**
     * Create referential
     */
    public function createReferential(){
        $collection = new DataAccess('Referentiel_de_formation');
        $item = $collection->GetByID(1);
        if($item === FALSE){
            $item = new Referentiel_de_formationObject;
            $item->rdf_nom_formation=  $this->_trainingName; 
            $item->rdf_domaine_formation=  $this->_trainingDomain;
            $item->rdf_reference=  $this->_referentialReference;
            $item->rdf_intitule= $this->_referencialName;
            $item->rdf_descriptif= $this->_referentialSpecification;
            $item->rdf_duree_formation=  $this->_trainingTime;
            $item->rdf_nombre_jours_stage= $this->_internshipDuration;
            $collection->Insert($item);
        }else{ // avoid multiple referential
            $item->rdf_nom_formation=  $this->_trainingName; 
            $item->rdf_domaine_formation=  $this->_trainingDomain;
            $item->rdf_reference=  $this->_referentialReference;
            $item->rdf_intitule= $this->_referencialName;
            $item->rdf_descriptif= $this->_referentialSpecification;
            $item->rdf_duree_formation=  $this->_trainingTime;
            $item->rdf_nombre_jours_stage= $this->_internshipDuration;
            $collection->Update($item);
        }       
    }
    
    /**
     * 
     */
    public function getReferentialFromDataBase(){
        $collection = new DataAccess('Referentiel_de_formation');
        $item = $collection->GetByID(1);
        if($item != FALSE){
            $this->_trainingName =  $item->rdf_nom_formation ; 
            $this->_trainingDomain = $item->rdf_domaine_formation  ;
            $this->_referentialReference = $item->rdf_reference  ;
            $this->_referencialName = $item->rdf_intitule ;
            $this->_referentialSpecification = $item->rdf_descriptif ;
            $this->_trainingTime = $item->rdf_duree_formation  ;
            $this->_internshipDuration = $item->rdf_nombre_jours_stage ;
        }// else don't hang just let empty model lives 
    }
    
    
}
