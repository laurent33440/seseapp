<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Collaborateur;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of CollaborateurQueryProvider
 *
 * @author laurent
 */
class CollaborateurQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Collaborateur(
                             col_civilite ,
                             col_nom ,
                             col_prenom ,
                             col_mel ,
                             col_tel ,
                             col_role_entreprise ,
                             col_compte ) "
            . "values(
                        :col_civilite,
                        :col_nom,
                        :col_prenom,
                        :col_mel,
                        :col_tel,
                        :col_role_entreprise,
                        :col_compte)";
    }

    static function SelectByIDQuery(){
        return "Select * from Collaborateur where id_collaborateur = :id_collaborateur";
    }
    
    static function SelectByValueQuery($column){
            return "Select * from Collaborateur where $column=:$column";
	}

    static function SelectAllQuery(){
        return "Select * from Collaborateur";
    }

    static function SelectIDQuery(){
        return "Select max(id_collaborateur) from Collaborateur";
    }

    static function UpdateQuery(){
            return "update Collaborateur set col_civilite=:col_civilite,
                                            col_nom=:col_nom,
                                            col_prenom=:col_prenom,
                                            col_mel=:col_mel,
                                            col_tel=:col_tel,
                                            col_role_entreprise=:col_role_entreprise,
                                            col_compte =:col_compte "
        . "where id_collaborateur = :id_collaborateur";
    }

    static function DeleteQuery(){
        return "delete from Collaborateur where id_collaborateur = :id_collaborateur";
    }
}
