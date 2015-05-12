<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Realiser;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of RealiserQueryProvider
 *
 * @author laurent
 */
class RealiserQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Realiser (id_stagiaire,
                                        id_stage_defini,) "
                              . "values(:id_stagiaire,
                                        :id_stage_defini,) ";
    }

    static function SelectByIDQuery(){
        return "Select * from Realiser where id_stagiaire=:id_stagiaire AND id_stage_defini = :id_stage_defini";
    }
    
    static function SelectByValueQuery($column){
            return "Select * from Realiser where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Realiser";
    }

    static function SelectIDQuery(){//inutile 
        //return "Select max(id_stagiaire,id_stage_defini) from Realiser";
    }

    static function UpdateQuery(){
        return "update Realiser set   id_stagiaire=:id_stagiaire,
                                        id_stage_defini=:id_stage_defini,
                                        "
            . "where id_stagiaire=:id_stagiaire AND id_stage_defini = :id_stage_defini";
    }

    static function DeleteQuery(){
        return "delete from Realiser where id_stagiaire=:id_stagiaire AND id_stage_defini = :id_stage_defini";
    }
}
