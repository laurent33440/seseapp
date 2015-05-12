<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Utilisateurs;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of UtilisateursMappingProvider
 *
 * @author laurent
 */

class UtilisateursMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_utilisateur = $row['id_utilisateur'];
        $item->uti_identifiant = $row['uti_identifiant'];
        $item->uti_mot_de_passe = $row['uti_mot_de_passe'];
        $item->uti_mel = $row['uti_mel'];
        $item->uti_etat_compte = $row['uti_etat_compte'];
        $item->uti_derniere_connexion = $row['uti_derniere_connexion'];
        $item->id_groupe = $row['id_groupe'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_utilisateur']=$id;
        return $retval;
    }
        
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['uti_identifiant']=$item->uti_identifiant;
        $retval['uti_mot_de_passe']=$item->uti_mot_de_passe;
        $retval['uti_mel']=$item->uti_mel;
        $retval['uti_etat_compte']=$item->uti_etat_compte;
        $retval['uti_derniere_connexion']=$item->uti_derniere_connexion;
        $retval['id_groupe']=$item->id_groupe;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_utilisateur']=$item->id_utilisateur;
        $retval['uti_identifiant']=$item->uti_identifiant;
        $retval['uti_mot_de_passe']=$item->uti_mot_de_passe;
        $retval['uti_mel']=$item->uti_mel;
        $retval['uti_etat_compte']=$item->uti_etat_compte;
        $retval['uti_derniere_connexion']=$item->uti_derniere_connexion;
        $retval['id_groupe']=$item->id_groupe;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_utilisateur'] = $item->id_utilisateur;
        return $retval;
    }

    static function GetID($item){
        return $item->id_utilisateur;
    }

    static function SetID($item,$id){
        $item->id_utilisateur=$id;
    }
}
