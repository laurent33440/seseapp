<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Stagiaire\StagiaireObject;
use Model\Dal\ModelDb\Promotion\PromotionObject;
use Model\Dal\ModelDb\Intervenir\IntervenirObject;
use Model\Dal\ModelDb\Utilisateurs\UtilisateursObject;

/**
 * Description of traineeDefinitionModel
 *
 * @author laurent
 */
class TraineeDefinitionModel extends AModel{
    //view 
    private $_traineesList= array();
    private $_promotionsList = array();
    private $_traineeLastName;
    private $_traineeFirstName;
    private $_traineeEmail;
    private $_traineePhone;
    
    //current trainee id in view
    protected $_traineeId; 
    
    public function __construct() {
        $this->updateModel();
    }

    public function get_traineesList() {
        return $this->_traineesList;
    }

    public function get_promotionsList() {
        return $this->_promotionsList;
    }

    public function get_traineeLastName() {
        return $this->_traineeLastName;
    }

    public function get_traineeFirstName() {
        return $this->_traineeFirstName;
    }

    public function get_traineeEmail() {
        return $this->_traineeEmail;
    }

    public function get_traineePhone() {
        return $this->_traineePhone;
    }

    public function set_traineesList($id, $identity=null) {
        if($identity===null){
            $identity='inconnu';
        }
        $this->_traineesList[$id] = $identity;
    }

    public function set_promotionsList($id, $promotion=null) {
        if($promotion===null){
            $promotion='???';
        }
        $this->_promotionsList[$id] = $promotion;
    }

    public function set_traineeLastName($_traineeLastName) {
        $this->_traineeLastName = $_traineeLastName;
    }

    public function set_traineeFirstName($_traineeFirstName) {
        $this->_traineeFirstName = $_traineeFirstName;
    }

    public function set_traineeEmail($_traineeMail) {
        $this->_traineeEmail = $_traineeMail;
    }

    public function set_traineePhone($_traineePhone) {
        $this->_traineePhone = $_traineePhone;
    }
    
    public function updateModel(){
        $this->getAllTrainees();
        $this->getAllPromotion();
    }

    /**
     * Get all teachers from data base - reset view model
     */
    public function getAllTrainees(){
        $this->_traineesList=array();//reset
        $collection = new DataAccess('Stagiaire');
        $trainees = $collection->GetAll();
        
        foreach ($trainees as $trainee) {
            $identity = $trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire;
            $this->set_traineesList($trainee->id_stagiaire,$identity);
        }
        if(count($trainees)!=0){
            $this->set_traineeFirstName($trainees[0]->sta_prenom_stagiaire);
            $this->set_traineeLastName($trainees[0]->sta_nom_stagiaire);
            $this->set_traineeEmail($trainees[0]->sta_mel_stagiaire);
            $this->set_traineePhone($trainees[0]->sta_url_stagiaire);
            $this->_traineeId = $trainees[0]->id_stagiaire;
        }else{
            $this->set_traineesList(0,'-----------------------');
        }
    }
    
    public function selectTrainee($id){
        $collection = new DataAccess('Stagiaire');
        $teacher = $collection->GetByID($id);
        $this->set_traineeFirstName($teacher->sta_prenom_stagiaire);
        $this->set_traineeLastName($teacher->sta_nom_stagiaire);
        $this->set_traineeEmail($teacher->sta_mel_stagiaire);
        $this->set_traineePhone($teacher->sta_url_stagiaire);
        $this->_traineeId = $teacher->id_stagiaire;
       
    }


    /**
     * Add trainee to data base
     */
    public function addTrainee(){
        $collection = new DataAccess('Stagiaire');
        $trainee = new StagiaireObject;
        $trainee->sta_prenom_stagiaire = $this->_traineeFirstName;
        $trainee->sta_nom_stagiaire = $this->_traineeLastName;
        $trainee->sta_mel_stagiaire = $this->_traineeEmail;
        $trainee->sta_url_stagiaire = $this->_traineePhone;
        $collection->Insert($trainee);
        //update Utilisateurs
        //ajouter enseignant comme utilisateur(identifiant, mel, mot de passe) du groupe enseignant
        $collection = new DataAccess('Groupe');
        $groupe = $collection->GetByColumnValue('grp_nom_groupe','stagiaire');
        $this->addToTable('Utilisateurs', array('uti_identifiant'=>  $this->_traineeEmail,
                                                 'uti_mot_de_passe'=>  $this->_traineeEmail,
                                                 'uti_mel'=>  $this->_traineeEmail,
                                                 'id_groupe'=>$groupe->id_groupe));
    }
    
    /**
     * Update teacher in data base
     */
    public function updateTrainee(){
        $collection = new DataAccess('Stagiaire');
        $teacher=$collection->GetByID($this->_traineeId);
        $teacher->sta_prenom_stagiaire = $this->_traineeFirstName;
        $teacher->sta_nom_stagiaire = $this->_traineeLastName;
        $teacher->sta_mel_stagiaire = $this->_traineeEmail;
        $teacher->sta_url_stagiaire = $this->_traineePhone;
        $collection->Update($teacher);
        //update Utilisateurs...
    }
    
    /**
     * Delete teacher from data base
     */
    public function delTrainee(){
        $collection = new DataAccess('Stagiaire');
        $trainee=$collection->GetByID($this->_traineeId);
        $collection->Delete($trainee);
        //delete from Utilisateurs with email value
        $collection = new DataAccess('Utilisateurs');
        $user = $collection->GetByColumnValue('uti_mel', $trainee->sta_mel_stagiaire);
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
        $collection->Insert($table);
    }
   

}
