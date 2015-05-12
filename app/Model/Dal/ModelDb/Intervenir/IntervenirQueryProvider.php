<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Intervenir;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of IntervenirQueryProvider
 *
 * @author laurent
 */
class IntervenirQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
        return "Insert into Intervenir (id_promotion,
                                        id_enseignant,) "
                              . "values(:id_promotion,
                                        :id_enseignant,) ";
    }

    static function SelectByIDQuery(){
        return "Select * from Intervenir where id_promotion=:id_promotion AND id_enseignant = :id_enseignant";
    }

    static function SelectAllQuery(){
        return "Select * from Intervenir";
    }

    static function SelectIDQuery(){
        return "Select max(id_promotion,id_enseignant) from Intervenir";
    }

    static function UpdateQuery(){
        return "update Intervenir set   id_promotion=:id_promotion,
                                        id_enseignant=:id_enseignant,
                                        "
            . "where id_promotion=:id_promotion AND id_enseignant = :id_enseignant";
    }

    static function DeleteQuery(){
        return "delete from Intervenir where id_promotion=:id_promotion AND id_enseignant = :id_enseignant";
    }
}
