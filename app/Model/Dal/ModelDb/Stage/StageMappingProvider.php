<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stage;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of StageMappingProvider
 *
 * @author laurent
 */
class StageMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_stage=$row['id_stage'];
        $item->stg_denomination_periode=$row['stg_denomination_periode'];
        $item->stg_date_debut=$row['stg_date_debut'];
        $item->stg_date_fin=$row['stg_date_fin'];
        $item->stg_annee=$row['stg_annee'];
        $item->id_referentiel_de_formation=$row['id_referentiel_de_formation'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_stage']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['stg_denomination_periode']=$item->stg_denomination_periode;
        $retval['stg_date_debut']=$item->stg_date_debut;
        $retval['stg_date_fin']= $item->stg_date_fin;
        $retval['stg_annee']=$item->stg_annee;
        $retval['id_referentiel_de_formation']= $item->id_referentiel_de_formation;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_stage']=$item->id_stage;
        $retval['stg_denomination_periode']=$item->stg_denomination_periode;
        $retval['stg_date_debut']=$item->stg_date_debut;
        $retval['stg_date_fin']= $item->stg_date_fin;
        $retval['stg_annee']=$item->stg_annee;
        $retval['id_referentiel_de_formation']= $item->id_referentiel_de_formation;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_stage'] = $item->id_stage;
        return $retval;
    }

    static function GetID($item){
        return $item->id_stage;
    }

    static function SetID($item,$id){
        $item->id_stage=$id;
    }
}
