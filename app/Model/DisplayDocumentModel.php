<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;


use UserConnected;
use Model\Dal\DbLibrary\DataAccess;

/**
 * Description of AdminPasswordDefinitionModel
 *
 * @author laurent
 */
class DisplayDocumentModel extends AModel implements IModel{
    //view
    private $_documentList; //array (title => doc)
   

    public function get_documentList() {
        return $this->_documentList;
    }

    public function set_documentList($title, $_documentList) {
        $this->_documentList[$title] = $_documentList;
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
        $user=  UserConnected::getInstance();
        $grpName = $user->getUserGroup();
        $collection = new DataAccess('Groupe');
        $gr = $collection->GetByColumnValue('grp_nom_groupe', $grpName);
        $collection = new DataAccess('Autoriser');
        $allPageId = $collection->GetAllByColumnValue('id_groupe', $gr->id_groupe);
        $collPage = new DataAccess('Page');
        $collDoc = new DataAccess('Documents_reference');
        foreach ($allPageId as $id){
            //get page name
            $pageN = $collPage->GetByID($id);
            //get doc from name
            $doc = $collDoc->GetByColumnValue('drf_sujet', $pageN);
            //set
            $this->set_documentList($doc->drf_sujet, $doc->drf_description_doc);
        }
    }

    public function resetModel() {
        $this->_documentList=array();
    }

    public function update($property, $val, $id) {
        
    }

}
