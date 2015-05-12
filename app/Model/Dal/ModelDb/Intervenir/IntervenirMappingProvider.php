<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Intervenir;

use Model\Dal\DbLibrary\IMappingProvider;


/**
 * Description of IntervenirMappingProvider
 *
 * @author laurent
 */
class IntervenirMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_promotion=$row['id_promotion'];
        $item->id_enseignant=$row['id_enseignant'];
    }

    static function MapToRowGetByID( $id ){ // FIXME composite key??? 
        $retval [':id_enseignant']=$id;
        return $retval;
    }

    Static function MapToRowInsert($item){ // FIXME just composite key .......
        $retval['id_promotion']=$item->id_promotion;
        $retval['id_enseignant']=$item->id_enseignant;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_promotion']=$item->id_promotion;
        $retval['id_enseignant']=$item->id_enseignant;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval['id_promotion']=$item->id_promotion;
        $retval[':id_enseignant'] = $item->id_enseignant;
        return $retval;
    }

    static function GetID($item){ // FIXME composite key??? 
        return $item->id_enseignant;
    }
 
    static function SetID($item,$id){ // FIXME composite key??? 
        $item->id_enseignant=$id;
    }
}
