<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Constituer;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of ConstituerMappingProvider
 *
 * @author laurent
 */
class ConstituerMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_competence= $row['id_competence'];
        $item->id_activite= $row['id_activite'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_competence']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval[':id_competence']=$item->id_competence;
        $retval[':id_activite']=$item->id_activite;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval[':id_competence']=$item->id_competence;
        $retval[':id_activite']=$item->id_activite;
        return $retval;
    }
    
    static function MapToRowInnerSelfUpdate($item, array $selector){
        $retval[':id_competence']=$item->id_competence;
        $retval[':id_activite']=$item->id_activite;
        foreach ($selector as $key => $value) {
            $retval [":$key"]=$value;
        }
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_competence'] = $item->id_competence;
        $retval[':id_activite'] = $item->id_activite;
        return $retval;
    }
    
    static function MapToRowGetByCompositeKeys($keys){
        foreach ($keys as $key => $value) {
            $retval [":$key"]=$value;
        }
        return $retval;
    }

    static function GetID($item){
        return $item->id_competence;
    }

    static function SetID($item,$id){
        $item->id_competence=$id;
    }
}
