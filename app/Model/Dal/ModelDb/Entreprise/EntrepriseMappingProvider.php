<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Entreprise;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of EntrepriseMappingProvider
 *
 * @author laurent
 */
class EntrepriseMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_entreprise=$row['id_entreprise'];
        $item->ent_nom_entreprise= $row['ent_nom_entreprise'];
        $item->ent_nom_commercial=$row['ent_nom_commercial'];
        $item->ent_siret=$row['ent_siret'];
        $item->ent_activite=$row['ent_activite'];
        $item->ent_profil=$row['ent_profil'];
        $item->ent_stagiaires_recus=$row['ent_stagiaires_recus'];
        $item->ent_commentaire=$row['ent_commentaire'];
        $item->ent_date_enregistrement=$row['ent_date_enregistrement'];
        $item->ent_adresse1_entreprise=$row['ent_adresse1_entreprise'];
        $item->ent_adresse2_entreprise=$row['ent_adresse2_entreprise'];
        $item->ent_ville_entreprise=$row['ent_ville_entreprise'];
        $item->ent_cp_entreprise=$row['ent_cp_entreprise'];
        $item->ent_pays_entreprise=$row['ent_pays_entreprise'];
        $item->ent_url_entreprise=$row['ent_url_entreprise'];
        $item->ent_telephone_entreprise=$row['ent_telephone_entreprise'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_entreprise']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['ent_nom_entreprise']=$item->ent_nom_entreprise;
        $retval['ent_nom_commercial']=$item->ent_nom_commercial;
        $retval['ent_siret']=$item->ent_siret;
        $retval['ent_activite']=$item->ent_activite;
        $retval['ent_profil']= $item->ent_profil;
        $retval['ent_stagiaires_recus']=$item->ent_stagiaires_recus;
        $retval['ent_commentaire']=$item->ent_commentaire;
        $retval['ent_date_enregistrement']=$item->ent_date_enregistrement;
        $retval['ent_adresse1_entreprise']=$item->ent_adresse1_entreprise;
        $retval['ent_adresse2_entreprise']=$item->ent_adresse2_entreprise;
        $retval['ent_ville_entreprise']=$item->ent_ville_entreprise;
        $retval['ent_cp_entreprise']=$item->ent_cp_entreprise;
        $retval['ent_pays_entreprise']=$item->ent_pays_entreprise;
        $retval['ent_url_entreprise']= $item->ent_url_entreprise;
        $retval['ent_telephone_entreprise']=$item->ent_telephone_entreprise;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_entreprise']=$item->id_entreprise;//PrK
        $retval['ent_nom_entreprise']=$item->ent_nom_entreprise;
        $retval['ent_nom_commercial']=$item->ent_nom_commercial;
        $retval['ent_siret']=$item->ent_siret;
        $retval['ent_activite']=$item->ent_activite;
        $retval['ent_profil']= $item->ent_profil;
        $retval['ent_stagiaires_recus']=$item->ent_stagiaires_recus;
        $retval['ent_commentaire']=$item->ent_commentaire;
        $retval['ent_date_enregistrement']=$item->ent_date_enregistrement;
        $retval['ent_adresse1_entreprise']=$item->ent_adresse1_entreprise;
        $retval['ent_adresse2_entreprise']=$item->ent_adresse2_entreprise;
        $retval['ent_ville_entreprise']=$item->ent_ville_entreprise;
        $retval['ent_cp_entreprise']=$item->ent_cp_entreprise;
        $retval['ent_pays_entreprise']=$item->ent_pays_entreprise;
        $retval['ent_url_entreprise']= $item->ent_url_entreprise;
        $retval['ent_telephone_entreprise']=$item->ent_telephone_entreprise;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_entreprise'] = $item->id_entreprise;
        return $retval;
    }

    static function GetID($item){
        return $item->id_entreprise;
    }

    static function SetID($item,$id){
        $item->id_entreprise=$id;
    }
}
