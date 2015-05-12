<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Utilisateurs;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of UtilisateursQueryProvider
 *
 * @author laurent
 */
class UtilisateursQueryProvider implements IQueryProvider{
    
	static function InsertQuery(){
            return "Insert into Utilisateurs(uti_identifiant,uti_mot_de_passe, uti_mel, uti_etat_compte, uti_derniere_connexion, id_groupe)
                              values(:uti_identifiant,:uti_mot_de_passe, :uti_mel, :uti_etat_compte, :uti_derniere_connexion, :id_groupe)";
        }

	static function SelectByIDQuery(){
            return "Select * from Utilisateurs where id_utilisateur=:id_utilisateur";
	}
        
        static function SelectByValueQuery($column){
            return "Select * from Utilisateurs where $column=:$column";
	}

	static function SelectAllQuery(){
            return "Select * from Utilisateurs";
	}

	static function SelectIDQuery(){
            return "Select max(id_utilisateur) from Utilisateurs";
	}

	static function UpdateQuery(){
            return "update Utilisateurs set uti_identifiant = :uti_identifiant,
                                            uti_mot_de_passe = :uti_mot_de_passe, 
                                            uti_mel=:uti_mel, 
                                            uti_etat_compte = :uti_etat_compte, 
                                            uti_derniere_connexion=:uti_derniere_connexion, 
                                            id_groupe = :id_groupe
                                        where id_utilisateur=:id_utilisateur";
	}

	static function DeleteQuery(){
            return "delete from Utilisateurs where id_utilisateur=:id_utilisateur";
	}
        
}
