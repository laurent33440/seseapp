<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Parametres;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of ParametresMappingProvider
 *
 * @author laurent
 */
class ParametresMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_parametre = $row['id_parametre'];
        $item->par_code_parametre = $row['par_code_parametre'];
        $item->par_libelle_parametre = $row['par_libelle_parametre'];
        $item->par_valeur_parametre = $row['par_valeur_parametre'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_parametre']=$id;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['par_code_parametre']=$item->par_code_parametre;
        $retval['par_libelle_parametre']=$item->par_libelle_parametre;
        $retval['par_valeur_parametre']=$item->par_valeur_parametre;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_parametre']=$item->id_parametre;
        $retval['par_code_parametre']=$item->par_code_parametre;
        $retval['par_libelle_parametre']=$item->par_libelle_parametre;
        $retval['par_valeur_parametre']=$item->par_valeur_parametre;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_parametre'] = $item->id_parametre;
        return $retval;
    }

    static function GetID($item){
        return $item->id_parametre;
    }

    static function SetID($item,$id){
        $item->id_parametre=$id;
    }
}
