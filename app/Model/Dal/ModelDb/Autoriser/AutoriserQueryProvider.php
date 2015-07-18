<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Autoriser;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of AutoriserQueryProvider
 *
 * @author laurent
 */
class AutoriserQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Autoriser(id_groupe, id_page, type_droit) values(:id_groupe, :id_page, :type_droit)";
    }

    static function SelectByIDQuery(){
        return "Select * from Autoriser where id_groupe = :id_groupe AND id_page = :id_page";
    }
    
    static function SelectByValueQuery($column){
            return "Select * from Autoriser where $column=:$column";
	}

    static function SelectAllQuery(){
        return "Select * from Autoriser";
    }

    static function SelectIDQuery(){
        return "Select max(id_groupe) from Autoriser";
    }

    static function UpdateQuery(){
        return "update Autoriser set type_droit = :type_droit where id_groupe = :id_groupe AND id_page = :id_page";
    }

    static function DeleteQuery(){
        return "delete from Autoriser where id_groupe = :id_groupe AND id_page = :id_page";
    }
}
