<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Competences_evaluees;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of CompetenceMappingProvider
 *
 * @author laurent
 */
class Competences_evalueesMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_competences_evaluees=$row['id_competences_evaluees'];
        $item->coe_annee_evaluation=$row['coe_annee_evaluation'];
        $item->coe_ref_competence_evaluee=$row['coe_ref_competence_evaluee'];
        $item->coe_intitule_competence_evaluee=$row['coe_intitule_competence_evaluee'];
        $item->coe_descriptif_competence_evaluee=$row['coe_descriptif_competence_evaluee'];
        $item->coe_niveau_competence=$row['coe_niveau_competence'];
        $item->coe_niveau_autonomie=$row['coe_niveau_autonomie'];
        $item->id_stagiaire=$row['id_stagiaire'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_competences_evaluees']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['coe_annee_evaluation']=$item->coe_annee_evaluation;
        $retval['coe_ref_competence_evaluee']= $item->coe_ref_competence_evaluee;
        $retval['coe_intitule_competence_evaluee']=$item->coe_intitule_competence_evaluee;
        $retval['coe_descriptif_competence_evaluee']=$item->coe_descriptif_competence_evaluee;
        $retval['coe_niveau_competence']=$item->coe_niveau_competence;
        $retval['coe_niveau_autonomie']=$item->coe_niveau_autonomie;
        $retval['id_stagiaire']=$item->id_stagiaire;
        return $retval;
    }

    static function MapToRowUpdate($item){
    
        $retval['id_competences_evaluees']=$item->id_competences_evaluees;
        $retval['coe_annee_evaluation']=$item->coe_annee_evaluation;
        $retval['coe_ref_competence_evaluee']= $item->coe_ref_competence_evaluee;
        $retval['coe_intitule_competence_evaluee']=$item->coe_intitule_competence_evaluee;
        $retval['coe_descriptif_competence_evaluee']=$item->coe_descriptif_competence_evaluee;
        $retval['coe_niveau_competence']=$item->coe_niveau_competence;
        $retval['coe_niveau_autonomie']=$item->coe_niveau_autonomie;
        $retval['id_stagiaire']=$item->id_stagiaire;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_competences_evaluees'] = $item->id_competences_evaluees;
        return $retval;
    }

    static function GetID($item){
        return $item->id_competences_evaluees;
    }

    static function SetID($item,$id){
        $item->id_competences_evaluees=$id;
    }
}
