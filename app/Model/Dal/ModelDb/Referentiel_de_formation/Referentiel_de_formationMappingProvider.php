<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Referentiel_de_formation;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of Referentiel_de_formationMappingProvider
 *
 * @author laurent
 */
class Referentiel_de_formationMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_referentiel_de_formation = $row['id_referentiel_de_formation'];
        $item->rdf_nom_formation=$row['rdf_nom_formation'];
        $item->rdf_domaine_formation=$row['rdf_domaine_formation'];
        $item->rdf_reference=$row['rdf_reference'];
        $item->rdf_intitule=$row['rdf_intitule'];
        $item->rdf_descriptif=$row['rdf_descriptif'];
        $item->rdf_duree_formation=$row['rdf_duree_formation'];
        $item->rdf_nombre_jours_stage=$row['rdf_nombre_jours_stage'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_referentiel_de_formation']=$id;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['rdf_nom_formation']=$item->rdf_nom_formation;
        $retval['rdf_domaine_formation']=$item->rdf_domaine_formation;
        $retval['rdf_reference']=$item->rdf_reference;
        $retval['rdf_intitule']=$item->rdf_intitule;
        $retval['rdf_descriptif']=$item->rdf_descriptif;
        $retval['rdf_duree_formation']=$item->rdf_duree_formation;
        $retval['rdf_nombre_jours_stage']=$item->rdf_nombre_jours_stage;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_referentiel_de_formation']=$item->id_referentiel_de_formation;
        $retval['rdf_nom_formation']=$item->rdf_nom_formation;
        $retval['rdf_domaine_formation']=$item->rdf_domaine_formation;
        $retval['rdf_reference']=$item->rdf_reference;
        $retval['rdf_intitule']=$item->rdf_intitule;
        $retval['rdf_descriptif']=$item->rdf_descriptif;
        $retval['rdf_duree_formation']=$item->rdf_duree_formation;
        $retval['rdf_nombre_jours_stage']=$item->rdf_nombre_jours_stage;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_referentiel_de_formation'] = $item->id_referentiel_de_formation;
        return $retval;
    }

    static function GetID($item){
        return $item->id_referentiel_de_formation;
    }

    static function SetID($item,$id){
        $item->id_referentiel_de_formation=$id;
    }
}
