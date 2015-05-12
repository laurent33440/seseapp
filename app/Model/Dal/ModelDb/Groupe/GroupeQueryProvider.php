<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Groupe;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of GroupeQueryProvider
 *
 * @author laurent
 */
class GroupeQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Groupe(grp_nom_groupe) values(:grp_nom_groupe)";
    }

    static function SelectByIDQuery(){
        return "Select * from Groupe where id_groupe = :id_groupe";
    }
    
    static function SelectByValueQuery($column){
            return "Select * from Groupe where $column=:$column";
	}

    static function SelectAllQuery(){
        return "Select * from Groupe";
    }

    static function SelectIDQuery(){
        return "Select max(id_groupe) from Groupe";
    }

    static function UpdateQuery(){
        return "update Groupe set grp_nom_groupe = :grp_nom_groupe where id_groupe = :id_groupe";
    }

    static function DeleteQuery(){
        return "delete from Groupe where id_groupe = :id_groupe";
    }
}
