<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Enseignant\EnseignantObject;
use Model\Dal\ModelDb\Promotion\PromotionObject;
use Model\Dal\ModelDb\Intervenir\IntervenirObject;
use Model\Dal\ModelDb\Utilisateurs\UtilisateursObject;

/**
 * Description of teacherDefinitionModel
 *
 * @author laurent
 */
class TeacherDefinitionModel extends AModel implements IModel{
    //view 
    private $_teachersList= array();
    private $_promotionsList = array();
    private $_teacherLastName;
    private $_teacherFirstName;
    private $_teacherMail;
    private $_teacherSkill;
    // flag to view editable form for teacher
    private $_editFormVisible; //!!!! boolean doesn't work with template
    //current teacher id in view
    private $_teacherId; 
     // flag to view import form for teacher
    private $_importFormVisible; //!!!! boolean doesn't work with template
    //format of import
    private $_formatImportList=array('CSV', 'PRONOTE', 'SCONET');
    
    public function __construct() {
        $this->_editFormVisible=0; 
        $this->_importFormVisible=0;
        $this->_teacherId=null;
        $this->getAllPromotion();
    }

    //second parameter is optional for setter in view model
    public function set_teachersList($id, $identity=null) {
        if($identity===null){
            $identity='inconnu';
        }
        $this->_teachersList[$id] = $identity;
    }

    //second parameter is optional for setter in view model
    public function set_promotionsList($id, $promotion=null) {
        if($promotion===null){
            $promotion='???';
        }
        $this->_promotionsList[$id] = $promotion;
    }

    public function set_teacherLastName($_teacherLastName) {
        $this->_teacherLastName = $_teacherLastName;
    }

    public function set_teacherFirstName($_teacherFirstName) {
        $this->_teacherFirstName = $_teacherFirstName;
    }

    public function set_teacherMail($_teacherMail) {
        $this->_teacherMail = $_teacherMail;
    }

    public function set_teacherSkill($_teacherSkill) {
        $this->_teacherSkill = $_teacherSkill;
    }
    
    public function set_editFormVisible($_editFormVisible) {
        $this->_editFormVisible = $_editFormVisible;
    }
    
    public function set_teacherId($_teacherId) {
        $this->_teacherId = $_teacherId;
    }
    public function set_importFormVisible($_importFormVisible) {
        $this->_importFormVisible = $_importFormVisible;
    }
    public function set_formatImportList($_formatImportList) {
        $this->_formatImportList = $_formatImportList;
    }

    public function get_teachersList() {
        return $this->_teachersList;
    }

    public function get_promotionsList() {
        return $this->_promotionsList;
    }

    public function get_teacherLastName() {
        return $this->_teacherLastName;
    }

    public function get_teacherFirstName() {
        return $this->_teacherFirstName;
    }

    public function get_teacherMail() {
        return $this->_teacherMail;
    }

    public function get_teacherSkill() {
        return $this->_teacherSkill;
    }
    
    public function get_editFormVisible() {
        return $this->_editFormVisible;
    }
    
    public function get_teacherId() {
        if($this->_teacherId==='new'){//create teacher
            return self::__BY_VALUE_TO_TEMPLATE__.$this->_teacherId;// to be computed in template
        }
        return $this->_teacherId;
    }
        
    public function get_importFormVisible() {
        return $this->_importFormVisible;
    }
    
    public function get_formatImportList() {
        return $this->_formatImportList;
    }

    
    public function addBlank() {
        $this->_teacherId='new';
        $this->_teachersList['new']='Création d\'un enseignant';
        $this->set_teacherFirstName('');
        $this->set_teacherLastName('');
        $this->set_teacherMail('');
        $this->set_teacherSkill('');
    }

    public function append() {
        $collection = new DataAccess('Enseignant');
        $kt=array_keys($this->_teachersList);// id of teacher edited
        $teacher = $collection->GetByID($kt[0]);
        if($teacher ===false){//new teacher -> append
            $teacher = new EnseignantObject;
            $teacher->ens_prenom_enseignant = $this->_teacherFirstName;
            $teacher->ens_nom_enseignant = $this->_teacherLastName;
            $teacher->ens_mel_enseignant = $this->_teacherMail;
            $teacher->ens_discipline = $this->_teacherSkill;
            $collection->Insert($teacher);
            //update Utilisateurs
            //ajouter enseignant comme utilisateur(identifiant, mel, mot de passe) du groupe enseignant
            $collection = new DataAccess('Groupe');
            $groupe = $collection->GetByColumnValue('grp_nom_groupe','enseignant');
            $this->addToTable('Utilisateurs', array('uti_identifiant'=>  $this->_teacherMail,
                                                     'uti_mot_de_passe'=>  $this->_teacherMail,
                                                     'uti_mel'=>  $this->_teacherMail,
                                                     'id_groupe'=>$groupe->id_groupe));
        }else{//update
            $ident=$teacher->ens_mel_enseignant;
            $teacher->ens_prenom_enseignant = $this->_teacherFirstName;
            $teacher->ens_nom_enseignant = $this->_teacherLastName;
            $teacher->ens_mel_enseignant = $this->_teacherMail;
            $teacher->ens_discipline = $this->_teacherSkill;
            $collection->Update($teacher);
            //update Utilisateurs
            $collection = new DataAccess('Utilisateurs');
            $user = $collection->GetByColumnValue('uti_identifiant', $ident);
            //update & reset password
            $user->uti_identifiant=  $this->_teacherMail;
            $user->uti_mot_de_passe=  $this->_teacherMail;
            $user->uti_mel=  $this->_teacherMail;
            $collection->Update($user);
        }
    }

    public function deleteFromId($id) {
        $collection = new DataAccess('Enseignant');
        $teacher=$collection->GetByID($id);
        $collection->Delete($teacher);
        //delete from Utilisateurs with email value
        $collection = new DataAccess('Utilisateurs');
        $user = $collection->GetByColumnValue('uti_mel', $teacher->ens_mel_enseignant);
        $collection->Delete($user);
    }

    public function deleteFromProperty($property, $val) {
        //
    }

    public function getAll() {
        //$this->resetModel();no reset : properties saved during all life cycle of this class 
        $collection = new DataAccess('Enseignant');
        $teachers = $collection->GetAll();
        if(count($teachers)!=0){
            foreach ($teachers as $teacher) {
                $identity = $teacher->ens_prenom_enseignant.' '.$teacher->ens_nom_enseignant;
                $this->set_teachersList($teacher->id_enseignant,$identity);
            }
            if($this->_teacherId===null){  
                $this->set_teacherFirstName($teachers[0]->ens_prenom_enseignant);
                $this->set_teacherLastName($teachers[0]->ens_nom_enseignant);
                $this->set_teacherMail($teachers[0]->ens_mel_enseignant);
                $this->set_teacherSkill($teachers[0]->ens_discipline);
                $this->_teacherId = $teachers[0]->id_enseignant;
            }else{
                if($this->_teacherId != 'new'){//update case
                    $this->selectTeacher($this->_teacherId);
                }
            }
        }else{
            $this->set_teachersList(0,'-----------------------');
        }
    }

    public function resetModel() {
        $this->_teachersList=array();
    }

    /**
     * 
     * @param type $property
     * @param type $val
     * @param type $id : optionnal 
     */
    public function update($property, $val, $id=null) {
        if($property === '_teachersList'){
            
        }
        $this->{'set'.$property}($val);//set a property of model
        $this->selectTeacher($this->_teacherId);//select teacher from current id 
    }
    
    public function update_old($property, $val, $id=null) {
        $this->{'set'.$property}($val);//set a property of model
        $this->selectTeacher($this->_teacherId);//select teacher from current id 
    }

    /**
     * PRIVATE
     * @param type $id
     */
    public function selectTeacher($id){
        $collection = new DataAccess('Enseignant');
        $teacher = $collection->GetByID($id);
        $this->set_teacherFirstName($teacher->ens_prenom_enseignant);
        $this->set_teacherLastName($teacher->ens_nom_enseignant);
        $this->set_teacherMail($teacher->ens_mel_enseignant);
        $this->set_teacherSkill($teacher->ens_discipline);
        $this->_teacherId = $teacher->id_enseignant;
       
    }
    
    /**
     * PRIVATE
     */
    public function getAllPromotion(){
        $collection = new DataAccess('Promotion');
        $promotions =$collection->GetAll();
        foreach ($promotions as $promotion) {
            $this->set_promotionsList($promotion->id_promotion, $promotion->pro_reference_promotion.' '.$promotion->pro_nom_promotion);
        }
    }
    
    /**
     * PRIVATE
     * Add to given table 
     * @param type $tableName table name 
     * @param array $rowValue  row name => row value
     */
    public function addToTable($tableName, array $rowValue){
        $collection = new DataAccess($tableName);
        $tableClass = __NAMESPACE__.'\Dal\ModelDb\\'.$tableName.'\\'.$tableName.'Object';
        $table= new $tableClass;
        foreach ($rowValue as $row => $value){
            $table->$row=$value;
        }
        //var_dump($table);
        $collection->Insert($table);
    }
   

}
