<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Collaborateur;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of CollaborateurMappingProvider
 *
 * @author laurent
 */
class CollaborateurMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_collaborateur=$row['id_collaborateur'];
        $item->col_civilite=$row['col_civilite'];
        $item->col_nom=$row['col_nom'];
        $item->col_prenom=$row['col_prenom'];
        $item->col_mel=$row['col_mel'];
        $item->col_tel=$row['col_tel'];
        $item->col_role_entreprise=$row['col_role_entreprise'];
        $item->col_compte=$row['col_compte'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_collaborateur']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['col_civilite']= $item->col_civilite;
        $retval['col_nom']=$item->col_nom;
        $retval['col_prenom']= $item->col_prenom;
        $retval['col_mel']=$item->col_mel;
        $retval['col_tel']= $item->col_tel;
        $retval['col_role_entreprise']=$item->col_role_entreprise;
        $retval['col_compte']=$item->col_compte;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_collaborateur']=$item->id_collaborateur;
        $retval['col_civilite']= $item->col_civilite;
        $retval['col_nom']=$item->col_nom;
        $retval['col_prenom']= $item->col_prenom;
        $retval['col_mel']=$item->col_mel;
        $retval['col_tel']= $item->col_tel;
        $retval['col_role_entreprise']=$item->col_role_entreprise;
        $retval['col_compte']=$item->col_compte;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_collaborateur'] = $item->id_collaborateur;
        return $retval;
    }

    static function GetID($item){
        return $item->id_collaborateur;
    }

    static function SetID($item,$id){
        $item->id_collaborateur=$id;
    }
}
