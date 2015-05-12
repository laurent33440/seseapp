<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Groupe;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of GroupeMappingProvider
 *
 * @author laurent
 */
class GroupeMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
            $item->id_groupe = $row['id_groupe'];
            $item->grp_nom_groupe = $row['grp_nom_groupe'];
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
        $retval['grp_nom_groupe']=$item->grp_nom_groupe;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_groupe']=$item->id_groupe;
        $retval['grp_nom_groupe']=$item->grp_nom_groupe;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_groupe'] = $item->id_groupe;
        return $retval;
    }

    static function GetID($item){
        return $item->id_groupe;
    }

    static function SetID($item,$id){
        $item->id_groupe=$id;
    }
}
