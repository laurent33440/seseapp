<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Reference;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of ReferenceQueryProvider
 *
 * @author laurent
 */
class ReferenceQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Reference (ref_type, ref_code, ref_libelle) "
                                  . "values(:ref_type, :ref_code, :ref_libelle)";
    }

    static function SelectByIDQuery(){
        return "Select * from Reference where id_reference = :id_reference";
    }

    static function SelectAllQuery(){
        return "Select * from Reference";
    }

    static function SelectIDQuery(){
        return "Select max(id_reference) from Reference";
    }
    
     static function SelectByValueQuery($column){
            return "Select * from Reference where $column=:$column";
	}

    static function UpdateQuery(){
        return "update Reference set ref_type = :ref_type, ref_code = :ref_code, ref_libelle = :ref_libelle"
            . " where id_reference = :id_reference";
    }

    static function DeleteQuery(){
        return "delete from Reference where id_reference = :id_reference";
    }
}
