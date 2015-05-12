<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Promotion\PromotionObject;

/**
 * Description of PromotionModel
 *
 * @author laurent
 */
class PromotionModel extends AModel{
    
    //view model
    private $_descriptions = array();
    private $_references = array();
    
    public function get_references() {
        return $this->_references;
    }
    
    public function get_descriptions() {
        return $this->_descriptions;
    }
    
    public function set_references($_reference) {
        $this->_references[] = $_reference;
    }

    public function set_descriptions($description) {
        $this->_descriptions[] = $description;
    }
    
    /**
     * 
     */
    public function addBlankToViewModel(){
        $this->_references[]='';
        $this->_descriptions[]='';
    }
    
    /**
     * Get all promotions from data base - reset view model
     */
    public function getAllPromotions(){
        $this->_references=array();//reset
        $this->_descriptions=array();//reset
        $collection = new DataAccess('Promotion');
        $promotions = $collection->GetAll();
        foreach ($promotions as $promotion) {
            $this->set_references($promotion->pro_reference_promotion);
            $this->set_descriptions($promotion->pro_nom_promotion);
        }
    }
    
    /**
     * Append last model view to data base
     */
    public function appendPromotion(){
        $ref = $this->_references[count($this->_references)-1];//last
        $decription = $this->_descriptions[count($this->_descriptions)-1];//last
        $this->addPromotion($ref, $decription);
    }

    /**
     * Add promotion to data base
     * @param type $ref
     * @param type $decription
     */
    public function addPromotion($ref, $decription){
        $collection = new DataAccess('Promotion');
        $promotion = new PromotionObject;
        $promotion->pro_reference_promotion = $ref;
        $promotion->pro_nom_promotion = $decription;
        $collection->Insert($promotion);
    }

    
    /**
     * Delete promotion from database
     * @param type $ref
     */
    public function delPromotion($ref){
        $collection = new DataAccess('Promotion');
        $promotion=$collection->GetByColumnValue('pro_reference_promotion',$ref);
        $collection->Delete($promotion);
    }
    
    /**
     * Update promotion in data base
     * @param type $ref
     * @param type $description
     */
    public function updatePromotion($ref, $description){
        $collection = new DataAccess('Promotion');
        $promotion=$collection->GetByColumnValue('pro_reference_promotion',$ref);
        $promotion->pro_reference_promotion = $ref;
        $promotion->pro_nom_promotion = $description;
        $collection->Update($promotion);
    }
    
}
