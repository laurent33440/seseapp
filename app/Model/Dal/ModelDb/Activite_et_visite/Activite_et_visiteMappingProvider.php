<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Activite_et_visite;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of Activite_et_visiteMappingProvider
 *
 * @author laurent
 */
class Activite_et_visiteMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_activite_et_visite=$row['id_activite_et_visite'];
        $item->aev_date_activite=$row['aev_date_activite'];
        $item->aev_description_activite=$row['aev_description_activite'];
        $item->aev_type_acteur=$row['aev_type_acteur'];
        $item->aev_id_type_acteur=$row['aev_id_type_acteur'];
        $item->aev_date_visite=$row['aev_date_visite'];
        $item->aev_commentaire_visite=$row['aev_commentaire_visite'];
        $item->id_enseignant=$row['id_enseignant'];
        $item->id_stagiaire=$row['id_stagiaire'];
        
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_activite_et_visite']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['aev_date_activite']=$item->aev_date_activite;
        $retval['aev_description_activite']= $item->aev_description_activite;
        $retval['aev_type_acteur']=$item->aev_type_acteur;
        $retval['aev_id_type_acteur']= $item->aev_id_type_acteur;
        $retval['aev_date_visite']=$item->aev_date_visite;
        $retval['aev_commentaire_visite'] = $item->aev_commentaire_visite;
        $retval['id_enseignant']=$item->id_enseignant;
        $retval['id_stagiaire']=$item->id_stagiaire;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_activite_et_visite']=$item->id_activite_et_visite;
        $retval['aev_date_activite']=$item->aev_date_activite;
        $retval['aev_description_activite']= $item->aev_description_activite;
        $retval['aev_type_acteur']=$item->aev_type_acteur;
        $retval['aev_id_type_acteur']= $item->aev_id_type_acteur;
        $retval['aev_date_viste']=$item->aev_date_viste;
        $retval['aev_commentaire_viste'] = $item->aev_commentaire_viste;
        $retval['id_enseignant']=$item->id_enseignant;
        $retval['id_stagiaire']=$item->id_stagiaire;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_activite_et_visite'] = $item->id_activite_et_visite;
        return $retval;
    }

    static function GetID($item){
        return $item->id_activite_et_visite;
    }

    static function SetID($item,$id){
        $item->id_activite_et_visite=$id;
    }
}
