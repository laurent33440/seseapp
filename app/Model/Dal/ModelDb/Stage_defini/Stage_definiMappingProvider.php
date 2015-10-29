<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stage_defini;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of Stage_definiMappingProvider
 *
 * @author laurent
 */
class Stage_definiMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_stage_defini=$row['id_stage_defini'];
        $item->stgdef_est_ouvrable= $row['stgdef_est_ouvrable'];
        $item->stgdef_status= $row['stgdef_status'];
        $item->stgdef_est_evalue=$row['stgdef_est_evalue'];
        $item->stgdef_commentaire_tuteur= $row['stgdef_commentaire_tuteur'];
        $item->id_collaborateur=$row['id_collaborateur'];
        $item->id_stage=$row['id_stage'];
        $item->id_enseignant= $row['id_enseignant'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_stage_defini']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['stgdef_est_ouvrable']=$item->stgdef_est_ouvrable;
        $retval['stgdef_status']=$item->stgdef_status;
        $retval['stgdef_est_evalue']=$item->stgdef_est_evalue;
        $retval['stgdef_commentaire_tuteur']=$item->stgdef_commentaire_tuteur;
        $retval['id_collaborateur']=$item->id_collaborateur;
        $retval['id_stage']= $item->id_stage;
        $retval['id_enseignant']= $item->id_enseignant;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_stage_defini']=$item->id_stage_defini;
        $retval['stgdef_est_ouvrable']=$item->stgdef_est_ouvrable;
        $retval['stgdef_status']=$item->stgdef_status;
        $retval['stgdef_est_evalue']=$item->stgdef_est_evalue;
        $retval['stgdef_commentaire_tuteur']=$item->stgdef_commentaire_tuteur;
        $retval['id_collaborateur']=$item->id_collaborateur;
        $retval['id_stage']= $item->id_stage;
        $retval['id_enseignant']= $item->id_enseignant;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_stage_defini'] = $item->id_stage_defini;
        return $retval;
    }

    static function GetID($item){
        return $item->id_stage_defini;
    }

    static function SetID($item,$id){
        $item->id_stage_defini=$id;
    }
}
