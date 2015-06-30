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
class PromotionModel extends AModel implements IModel{
    
    /**
     * view model
     */
    
    /**
     * array(id => value)
     * @var array 
     */
    private $_descriptions = array();
    /**
     * array(id => value)
     * @var array 
     */
    private $_references = array();
    
    public function get_references() {
        return $this->_references;
    }
    
    public function get_descriptions() {
        return $this->_descriptions;
    }
    
    public function set_references($_reference, $id=null) {
        if($id != null){
            $this->_references[$id] = $_reference;
        }else{
            $this->_references['new'] = $_reference;
        }
    }

    public function set_descriptions($description, $id=null) {
        if($id != null){
            $this->_descriptions[$id] = $description;
        }else{
            $this->_descriptions['new'] = $description;
        }
    }
    
    public function addBlank() {
        $this->_references['new']='';
        $this->_descriptions['new']='';
    }

    public function append() {
        $ref = end($this->_references);//last
        $decription = end($this->_descriptions);//last
        $collection = new DataAccess('Promotion');
        $promotion = new PromotionObject;
        $promotion->pro_reference_promotion = $ref;
        $promotion->pro_nom_promotion = $decription;
        $collection->Insert($promotion);
    }

    public function deleteFromId($id) {
        $collection = new DataAccess('Promotion');
        $promotion=$collection->GetByID($id);
        $collection->Delete($promotion);
    }

    public function deleteFromProperty($property, $val) {
        //
    }

    public function getAll() {
        $this->resetModel();
        $collection = new DataAccess('Promotion');
        $promotions = $collection->GetAll();
        foreach ($promotions as $promotion) {
            $this->set_references($promotion->pro_reference_promotion, $promotion->id_promotion);
            $this->set_descriptions($promotion->pro_nom_promotion, $promotion->id_promotion);
        }
    }

    public function resetModel() {
        $this->_descriptions=array();
        $this->_references=array();
    }

    public function update($property, $val, $id) {
        //
    }
    
    /**
     * UNUSED
     * Update promotion in data base
     * @param type $ref
     * @param type $description
     */
//    public function updatePromotion($ref, $description){
//        $collection = new DataAccess('Promotion');
//        $promotion=$collection->GetByColumnValue('pro_reference_promotion',$ref);
//        $promotion->pro_reference_promotion = $ref;
//        $promotion->pro_nom_promotion = $description;
//        $collection->Update($promotion);
//    }
    
}
