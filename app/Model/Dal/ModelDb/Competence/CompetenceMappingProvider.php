<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Competence;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of CompetenceMappingProvider
 *
 * @author laurent
 */
class CompetenceMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_competence= $row['id_competence'];
        $item->comp_ref_comptetence=$row['comp_ref_comptetence'];
        $item->comp_intitule_competence=$row['comp_intitule_competence'];
        $item->descriptif_competence=$row['descriptif_competence'];
        $item->comp_est_evaluable= $row['comp_est_evaluable'];
        $item->comp_est_evaluee=$row['comp_est_evaluee'];
        $item->comp_niveau_competence= $row['comp_niveau_competence'];
        $item->comp_niveau_autonomie=$row['comp_niveau_autonomie'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_competence']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['comp_ref_comptetence']=$item->comp_ref_comptetence;
        $retval['comp_intitule_competence']=$item->comp_intitule_competence;
        $retval['descriptif_competence']=$item->descriptif_competence;
        $retval['comp_est_evaluable']= $item->comp_est_evaluable;
        $retval['comp_est_evaluee']=$item->comp_est_evaluee;
        $retval['comp_niveau_competence']=$item->comp_niveau_competence;
        $retval['comp_niveau_autonomie']=$item->comp_niveau_autonomie;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_competence']=$item->id_competence;
        $retval['comp_ref_comptetence']=$item->comp_ref_comptetence;
        $retval['comp_intitule_competence']=$item->comp_intitule_competence;
        $retval['descriptif_competence']=$item->descriptif_competence;
        $retval['comp_est_evaluable']= $item->comp_est_evaluable;
        $retval['comp_est_evaluee']=$item->comp_est_evaluee;
        $retval['comp_niveau_competence']=$item->comp_niveau_competence;
        $retval['comp_niveau_autonomie']=$item->comp_niveau_autonomie;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_competence'] = $item->id_competence;
        return $retval;
    }

    static function GetID($item){
        return $item->id_competence;
    }

    static function SetID($item,$id){
        $item->id_competence=$id;
    }
}
