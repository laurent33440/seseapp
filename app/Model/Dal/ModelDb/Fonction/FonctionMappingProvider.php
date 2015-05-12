<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Fonction;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of FonctionMappingProvider
 *
 * @author laurent
 */
class FonctionMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_fonction= $row['id_fonction'];
        $item->f_description= $row['f_description'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_fonction']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['f_description']=$item->f_description;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_fonction']=$item->id_fonction;
        $retval['f_description']=$item->f_description;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_fonction'] = $item->id_fonction;
        return $retval;
    }

    static function GetID($item){
        return $item->id_fonction;
    }

    static function SetID($item,$id){
        $item->id_fonction=$id;
    }
}
