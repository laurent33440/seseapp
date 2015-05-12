<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Etablissement;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of EtablissementMappingProvider
 *
 * @author laurent
 */
class EtablissementMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_etablissement = $row['id_etablissement'];
        $item->eta_nom_etablissement= $row['eta_nom_etablissement'];
        $item->eta_siret_etablissement= $row['eta_siret_etablissement'];
        $item->eta_adresse1_etablissement= $row['eta_adresse1_etablissement'];
        $item->eta_adresse2_etablissement= $row['eta_adresse2_etablissement'];
        $item->eta_ville_etablissement= $row['eta_ville_etablissement'];
        $item->eta_cp_etablissement= $row['eta_cp_etablissement'];
        $item->eta_url_etablissement= $row['eta_url_etablissement'];
        $item->eta_mel_etablissement= $row['eta_mel_etablissement'];
        $item->eta_telephone_etablissement= $row['eta_telephone_etablissement'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_etablissement']=$id;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['eta_nom_etablissement']=$item->eta_nom_etablissement;
        $retval['eta_siret_etablissement']=$item->eta_siret_etablissement;
        $retval['eta_adresse1_etablissement']=$item->eta_adresse1_etablissement;
        $retval['eta_adresse2_etablissement']=$item->eta_adresse2_etablissement;
        $retval['eta_ville_etablissement']=$item->eta_ville_etablissement;
        $retval['eta_cp_etablissement']=$item->eta_cp_etablissement;
        $retval['eta_url_etablissement']=$item->eta_url_etablissement;
        $retval['eta_mel_etablissement']=$item->eta_mel_etablissement;
        $retval['eta_telephone_etablissement']=$item->eta_telephone_etablissement;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_etablissement']=$item->id_etablissement ;
        $retval['eta_nom_etablissement']=$item->eta_nom_etablissement;
        $retval['eta_siret_etablissement']=$item->eta_siret_etablissement;
        $retval['eta_adresse1_etablissement']=$item->eta_adresse1_etablissement;
        $retval['eta_adresse2_etablissement']=$item->eta_adresse2_etablissement;
        $retval['eta_ville_etablissement']=$item->eta_ville_etablissement;
        $retval['eta_cp_etablissement']=$item->eta_cp_etablissement;
        $retval['eta_url_etablissement']=$item->eta_url_etablissement;
        $retval['eta_mel_etablissement']=$item->eta_mel_etablissement;
        $retval['eta_telephone_etablissement']=$item->eta_telephone_etablissement;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_etablissement'] = $item->id_etablissement;
        return $retval;
    }

    static function GetID($item){
        return $item->id_etablissement;
    }

    static function SetID($item,$id){
        $item->id_etablissement=$id;
    }
}
