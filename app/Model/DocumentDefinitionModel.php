<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Documents_reference\Documents_referenceObject;

/**
 * Description of DocumentDefinitionModel
 *
 * @author laurent
 */
class DocumentDefinitionModel extends AModel implements IModel{
    private $_documentTypeList = array('Convention', 'Document pédagogique');
    private $_readerList = array( 'Tuteur', 'Stagiaire');
    private $_docList=array( );
    
    private $_documentType;
    private $_docName;
    private $_newDocName=null;
    private $_access = array();
    private $_doc;
    
    public function get_documentTypeList() {
        return $this->_documentTypeList;
    }

    public function get_readerList() {
        return $this->_readerList;
    }
    
    public function get_docList() {
        return $this->_docList;
    }
    
    public function set_documentType($_documentType) {
        $this->_documentType = $_documentType;
    }

    public function set_docName($_documentName) {
        $this->_docName = $_documentName;
    }
    
    public function set_newDocName($_newDocName) {
        $this->_newDocName = $_newDocName;
    }

    public function set_access($_access) {
        $this->_access = $_access;
    }

    public function set_doc($_doc) {
        $this->_doc = $_doc;
    }
    
    public function addBlank() {
        
    }

    public function append() {
        $collection = new DataAccess('Documents_reference');
        if(!empty($this->_newDocName)){//new
            $drf = new Documents_referenceObject();
            $drf->drf_sujet = $this->_newDocName;
            $drf->drf_description_doc = $this->_doc;
            $collection->Insert($drf);
        }else{//get existing & update
            $doc = $collection->GetByColumnValue('drf_sujet', $this->_docName);
            $doc->drf_description_doc = $this->_doc;
            $collection->Update($doc);
            
        }
    }

    public function deleteFromId($id) {
        
    }

    public function deleteFromProperty($property, $val) {
        
    }

    public function getAll() {
        $this->getDocList();
    }

    public function resetModel() {
        
    }

    public function update($property, $val, $id) {
        
    }
    
    public function getDocList(){
        $collection = new DataAccess('Documents_reference');
        $docs = $collection->GetAll();
        foreach ($docs as $doc) {
            $this->_docList[$doc->id_documents_reference] = $doc->drf_sujet;
        }
        reset($docs);
        $doc=$docs[0];
        $this->_doc = $doc->drf_description_doc;
    }

    
    




    
    
}
