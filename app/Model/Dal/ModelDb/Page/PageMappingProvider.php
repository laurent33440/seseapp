<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Page;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of PageMappingProvider
 *
 * @author laurent
 */
class PageMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){ 
            $item->id_page = $row['id_page'];
            $item->pge_nom_page = $row['pge_nom_page'];
        }

    static function MapToRowGetByID( $id ){
        $retval [':id_page']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        
        $retval['id_page']=$item->id_page;
        $retval['pge_nom_page']=$item->pge_nom_page;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_page']=$item->id_page;
        $retval['pge_nom_page']=$item->pge_nom_page;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval['id_page']=$item->id_page;
        $retval['pge_nom_page']=$item->pge_nom_page;
        return $retval;
    }
    
    static function MapToRowGetByCompositeKeys($keys){
        foreach ($keys as $key => $value) {
            $retval [":$key"]=$value;
        }
        return $retval;
    }

    static function GetID($item){
        return $item->id_page;
    }

    static function SetID($item,$id){
        $item->id_page=$id;
    }
}
