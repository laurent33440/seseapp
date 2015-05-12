<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Constituer;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of ConstituerQueryProvider
 *
 * @author laurent
 */
class ConstituerQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Competence (
                                        id_activite,
                                        id_competence
                                         )
                                      
                          values(
                                        :id_activite,
                                        :id_competence
                )";
    }

    static function SelectByIDQuery(){
        return "Select * from Competence where id_activite=:id_activite AND id_competence=:id_competence";
    }

    static function SelectByValueQuery($column){
        return "Select * from Competence where $column=:$column";
    }

    static function SelectAllQuery(){
        return "Select * from Competence";
    }

    static function SelectIDQuery(){
        return "Select max(id_activite) from Competence";
    }

    static function UpdateQuery(){
        return "update Competence set    
                                        id_activite=:id_activite,
                                        id_competence=:id_competence
                                    where id_activite=:id_activite AND id_competence=:id_competence";
    }

    static function DeleteQuery(){
        return "delete from Competence where id_activite=:id_activite AND id_competence=:id_competence";
    }
}
