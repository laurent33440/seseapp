<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Autoriser;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of AutoriserMappingProvider
 *
 * @author laurent
 */
class AutoriserMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
            $item->id_groupe = $row['id_groupe'];
            $item->id_page = $row['id_page'];
            $item->type_droit = $row['type_droit'];
        }

    static function MapToRowGetByID( $id ){
        $retval [':id_groupe']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['id_groupe']=$item->id_groupe;
        $retval['id_page']=$item->id_page;
        $retval['type_droit']=$item->type_droit;
        
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_groupe']=$item->id_groupe;
        $retval['id_page']=$item->id_page;
        $retval['type_droit']=$item->type_droit;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval['id_page']=$item->id_page;
        $retval[':id_groupe'] = $item->id_groupe;
        $retval['type_droit']=$item->type_droit;
        return $retval;
    }
    
    static function MapToRowGetByCompositeKeys($keys){
        foreach ($keys as $key => $value) {
            $retval [":$key"]=$value;
        }
        return $retval;
    }

    static function GetID($item){
        return $item->id_groupe;
    }

    static function SetID($item,$id){
        $item->id_groupe=$id;
    }
}
