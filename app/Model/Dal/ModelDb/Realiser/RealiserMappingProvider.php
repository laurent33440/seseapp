<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Realiser;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of RealiserMappingProvider
 *
 * @author laurent
 */
class RealiserMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_stagiaire=$row['id_stagiaire'];
        $item->id_stage_defini=$row['id_stage_defini'];
    }

    static function MapToRowGetByID( $id ){ // FIXME composite key??? 
        $retval [':id_stage_defini']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }
    
    static function MapToRowGetByCompositeKeys(array $keys){
        foreach ($keys as $key) {
            $retval [":$key"]=$key;
        }
        return $retval;
    }

    Static function MapToRowInsert($item){ //idem update
        $retval['id_stagiaire']=$item->id_stagiaire;
        $retval['id_stage_defini']=$item->id_stage_defini;
        return $retval;
    }

    static function MapToRowUpdate($item){//idem insert
        $retval['id_stagiaire']=$item->id_stagiaire;
        $retval['id_stage_defini']=$item->id_stage_defini;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval['id_stagiaire']=$item->id_stagiaire;
        $retval[':id_stage_defini'] = $item->id_stage_defini;
        return $retval;
    }

    static function GetID($item){ // FIXME composite key??? 
        return $item->id_stage_defini;
    }
 
    static function SetID($item,$id){ // FIXME composite key??? 
        $item->id_stage_defini=$id;
    }
}
