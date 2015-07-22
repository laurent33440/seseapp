<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Reference;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of ReferenceMappingProvider
 *
 * @author laurent
 */
class ReferenceMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_reference = $row['id_reference'];
        $item->ref_type = $row['ref_type'];
        $item->ref_code = $row['ref_code'];
        $item->ref_libelle = $row['ref_libelle'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_reference']=$id;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['ref_type']=$item->ref_type;
        $retval['ref_code']=$item->ref_code;
        $retval['ref_libelle']=$item->ref_libelle;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_reference']=$item->id_reference;
        $retval['ref_type']=$item->ref_type;
        $retval['ref_code']=$item->ref_code;
        $retval['ref_libelle']=$item->ref_libelle;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_reference'] = $item->id_reference;
        return $retval;
    }

    static function GetID($item){
        return $item->id_reference;
    }

    static function SetID($item,$id){
        $item->id_reference=$id;
    }
}
