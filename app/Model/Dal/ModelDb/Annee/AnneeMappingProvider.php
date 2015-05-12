<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Dal\ModelDb\Annee;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of AnneeMappingProvider
 *
 * @author laurent
 */
class AnneeMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
            $item->annee_scolaire = $row['annee_scolaire'];
        }

    static function MapToRowGetByID( $id ){
        $retval [':annee_scolaire']=$id;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['annee_scolaire']=$item->annee_scolaire;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['annee_scolaire']=$item->annee_scolaire;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':annee_scolaire'] = $item->annee_scolaire;
        return $retval;
    }

    static function GetID($item){
        return $item->annee_scolaire;
    }

    static function SetID($item,$id){
        $item->annee_scolaire=$id;
    }
}
