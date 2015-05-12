<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Activite;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of ActiviteMappingProvider
 *
 * @author laurent
 */
class ActiviteMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_activite=$row['id_activite'];
        $item->act_ref_activite=$row['act_ref_activite'];
        $item->act_intitule_activite=$row['act_intitule_activite'];
        $item->act_descriptif_activite= $row['act_descriptif_activite'];
        $item->act_est_realise=$row['act_est_realise'];
        $item->id_referentiel_de_formation=$row['id_referentiel_de_formation'];
        $item->id_fonction= $row['id_fonction'];
        
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_activite']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['act_ref_activite']=$item->act_ref_activite;
        $retval['act_intitule_activite']=$item->act_intitule_activite;
        $retval['act_descriptif_activite']=$item->act_descriptif_activite;
        $retval['act_est_realise']=$item->act_est_realise;
        $retval['id_referentiel_de_formation']=$item->id_referentiel_de_formation;
        $retval['id_fonction']=$item->id_fonction;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_activite']=$item->id_activite;
        $retval['act_ref_activite']=$item->act_ref_activite;
        $retval['act_intitule_activite']=$item->act_intitule_activite;
        $retval['act_descriptif_activite']=$item->act_descriptif_activite;
        $retval['act_est_realise']=$item->act_est_realise;
        $retval['id_referentiel_de_formation']=$item->id_referentiel_de_formation;
        $retval['id_fonction']=$item->id_fonction;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_activite'] = $item->id_activite;
        return $retval;
    }

    static function GetID($item){
        return $item->id_activite;
    }

    static function SetID($item,$id){
        $item->id_activite=$id;
    }
}
