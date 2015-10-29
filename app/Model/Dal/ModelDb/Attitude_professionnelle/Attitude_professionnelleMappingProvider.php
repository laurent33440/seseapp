<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Attitude_professionnelle;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of Attitude_professionnelleMappingProvider
 *
 * @author laurent
 */
class Attitude_professionnelleMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_attitude_professionnelle= $row['id_attitude_professionnelle'];
        $item->apro_critere= $row['apro_critere'];
        $item->apro_choix= $row['apro_choix'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_attitude_professionnelle']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval[':apro_critere']=$item->apro_critere;
        $retval[':apro_choix']=$item->apro_choix;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval[':id_attitude_professionnelle']=$item->id_attitude_professionnelle;
        $retval[':apro_critere']=$item->apro_critere;
        $retval[':apro_choix']=$item->apro_choix;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_attitude_professionnelle'] = $item->id_attitude_professionnelle;
        return $retval;
    }

    static function GetID($item){
        return $item->id_attitude_professionnelle;
    }

    static function SetID($item,$id){
        $item->id_attitude_professionnelle=$id;
    }
}
