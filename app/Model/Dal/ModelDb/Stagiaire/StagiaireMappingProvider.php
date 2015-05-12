<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stagiaire;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of StagiaireMappingProvider
 *
 * @author laurent
 */
class StagiaireMappingProvider implements IMappingProvider{

    static function MapFromRow( $row , $item ){
        $item->id_stagiaire = $row['id_stagiaire'];
        $item->sta_civilite_stagiaire=$row[ 'sta_civilite_stagiaire'];
        $item->sta_nom_stagiaire=$row[ 'sta_nom_stagiaire'];
        $item->sta_prenom_stagiaire=$row[ 'sta_prenom_stagiaire'];
        $item->sta_mel_stagiaire=$row[ 'sta_mel_stagiaire'];
        $item->sta_adresse1_stagiaire=$row[ 'sta_adresse1_stagiaire'];
        $item->sta_adresse2_stagiaire=$row[ 'sta_adresse2_stagiaire'];
        $item->sta_url_stagiaire=$row[ 'sta_url_stagiaire'];
        $item->sta_cp_stagiaire=$row[ 'sta_cp_stagiaire'];
        $item->sta_civilite_resp_legal=$row[ 'sta_civilite_resp_legal'];
        $item->sta_nom_resp_legal=$row[ 'sta_nom_resp_legal'];
        $item->sta_prenom_resp_legal=$row[ 'sta_prenom_resp_legal'];
        $item->sta_mel_resp_legal=$row['sta_mel_resp_legal'];
        $item->sta_adresse1_resp_legal=$row[ 'sta_adresse1_resp_legal'];
        $item->sta_adresse2_resp_legal=$row[ 'sta_adresse2_resp_legal'];
        $item->sta_url_resp_legal=$row[ 'sta_url_resp_legal'];
        $item->sta_cp_resp_legal=$row[ 'sta_cp_resp_legal'];
        $item->sta_affiliation=$row[ 'sta_affiliation'];
        $item->id_promotion= $row[ 'id_promotion']; //FrK//FrK
        $item->id_enseignant=$row[ 'id_enseignant']; //FrK //FrK
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_stagiaire']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['sta_civilite_stagiaire']=$item->sta_civilite_stagiaire;
        $retval['sta_nom_stagiaire']= $item->sta_nom_stagiaire;
        $retval['sta_prenom_stagiaire']= $item->sta_prenom_stagiaire;
        $retval['sta_mel_stagiaire']= $item->sta_mel_stagiaire;
        $retval['sta_adresse1_stagiaire']=$item->sta_adresse1_stagiaire;
        $retval['sta_adresse2_stagiaire']= $item->sta_adresse2_stagiaire;
        $retval['sta_url_stagiaire']=$item->sta_url_stagiaire;
        $retval['sta_cp_stagiaire']=$item->sta_cp_stagiaire;
        $retval['sta_civilite_resp_legal']=$item->sta_civilite_resp_legal;
        $retval['sta_nom_resp_legal']=$item->sta_nom_resp_legal;
        $retval['sta_prenom_resp_legal']=$item->sta_prenom_resp_legal;
        $retval['sta_mel_resp_legal']=$item->sta_mel_resp_legal;
        $retval['sta_adresse1_resp_legal']=$item->sta_adresse1_resp_legal;
        $retval['sta_adresse2_resp_legal']=$item->sta_adresse2_resp_legal;
        $retval['sta_url_resp_legal']=$item->sta_url_resp_legal;
        $retval['sta_cp_resp_legal']=$item->sta_cp_resp_legal;
        $retval['sta_affiliation']=$item->sta_affiliation;
        $retval['id_promotion']= $item->id_promotion; //FrK
        $retval['id_enseignant']= $item->id_enseignant; //FrK
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_stagiaire']= $item->id_stagiaire; //PrK
        $retval['sta_civilite_stagiaire']=$item->sta_civilite_stagiaire;
        $retval['sta_nom_stagiaire']= $item->sta_nom_stagiaire;
        $retval['sta_prenom_stagiaire']= $item->sta_prenom_stagiaire;
        $retval['sta_mel_stagiaire']= $item->sta_mel_stagiaire;
        $retval['sta_adresse1_stagiaire']=$item->sta_adresse1_stagiaire;
        $retval['sta_adresse2_stagiaire']= $item->sta_adresse2_stagiaire;
        $retval['sta_url_stagiaire']=$item->sta_url_stagiaire;
        $retval['sta_cp_stagiaire']=$item->sta_cp_stagiaire;
        $retval['sta_civilite_resp_legal']=$item->sta_civilite_resp_legal;
        $retval['sta_nom_resp_legal']=$item->sta_nom_resp_legal;
        $retval['sta_prenom_resp_legal']=$item->sta_prenom_resp_legal;
        $retval['sta_mel_resp_legal']=$item->sta_mel_resp_legal;
        $retval['sta_adresse1_resp_legal']=$item->sta_adresse1_resp_legal;
        $retval['sta_adresse2_resp_legal']=$item->sta_adresse2_resp_legal;
        $retval['sta_url_resp_legal']=$item->sta_url_resp_legal;
        $retval['sta_cp_resp_legal']=$item->sta_cp_resp_legal;
        $retval['sta_affiliation']=$item->sta_affiliation;
        $retval['id_promotion']= $item->id_promotion; //FrK
        $retval['id_enseignant']= $item->id_enseignant; //FrK
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_stagiaire'] = $item->id_stagiaire;
        return $retval;
    }

    static function GetID($item){
        return $item->id_stagiaire;
    }

    static function SetID($item,$id){
        $item->id_stagiaire=$id;
    }
}
