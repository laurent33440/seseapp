<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Attitude_professionnelle_evaluee;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of Attitude_professionnelle_evalueeMappingProvider
 *
 * @author laurent
 */
class Attitude_professionnelle_evalueeMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_attitude_professionnelle_evaluee= $row['id_attitude_professionnelle_evaluee'];
        $item->aproeva_critere= $row['aproeva_critere'];
        $item->aproeva_choix= $row['aproeva_choix'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_attitude_professionnelle_evaluee_evaluee']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval[':aproeva_critere']=$item->aproeva_critere;
        $retval[':aproeva_choix']=$item->aproeva_choix;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval[':id_attitude_professionnelle_evaluee']=$item->id_attitude_professionnelle_evaluee;
        $retval[':aproeva_critere']=$item->aproeva_critere;
        $retval[':aproeva_choix']=$item->aproeva_choix;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_attitude_professionnelle_evaluee'] = $item->id_attitude_professionnelle_evaluee;
        return $retval;
    }

    static function GetID($item){
        return $item->id_attitude_professionnelle_evaluee;
    }

    static function SetID($item,$id){
        $item->id_attitude_professionnelle_evaluee=$id;
    }
}
