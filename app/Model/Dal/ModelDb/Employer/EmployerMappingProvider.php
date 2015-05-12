<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Employer;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of EmployerMappingProvider
 *
 * @author laurent
 */
class EmployerMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_entreprise=$row['id_entreprise'];
        $item->id_collaborateur=$row['id_collaborateur'];
    }

    static function MapToRowGetByID( $id ){ // FIXME composite key??? 
        $retval [':id_collaborateur']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){ // FIXME just composite key .......
        $retval['id_entreprise']=$item->id_entreprise;
        $retval['id_collaborateur']=$item->id_collaborateur;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_entreprise']=$item->id_entreprise;
        $retval['id_collaborateur']=$item->id_collaborateur;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval['id_entreprise']=$item->id_entreprise;
        $retval[':id_collaborateur'] = $item->id_collaborateur;
        return $retval;
    }

    static function GetID($item){ // FIXME composite key??? 
        return $item->id_collaborateur;
    }
 
    static function SetID($item,$id){ // FIXME composite key??? 
        $item->id_collaborateur=$id;
    }
}
