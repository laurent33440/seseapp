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
    //groups allways allowed to read doc
    private $_FULL_READER_GROUP = array('administrateur', 'enseignant');
    
    //view
    private $_documentList=array(); //array (title => doc)
   

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
        if(in_array($grpName, $this->_FULL_READER_GROUP)){
            $collDoc = new DataAccess('Documents_reference');
            $all = $collDoc->GetAll();
            foreach ($all as $doc) {
                $this->set_documentList($doc->drf_sujet, $doc->drf_description_doc);
            }
        }else{
            $collection = new DataAccess('Groupe');
            $gr = $collection->GetByColumnValue('grp_nom_groupe', $grpName);
            $collection = new DataAccess('Autoriser');
            $allAuth = $collection->GetAllByColumnValue('id_groupe', $gr->id_groupe);
            if(empty($allAuth)){
                $this->set_documentList('Aucun document consultable', '-------------');
            }else{
                $collPage = new DataAccess('Page');
                $collDoc = new DataAccess('Documents_reference');
                //var_dump($allAuth);
                foreach ($allAuth as $auth){
                    //var_dump($auth);
                    //get page name
                    $page = $collPage->GetByID($auth->id_page);
                    //var_dump($page);
                    //get doc from name
                    $doc = $collDoc->GetByColumnValue('drf_sujet', $page->pge_nom_page);
                    //var_dump($doc);
                    //set
                    $this->set_documentList($doc->drf_sujet, $doc->drf_description_doc);
                }
            }
        }
    }

    public function resetModel() {
        $this->_documentList=array();
    }

    public function update($property, $val, $id) {
        
    }

}
