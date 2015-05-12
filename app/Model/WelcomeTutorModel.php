<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;

use DateTime;

/**
 * Description of WorkDateModel
 *
 * @author laurent
 */
class WelcomeTutorModel extends AModel{
    //view
    private $_visitsInfos=array();//date=>(trainee=>teacher)
    
    public function __construct() {
        $this->getAllVisits();
    }

    public function get_visitsInfos() {
        return $this->_visitsInfos;
    }

    //second parameter is optional for setter in view model
//    public function set_visitsInfos($trainee, $_date=null) {
//        $this->_visits[$trainee] = $_date;
//    }

    /**
     * Get all work date from data base - reset view model
     */
    public function getAllVisits(){
        $this->_visitsInfos=array();//reset
        $collection = new DataAccess('Activite_et_visite');
        $visits = $collection->GetAll();
        setlocale(LC_TIME, 'fr_FR.UTF8');
        $currentDate = strftime('%Y-%m-%d');
        foreach ($visits as $visit) {
            if($currentDate<$visit->aev_date_visite){
                $collection = new DataAccess('Stagiaire');
                $trainee = $collection->GetByID($visit->id_stagiaire);
                $collection=new DataAccess('Enseignant');
                $teacher = $collection->GetByID($visit->id_enseignant);
                $date = $this->convertMysqlToFrDate($visit->aev_date_visite);
                $this->_visitsInfos[$date] = array(
                    $trainee->sta_prenom_stagiaire.' '.$trainee->sta_nom_stagiaire => 
                    $teacher->ens_prenom_enseignant.' '.$teacher->ens_nom_enseignant    );
            }
        }
    }
    
    public function convertMysqlToFrDate($mysqlDate){
        date_default_timezone_set('Europe/Paris');
        $date = new DateTime($mysqlDate);
        //return $date->format('D F Y'); //convert to french
        return $date->format('d/m/Y');
    }
    
   
    
    
    
}
