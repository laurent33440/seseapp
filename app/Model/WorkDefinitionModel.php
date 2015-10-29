<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Entreprise\EntrepriseObject;
use Model\Dal\ModelDb\Employer\EmployerObject;
use Model\Dal\ModelDb\Collaborateur\CollaborateurObject;
use Model\Dal\ModelDb\Stage\StageObject;
use Model\Dal\ModelDb\Stage_defini\Stage_definiObject;


/**
 * Description of WorkDefinitionModel
 *
 * @author laurent
 */
class WorkDefinitionModel extends AModel implements IModel{
    const WORK_CREATED = 'cree';
    
    //view
    private $_workNameList=array();
    private $_traineeList=array();
    private $_teacherList=array();
    private $_companyList=array();
    private $_companyName;
    private $_companyActivity;
    private $_companySiret;
    private $_companyAddress;
    private $_companyCity;
    private $_companyZip;
    private $_companyPhone;
    private $_companyEmail;
    private $_employeeList=array();
    private $_employeeLastName;
    private $_employeeFirstName;
    private $_employeePhone;
    private $_employeeEmail;
    private $_employeeRole;
    
    //currents ids
    protected $id_workName;
    protected $id_trainee;
    protected $id_teacher;
    protected $id_employee;
    protected $id_company;
    
    public function __construct() {
       
    }
    
    public function get_workNameList() {
        return $this->_workNameList;
    }

    public function get_traineeList() {
        return $this->_traineeList;
    }
    
    public function get_teacherList() {
        return $this->_teacherList;
    }

    public function get_companyList() {
        return $this->_companyList;
    }

    public function get_companyName() {
        return $this->_companyName;
    }

    public function get_companyActivity() {
        return $this->_companyActivity;
    }

    public function get_companySiret() {
    return $this->_companySiret;
    }

    public function get_companyAddress() {
    return $this->_companyAddress;
    }

    public function get_companyCity() {
    return $this->_companyCity;
    }

    public function get_companyZip() {
    return $this->_companyZip;
    }

    public function get_companyPhone() {
    return $this->_companyPhone;
    }

    public function get_companyEmail() {
    return $this->_companyEmail;
    }

    public function get_employeeList() {
    return $this->_employeeList;
    }

    public function get_employeeLastName() {
    return $this->_employeeLastName;
    }

    public function get_employeeFirstName() {
    return $this->_employeeFirstName;
    }

    public function get_employeePhone() {
    return $this->_employeePhone;
    }

    public function get_employeeEmail() {
    return $this->_employeeEmail;
    }

    public function get_employeeRole() {
    return $this->_employeeRole;
    }

    //second parameter is optional for setter in view model
    public function set_workNameList($id, $_promotion=null) {
    $this->_workNameList[$id] = $_promotion;
    }

    //second parameter is optional for setter in view model
    public function set_traineeList($id, $_trainee=null) {
    $this->_traineeList[$id] = $_trainee;
    }
    
    //second parameter is optional for setter in view model
    public function set_teacherList($id, $_teacherList=null) {
        $this->_teacherList[$id] = $_teacherList;
    }

    //second parameter is optional for setter in view model
    public function set_companyList($id, $_company=null) {
    $this->_companyList[$id] = $_company;
    }

    public function set_companyName($_companyName) {
    $this->_companyName = $_companyName;
    }

    public function set_companyActivity($_companyActivity) {
    $this->_companyActivity = $_companyActivity;
    }

    public function set_companySiret($_Siret) {
    $this->_companySiret = $_Siret;
    }

    public function set_companyAddress($_Address) {
    $this->_companyAddress = $_Address;
    }

    public function set_companyCity($_City) {
    $this->_companyCity = $_City;
    }

    public function set_companyZip($_Zip) {
    $this->_companyZip = $_Zip;
    }

    public function set_companyPhone($_Phone) {
    $this->_companyPhone = $_Phone;
    }

    public function set_companyEmail($_Email) {
    $this->_companyEmail = $_Email;
    }

    public function set_employeeList($id, $_employee=null) {
    $this->_employeeList[$id] = $_employee;
    }

    public function set_employeeLastName($_employeeLastName) {
    $this->_employeeLastName = $_employeeLastName;
    }

    public function set_employeeFirstName($_employeeFirstName) {
    $this->_employeeFirstName = $_employeeFirstName;
    }

    public function set_employeePhone($_employeePhone) {
    $this->_employeePhone = $_employeePhone;
    }

    public function set_employeeEmail($_employeeEmail) {
    $this->_employeeEmail = $_employeeEmail;
    }

    public function set_employeeRole($_employeeRole) {
    $this->_employeeRole = $_employeeRole;
    }
    
    public function setId_trainee($id_trainee) {
        $this->id_trainee = $id_trainee;
    }
    
    public function addBlank() {
        //
    }

    public function append() {
        $collection = new DataAccess('Stage_defini');
        $work = new Stage_definiObject;
        $work->stgdef_status = self::WORK_CREATED;
        $work->id_stage=$this->id_workName;
        $work->id_collaborateur=$this->addEmployee();
        $work->id_enseignant=$this->id_teacher;
        $collection->Insert($work);
    }

    public function deleteFromId($id) {
        //
    }

    /**
     * Delete work in progress from trainee id
     * @param type $property : trainee_id
     * @param type $val: unused
     */
    public function deleteFromProperty($property='id_trainee', $val=null) {
        $collection = new DataAccess('Realiser');
        $link = $collection->GetByColumnValue('id_stagiaire', $this->id_trainee);
        $collection->Delete($link);
        $collection = new DataAccess('Stage_defini');
        var_dump($link);
        $work = $collection->GetByID($link->id_stage_defini);
        var_dump($work);
        $collection->Delete($work);
    }

    public function getAll() {
        $this->getAllWorkName();
        $this->getAllTrainees();
        $this->getAllTeachers();
        $this->getAllCompanies();
    }

    public function resetModel() {
        //
    }

    public function update($property, $val, $id) {
        
    }

    
    //PRIVATE
    public function getAllWorkName(){
        $collection = new DataAccess('Stage');
        $rows = $collection->GetAll();
        foreach ($rows as $row) {
            $this->set_workNameList($row->id_stage, $row->stg_denomination_periode);
        }
        if(!empty($rows[0])){
            $this->id_workName=$rows[0]->id_stage;
        }else{
            $this->set_workNameList(0,'-----------------------');
        }
    }
    
    //PRIVATE
    public function getAllTrainees(){
        $collection = new DataAccess('Stagiaire');
        $rows = $collection->GetAll();
        foreach ($rows as $row) {
            $this->set_traineeList($row->id_stagiaire, $row->sta_nom_stagiaire);
        }
        if(!empty($rows[0])){
            $this->id_trainee=$rows[0]->id_stagiaire;
        }else{
            $this->set_traineeList(0,'-----------------------');
        }
    }
    
    //PRIVATE
    public function getAllTeachers(){
        $collection = new DataAccess('Enseignant');
        $rows = $collection->GetAll();
        foreach ($rows as $row) {
            $this->set_teacherList($row->id_enseignant, $row->ens_nom_enseignant);
        }if(!empty($rows[0])){
            $this->id_teacher=$rows[0]->id_enseignant;
        }else{
            $this->set_teacherList(0,'-----------------------');
        }
    }
    
    //PRIVATE
    public function getAllCompanies(){
        $collection = new DataAccess('Entreprise');
        $rows = $collection->GetAll();
        foreach ($rows as $row) {
            $this->set_companyList($row->id_entreprise,$row->ent_nom_entreprise);
        }
        if(!empty($rows[0])){
            $this->_companyName=$rows[0]->ent_nom_entreprise;
            $this->_companyActivity=$rows[0]->ent_activite;
            $this->_companySiret=$rows[0]->ent_siret;
            $this->_companyAddress=$rows[0]->ent_adresse1_entreprise;
            $this->_companyCity=$rows[0]->ent_ville_entreprise;
            $this->_companyZip=$rows[0]->ent_cp_entreprise;
            $this->_companyPhone=$rows[0]->ent_telephone_entreprise;
            $this->_companyEmail=$rows[0]->ent_url_entreprise;
            $this->id_company=$rows[0]->id_entreprise;
            $this->getAllEmployees($this->id_company);
        }else{
            $this->set_companyList(0,'-----------------------');
            $this->getAllEmployees(null);
        }
    }
    
    //PRIVATE
    public function getAllEmployees($id_company=null){
        if($id_company===null){
            $this->set_employeeList(0,'-----------------------');
        }else{
            $links = new Dal\DbLibrary\DataAccess('Employer');
            $employeeLinkList = $links->GetAllByColumnValue('id_entreprise', $id_company);
            if (count($employeeLinkList)!=0){
                $collection = new DataAccess('Collaborateur');
                foreach ($employeeLinkList as $employeeLink) {
                    $row = $collection->GetById($employeeLink->id_collaborateur);
                    $this->set_employeeList($employeeLink->id_collaborateur,$row->col_nom.' '.$row->col_prenom);
                }
                $employeeLink = $employeeLinkList[0];//get first
                $row = $collection->GetById($employeeLink->id_collaborateur);
                $this->_employeeLastName=$row->col_nom;
                $this->_employeeFirstName=$row->col_prenom;
                $this->_employeePhone=$row->col_tel;
                $this->_employeeEmail=$row->col_mel;
                $this->_employeeRole=$row->col_role_entreprise;
                $this->id_employee = $row->id_collaborateur;
            }else{
                $this->set_employeeList(0,'-----------------------');
            }
        }
    }
    
    /**
     * UNUSED 
     * Update teacher in data base
     */
//    public function updateWork(){
//        $collection = new DataAccess('Stage');
//        $teacher=$collection->GetByID($this->_traineeId);
//        $teacher->sta_prenom_stagiaire = $this->_traineeFirstName;
//        $teacher->sta_nom_stagiaire = $this->_traineeLastName;
//        $teacher->sta_mel_stagiaire = $this->_traineeEmail;
//        $teacher->sta_url_stagiaire = $this->_traineePhone;
//        $collection->Update($teacher);
//        //update Utilisateurs...
//    }
      
    //PRIVATE
    public function addCompany(){
        $collection = new Dal\DbLibrary\DataAccess('Entreprise');
        $company=$collection->GetByColumnValue('ent_nom_entreprise', $this->_companyName);
        if($company===false){//new -> add to db
            $company = new Dal\ModelDb\Entreprise\EntrepriseObject;
            $company->ent_nom_entreprise=  $this->_companyName;
            $company->ent_activite = $this->_companyActivity;
            $company->ent_adresse1_entreprise=  $this->_companyAddress;
            $company->ent_siret = $this->_companySiret;
            $company->ent_cp_entreprise = $this->_companyZip;
            $company->ent_ville_entreprise= $this->_companyCity;
            $company->ent_telephone_entreprise = $this->_companyPhone;
            $company->ent_url_entreprise= $this->_companyEmail;
            $company->ent_date_enregistrement = strftime('%A %d %B %Y');
            $collection->Insert($company);
        }
        return $company->id_entreprise;
    }
    
    // PRIVATE
    // we suppose that an employee only work in ONE company
    public function addEmployee(){
        $collection = new Dal\DbLibrary\DataAccess('Collaborateur');
        $employee = $collection->GetByColumnValue('col_mel', $this->_employeeEmail);
        if($employee===false){//new -> add to db
            $employee = new Dal\ModelDb\Collaborateur\CollaborateurObject;
            $employee->col_nom = $this->_employeeLastName;
            $employee->col_prenom = $this->_employeeFirstName;
            $employee->col_tel = $this->_employeePhone;
            $employee->col_mel = $this->_employeeEmail;
            $employee->col_role_entreprise = $this->_employeeRole;
            $employee->col_compte = strftime('%A %d %B %Y');
            $collection->Insert($employee);
            $idCompany = $this->addCompany();
            $c2 = new Dal\DbLibrary\DataAccess('Employer');
            $link = new Dal\ModelDb\Employer\EmployerObject;
            $link->id_entreprise = $idCompany;
            $link->id_collaborateur = $employee->id_collaborateur;
            $c2->Insert($link);
            //add employee to 'Utilisateurs' data base
            $collection = new DataAccess('Groupe');
            $groupe = $collection->GetByColumnValue('grp_nom_groupe','tuteur');
            $this->addToTable('Utilisateurs', array('uti_identifiant'=>  $this->_employeeEmail,
                                                 'uti_mot_de_passe'=>  $this->_employeeEmail,
                                                 'uti_mel'=>  $this->_employeeEmail,
                                                 'id_groupe'=>$groupe->id_groupe));
        }
        return $employee->id_collaborateur;
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
        $collection->Insert($table);
    }
    
    
}


