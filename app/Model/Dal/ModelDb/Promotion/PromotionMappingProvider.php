<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Promotion;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of PromotionMappingProvider
 *
 * @author laurent
 */
class PromotionMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_promotion = $row['id_promotion'];
        $item->pro_reference_promotion = $row['pro_reference_promotion'];
        $item->pro_nom_promotion = $row['pro_nom_promotion'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_promotion']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval[':pro_reference_promotion']=$item->pro_reference_promotion;
        $retval[':pro_nom_promotion']=$item->pro_nom_promotion;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval[':id_promotion']=$item->id_promotion;
        $retval[':pro_reference_promotion']=$item->pro_reference_promotion;
        $retval[':pro_nom_promotion']=$item->pro_nom_promotion;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_promotion'] = $item->id_promotion;
        return $retval;
    }

    static function GetID($item){
        return $item->id_promotion;
    }

    static function SetID($item,$id){
        $item->id_promotion=$id;
    }
}
