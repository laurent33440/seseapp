<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Documents_reference;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of Documents_referenceMappingProvider
 *
 * @author laurent
 */
class Documents_referenceMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_documents_reference= $row['id_documents_reference'];
        $item->drf_sujet= $row['drf_sujet'];
        $item->drf_description_doc= $row['drf_description_doc'];
        $item->id_referentiel_de_formation= $row['id_referentiel_de_formation'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_documents_reference']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['drf_sujet']=$item->drf_sujet;
        $retval['drf_description_doc'] = $item->drf_description_doc;
        $retval['id_referentiel_de_formation']=$item->id_referentiel_de_formation;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_documents_reference']=$item->id_documents_reference;
        $retval['drf_sujet']=$item->drf_sujet;
        $retval['drf_description_doc'] = $item->drf_description_doc;
        $retval['id_referentiel_de_formation']=$item->id_referentiel_de_formation;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_documents_reference'] = $item->id_documents_reference;
        $retval[':drf_sujet'] = $item->drf_sujet;
        $retval[':drf_description_doc'] = $item->drf_description_doc;
        $retval[':id_referentiel_de_formation']=$item->id_referentiel_de_formation;
        return $retval;
    }

    static function GetID($item){
        return $item->id_documents_reference;
    }

    static function SetID($item,$id){
        $item->id_documents_reference=$id;
    }
}
