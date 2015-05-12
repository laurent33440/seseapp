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
class TeacherDefinitionModel extends AModel{
    //view 
    private $_teachersList= array();
    private $_promotionsList = array();
    private $_teacherLastName;
    private $_teacherFirstName;
    private $_teacherMail;
    private $_teacherSkill;
    
    //current teacher id in view
    protected $_teacherId; 
    
    public function __construct() {
        $this->updateModel();
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
    
    public function updateModel(){
        $this->getAllTeachers();
        $this->getAllPromotion();
    }

    /**
     * Get all teachers from data base - reset view model
     */
    public function getAllTeachers(){
        $this->_teachersList=array();//reset
        $collection = new DataAccess('Enseignant');
        $teachers = $collection->GetAll();
        foreach ($teachers as $teacher) {
            $identity = $teacher->ens_prenom_enseignant.' '.$teacher->ens_nom_enseignant;
            $this->set_teachersList($teacher->id_enseignant,$identity);
        }
        if(count($teachers)!=0){
            $this->set_teacherFirstName($teachers[0]->ens_prenom_enseignant);
            $this->set_teacherLastName($teachers[0]->ens_nom_enseignant);
            $this->set_teacherMail($teachers[0]->ens_mel_enseignant);
            $this->set_teacherSkill($teachers[0]->ens_discipline);
            $this->_teacherId = $teachers[0]->id_enseignant;
        }else{
            $this->set_teachersList(0,'-----------------------');
        }
    }
    
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
     * Add teacher to data base
     * @param type $ref
     * @param type $decription
     */
    public function addTeacher(){
        $collection = new DataAccess('Enseignant');
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
    }
    
    /**
     * Update teacher in data base
     */
    public function updateTeacher(){
        $collection = new DataAccess('Enseignant');
        $teacher=$collection->GetByID($this->_teacherId);
        $teacher->ens_prenom_enseignant = $this->_teacherFirstName;
        $teacher->ens_nom_enseignant = $this->_teacherLastName;
        $teacher->ens_mel_enseignant = $this->_teacherMail;
        $teacher->ens_discipline = $this->_teacherSkill;
        $collection->Update($teacher);
        //update Utilisateurs...
    }
    
    /**
     * Delete teacher from data base
     */
    public function delTeacher(){
        $collection = new DataAccess('Enseignant');
        $teacher=$collection->GetByID($this->_teacherId);
        $collection->Delete($teacher);
        //delete from Utilisateurs with email value
        $collection = new DataAccess('Utilisateurs');
        $user = $collection->GetByColumnValue('uti_mel', $teacher->ens_mel_enseignant);
        $collection->Delete($user);
    }
    
    public function getAllPromotion(){
        $collection = new DataAccess('Promotion');
        $promotions =$collection->GetAll();
        foreach ($promotions as $promotion) {
            $this->set_promotionsList($promotion->id_promotion, $promotion->pro_reference_promotion.' '.$promotion->pro_nom_promotion);
        }
    }
    
    /**
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
        var_dump($table);
        $collection->Insert($table);
    }
   

}
