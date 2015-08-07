<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Documents_reference\Documents_referenceObject;
use Model\Dal\ModelDb\Page\PageObject;
use Model\Dal\ModelDb\Autoriser\AutoriserObject;

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
    private $_documentContent;
    
    public function get_documentTypeList() {
        return $this->_documentTypeList;
    }

    public function get_readerList() {
        return $this->_readerList;
    }
    
    public function get_docList() {
        return $this->_docList;
    }
    public function get_documentContent() {
        return $this->_documentContent;
    }
    
    public function get_documentSubject(){
        return $this->_docName;
    }

            //for debug
    public function get_access() {
        return $this->_access;
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

    public function set_access($_access, $reader) {
        $this->_access[$reader] = $_access;
        
    }

    public function set_documentContent($_doc) {
        $this->_documentContent = $_doc;
    }
    
    public function addBlank() {
        
    }

    public function append() {
        $collection = new DataAccess('Documents_reference');
        if(!empty($this->_newDocName)){//new
            $drf = new Documents_referenceObject();
            $drf->drf_sujet = $this->_newDocName;
            $drf->drf_description_doc = $this->_documentContent;
            $drf->drf_type = $this->_documentType;
            \Logger::getInstance()->logDebug(__CLASS__.'  DOC cONTENT: '.print_r($this->_documentContent,true));
            $collection->Insert($drf);
            //m a j droits sur document
            $this->updateAccessToDoc($drf->drf_sujet);
        }else{//get existing & update
            $doc = $collection->GetByColumnValue('drf_sujet', $this->_docName);
            $doc->drf_description_doc = $this->_documentContent;
            $doc->drf_type = $this->_documentType;
            $collection->Update($doc);
            $this->updateAccessToDoc($this->_docName);
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

    public function update($property, $val, $id=null) {
        if($property === '_docName'){
            $this->getDocList();// update list
            \Logger::getInstance()->logDebug(__CLASS__.'  AJAX VAL: '.print_r($val,true));
            $this->_docName = $val;
            //\Logger::getInstance()->logDebug(__CLASS__.'  AJAX LIST DOC: '.print_r($this->_docList,true));
            $id = array_search($val, $this->_docList);
            //\Logger::getInstance()->logDebug(__CLASS__.'  AJAX ID: '.print_r($id,true));
            $collection = new DataAccess('Documents_reference');
            $doc = $collection->GetByID($id);
            $this->_documentContent = $doc->drf_description_doc;
             //\Logger::getInstance()->logDebug(__CLASS__.' TEST TEST : '.print_r($this->_documentContent,true));
        }
        
    }
    
    public function getDocList(){
        $collection = new DataAccess('Documents_reference');
        $docs = $collection->GetAll();
        foreach ($docs as $doc) {
            $this->_docList[$doc->id_documents_reference] = $doc->drf_sujet;
        }
        reset($docs);
        $doc=$docs[0];
        $this->_documentContent = $doc->drf_description_doc;
        $this->_docName = $doc->drf_sujet;
    }
    
    public function updateAccessToDoc($docTitle){
        $p=new PageObject;
        $p->pge_nom_page=$docTitle;
        $cp=new DataAccess('Page');
        $cp->Insert($p);
        $ca = new DataAccess('Autoriser');
        $cg = new DataAccess('Groupe');
        foreach ($this->_access as $reader){
            $a = new AutoriserObject;
            $g=$cg->GetByColumnValue('grp_nom_groupe', $reader);
            $a->id_groupe = $g->id_groupe;
            $a->id_page = $p->id_page;
            $a->type_droit = 'lecture';
            $ca->Insert($a);
        }
    }
    
    
}